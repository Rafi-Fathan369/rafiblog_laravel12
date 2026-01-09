<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * ContentManagementController - Mengelola CRUD artikel
 * Hanya dapat diakses oleh admin yang sudah login
 * 
 * @author Rafi Fathan Gandari
 * @nim C2383207002
 * @class PTI 5A
 */
class ContentManagementController extends Controller
{
    /**
     * Menampilkan daftar semua artikel (admin view)
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Publication::query();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('publication_status', $request->status);
        }

        // Search berdasarkan title
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Urutkan terbaru dahulu
        $publications = $query->latest()
            ->paginate(10);

        return view('admin.content-list', compact('publications'));
    }

    /**
     * Menampilkan form create artikel
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.content-create');
    }

    /**
     * Menyimpan artikel baru ke database
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'published_date' => 'nullable|date',
            'publication_status' => 'required|in:draft,publish',
            'category' => 'required|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048' // Max 2MB
        ]);

        // Auto-generate slug dari title
        $validated['slug'] = Str::slug($validated['title']);

        // Cek uniqueness slug, tambahkan suffix jika duplikat
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Publication::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '-' . Str::slug($validated['title']) . '.' . $image->getClientOriginalExtension();
            
            // Simpan ke public/images/articles
            $image->move(public_path('images/articles'), $imageName);
            $validated['featured_image'] = 'images/articles/' . $imageName;
        }

        // Set default author (dari identitas mahasiswa)
        $validated['author_name'] = 'Rafi Fathan Gandari';
        $validated['author_nim'] = 'C2383207002';

        // Set published_date jika status publish
        if ($validated['publication_status'] === 'publish' && empty($validated['published_date'])) {
            $validated['published_date'] = now();
        }

        // Create publication
        $publication = Publication::create($validated);

        return redirect()
            ->route('admin.content.index')
            ->with('success', 'Artikel "' . $publication->title . '" berhasil dibuat!');
    }

    /**
     * Menampilkan form edit artikel
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $publication = Publication::findOrFail($id);
        
        return view('admin.content-edit', compact('publication'));
    }

    /**
     * Update artikel di database
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $publication = Publication::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:publications,slug,' . $id . ',publication_id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'published_date' => 'nullable|date',
            'publication_status' => 'required|in:draft,publish',
            'category' => 'required|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'remove_image' => 'nullable|boolean' // Untuk remove existing image
        ]);

        // Handle image removal
        if ($request->has('remove_image') && $request->remove_image) {
            if ($publication->featured_image && file_exists(public_path($publication->featured_image))) {
                unlink(public_path($publication->featured_image));
            }
            $validated['featured_image'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image jika ada
            if ($publication->featured_image && file_exists(public_path($publication->featured_image))) {
                unlink(public_path($publication->featured_image));
            }
            
            $image = $request->file('featured_image');
            $imageName = time() . '-' . Str::slug($validated['title']) . '.' . $image->getClientOriginalExtension();
            
            // Simpan ke public/images/articles
            $image->move(public_path('images/articles'), $imageName);
            $validated['featured_image'] = 'images/articles/' . $imageName;
        }

        // Jika status berubah ke publish dan belum ada tanggal publish
        if ($validated['publication_status'] === 'publish' && 
            empty($validated['published_date']) && 
            $publication->publication_status === 'draft') {
            $validated['published_date'] = now();
        }

        // Update publication
        $publication->update($validated);

        return redirect()
            ->route('admin.content.index')
            ->with('success', 'Artikel "' . $publication->title . '" berhasil diupdate!');
    }

    /**
     * Menghapus artikel dari database
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $publication = Publication::findOrFail($id);
        $title = $publication->title;

        // Delete featured image jika ada
        if ($publication->featured_image && file_exists(public_path($publication->featured_image))) {
            unlink(public_path($publication->featured_image));
        }

        // Soft delete
        $publication->delete();

        return redirect()
            ->route('admin.content.index')
            ->with('success', 'Artikel "' . $title . '" berhasil dihapus!');
    }

    /**
     * Preview artikel sebelum publish
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function preview(int $id)
    {
        $publication = Publication::findOrFail($id);
        $relatedPublications = Publication::published()
            ->where('publication_id', '!=', $id)
            ->latest()
            ->limit(3)
            ->get();

        return view('frontend.article-detail', compact('publication', 'relatedPublications'))
            ->with('preview_mode', true);
    }
}
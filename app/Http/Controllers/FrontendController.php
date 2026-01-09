<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

/**
 * FrontendController - Mengelola halaman publik RafiBlog
 * Menampilkan artikel untuk pengunjung umum
 * 
 * @author Rafi Fathan Gandari
 * @nim C2383207002
 * @class PTI 5A
 */
class FrontendController extends Controller
{
    /**
     * Menampilkan homepage dengan daftar artikel published
     * 
     * @return \Illuminate\View\View
     */
    public function home(Request $request)
    {
        // Query dasar
        $query = Publication::published()->latest();

        // 🔍 SEARCH (TAMBAHAN)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Filter by category jika ada
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Ambil artikel dengan pagination
        $publications = $query->paginate(9);

        // Statistik untuk hero section
        $totalArticles = Publication::published()->count();
        $totalViews = Publication::published()->sum('view_count');

        // Get all categories dengan jumlah artikel
        $categories = Publication::published()
            ->select('category', \DB::raw('count(*) as count'))
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();

        return view('frontend.home', compact(
            'publications',
            'totalArticles',
            'totalViews',
            'categories'
        ));
    }

    /**
     * Menampilkan detail artikel berdasarkan slug
     * 
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug)
    {
        // Cari artikel berdasarkan slug
        $publication = Publication::where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Increment view count
        $publication->incrementViews();

        // Artikel terkait
        $relatedPublications = Publication::published()
            ->where('publication_id', '!=', $publication->publication_id)
            ->latest()
            ->limit(3)
            ->get();

        return view('frontend.article-detail', compact('publication', 'relatedPublications'));
    }
}

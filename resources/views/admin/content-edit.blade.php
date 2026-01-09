@extends('admin.layouts.dashboard')

@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.content.update', $publication->publication_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
            <div class="p-6 space-y-6">
                <!-- Judul -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                        Judul Artikel <span class="text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title', $publication->title) }}"
                        required
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white text-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                        placeholder="Masukkan judul artikel..."
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-300 mb-2">
                        Slug URL <span class="text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="slug" 
                        name="slug" 
                        value="{{ old('slug', $publication->slug) }}"
                        required
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all font-mono text-sm"
                        placeholder="artikel-url-slug"
                    >
                    @error('slug')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Versi ramah URL dari judul (huruf kecil, tanda hubung, tanpa spasi)</p>
                </div>
                
                <!-- Ringkasan -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-300 mb-2">
                        Ringkasan (Opsional)
                    </label>
                    <textarea 
                        id="excerpt" 
                        name="excerpt" 
                        rows="3"
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all resize-none"
                        placeholder="Ringkasan singkat dari artikel..."
                    >{{ old('excerpt', $publication->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Gambar Unggulan -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Gambar Unggulan
                    </label>
                    
                    <!-- Gambar Saat Ini -->
                    @if($publication->featured_image)
                        <div class="mb-4">
                            <p class="text-sm text-gray-400 mb-2">Gambar Saat Ini:</p>
                            <div class="relative inline-block">
                                <img 
                                    src="{{ asset($publication->featured_image) }}" 
                                    alt="{{ $publication->title }}"
                                    class="w-full max-w-md h-48 object-cover rounded-lg"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/400x200/4F46E5/FFFFFF?text=Rafi+Blog';"
                                >
                                <label class="flex items-center mt-2">
                                    <input type="checkbox" name="remove_image" value="1" class="mr-2">
                                    <span class="text-sm text-red-400">Hapus gambar saat ini</span>
                                </label>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Unggah Gambar Baru -->
                    <div class="relative">
                        <input 
                            type="file" 
                            id="featured_image" 
                            name="featured_image" 
                            accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                            class="hidden"
                            onchange="previewImage(event)"
                        >
                        <label 
                            for="featured_image" 
                            class="flex items-center justify-center w-full px-4 py-6 bg-gray-900 border-2 border-dashed border-gray-600 rounded-lg cursor-pointer hover:border-indigo-500 transition-all"
                        >
                            <div class="text-center" id="upload-placeholder">
                                <svg class="w-10 h-10 mx-auto mb-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                                </svg>
                                <p class="text-gray-400 text-sm mb-1">Unggah gambar baru</p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP maksimal 2MB</p>
                            </div>
                        </label>
                        <!-- Pratinjau Gambar Baru -->
                        <div id="image-preview" class="hidden mt-4 relative">
                            <img src="" alt="Preview" class="w-full h-64 object-cover rounded-lg" id="preview-img">
                            <button 
                                type="button" 
                                onclick="removeNewImage()" 
                                class="absolute top-2 right-2 p-2 bg-red-600 hover:bg-red-700 text-white rounded-lg"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @error('featured_image')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Konten -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-300 mb-2">
                        Isi Artikel <span class="text-red-400">*</span>
                    </label>
                    <textarea 
                        id="content" 
                        name="content" 
                        rows="20"
                        required
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all font-mono text-sm resize-none"
                        placeholder="Tulis isi artikel di sini..."
                    >{{ old('content', $publication->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Kategori -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-300 mb-2">
                            Kategori <span class="text-red-400">*</span>
                        </label>
                        <select 
                            id="category" 
                            name="category" 
                            required
                            class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                        >
                            @foreach(\App\Models\Publication::getCategories() as $key => $label)
                                <option value="{{ $key }}" {{ old('category', $publication->category) === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Tanggal Publikasi -->
                    <div>
                        <label for="published_date" class="block text-sm font-medium text-gray-300 mb-2">
                            Tanggal Publikasi
                        </label>
                        <input 
                            type="date" 
                            id="published_date" 
                            name="published_date" 
                            value="{{ old('published_date', $publication->published_date ? $publication->published_date->format('Y-m-d') : '') }}"
                            class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                        >
                        @error('published_date')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="publication_status" class="block text-sm font-medium text-gray-300 mb-2">
                            Status Publikasi <span class="text-red-400">*</span>
                        </label>
                        <select 
                            id="publication_status" 
                            name="publication_status" 
                            required
                            class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                        >
                            <option value="draft" {{ old('publication_status', $publication->publication_status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publish" {{ old('publication_status', $publication->publication_status) === 'publish' ? 'selected' : '' }}>Publikasikan</option>
                        </select>
                        @error('publication_status')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Statistik Artikel -->
                <div class="bg-gray-900/50 rounded-lg p-4 border border-gray-700">
                    <h4 class="text-sm font-medium text-gray-300 mb-3">Statistik Artikel</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div>
                            <div class="text-2xl font-bold text-indigo-400">{{ $publication->view_count }}</div>
                            <div class="text-xs text-gray-500">Total Dilihat</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-purple-400">{{ $publication->reading_time }}</div>
                            <div class="text-xs text-gray-500">Menit Baca</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-green-400">{{ $publication->created_at->diffForHumans() }}</div>
                            <div class="text-xs text-gray-500">Dibuat</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-yellow-400">{{ $publication->updated_at->diffForHumans() }}</div>
                            <div class="text-xs text-gray-500">Diperbarui</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Aksi Form -->
            <div class="px-6 py-4 bg-gray-900/50 border-t border-gray-700 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.content.index') }}" class="inline-flex items-center px-6 py-2.5 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-all">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"/>
                        </svg>
                        Batal
                    </a>
                    
                    @if($publication->publication_status === 'publish')
                        <a href="{{ route('article.show', $publication->slug) }}" target="_blank" class="inline-flex items-center px-6 py-2.5 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-all">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                            </svg>
                            Lihat Publik
                        </a>
                    @else
                        <a href="{{ route('admin.content.preview', $publication->publication_id) }}" target="_blank" class="inline-flex items-center px-6 py-2.5 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-all">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            Pratinjau
                        </a>
                    @endif
                </div>
                
                <button type="submit" class="inline-flex items-center px-8 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    Perbarui Artikel
                </button>
            </div>
        </div>
    </form>
    
    <!-- Hapus Artikel -->
    <div class="mt-6 bg-red-900/20 border border-red-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-red-400 mb-2">Zona Berbahaya</h3>
        <p class="text-gray-400 text-sm mb-4">Setelah artikel dihapus, tindakan ini tidak dapat dibatalkan. Harap pastikan.</p>
        <form action="{{ route('admin.content.destroy', $publication->publication_id) }}" method="POST" onsubmit="return confirm('Apakah Anda benar-benar yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-all">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"/>
                </svg>
                Hapus Artikel
            </button>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
    
    function removeNewImage() {
        document.getElementById('featured_image').value = '';
        document.getElementById('image-preview').classList.add('hidden');
    }
</script>
@endsection

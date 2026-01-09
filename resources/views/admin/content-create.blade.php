@extends('admin.layouts.dashboard')

@section('title', 'Buat Artikel Baru')
@section('page-title', 'Buat Artikel Baru')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.content.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
            <div class="p-6 space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                        Judul Artikel <span class="text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title') }}"
                        required
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white text-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                        placeholder="Masukkan judul artikel..."
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Slug akan dibuat otomatis dari judul</p>
                </div>
                
                <!-- Excerpt -->
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
                    >{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Kosongkan untuk dibuat otomatis dari isi artikel (maksimal 150 karakter)</p>
                </div>
                
                <!-- Featured Image -->
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-300 mb-2">
                        Gambar Utama (Opsional)
                    </label>
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
                            class="flex items-center justify-center w-full px-4 py-8 bg-gray-900 border-2 border-dashed border-gray-600 rounded-lg cursor-pointer hover:border-indigo-500 transition-all"
                            id="image-upload-label"
                        >
                            <div class="text-center" id="upload-placeholder">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                                </svg>
                                <p class="text-gray-400 mb-1">Klik untuk mengunggah gambar</p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP maksimal 2MB</p>
                            </div>
                        </label>
                        <!-- Image Preview -->
                        <div id="image-preview" class="hidden mt-4 relative">
                            <img src="" alt="Pratinjau" class="w-full h-64 object-cover rounded-lg" id="preview-img">
                            <button 
                                type="button" 
                                onclick="removeImage()" 
                                class="absolute top-2 right-2 p-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all"
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
                
                <!-- Content -->
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
                        placeholder="Tulis isi artikel di sini... Anda dapat menggunakan tag HTML untuk pemformatan."
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Anda dapat menggunakan tag HTML: &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;, dll.</p>
                </div>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Category -->
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
                                <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Published Date -->
                    <div>
                        <label for="published_date" class="block text-sm font-medium text-gray-300 mb-2">
                            Tanggal Publikasi
                        </label>
                        <input 
                            type="date" 
                            id="published_date" 
                            name="published_date" 
                            value="{{ old('published_date', now()->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                        >
                        @error('published_date')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Kosongkan untuk menggunakan tanggal hari ini saat dipublikasikan</p>
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
                            <option value="draft" {{ old('publication_status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publish" {{ old('publication_status') === 'publish' ? 'selected' : '' }}>Publikasikan</option>
                        </select>
                        @error('publication_status')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Author Info (Read-only) -->
                <div class="bg-gray-900/50 rounded-lg p-4 border border-gray-700">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold mr-4">
                            R
                        </div>
                        <div>
                            <div class="text-sm text-gray-400">Penulis Artikel</div>
                            <div class="text-white font-medium">Rafi Fathan Gandari</div>
                            <div class="text-sm text-gray-500">C2383207002 | PTI 5A</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-900/50 border-t border-gray-700 flex items-center justify-between">
                <a href="{{ route('admin.content.index') }}" class="inline-flex items-center px-6 py-2.5 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-all">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"/>
                    </svg>
                    Batal
                </a>
                
                <button type="submit" class="inline-flex items-center px-8 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                    Buat Artikel
                </button>
            </div>
        </div>
    </form>
    
    <!-- HTML Formatting Guide -->
    <div class="mt-6 bg-gray-800 rounded-xl border border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Panduan Pemformatan HTML</h3>
        <div class="grid md:grid-cols-2 gap-4 text-sm">
            <div>
                <h4 class="text-indigo-400 font-medium mb-2">Judul</h4>
                <code class="block bg-gray-900 p-2 rounded text-gray-300 mb-1">&lt;h2&gt;Judul Utama&lt;/h2&gt;</code>
                <code class="block bg-gray-900 p-2 rounded text-gray-300">&lt;h3&gt;Sub Judul&lt;/h3&gt;</code>
            </div>
            <div>
                <h4 class="text-indigo-400 font-medium mb-2">Pemformatan Teks</h4>
                <code class="block bg-gray-900 p-2 rounded text-gray-300 mb-1">&lt;p&gt;Teks paragraf&lt;/p&gt;</code>
                <code class="block bg-gray-900 p-2 rounded text-gray-300">&lt;strong&gt;Tebal&lt;/strong&gt;</code>
            </div>
            <div>
                <h4 class="text-indigo-400 font-medium mb-2">Daftar</h4>
                <code class="block bg-gray-900 p-2 rounded text-gray-300">&lt;ul&gt;&lt;li&gt;Item&lt;/li&gt;&lt;/ul&gt;</code>
            </div>
            <div>
                <h4 class="text-indigo-400 font-medium mb-2">Tautan</h4>
                <code class="block bg-gray-900 p-2 rounded text-gray-300">&lt;a href="url"&gt;Tautan&lt;/a&gt;</code>
            </div>
        </div>
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
                document.getElementById('upload-placeholder').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
    
    function removeImage() {
        document.getElementById('featured_image').value = '';
        document.getElementById('image-preview').classList.add('hidden');
        document.getElementById('upload-placeholder').classList.remove('hidden');
    }
</script>
@endsection
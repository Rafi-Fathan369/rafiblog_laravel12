@extends('frontend.layouts.main')

@section('title', 'Rafi Blog - Home')

@section('content')
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
    
    @keyframes glow {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }
    
    @keyframes slide-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-glow {
        animation: glow 3s ease-in-out infinite;
    }
    
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient-shift 8s ease infinite;
    }
    
    .animate-slide-up {
        animation: slide-in-up 0.6s ease-out forwards;
    }
    
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }
    
    .card-3d {
        transform-style: preserve-3d;
        transition: transform 0.6s;
    }
    
    .card-3d:hover {
        transform: perspective(1000px) rotateY(5deg) rotateX(5deg);
    }
    
    .typing-cursor {
        animation: blink 1s infinite;
    }
    
    @keyframes blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0; }
    }
    
    .search-input:focus {
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
    
    /* Particle effect */
    .particle {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }
    
    @keyframes particle-float {
        0% {
            transform: translateY(0) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) translateX(100px);
            opacity: 0;
        }
    }
</style>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-gray-950 dark:via-indigo-950 dark:to-purple-950 py-24 md:py-32">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-30">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(99, 102, 241, 0.2) 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>
    
    <!-- Gradient Orbs with Animation -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-indigo-500/20 rounded-full filter blur-3xl animate-float animate-glow"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-500/20 rounded-full filter blur-3xl animate-float" style="animation-delay: 1s;"></div>
    <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-pink-500/20 rounded-full filter blur-3xl animate-float" style="animation-delay: 2s;"></div>
    
    <!-- Floating Icons -->
    <div class="absolute top-1/4 left-1/4 animate-float opacity-10 dark:opacity-20">
        <svg class="w-16 h-16 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/>
        </svg>
    </div>
    <div class="absolute bottom-1/4 right-1/4 animate-float opacity-10 dark:opacity-20" style="animation-delay: 1.5s;">
        <svg class="w-20 h-20 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z"/>
        </svg>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <div class="inline-block mb-4 animate-slide-up">
                <span class="px-4 py-2 rounded-full text-sm font-semibold bg-indigo-600/10 text-indigo-600 dark:bg-indigo-400/10 dark:text-indigo-400 border border-indigo-200 dark:border-indigo-800 hover:scale-110 transition-transform duration-300 inline-block">
                    ✨ Welcome to my blog
                </span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight animate-slide-up" style="animation-delay: 0.1s;">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 animate-gradient">
                    Rafi Blog
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-10 max-w-3xl mx-auto font-light animate-slide-up" style="animation-delay: 0.2s;">
                Temukan artikel-artikel yang penuh wawasan tetang <span class="font-semibold text-indigo-600 dark:text-indigo-400">pengembangan web</span>, <span class="font-semibold text-purple-600 dark:text-purple-400">Pemrograman</span>, dan <span class="font-semibold text-pink-600 dark:text-pink-400">teknologi</span>
            </p>
            
            <!-- Stats -->
            <div class="flex flex-wrap justify-center gap-6 mb-8">
                <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl px-8 py-6 border border-gray-200/50 dark:border-gray-700/50 shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 animate-slide-up" style="animation-delay: 0.3s;">
                    <div class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 animate-pulse">{{ $totalArticles }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400 font-medium mt-1">Articles Published</div>
                </div>
                <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl px-8 py-6 border border-gray-200/50 dark:border-gray-700/50 shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 animate-slide-up" style="animation-delay: 0.4s;">
                    <div class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-pink-600 animate-pulse">{{ number_format($totalViews) }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400 font-medium mt-1">Total Views</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Bar -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 mb-6 relative z-20 animate-slide-up" style="animation-delay: 0.5s;">
    <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl border border-gray-200/50 dark:border-gray-700/50 p-6 shadow-2xl">
        <form action="{{ route('home') }}" method="GET" class="relative">
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl opacity-0 group-hover:opacity-20 blur transition-opacity duration-300"></div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="🔍 Search articles by title, category, or content..." 
                    class="search-input w-full pl-14 pr-32 py-5 rounded-2xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-0 outline-none transition-all duration-300 text-lg font-medium"
                    style="position: relative; z-index: 10;" 
                >
                <div class="absolute left-5 top-1/2 -translate-y-1/2">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-indigo-500 transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"/>
                    </svg>
                </div>
                <button 
                    type="submit" 
                    class="absolute right-3 top-1/2 -translate-y-1/2 px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl hover:shadow-indigo-500/50 flex items-center gap-2"
                >
                    <span>Search</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"/>
                    </svg>
                </button>
            </div>
            @if(request('search'))
                <div class="mt-4 flex items-center justify-between bg-indigo-50 dark:bg-indigo-900/30 rounded-xl p-3 border border-indigo-200 dark:border-indigo-700">
                    <span class="text-sm text-indigo-700 dark:text-indigo-300">
                        🎯 Searching for: <strong>"{{ request('search') }}"</strong>
                    </span>
                    <a href="{{ route('home') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-semibold flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"/>
                        </svg>
                        Clear
                    </a>
                </div>
            @endif
        </form>
    </div>
</section>

<!-- Category Filter -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 relative z-20 animate-slide-up" style="animation-delay: 0.6s;">
    <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl border border-gray-200/50 dark:border-gray-700/50 p-8 shadow-2xl relative overflow-hidden">
        <div class="absolute inset-0 shimmer-effect pointer-events-none"></div>
        <div class="flex items-center justify-between mb-6 relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center animate-pulse shadow-lg shadow-indigo-500/50">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Filter by Category</h3>
            </div>
            @if(request('category'))
                <a href="{{ route('home', ['search' => request('search')]) }}" class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-950 transition-all hover:scale-105">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"/>
                    </svg>
                    Clear Filter
                </a>
            @endif
        </div>
        <div class="flex flex-wrap gap-3 relative z-10">
            <a href="{{ route('home', ['search' => request('search')]) }}" 
               class="px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 hover:shadow-lg {{ !request('category') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-500/50 scale-105' : 'bg-gray-100 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 hover:scale-105' }}">
                All ({{ $totalArticles }})
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('home', ['category' => $cat->category, 'search' => request('search')]) }}" 
                   class="px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 hover:shadow-lg {{ request('category') === $cat->category ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-500/50 scale-105' : 'bg-gray-100 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 hover:scale-105' }}">
                    {{ $cat->category }} ({{ $cat->count }})
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Articles Grid -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if($publications->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($publications as $index => $publication)
                <article class="group card-3d bg-white dark:bg-gray-800 rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700/50 hover:border-transparent hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-500 hover:-translate-y-2 animate-slide-up" style="animation-delay: {{ 0.7 + ($index * 0.1) }}s;">
                    <!-- Featured Image -->
                    <div class="relative overflow-hidden">
                        @if($publication->featured_image)
                            <div class="aspect-video w-full overflow-hidden bg-gray-900 relative">
                                <img 
                                    src="{{ asset($publication->featured_image) }}" 
                                    alt="{{ $publication->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/800x450/4F46E5/FFFFFF?text=Rafi+Blog';"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>
                        @else
                            <div class="aspect-video w-full bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 animate-gradient flex items-center justify-center">
                                <svg class="w-20 h-20 text-white/30 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent opacity-60"></div>
                        
                        <!-- Category Badge on Image -->
                        <div class="absolute top-4 left-4 animate-slide-up">
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold {{ $publication->category_color }} text-white shadow-lg backdrop-blur-sm hover:scale-110 transition-transform duration-300">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                                {{ $publication->category }}
                            </span>
                        </div>
                        
                        <!-- View Count Badge -->
                        <div class="absolute top-4 right-4 animate-slide-up">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-black/40 backdrop-blur-md text-white">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                {{ $publication->view_count }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Card Content -->
                    <div class="p-6">
                        <!-- Meta Info Top -->
                        <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400 mb-4">
                            <span class="flex items-center gap-1.5 hover:text-indigo-500 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
                                </svg>
                                {{ $publication->formatted_date }}
                            </span>
                        </div>
                        
                        <!-- Title -->
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2 mb-3 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            {{ $publication->title }}
                        </h2>
                        
                        <!-- Excerpt -->
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 line-clamp-3 leading-relaxed">
                            {{ $publication->excerpt }}
                        </p>
                        
                        <!-- Footer -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-indigo-500 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                                </svg>
                                <span class="font-medium">{{ $publication->reading_time }} min</span>
                            </div>
                            
                            <a href="{{ route('article.show', $publication->slug) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 shadow-md hover:shadow-lg hover:shadow-indigo-500/50 transition-all duration-300 group/btn">
                                Read More
                                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-16 animate-slide-up" style="animation-delay: {{ 0.7 + ($publications->count() * 0.1) }}s;">
            {{ $publications->links('pagination::tailwind') }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-24 animate-slide-up">
            <div class="w-32 h-32 mx-auto mb-8 rounded-3xl bg-gradient-to-br from-indigo-500/10 to-purple-500/10 flex items-center justify-center border border-indigo-200 dark:border-indigo-800 animate-pulse">
                <svg class="w-16 h-16 text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"/>
                </svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-3">
                @if(request('search'))
                    No Results Found
                @else
                    No Articles Yet
                @endif
            </h3>
            <p class="text-lg text-gray-500 dark:text-gray-400 mb-6">
                @if(request('search'))
                    Try adjusting your search terms or browse all articles
                @else
                    Check back later for exciting new content!
                @endif
            </p>
            @if(request('search'))
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"/>
                    </svg>
                    Back to All Articles
                </a>
            @endif
        </div>
    @endif
</section>

<script>
    // Smooth scroll reveal animation
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.animate-slide-up').forEach(el => {
            observer.observe(el);
        });
    });

    // Add particle effect on hero section
    function createParticle() {
        const hero = document.querySelector('section');
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.width = Math.random() * 4 + 2 + 'px';
        particle.style.height = particle.style.width;
        particle.style.left = Math.random() * 100 + '%';
        particle.style.background = `rgba(${99 + Math.random() * 50}, ${102 + Math.random() * 50}, 241, 0.5)`;
        particle.style.animation = `particle-float ${15 + Math.random() * 10}s linear`;
        
        hero.appendChild(particle);
        
        setTimeout(() => {
            particle.remove();
        }, 25000);
    }

    setInterval(createParticle, 500);
</script>
@endsection
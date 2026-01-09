@extends('frontend.layouts.main')

@section('title', $publication->title . ' - Rafi Blog')

@section('content')
<!-- Article Header -->
<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Breadcrumb -->
    <nav class="mb-8 fade-in">
        <ol class="flex items-center space-x-2 text-sm text-gray-400">
            <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-500">Article</li>
        </ol>
    </nav>
    
    <!-- Article Meta -->
    <div class="mb-8 fade-in" style="animation-delay: 0.1s;">
        <!-- Featured Image -->
        @if($publication->featured_image)
            <div class="mb-8 rounded-2xl overflow-hidden">
                <img 
                    src="{{ asset($publication->featured_image) }}" 
                    alt="{{ $publication->title }}"
                    class="w-full h-auto max-h-[500px] object-cover"
                    onerror="this.onerror=null; this.src='https://via.placeholder.com/1200x600/4F46E5/FFFFFF?text=Rafi+Blog';"
                >
            </div>
        @endif
        
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
            {{ $publication->title }}
        </h1>
        
        <div class="flex flex-wrap items-center gap-6 text-gray-400 text-sm">
            <!-- Author -->
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold mr-3">
                    {{ substr($publication->author_name, 0, 1) }}
                </div>
                <div>
                    <div class="text-white font-medium">{{ $publication->author_name }}</div>
                    <div class="text-xs">{{ $publication->author_nim }}</div>
                </div>
            </div>
            
            <!-- Date -->
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
                </svg>
                {{ $publication->formatted_date }}
            </div>
            
            <!-- Reading Time -->
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                </svg>
                {{ $publication->reading_time }} min read
            </div>
            
            <!-- Views -->
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                {{ $publication->view_count }} views
            </div>
        </div>
    </div>
    
    <!-- Article Content -->
    <div class="prose prose-invert prose-lg max-w-none fade-in" style="animation-delay: 0.2s;">
        <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700">
            {!! $publication->content !!}
        </div>
    </div>
    
    <!-- Tags/Category (Optional Enhancement) -->
    <div class="mt-8 pt-8 border-t border-gray-800 fade-in" style="animation-delay: 0.3s;">
        <div class="flex items-center justify-between">
            <div class="text-gray-400 text-sm">
                Published by <span class="text-white font-medium">{{ $publication->author_name }}</span>
            </div>
            
            <a href="{{ route('home') }}" class="inline-flex items-center text-indigo-400 hover:text-indigo-300 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"/>
                </svg>
                Back to Home
            </a>
        </div>
    </div>
</article>

<!-- Related Articles -->
@if($relatedPublications->count() > 0)
<section class="bg-gray-950 border-t border-gray-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-white mb-8 fade-in">Related Articles</h2>
        
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($relatedPublications as $related)
                <a href="{{ route('article.show', $related->slug) }}" class="block card-hover bg-gray-800 rounded-xl overflow-hidden border border-gray-700 hover:border-indigo-500 fade-in">
                    @if($related->featured_image)
                        <div class="aspect-video w-full overflow-hidden bg-gray-900">
                            <img 
                                src="{{ asset($related->featured_image) }}" 
                                alt="{{ $related->title }}"
                                class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"
                                onerror="this.onerror=null; this.src='https://via.placeholder.com/400x225/4F46E5/FFFFFF?text=Rafi+Blog';"
                            >
                        </div>
                    @endif
                    <div class="p-6 bg-gradient-to-br from-indigo-600 to-purple-600">
                        <h3 class="font-bold text-white line-clamp-2">{{ $related->title }}</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-400 text-sm line-clamp-2 mb-4">{{ $related->excerpt }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>{{ $related->formatted_date }}</span>
                            <span>{{ $related->reading_time }} min read</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
    /* Prose Styling for Article Content */
    .prose-invert h2 {
        color: #fff;
        font-size: 1.875rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .prose-invert h3 {
        color: #e5e7eb;
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .prose-invert p {
        color: #d1d5db;
        line-height: 1.75;
        margin-bottom: 1rem;
    }
    .prose-invert ul, .prose-invert ol {
        color: #d1d5db;
        margin-left: 1.5rem;
        margin-bottom: 1rem;
    }
    .prose-invert li {
        margin-bottom: 0.5rem;
    }
    .prose-invert a {
        color: #818cf8;
        text-decoration: underline;
    }
    .prose-invert a:hover {
        color: #a5b4fc;
    }
    .prose-invert code {
        background-color: #1f2937;
        color: #f472b6;
        padding: 0.125rem 0.375rem;
        border-radius: 0.25rem;
        font-size: 0.875em;
    }
    .prose-invert pre {
        background-color: #111827;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin-bottom: 1rem;
    }
</style>
@endsection
@extends('admin.layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Publications -->
    <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-xl p-6 border border-indigo-500 shadow-lg slide-in">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white mb-1">{{ $stats['total_publications'] }}</div>
        <div class="text-indigo-100 text-sm">Total Articles</div>
    </div>
    
    <!-- Published -->
    <div class="bg-gradient-to-br from-green-600 to-green-700 rounded-xl p-6 border border-green-500 shadow-lg slide-in" style="animation-delay: 0.1s;">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white mb-1">{{ $stats['published'] }}</div>
        <div class="text-green-100 text-sm">Published</div>
    </div>
    
    <!-- Drafts -->
    <div class="bg-gradient-to-br from-yellow-600 to-yellow-700 rounded-xl p-6 border border-yellow-500 shadow-lg slide-in" style="animation-delay: 0.2s;">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white mb-1">{{ $stats['drafts'] }}</div>
        <div class="text-yellow-100 text-sm">Drafts</div>
    </div>
    
    <!-- Total Views -->
    <div class="bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl p-6 border border-purple-500 shadow-lg slide-in" style="animation-delay: 0.3s;">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-white mb-1">{{ number_format($stats['total_views']) }}</div>
        <div class="text-purple-100 text-sm">Total Views</div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mb-8 slide-in" style="animation-delay: 0.4s;">
    <h2 class="text-xl font-bold text-white mb-4">Quick Actions</h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.content.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-all transform hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
            </svg>
            Create New Article
        </a>
        
        <a href="{{ route('admin.content.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-lg font-medium transition-all">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"/>
            </svg>
            Manage Articles
        </a>
        
        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-lg font-medium transition-all">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
            </svg>
            View Public Site
        </a>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-8">
    <!-- Recent Articles -->
    <div class="bg-gray-800 rounded-xl border border-gray-700 slide-in" style="animation-delay: 0.5s;">
        <div class="p-6 border-b border-gray-700">
            <h2 class="text-xl font-bold text-white">Recent Articles</h2>
        </div>
        <div class="p-6">
            @if($recentPublications->count() > 0)
                <div class="space-y-4">
                    @foreach($recentPublications as $publication)
                        <div class="flex items-start space-x-4 p-4 bg-gray-900/50 rounded-lg hover:bg-gray-900 transition-colors">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-white font-medium line-clamp-1">{{ $publication->title }}</h3>
                                <div class="flex items-center space-x-3 mt-1 text-sm text-gray-400">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $publication->publication_status === 'publish' ? 'bg-green-900/50 text-green-300' : 'bg-yellow-900/50 text-yellow-300' }}">
                                        {{ ucfirst($publication->publication_status) }}
                                    </span>
                                    <span>{{ $publication->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <a href="{{ route('admin.content.edit', $publication->publication_id) }}" class="flex-shrink-0 text-indigo-400 hover:text-indigo-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No articles yet</p>
            @endif
        </div>
    </div>
    
    <!-- Popular Articles -->
    <div class="bg-gray-800 rounded-xl border border-gray-700 slide-in" style="animation-delay: 0.6s;">
        <div class="p-6 border-b border-gray-700">
            <h2 class="text-xl font-bold text-white">Most Popular</h2>
        </div>
        <div class="p-6">
            @if($popularPublications->count() > 0)
                <div class="space-y-4">
                    @foreach($popularPublications as $index => $publication)
                        <div class="flex items-start space-x-4 p-4 bg-gray-900/50 rounded-lg hover:bg-gray-900 transition-colors">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center font-bold text-white">
                                #{{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-white font-medium line-clamp-1">{{ $publication->title }}</h3>
                                <div class="flex items-center space-x-3 mt-1 text-sm text-gray-400">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        {{ $publication->view_count }} views
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('article.show', $publication->slug) }}" target="_blank" class="flex-shrink-0 text-indigo-400 hover:text-indigo-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No published articles yet</p>
            @endif
        </div>
    </div>
</div>
@endsection
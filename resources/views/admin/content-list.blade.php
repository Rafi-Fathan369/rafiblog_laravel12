@extends('admin.layouts.dashboard')

@section('title', 'Manage Articles')
@section('page-title', 'Manage Articles')

@section('content')
<!-- Toolbar -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
    <!-- Search & Filter -->
    <div class="flex-1 flex gap-3">
        <form action="{{ route('admin.content.index') }}" method="GET" class="flex-1 flex gap-3">
            <!-- Search -->
            <div class="flex-1">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search articles..."
                    class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                >
            </div>
            
            <!-- Status Filter -->
            <select 
                name="status" 
                onchange="this.form.submit()"
                class="px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
            >
                <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Status</option>
                <option value="publish" {{ request('status') === 'publish' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-all">
                Search
            </button>
        </form>
    </div>
    
    <!-- Create Button -->
    <a href="{{ route('admin.content.create') }}" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all transform hover:scale-105">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
        </svg>
        New Article
    </a>
</div>

<!-- Articles Table -->
@if($publications->count() > 0)
    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-900/50 border-b border-gray-700">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Published</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Views</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($publications as $publication)
                        <tr class="hover:bg-gray-900/30 transition-colors">
                            <!-- Title -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                        </svg>
                                    </div>
                                    <div class="max-w-md">
                                        <div class="text-white font-medium line-clamp-1">{{ $publication->title }}</div>
                                        <div class="text-sm text-gray-400 line-clamp-1">{{ $publication->excerpt }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Status -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $publication->publication_status === 'publish' ? 'bg-green-900/50 text-green-300 border border-green-700' : 'bg-yellow-900/50 text-yellow-300 border border-yellow-700' }}">
                                    @if($publication->publication_status === 'publish')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    @endif
                                    {{ ucfirst($publication->publication_status) }}
                                </span>
                            </td>
                            
                            <!-- Published Date -->
                            <td class="px-6 py-4 text-sm text-gray-400">
                                {{ $publication->formatted_date }}
                            </td>
                            
                            <!-- Views -->
                            <td class="px-6 py-4">
                                <div class="flex items-center text-sm text-gray-400">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    {{ $publication->view_count }}
                                </div>
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end space-x-2">
                                    <!-- Preview -->
                                    @if($publication->publication_status === 'publish')
                                        <a href="{{ route('article.show', $publication->slug) }}" target="_blank" class="p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg transition-all" title="View">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                                            </svg>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.content.preview', $publication->publication_id) }}" target="_blank" class="p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg transition-all" title="Preview">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                                            </svg>
                                        </a>
                                    @endif
                                    
                                    <!-- Edit -->
                                    <a href="{{ route('admin.content.edit', $publication->publication_id) }}" class="p-2 text-indigo-400 hover:text-indigo-300 hover:bg-gray-700 rounded-lg transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </a>
                                    
                                    <!-- Delete -->
                                    <form action="{{ route('admin.content.destroy', $publication->publication_id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-400 hover:text-red-300 hover:bg-gray-700 rounded-lg transition-all" title="Delete">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="mt-6">
        {{ $publications->appends(request()->query())->links('pagination::tailwind') }}
    </div>
@else
    <!-- Empty State -->
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-12 text-center">
        <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-700 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">No Articles Found</h3>
        <p class="text-gray-400 mb-6">
            @if(request('search'))
                No results for "{{ request('search') }}". Try a different search term.
            @else
                Get started by creating your first article.
            @endif
        </p>
        <a href="{{ route('admin.content.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-all">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
            </svg>
            Create First Article
        </a>
    </div>
@endif
@endsection
@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-white py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Article Header -->
        <article class="bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Featured Image -->
            @if($post->image)
            <div class="w-full h-64 md:h-80 lg:h-96 overflow-hidden">
                <img src="{{ asset('images/' . $post->image) }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-full object-cover">
            </div>
            @endif
            
            <!-- Article Content -->
            <div class="px-6 md:px-12 py-8">
                <!-- Title -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                    {{ $post->title }}
                </h1>
                
                <!-- Meta Information -->
                <div class="flex items-center space-x-4 text-gray-600 text-sm mb-8 pb-6 border-b border-gray-200">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                            <span class="text-gray-600 font-medium text-xs">
                                {{ strtoupper(substr($post->author ?? 'A', 0, 1)) }}
                            </span>
                        </div>
                        <span class="font-medium">{{ $post->author ?? 'Anonymous' }}</span>
                    </div>
                    <span>•</span>
                    <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                        {{ $post->created_at->format('M d, Y') }}
                    </time>
                    <span>•</span>
                    <span>{{ str_word_count(strip_tags($post->description)) }} words</span>
                </div>
                
                <!-- Article Content -->
                <div class="prose prose-lg max-w-none">
                    <div class="text-gray-800 leading-relaxed text-lg">
                        {!! nl2br(e($post->description)) !!}
                    </div>
                </div>
                
                <!-- Tags (if you have them) -->
                @if(isset($post->tags) && $post->tags)
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $post->tags) as $tag)
                        <span class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                            {{ trim($tag) }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Action Buttons -->
                <div class="mt-12 pt-8 border-t border-gray-200 flex justify-between items-center">
                    <a href="{{ route('posts.index') }}" 
                       class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Posts
                    </a>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('posts.edit', ['id' => $post->id]) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>

                        <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>

                    
                </div>
            </div>
        </article>
    </div>
</div>
@endsection

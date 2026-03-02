@extends('layouts.app')

@section('title', 'DINAMIKA Forum - Beranda')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-3">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl p-8 mb-6 text-white">
                <h1 class="text-3xl font-bold mb-2">Selamat Datang di DINAMIKA Forum!</h1>
                <p class="text-blue-100 mb-4">Platform diskusi untuk Mahasiswa Teknik Informatika</p>
                @guest
                    <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50">
                        Bergabung Sekarang
                    </a>
                @endguest
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('home', ['filter' => 'latest']) }}" 
                       class="px-4 py-2 rounded-lg {{ $filter === 'latest' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Terbaru
                    </a>
                    <a href="{{ route('home', ['filter' => 'popular']) }}" 
                       class="px-4 py-2 rounded-lg {{ $filter === 'popular' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Populer
                    </a>
                    <a href="{{ route('home', ['filter' => 'unsolved']) }}" 
                       class="px-4 py-2 rounded-lg {{ $filter === 'unsolved' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Belum Terjawab
                    </a>
                    <a href="{{ route('home', ['filter' => 'solved']) }}" 
                       class="px-4 py-2 rounded-lg {{ $filter === 'solved' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Terjawab
                    </a>
                </div>
            </div>

            <!-- Discussion List -->
            <div class="space-y-4">
                @forelse($discussions as $discussion)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex items-start space-x-4">
                                <!-- Avatar -->
                                <img src="{{ $discussion->user->avatar_url }}" 
                                     alt="{{ $discussion->user->name }}" 
                                     class="w-12 h-12 rounded-full flex-shrink-0">

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Title & Status -->
                                    <div class="flex items-start justify-between mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900 hover:text-blue-600">
                                            <a href="{{ route('discussions.show', $discussion) }}">
                                                {{ $discussion->title }}
                                            </a>
                                        </h3>
                                        @if($discussion->is_solved)
                                            <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full flex-shrink-0">
                                                ✓ Terjawab
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Content Preview -->
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ Str::limit(strip_tags($discussion->content), 150) }}
                                    </p>

                                    <!-- Meta Info -->
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center space-x-4">
                                            <span>{{ $discussion->user->name }}</span>
                                            <span>•</span>
                                            <span>{{ $discussion->created_at->diffForHumans() }}</span>
                                            <span>•</span>
                                            <span>👁 {{ $discussion->views }} views</span>
                                            <span>•</span>
                                            <span>💬 {{ $discussion->all_comments_count }} komentar</span>
                                        </div>
                                    </div>

                                    <!-- Tags -->
                                    @if($discussion->tags->count() > 0)
                                        <div class="flex flex-wrap gap-2 mt-3">
                                            @foreach($discussion->tags as $tag)
                                                <a href="{{ route('home', ['tag' => $tag->slug]) }}" 
                                                   class="px-2 py-1 text-xs font-medium rounded"
                                                   style="background-color: {{ $tag->color }}20; color: {{ $tag->color }}">
                                                    #{{ $tag->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                        <p class="text-gray-500">Belum ada diskusi yang tersedia.</p>
                        @auth
                            <a href="{{ route('discussions.create') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-700 font-semibold">
                                Buat diskusi pertama →
                            </a>
                        @endauth
                    </div>
                @endforelse

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $discussions->links() }}
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Popular Tags -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-20">
                <h3 class="font-bold text-gray-900 mb-4">Tag Populer</h3>
                <div class="space-y-2">
                    @foreach($popularTags as $popularTag)
                        <a href="{{ route('home', ['tag' => $popularTag->slug]) }}" 
                           class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 group">
                            <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600">
                                #{{ $popularTag->name }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $popularTag->discussions_count }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

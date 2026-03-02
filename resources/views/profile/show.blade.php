@extends('layouts.app')

@section('title', $user->name . ' - Profil DINAMIKA')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-start gap-4">
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                <p class="text-sm text-gray-500">{{ '@' . $user->username }}</p>
                <p class="text-sm text-gray-600 mt-2">{{ $user->bio ?: 'Belum ada bio.' }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Diskusi oleh {{ $user->name }}</h2>

        <div class="space-y-4">
            @forelse($discussions as $discussion)
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between gap-3">
                        <a href="{{ route('discussions.show', $discussion) }}" class="font-semibold text-gray-900 hover:text-blue-600">
                            {{ $discussion->title }}
                        </a>
                        @if($discussion->is_solved)
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">✓ Terjawab</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 mt-2">{{ \Illuminate\Support\Str::limit(strip_tags($discussion->content), 120) }}</p>
                    <div class="text-xs text-gray-500 mt-2">
                        {{ $discussion->created_at->diffForHumans() }} • 👁 {{ $discussion->views }} • 💬 {{ $discussion->all_comments_count }}
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada diskusi.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $discussions->links() }}
        </div>
    </div>
</div>
@endsection

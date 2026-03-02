@extends('layouts.app')

@section('title', $discussion->title . ' - DINAMIKA Forum')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $discussion->title }}</h1>
                <div class="mt-2 text-sm text-gray-500 flex items-center gap-2">
                    <a href="{{ route('profile.show', $discussion->user) }}" class="hover:text-blue-600">{{ $discussion->user->name }}</a>
                    <span>•</span>
                    <span>{{ $discussion->created_at->diffForHumans() }}</span>
                    <span>•</span>
                    <span>👁 {{ $discussion->views }} views</span>
                </div>
            </div>
            @if($discussion->is_solved)
                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">✓ Terjawab</span>
            @endif
        </div>

        @if($discussion->tags->count())
            <div class="flex flex-wrap gap-2 mt-4">
                @foreach($discussion->tags as $tag)
                    <a href="{{ route('home', ['tag' => $tag->slug]) }}" class="px-2 py-1 text-xs font-medium rounded" style="background-color: {{ $tag->color }}20; color: {{ $tag->color }}">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <div class="prose max-w-none mt-6 text-gray-800">
            {!! nl2br(e($discussion->content)) !!}
        </div>

        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                💬 {{ $discussion->allComments->count() }} komentar
            </div>
            @can('update', $discussion)
                <div class="flex items-center gap-2">
                    <a href="{{ route('discussions.edit', $discussion) }}" class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-lg">Edit</a>
                    <form action="{{ route('discussions.destroy', $discussion) }}" method="POST" onsubmit="return confirm('Yakin hapus diskusi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 text-sm bg-red-100 text-red-700 hover:bg-red-200 rounded-lg">Hapus</button>
                    </form>
                </div>
            @endcan
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Tambah Komentar</h2>
        @auth
            <form action="{{ route('comments.store', $discussion) }}" method="POST" class="space-y-3">
                @csrf
                <textarea name="content" rows="4" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tulis komentar..." required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kirim Komentar</button>
            </form>
        @else
            <p class="text-sm text-gray-600">Silakan <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> untuk menulis komentar.</p>
        @endauth
    </div>

    <div class="space-y-4">
        <h2 class="text-lg font-semibold text-gray-900">Komentar</h2>
        @forelse($discussion->comments as $comment)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-sm font-semibold text-gray-900">{{ $comment->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
                    </div>
                    @if($discussion->best_answer_id === $comment->id || $comment->is_best_answer)
                        <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Best Answer</span>
                    @endif
                </div>

                <p class="mt-3 text-gray-800">{!! nl2br(e($comment->content)) !!}</p>

                @can('update', $discussion)
                    <div class="mt-3">
                        @if($discussion->best_answer_id === $comment->id)
                            <form action="{{ route('discussions.best-answer.remove', $discussion) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs px-3 py-1 rounded bg-gray-100 hover:bg-gray-200">Hapus Best Answer</button>
                            </form>
                        @else
                            <form action="{{ route('discussions.best-answer.set', [$discussion, $comment]) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs px-3 py-1 rounded bg-blue-100 text-blue-700 hover:bg-blue-200">Jadikan Best Answer</button>
                            </form>
                        @endif
                    </div>
                @endcan

                @if($comment->replies->count())
                    <div class="mt-4 pl-4 border-l border-gray-200 space-y-3">
                        @foreach($comment->replies as $reply)
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $reply->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</div>
                                <p class="mt-1 text-sm text-gray-800">{!! nl2br(e($reply->content)) !!}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center text-gray-500">
                Belum ada komentar.
            </div>
        @endforelse
    </div>
</div>
@endsection

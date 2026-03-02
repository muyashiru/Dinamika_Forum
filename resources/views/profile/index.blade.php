@extends('layouts.app', [
    'title' => 'Anggota Forum',
    'footer' => true,
    'navbar' => true,
])

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Anggota Forum</h1>
        <p class="text-gray-600">Lihat semua anggota yang tergabung di DINAMIKA Forum</p>
    </div>

    <!-- Search -->
    <div class="mb-6">
        <form action="{{ route('members.index') }}" method="GET" class="max-w-xl">
            <div class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ $search }}"
                       placeholder="Cari anggota berdasarkan nama, username, atau email..." 
                       class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </form>
    </div>

    <!-- Stats -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-6 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium mb-1">Total Anggota Terdaftar</p>
                <p class="text-4xl font-bold">{{ number_format($users->total()) }}</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Members Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($users as $user)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition overflow-hidden">
                <!-- Header with gradient -->
                <div class="h-20 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                
                <!-- Content -->
                <div class="px-6 pb-6 -mt-12">
                    <!-- Avatar -->
                    <div class="mb-4">
                        <img src="{{ $user->avatar_url }}" 
                             alt="{{ $user->name }}" 
                             class="w-24 h-24 rounded-full border-4 border-white shadow-lg mx-auto">
                    </div>

                    <!-- User Info -->
                    <div class="text-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $user->name }}</h3>
                        <p class="text-gray-500 text-sm mb-2">{{ '@' . $user->username }}</p>
                        
                        @if($user->bio)
                            <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ $user->bio }}</p>
                        @endif
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <p class="text-2xl font-bold text-blue-600">{{ $user->discussions_count }}</p>
                            <p class="text-xs text-gray-600">Diskusi</p>
                        </div>
                        <div class="text-center p-3 bg-green-50 rounded-lg">
                            <p class="text-2xl font-bold text-green-600">{{ $user->comments_count }}</p>
                            <p class="text-xs text-gray-600">Komentar</p>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <a href="{{ route('profile.show', $user) }}" 
                       class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">
                        Lihat Profil
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">
                        @if($search)
                            Tidak ada anggota yang ditemukan dengan kata kunci "{{ $search }}"
                        @else
                            Belum ada anggota yang terdaftar
                        @endif
                    </p>
                    @if($search)
                        <a href="{{ route('members.index') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-700 font-semibold">
                            ← Kembali ke semua anggota
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="mt-8">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection

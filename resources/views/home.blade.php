@extends('layouts.app')

@section('title', 'DINAMIKA Forum - Beranda')

@section('content')
<!-- Hero Section - Full Width -->
<div class="relative bg-gradient-to-br from-blue-500 via-indigo-600 to-purple-600 overflow-hidden" style="min-height: 500px;">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-20 left-10 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl"></div>
        <div class="absolute bottom-20 left-1/3 w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="text-white space-y-6 z-10">
                <h1 class="text-6xl md:text-7xl font-bold tracking-tight">
                    DINAMIKA
                </h1>
                <h2 class="text-2xl md:text-3xl font-semibold text-blue-100">
                    DINASTI MAHASISWA TEKNIK INFORMATIKA
                </h2>
                <p class="text-lg md:text-xl text-blue-50 leading-relaxed">
                    Tempat dimana kita bisa berbagi ilmu dan bertukar pikiran
                </p>
                @guest
                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-bold hover:bg-blue-50 transform hover:scale-105 transition shadow-lg">
                            Bergabung Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="inline-block bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-blue-600 transition">
                            Masuk
                        </a>
                    </div>
                @else
                    <a href="{{ route('discussions.create') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-bold hover:bg-blue-50 transform hover:scale-105 transition shadow-lg">
                        🚀 Buat Diskusi Baru
                    </a>
                @endguest
            </div>

            <!-- Right Illustration -->
            <div class="hidden lg:block relative">
                <svg viewBox="0 0 500 400" class="w-full h-auto">
                    <!-- People Illustration -->
                    <!-- Person 1 - Left -->
                    <g transform="translate(50, 180)">
                        <ellipse cx="30" cy="100" rx="40" ry="8" fill="#1e40af" opacity="0.3"/>
                        <rect x="15" y="60" width="30" height="40" rx="5" fill="#ef4444"/>
                        <circle cx="30" cy="40" r="15" fill="#fbbf24"/>
                        <path d="M 20 75 L 10 95" stroke="#4b5563" stroke-width="4" stroke-linecap="round"/>
                        <path d="M 40 75 L 50 95" stroke="#4b5563" stroke-width="4" stroke-linecap="round"/>
                    </g>
                    
                    <!-- Person 2 - Center -->
                    <g transform="translate(200, 150)">
                        <ellipse cx="30" cy="120" rx="40" ry="8" fill="#1e40af" opacity="0.3"/>
                        <rect x="15" y="80" width="30" height="45" rx="5" fill="#f3f4f6"/>
                        <circle cx="30" cy="55" r="18" fill="#8b5cf6"/>
                        <path d="M 20 95 L 10 120" stroke="#4b5563" stroke-width="4" stroke-linecap="round"/>
                        <path d="M 40 95 L 50 120" stroke="#4b5563" stroke-width="4" stroke-linecap="round"/>
                    </g>

                    <!-- Person 3 - Right Front -->
                    <g transform="translate(330, 200)">
                        <ellipse cx="35" cy="90" rx="45" ry="8" fill="#1e40af" opacity="0.3"/>
                        <rect x="20" y="50" width="30" height="40" rx="5" fill="#f97316"/>
                        <circle cx="35" cy="30" r="15" fill="#4b5563"/>
                        <path d="M 25 65 L 15 85" stroke="#6b7280" stroke-width="4" stroke-linecap="round"/>
                        <path d="M 45 65 L 55 85" stroke="#6b7280" stroke-width="4" stroke-linecap="round"/>
                    </g>

                    <!-- Person 4 - Right Back -->
                    <g transform="translate(400, 170)">
                        <ellipse cx="30" cy="100" rx="40" ry="8" fill="#1e40af" opacity="0.3"/>
                        <rect x="15" y="60" width="30" height="40" rx="5" fill="#f97316"/>
                        <circle cx="30" cy="40" r="15" fill="#1f2937"/>
                        <path d="M 20 75 L 10 95" stroke="#6b7280" stroke-width="4" stroke-linecap="round"/>
                        <path d="M 40 75 L 50 95" stroke="#6b7280" stroke-width="4" stroke-linecap="round"/>
                    </g>

                    <!-- Decorative Elements -->
                    <circle cx="450" cy="50" r="30" fill="white" opacity="0.2"/>
                    <circle cx="470" cy="80" r="20" fill="white" opacity="0.15"/>
                    <rect x="30" y="30" width="60" height="60" rx="10" fill="white" opacity="0.1" transform="rotate(-15 60 60)"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Diskusi</p>
                    <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Discussion::count() }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Member</p>
                    <p class="text-3xl font-bold text-green-600">{{ \App\Models\User::count() }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Diskusi Terjawab</p>
                    <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Discussion::where('is_solved', true)->count() }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-3" x-data="discussionFilter('{{ $filter }}')">

            <!-- Filters -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6" id="filter-section">
                <div class="flex flex-wrap items-center gap-2">
                    <button @click="changeFilter('latest')" 
                       :class="filter === 'latest' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                       class="px-4 py-2 rounded-lg transition">
                        Terbaru
                    </button>
                    <button @click="changeFilter('popular')" 
                       :class="filter === 'popular' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                       class="px-4 py-2 rounded-lg transition">
                        Populer
                    </button>
                    <button @click="changeFilter('unsolved')" 
                       :class="filter === 'unsolved' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                       class="px-4 py-2 rounded-lg transition">
                        Belum Terjawab
                    </button>
                    <button @click="changeFilter('solved')" 
                       :class="filter === 'solved' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                       class="px-4 py-2 rounded-lg transition">
                        Terjawab
                    </button>
                </div>
            </div>

            <!-- Loading Indicator -->
            <div x-show="loading" class="text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <p class="mt-2 text-gray-600">Memuat diskusi...</p>
            </div>

            <!-- Discussion List -->
            <div class="space-y-4" x-show="!loading" x-transition>
                <template x-for="discussion in discussions" :key="discussion.id">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex items-start space-x-4">
                                <!-- Avatar -->
                                <img :src="discussion.user.avatar_url" 
                                     :alt="discussion.user.name" 
                                     class="w-12 h-12 rounded-full flex-shrink-0">

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Title & Status -->
                                    <div class="flex items-start justify-between mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900 hover:text-blue-600">
                                            <a :href="`/discussions/${discussion.slug}`" x-text="discussion.title"></a>
                                        </h3>
                                        <span x-show="discussion.is_solved" 
                                              class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full flex-shrink-0">
                                            ✓ Terjawab
                                        </span>
                                    </div>

                                    <!-- Content Preview -->
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2"
                                       x-text="truncate(stripTags(discussion.content))"></p>

                                    <!-- Meta Info -->
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center space-x-4">
                                            <span x-text="discussion.user.name"></span>
                                            <span>•</span>
                                            <span x-text="formatDate(discussion.created_at)"></span>
                                            <span>•</span>
                                            <span>👁 <span x-text="discussion.views"></span> views</span>
                                            <span>•</span>
                                            <span>💬 <span x-text="discussion.all_comments_count"></span> komentar</span>
                                        </div>
                                    </div>

                                    <!-- Tags -->
                                    <div x-show="discussion.tags && discussion.tags.length > 0" class="flex flex-wrap gap-2 mt-3">
                                        <template x-for="tag in discussion.tags" :key="tag.id">
                                            <a :href="`/?tag=${tag.slug}`" 
                                               class="px-2 py-1 text-xs font-medium rounded"
                                               :style="`background-color: ${tag.color}20; color: ${tag.color}`"
                                               x-text="`#${tag.name}`"></a>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                
                <!-- Empty State -->
                <div x-show="discussions.length === 0" class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg mb-2">Belum ada diskusi</p>
                    @auth
                        <a href="{{ route('discussions.create') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-700 font-semibold">
                            Buat diskusi pertama →
                        </a>
                    @endauth
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

<script>
function discussionFilter(initialFilter) {
    return {
        filter: initialFilter,
        discussions: @json($discussions->items()),
        loading: false,
        
        async changeFilter(newFilter) {
            if (this.filter === newFilter) return;
            
            this.filter = newFilter;
            this.loading = true;
            
            try {
                const response = await fetch(`{{ route('home') }}?filter=${newFilter}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                this.discussions = data.discussions;
            } catch (error) {
                console.error('Error loading discussions:', error);
            } finally {
                this.loading = false;
            }
        },
        
        formatDate(dateString) {
            // Simple date formatting
            const date = new Date(dateString);
            const now = new Date();
            const diffInSeconds = Math.floor((now - date) / 1000);
            
            if (diffInSeconds < 60) return 'Just now';
            if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)} minutes ago`;
            if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)} hours ago`;
            if (diffInSeconds < 2592000) return `${Math.floor(diffInSeconds / 86400)} days ago`;
            return date.toLocaleDateString();
        },
        
        stripTags(html) {
            const tmp = document.createElement('DIV');
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || '';
        },
        
        truncate(text, length = 150) {
            if (text.length <= length) return text;
            return text.substr(0, length) + '...';
        }
    }
}
</script>

@endsection

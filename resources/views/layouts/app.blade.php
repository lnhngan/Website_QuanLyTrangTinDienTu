<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sport News')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans bg-gray-50 text-gray-800 antialiased">

<!-- HEADER -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- LOGO -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-1">
                    <span class="text-2xl font-black text-red-600 tracking-tighter">SPORT</span>
                    <span class="text-xl font-bold text-gray-900">NEWS</span>
                </a>
            </div>

            <!-- MENU CHÍNH - NGANG 1 DÒNG -->
            <nav class="hidden lg:flex items-center space-x-1 text-sm font-medium">
                @foreach(\App\Models\Category::all() as $cat)
                    <a href="{{ route('category.show', $cat->slug) }}"
                       class="px-3 py-1.5 rounded-md hover:bg-gray-100 transition {{ request()->is("danh-muc/{$cat->slug}") ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </nav>

            <!-- RIGHT ACTIONS -->
            <div class="flex items-center space-x-3">

                <!-- TÌM KIẾM NHỎ GỌN -->
                <form action="{{ route('home') }}" class="hidden md:flex items-center">
                    <div class="relative">
                        <input type="text" name="s" placeholder="Tìm kiếm..."
                               class="w-48 pl-9 pr-3 py-1.5 text-sm border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 transition">
                        <svg class="w-4 h-4 text-gray-500 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </form>

                <!-- NÚT GỬI BÀI -->
                <a href="#" class="hidden sm:flex items-center space-x-1 text-sm text-gray-700 hover:text-red-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Gửi bài</span>
                </a>

                <!-- USER DROPDOWN -->
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-red-600 focus:outline-none">
                            <img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=dc2626&color=fff' }}"
                                 alt="{{ Auth::user()->name }}"
                                 class="w-8 h-8 rounded-full object-cover border border-gray-300">
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Hồ sơ</a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Đăng xuất</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- NÚT ĐĂNG NHẬP / ĐĂNG KÝ -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-red-600">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-red-600 hover:text-red-700">Đăng ký</a>
                    </div>
                @endauth

                <!-- MOBILE MENU BUTTON -->
                <button class="lg:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100" @click="$dispatch('open-mobile-menu')">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- MOBILE MENU (ẩn mặc định) -->
<div class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-50 hidden" x-data="{ open: false }" x-show="open" @open-mobile-menu.window="open = true" @click="open = false">
    <div @click.stop class="bg-white w-64 h-full shadow-xl p-6 overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0">
        <div class="flex justify-between items-center mb-6">
            <span class="text-xl font-bold text-red-600">SPORT NEWS</span>
            <button @click="open = false" class="p-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="space-y-1">
            @foreach(\App\Models\Category::all() as $cat)
                <a href="{{ route('category.show', $cat->slug) }}"
                   class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100 {{ request()->is("danh-muc/{$cat->slug}") ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </nav>
    </div>
</div>

<!-- MAIN CONTENT -->
<main class="py-6">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @yield('content')
    </div>
</main>

<!-- FOOTER -->
<footer class="bg-gray-900 text-white py-8 mt-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-sm">&copy; 2025 <strong>Sport News</strong> – Phát triển tại An Giang</p>
        <p class="text-xs mt-1 text-gray-400">Nguồn tin thể thao uy tín nhất Việt Nam</p>
    </div>
</footer>

<!-- Alpine.js cho Dropdown -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@yield('scripts')
</body>
</html>
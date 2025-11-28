<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bidang - {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 text-gray-900 flex min-h-screen">
   {{-- Sidebar --}}
    <aside class="bg-white border-r border-gray-200 flex flex-col justify-between transition-all duration-300"
        :class="sidebarOpen ? 'w-64' : 'w-20'">
        <div>
            {{-- Logo --}}
            <div class="p-4 text-center border-b border-gray-200">
                <img src="{{ asset('icon/logo-bidang.svg') }}" alt="Logo Bidang" class="h-10 w-auto mx-auto">
            </div>

            {{-- Navigation --}}
            <nav class="p-4 space-y-2">
                <a href="{{ route('bidang.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all
                   {{ request()->routeIs('bidang.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100 hover:text-blue-700 text-gray-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m2 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8" />
                    </svg>
                    <span x-show="sidebarOpen" class="transition-all duration-300">Dashboard</span>
                </a>
                </a>

                <a href="{{ route('bidang.pengaduan') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all
                   {{ request()->routeIs('bidang.pengaduan') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100 hover:text-blue-700 text-gray-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 8h10M7 12h4m-2 8a9 9 0 110-18 9 9 0 010 18z" />
                    </svg>
                    <span x-show="sidebarOpen" class="transition-all duration-300">Pengaduan</span>
                </a>

                <a href="{{ route('bidang.histori') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all
                   {{ request()->routeIs('bidang.histori') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100 hover:text-blue-700 text-gray-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-show="sidebarOpen" class="transition-all duration-300">Histori</span>
                </a>

                <a href="{{ route('bidang.profil') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition-all
                    {{ request()->routeIs('bidang.profil') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100 hover:text-blue-700 text-gray-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A10 10 0 0112 14a10 10 0 016.879 3.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span x-show="sidebarOpen" class="transition-all duration-300">Profil Bidang</span>
                </a>
            </nav>
        </div>

        {{-- Logout --}}
        <div class="p-4 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-all">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8 overflow-y-auto">
        {{-- Top Menubar --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                {{ $title ?? 'Dashboard Bidang' }}
            </h1>

            {{-- Profil user --}}
            <div class="flex items-center gap-3">
                <span class="text-gray-700 font-medium">{{ Auth::user()->name ?? 'Bidang' }}</span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Bidang') }}"
                    alt="Avatar" class="w-10 h-10 rounded-full border border-gray-300">
            </div>
        </div>

        {{-- Konten halaman --}}
        <div>
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>

    @livewireScripts
</body>

</html>

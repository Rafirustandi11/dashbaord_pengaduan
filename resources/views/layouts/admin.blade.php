<!DOCTYPE html>
<html lang="id" x-data="{
    sidebarOpen: true,
    theme: localStorage.getItem('theme') || 'light'
}" x-init="document.documentElement.classList.toggle('dark', theme === 'dark');
window.addEventListener('set-theme', e => {
    theme = e.detail.theme;
    localStorage.setItem('theme', theme);
    document.documentElement.classList.toggle('dark', theme === 'dark');
});" x-cloak>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- 🔥 TITLE DINAMIS --}}
    <title>@yield('title', $title ?? 'Dashboard Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 dark:bg-gray-900 flex min-h-screen transition-all duration-300">

    {{-- SIDEBAR --}}
    <aside
        class="backdrop-blur-xl bg-white/40 dark:bg-gray-800/40 border-r border-gray-200 dark:border-gray-700
               shadow-xl flex flex-col justify-between transition-all duration-300"
        :class="sidebarOpen ? 'w-64' : 'w-20'">

        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <img src="{{ asset('icon/logo-admin.svg') }}" alt="Logo Admin"
                class="h-10 w-auto transition-all duration-300"
                :class="sidebarOpen ? 'opacity-100' : 'opacity-0 hidden'">

            <button @click="sidebarOpen = !sidebarOpen"
                class="p-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-800 dark:text-gray-200" fill="none"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
        </div>

        <nav class="p-4 space-y-2 flex-1">
            @php
                $menu = [
                    [
                        'route' => 'admin.dashboard',
                        'label' => 'Dashboard',
                        'icon' => '<path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m2 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8" />',
                    ],
                    [
                        'route' => 'admin.users',
                        'label' => 'Manajemen Akun',
                        'icon' => '<path d="M17 20h5V4H2v16h5m10 0v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4m10 0H7" />',
                    ],
                    [
                        'route' => 'admin.pengaduan',
                        'label' => 'Pengaduan',
                        'icon' => '<path d="M7 8h10M7 12h4m-2 8a9 9 0 110-18 9 9 0 010 18z" />',
                    ],
                    [
                        'route' => 'admin.form-fields',
                        'label' => 'Kelola Form Pengaduan',
                        'icon' => '<path d="M5 13l4 4L19 7M12 4v16m8-8H4" />',
                    ],
                    [
                        'route' => 'admin.histori-pengaduan',
                        'label' => 'Histori',
                        'icon' => '<path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                    ],
                    [
                        'route' => 'admin.profil-admin',
                        'label' => 'Profil Admin',
                        'icon' =>
                            '<path d="M5.121 17.804A10 10 0 0112 14a10 10 0 016.879 3.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />',
                    ],
                ];
            @endphp

            @foreach ($menu as $item)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium transition-all
                   {{ request()->routeIs($item['route'])
                       ? 'bg-blue-600/90 text-white shadow-lg'
                       : 'hover:bg-blue-100 hover:text-blue-700 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        {!! $item['icon'] !!}
                    </svg>

                    <span x-show="sidebarOpen">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-3 py-2
                           bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium">

                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                    </svg>

                    <span x-show="sidebarOpen">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                {{ $title ?? 'Dashboard Admin' }}
            </h1>

            @livewire('toggle-theme')
        </div>

        {{ $slot }}
    </main>

    @livewireScripts

</body>

</html>

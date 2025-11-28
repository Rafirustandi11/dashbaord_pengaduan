<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        @if (auth()->user()->role === 'admin')
                            {{-- Logo Admin --}}
                            <svg class="h-9 w-auto" viewBox="0 0 200 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="30" cy="30" r="25" fill="#8B5CF6" />
                                <path d="M30 15v15l10 10" stroke="white" stroke-width="3" stroke-linecap="round" />
                                <text x="65" y="38" font-family="Arial" font-size="24" font-weight="bold"
                                    fill="#1F2937">
                                    Admin Panel
                                </text>
                            </svg>
                        @else
                            {{-- Logo Bidang --}}
                            <svg class="h-9 w-auto" viewBox="0 0 200 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="30" cy="30" r="25" fill="#10B981" />
                                <path d="M30 15v15l10 10" stroke="white" stroke-width="3" stroke-linecap="round" />
                                <text x="65" y="38" font-family="Arial" font-size="24" font-weight="bold"
                                    fill="#1F2937">
                                    {{ strtoupper(auth()->user()->bidang ?? 'Bidang') }}
                                </text>
                            </svg>
                        @endif
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if (auth()->user()->role === 'admin')
                        {{-- Admin Navigation --}}
                        <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.manajemen-akun') }}" :active="request()->routeIs('admin.manajemen-akun')">
                            Manajemen Akun
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.pengaduan') }}" :active="request()->routeIs('admin.pengaduan')">
                            Pengaduan
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.form-fields') }}" :active="request()->routeIs('admin.form-fields')">
                            Kelola Form Pengaduan
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.histori') }}" :active="request()->routeIs('admin.histori')">
                            Histori
                        </x-nav-link>
                    @else
                        {{-- Bidang Navigation --}}
                        <x-nav-link href="{{ route('bidang.dashboard') }}" :active="request()->routeIs('bidang.dashboard')">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link href="{{ route('bidang.pengaduan') }}" :active="request()->routeIs('bidang.pengaduan')">
                            Pengaduan
                        </x-nav-link>
                        <x-nav-link href="{{ route('bidang.histori') }}" :active="request()->routeIs('bidang.histori')">
                            Histori
                        </x-nav-link>
                        <x-nav-link href="{{ route('bidang.profil') }}" :active="request()->routeIs('bidang.profil')">
                            Profil Bidang
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-4">
                @livewire('toggle-theme')
            </div>

            {{-- User Settings Dropdown --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <div class="border-t border-gray-200"></div>

                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500
                    hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (auth()->user()->role === 'admin')
                <x-responsive-nav-link href="{{ route('admin.dashboard') }}"
                    :active="request()->routeIs('admin.dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.manajemen-akun') }}" :active="request()->routeIs('admin.manajemen-akun')">Manajemen
                    Akun</x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.pengaduan') }}"
                    :active="request()->routeIs('admin.pengaduan')">Pengaduan</x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.form-fields') }}" :active="request()->routeIs('admin.form-fields')">Kelola Form
                    Pengaduan</x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.histori') }}"
                    :active="request()->routeIs('admin.histori')">Histori</x-responsive-nav-link>
            @else
                <x-responsive-nav-link href="{{ route('bidang.dashboard') }}" :active="request()->routeIs('bidang.dashboard')">Dashboard
                    {{ strtoupper(auth()->user()->bidang ?? 'Bidang') }}</x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('bidang.pengaduan') }}"
                    :active="request()->routeIs('bidang.pengaduan')">Pengaduan</x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('bidang.histori') }}"
                    :active="request()->routeIs('bidang.histori')">Histori</x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('bidang.profil') }}" :active="request()->routeIs('bidang.profil')">Profil
                    Bidang</x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}"
                    :active="request()->routeIs('profile.show')">Profile</x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">Log
                        Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

@props([
  'role' => 'bidang',      // 'admin' atau 'bidang' — untuk menampilkan menu sesuai role
  'openDefault' => true,   // default open state
])

{{-- Alpine.js based Sidebar component --}}
<div
  x-data="sidebarComponent({ openDefault: @json($openDefault) })"
  x-init="init()"
  x-bind:data-state="open ? 'expanded' : 'collapsed'"
  class="group/sidebar-wrapper has-data-[variant=inset]:bg-sidebar flex min-h-screen w-full"
  style="--sidebar-width:16rem; --sidebar-width-mobile:18rem; --sidebar-width-icon:3rem;"
>
  {{-- Mobile overlay + sheet --}}
  <div x-show="mobileOpen" x-cloak
       x-transition.opacity
       class="fixed inset-0 z-30 bg-black/40 lg:hidden"
       @click="mobileOpen = false"></div>

  <aside
    class="fixed inset-y-0 left-0 z-40 transform transition-all duration-200 ease-linear lg:relative lg:translate-x-0"
    :class="{
      'translate-x-0 w-[var(--sidebar-width)]': open && !isMobile,
      '-translate-x-full w-64': !open && !isMobile && collapsedMode == 'offcanvas',
      'w-[var(--sidebar-width-icon)]': !open && !isMobile && collapsedMode == 'icon',
      'translate-x-0 w-[var(--sidebar-width-mobile)]': isMobile && mobileOpen,
      'hidden lg:block': isMobile && !mobileOpen
    }"
    style="background: theme('colors.white')"
  >
    <div class="flex h-full flex-col bg-white border-r border-gray-200 shadow-sm">
      {{-- Header / Brand --}}
      <div class="flex items-center gap-3 px-4 py-4 border-b">
        <div class="flex items-center gap-3">
          <div class="h-10 w-10 rounded-md bg-indigo-600 text-white flex items-center justify-center font-semibold">
            {{ strtoupper(substr($role,0,1)) }}
          </div>

          <div class="hidden md:block">
            <div class="text-sm font-semibold">{{ $role === 'admin' ? 'Admin' : 'Bidang' }}</div>
            <div class="text-xs text-gray-500">{{ config('app.name') }}</div>
          </div>
        </div>

        {{-- Trigger / collapse button --}}
        <div class="ml-auto flex items-center gap-2">
          <button
            @click="toggle()"
            type="button"
            aria-label="Toggle sidebar"
            class="p-2 rounded-md hover:bg-gray-100"
            title="Toggle sidebar (Ctrl/Cmd + B)"
          >
            {{-- simple icon (chevron) --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16" />
            </svg>
          </button>

          {{-- Mobile open/close for small screens --}}
          <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-md hover:bg-gray-100" title="Open menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18"/>
            </svg>
          </button>
        </div>
      </div>

      {{-- Content --}}
      <nav class="flex-1 overflow-auto p-2">
        {{-- Search (optional) --}}
        <div class="px-2 py-2">
          <input type="search" placeholder="Cari menu..." x-model="query"
                 class="w-full rounded-md border-gray-200 px-3 py-2 text-sm focus:ring-0 focus:border-indigo-300"/>
        </div>

        {{-- Menu groups --}}
        <ul class="mt-2 space-y-1">
          {{-- Dashboard --}}
          <li>
            <a href="{{ $role === 'admin' ? route('admin.dashboard') : route('bidang.dashboard') }}"
               :class="menuClass('{{ $role === 'admin' ? 'admin-dashboard' : 'bidang-dashboard' }}')"
               class="flex items-center gap-3 px-3 py-2 rounded-md">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 13h8V3H3v10zM13 21h8V11h-8v10zM13 3v6h8V3h-8zM3 21h8v-6H3v6z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span class="truncate">Dashboard</span>
            </a>
          </li>

          {{-- Pengaduan/Histori --}}
          <li>
            <a href="{{ $role === 'admin' ? route('admin.pengaduan') : route('bidang.histori-pengaduan') }}"
               :class="menuClass('pengaduan')"
               class="flex items-center gap-3 px-3 py-2 rounded-md">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span class="truncate">Pengaduan</span>
            </a>
          </li>

          {{-- Profil --}}
          <li>
            <a href="{{ $role === 'admin' ? route('admin.profil-admin') : route('bidang.profil') }}"
               :class="menuClass('profil')"
               class="flex items-center gap-3 px-3 py-2 rounded-md">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 12c2.761 0 5-2.239 5-5S14.761 2 12 2 7 4.239 7 7s2.239 5 5 5zM4 20c0-3.314 2.686-6 6-6h4c3.314 0 6 2.686 6 6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span class="truncate">Profil</span>
            </a>
          </li>

          {{-- Additional menu for admin --}}
          @if($role === 'admin')
            <li>
              <a href="{{ route('admin.users') }}" :class="menuClass('users')" class="flex items-center gap-3 px-3 py-2 rounded-md">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 21v-2a4 4 0 0 0-3-3.87M9 21v-2a4 4 0 0 1 3-3.87M12 7a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span class="truncate">Manajemen Akun</span>
              </a>
            </li>
          @endif
        </ul>
      </nav>

      {{-- Footer (logout) --}}
      <div class="border-t px-3 py-3">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full flex items-center gap-2 justify-center rounded-md bg-red-600 text-white px-3 py-2 hover:bg-red-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 16l4-4m0 0l-4-4m4 4H7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Logout
          </button>
        </form>
      </div>
    </div>
  </aside>

  {{-- Main slot wrapper --}}
  <div class="flex flex-1 flex-col lg:pl-[var(--sidebar-width)]">
    {{-- Provide a small rail/gap so content not covered when collapsed icon-mode --}}
    <div class="hidden lg:block" :class="{'w-[var(--sidebar-width-icon)]': !open && collapsedMode === 'icon', 'w-0': open}"></div>

    {{-- content slot --}}
    <div class="min-h-screen bg-gray-50">
      {{ $slot }}
    </div>
  </div>
</div>

{{-- Alpine component script --}}
<script>
  function sidebarComponent({ openDefault = true } = {}) {
    return {
      open: openDefault,
      mobileOpen: false,
      isMobile: window.matchMedia('(max-width: 1023px)').matches,
      collapsedMode: 'icon', // 'offcanvas' or 'icon' - adjust if you want offcanvas behavior
      query: '',
      init() {
        // Load cookie
        try {
          const match = document.cookie.match(new RegExp('(^| )sidebar_state=([^;]+)'));
          if (match) {
            this.open = match[2] === 'true';
          }
        } catch(e){}

        // keyboard shortcut Ctrl/Cmd + B
        window.addEventListener('keydown', (e) => {
          if ((e.ctrlKey || e.metaKey) && (e.key === 'b' || e.key === 'B')) {
            e.preventDefault();
            this.toggle();
          }
        });

        // responsive listener
        const mq = window.matchMedia('(max-width: 1023px)');
        mq.addEventListener('change', (ev) => {
          this.isMobile = ev.matches;
          if (!this.isMobile) this.mobileOpen = false;
        });
      },
      toggle() {
        if (this.isMobile) {
          this.mobileOpen = !this.mobileOpen;
          return;
        }
        this.open = !this.open;
        // save cookie for 7 days
        document.cookie = `sidebar_state=${this.open};path=/;max-age=${60*60*24*7}`;
      },
      menuClass(key) {
        // simple helper — you can enhance to set active based on route name
        return 'flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-100';
      }
    }
  }
</script>

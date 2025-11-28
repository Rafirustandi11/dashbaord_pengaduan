<div>
    <button 
        wire:click="toggleTheme"
        class="backdrop-blur-md bg-white/20 dark:bg-black/30 
            border border-white/30 dark:border-gray-600/40 
            shadow-xl p-2 rounded-2xl 
            transition-all duration-300 flex items-center gap-2 hover:scale-105">

        @if($theme === 'light')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 18a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm0-14a1 1 0 011-1V2a1 1 0 11-2 0v1a1 1 0 011 1zm8 7a1 1 0 110 2h-1a1 1 0 110-2h1zm-14 0a1 1 0 110 2H2a1 1 0 110-2h1zm11.657 5.657a1 1 0 010 1.414l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zm-9.9 0l.707.707A1 1 0 016.05 17.05l-.707-.707a1 1 0 011.414-1.414zM17.657 6.343a1 1 0 010 1.414l-.707.707A1 1 0 0115.536 7.05l.707-.707a1 1 0 011.414 0zm-11.314 0l.707.707A1 1 0 015.05 8.05l-.707-.707A1 1 0 016.343 6.343z"/>
                <circle cx="12" cy="12" r="4"/>
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-300" viewBox="0 0 24 24" fill="currentColor">
                <path d="M21 12.79A9 9 0 0111.21 3 7 7 0 1019 14.79 9.05 9.05 0 0121 12.79z"/>
            </svg>
        @endif
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let saved = localStorage.getItem('theme') || 'light';
    document.documentElement.classList.toggle('dark', saved === 'dark');
});

// Event dari Livewire v3
document.addEventListener('theme-changed', event => {
    let theme = event.detail.theme;

    document.documentElement.classList.toggle('dark', theme === 'dark');
    localStorage.setItem('theme', theme);
});
</script>

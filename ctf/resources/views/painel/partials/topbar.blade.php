<header class="h-16 shrink-0 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700/80 flex items-center justify-between px-6 transition-colors duration-200">
    <div>
        <h1 class="font-display font-semibold text-lg text-slate-800 dark:text-slate-100" x-text="currentNav.label"></h1>
        <p class="text-xs text-slate2 dark:text-slate-400" x-text="currentNav.subtitle"></p>
    </div>
    <div class="flex items-center gap-4">
        <div class="relative hidden md:block">
            <input type="text" placeholder="Pesquisar formando, curso, docente…"
                   class="w-72 text-sm bg-surface dark:bg-slate-700/60 border border-slate-200 dark:border-slate-600 rounded-lg pl-9 pr-3 py-2 text-slate-800 dark:text-slate-200 placeholder-slate2/60 dark:placeholder-slate-400/60 focus:outline-none focus:ring-2 focus:ring-amber/50">
            <svg class="w-4 h-4 absolute left-3 top-2.5 text-slate2 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
        </div>

        <!-- Toggle Modo Escuro / Claro -->
        <button @click="toggleDarkMode()" 
                type="button"
                class="p-2 rounded-lg text-slate2 dark:text-slate-300 hover:bg-surface dark:hover:bg-slate-700 focus:outline-none transition-colors"
                :title="darkMode ? 'Mudar para modo claro' : 'Mudar para modo escuro'">
            <!-- Sun Icon (Modo Escuro activo) -->
            <svg x-show="darkMode" class="w-5 h-5 text-amber" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <!-- Moon Icon (Modo Claro activo) -->
            <svg x-show="!darkMode" class="w-5 h-5 text-slate-600 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>

        <div class="flex items-center gap-2 pl-4 border-l border-slate-200 dark:border-slate-700">
            <div class="w-8 h-8 rounded-full bg-ink dark:bg-amber dark:text-ink text-white flex items-center justify-center text-xs font-display font-semibold">EN</div>
            <div class="text-xs leading-tight hidden sm:block">
                <p class="font-medium text-slate-800 dark:text-slate-200">Eliandra Neto</p>
                <p class="text-slate2 dark:text-slate-400">Administração</p>
            </div>
        </div>
    </div>
</header>

<aside class="w-64 shrink-0 bg-ink dark:bg-slate-950 text-white flex flex-col transition-colors duration-200 border-r border-transparent dark:border-slate-800">
    <div class="px-5 py-5 border-b border-white/10 flex items-center gap-3">
        <div class="w-9 h-9 rounded-md bg-amber flex items-center justify-center font-display font-bold text-ink text-sm">CF</div>
        <div>
            <p class="font-display font-semibold text-sm leading-tight">Centro de Formação</p>
            <p class="text-[11px] text-white/50 font-mono tracking-wide">PAINEL&nbsp;·&nbsp;GESTÃO</p>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <template x-for="item in navItems" :key="item.id">
            <button
                @click="activeTab = item.id"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors"
                :class="activeTab === item.id ? 'bg-amber text-ink font-semibold' : 'text-white/70 hover:bg-white/5 hover:text-white'">
                <span class="w-5 h-5 shrink-0" x-html="item.icon"></span>
                <span x-text="item.label"></span>
            </button>
        </template>
    </nav>

    <div class="px-4 py-4 border-t border-white/10 text-[11px] text-white/40 font-mono">
        CINFOTEC&nbsp;·&nbsp;MAPTSS<br>Talatona, Luanda-Sul
    </div>
</aside>

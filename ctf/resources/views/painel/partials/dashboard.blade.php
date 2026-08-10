<section x-show="activeTab === 'dashboard'">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <template x-for="kpi in kpis" :key="kpi.label">
            <div class="bg-card dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700/80 p-4 transition-colors">
                <p class="text-xs text-slate2 dark:text-slate-400 font-mono uppercase tracking-wide" x-text="kpi.label"></p>
                <p class="font-display text-2xl font-semibold mt-1 text-slate-800 dark:text-slate-100" x-text="kpi.value"></p>
                <p class="text-xs mt-1" :class="kpi.trendUp ? 'text-green dark:text-emerald-400' : 'text-red dark:text-rose-400'" x-text="kpi.trend"></p>
            </div>
        </template>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-6">
        <div class="lg:col-span-2 bg-card dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700/80 p-5 transition-colors">
            <h3 class="font-display font-semibold mb-4 text-slate-800 dark:text-slate-100">Ocupação por área de formação</h3>
            <div class="space-y-3">
                <template x-for="area in ocupacaoAreas" :key="area.nome">
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="font-medium text-slate-800 dark:text-slate-200" x-text="area.nome"></span>
                            <span class="text-slate2 dark:text-slate-400 font-mono" x-text="area.ocupadas + '/' + area.vagas + ' vagas'"></span>
                        </div>
                        <div class="w-full h-2 bg-surface dark:bg-slate-700 rounded-full overflow-hidden">
                            <div class="h-full bg-amber rounded-full" :style="'width:' + (area.ocupadas/area.vagas*100) + '%'"></div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="bg-card dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700/80 p-5 transition-colors">
            <h3 class="font-display font-semibold mb-4 text-slate-800 dark:text-slate-100">Próximas inscrições a validar</h3>
            <ul class="space-y-3">
                <template x-for="i in inscricoes.slice(0,4)" :key="i.id">
                    <li class="flex items-center justify-between text-sm">
                        <div>
                            <p class="font-medium text-slate-800 dark:text-slate-200" x-text="i.candidato"></p>
                            <p class="text-xs text-slate2 dark:text-slate-400" x-text="i.curso"></p>
                        </div>
                        <span class="text-[11px] font-mono px-2 py-0.5 rounded-full"
                              :class="i.estado === 'Pendente' ? 'bg-amber/15 text-amberD dark:bg-amber/20 dark:text-amber' : 'bg-green/10 text-green dark:bg-emerald-500/20 dark:text-emerald-400'"
                              x-text="i.estado"></span>
                    </li>
                </template>
            </ul>
            <button @click="activeTab = 'inscricoes'" class="mt-4 text-xs font-semibold text-ink dark:text-amber hover:text-amberD dark:hover:text-amber/80">Ver todas as inscrições →</button>
        </div>
    </div>
</section>

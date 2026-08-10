<section x-show="activeTab === 'cursos'">
    <div class="nameplate rounded-xl p-4 mb-5 flex items-center justify-between text-white">
        <div class="flex items-center gap-3">
            <span class="rivet"></span><span class="rivet"></span>
            <div>
                <p class="text-[11px] font-mono text-white/60 uppercase">Catálogo</p>
                <p class="font-display font-semibold">Cursos ministrados</p>
            </div>
        </div>
        <button @click="modalCurso = true" class="bg-amber text-ink text-sm font-semibold px-4 py-2 rounded-lg hover:bg-amberD hover:text-white transition-colors">+ Novo curso</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <template x-for="c in cursos" :key="c.codigo">
            <div class="bg-card dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl p-4 flex flex-col transition-colors">
                <div class="flex items-start justify-between">
                    <span class="font-mono text-[11px] px-2 py-0.5 rounded bg-ink dark:bg-slate-900 text-white dark:text-amber" x-text="c.codigo"></span>
                    <span class="text-[11px] font-mono px-2 py-0.5 rounded-full"
                          :class="c.nivel === 'Técnico' ? 'bg-amber/15 text-amberD dark:bg-amber/20 dark:text-amber' : 'bg-slate-100 dark:bg-slate-700 text-slate2 dark:text-slate-300'"
                          x-text="c.nivel"></span>
                </div>
                <h4 class="font-display font-semibold mt-3 text-slate-800 dark:text-slate-100" x-text="c.nome"></h4>
                <p class="text-xs text-slate2 dark:text-slate-400 mt-1" x-text="c.area"></p>
                <div class="mt-3 flex items-center justify-between text-xs text-slate2 dark:text-slate-400">
                    <span x-text="c.duracao"></span>
                    <span class="font-mono" x-text="c.turmasAtivas + ' turma(s) activa(s)'"></span>
                </div>
                <button @click="activeTab='turmas'" class="mt-4 text-xs font-semibold text-ink dark:text-amber hover:text-amberD dark:hover:text-amber/80 self-start">Ver turmas →</button>
            </div>
        </template>
    </div>

    <div x-show="modalCurso" x-cloak class="fixed inset-0 bg-ink/60 dark:bg-slate-950/80 flex items-center justify-center z-50 p-4" @click.self="modalCurso=false">
        <div class="bg-card dark:bg-slate-800 border dark:border-slate-700 rounded-xl w-full max-w-md p-6 shadow-xl">
            <h3 class="font-display font-semibold text-lg mb-4 text-slate-800 dark:text-slate-100">Novo curso</h3>
            <form @submit.prevent="modalCurso=false" class="space-y-3 text-sm">
                <div>
                    <label class="text-xs font-medium text-slate2 dark:text-slate-300">Nome do curso</label>
                    <input class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="ex.: Electricidade Industrial">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium text-slate2 dark:text-slate-300">Área</label>
                        <select class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50">
                            <option>Tecnologias de Informação</option>
                            <option>Electricidade e Mecatrónica</option>
                            <option>Mecânica e Produção</option>
                            <option>Metrologia</option>
                            <option>Energias Renováveis</option>
                            <option>Empreendedorismo</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-slate2 dark:text-slate-300">Nível</label>
                        <select class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50">
                            <option>Qualificação</option>
                            <option>Técnico</option>
                            <option>Aperfeiçoamento</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-medium text-slate2 dark:text-slate-300">Duração</label>
                    <input class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="ex.: 6 meses">
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="modalCurso=false" class="px-4 py-2 text-sm rounded-lg text-slate2 dark:text-slate-300 hover:bg-surface dark:hover:bg-slate-700">Cancelar</button>
                    <button type="submit" class="px-4 py-2 text-sm rounded-lg bg-ink dark:bg-amber dark:text-ink text-white font-semibold hover:bg-ink2 dark:hover:bg-amberD transition-colors">Guardar curso</button>
                </div>
            </form>
        </div>
    </div>
</section>

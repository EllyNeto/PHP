<section x-show="activeTab === 'turmas'">
    <div class="nameplate rounded-xl p-4 mb-5 flex items-center justify-between text-white">
        <div class="flex items-center gap-3">
            <span class="rivet"></span><span class="rivet"></span>
            <div>
                <p class="text-[11px] font-mono text-white/60 uppercase">Organização</p>
                <p class="font-display font-semibold">Turmas</p>
            </div>
        </div>
        <button @click="modalTurma = true" class="bg-amber text-ink text-sm font-semibold px-4 py-2 rounded-lg hover:bg-amberD hover:text-white transition-colors">+ Nova turma</button>
    </div>

    <div class="bg-card dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl overflow-hidden transition-colors">
        <table class="w-full text-sm">
            <thead class="bg-surface dark:bg-slate-700/50 text-xs text-slate2 dark:text-slate-300 uppercase font-mono">
                <tr>
                    <th class="text-left px-4 py-3">Turma</th>
                    <th class="text-left px-4 py-3">Curso</th>
                    <th class="text-left px-4 py-3">Docente</th>
                    <th class="text-left px-4 py-3">Horário</th>
                    <th class="text-left px-4 py-3">Ocupação</th>
                    <th class="text-left px-4 py-3">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                <template x-for="t in turmas" :key="t.id">
                    <tr class="hover:bg-surface/60 dark:hover:bg-slate-700/30 text-slate-800 dark:text-slate-200">
                        <td class="px-4 py-3 font-mono text-xs text-slate-800 dark:text-slate-200" x-text="t.id"></td>
                        <td class="px-4 py-3 font-medium text-slate-800 dark:text-slate-100" x-text="t.curso"></td>
                        <td class="px-4 py-3 text-slate-700 dark:text-slate-300" x-text="t.docente"></td>
                        <td class="px-4 py-3 text-slate2 dark:text-slate-400" x-text="t.horario"></td>
                        <td class="px-4 py-3">
                            <div class="w-24 h-1.5 bg-surface dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="h-full bg-amber" :style="'width:' + (t.ocupadas/t.capacidade*100) + '%'"></div>
                            </div>
                            <span class="text-[11px] text-slate2 dark:text-slate-400 font-mono" x-text="t.ocupadas + '/' + t.capacidade"></span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-[11px] font-mono px-2 py-0.5 rounded-full"
                                  :class="t.estado === 'Em curso' ? 'bg-green/10 text-green dark:bg-emerald-500/20 dark:text-emerald-400' : 'bg-slate-100 dark:bg-slate-700 text-slate2 dark:text-slate-300'"
                                  x-text="t.estado"></span>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div x-show="modalTurma" x-cloak class="fixed inset-0 bg-ink/60 dark:bg-slate-950/80 flex items-center justify-center z-50 p-4" @click.self="modalTurma=false">
        <div class="bg-card dark:bg-slate-800 border dark:border-slate-700 rounded-xl w-full max-w-md p-6 shadow-xl">
            <h3 class="font-display font-semibold text-lg mb-4 text-slate-800 dark:text-slate-100">Nova turma</h3>
            <form @submit.prevent="modalTurma=false" class="space-y-3 text-sm">
                <div>
                    <label class="text-xs font-medium text-slate2 dark:text-slate-300">Curso associado</label>
                    <select class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50">
                        <template x-for="c in cursos" :key="c.codigo"><option x-text="c.nome"></option></template>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium text-slate2 dark:text-slate-300">Docente</label>
                        <select class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50">
                            <template x-for="d in docentes" :key="d.id"><option x-text="d.nome"></option></template>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-slate2 dark:text-slate-300">Capacidade</label>
                        <input type="number" class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="25">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-medium text-slate2 dark:text-slate-300">Horário</label>
                    <input class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="Seg/Qua/Sex · 08h–12h">
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="modalTurma=false" class="px-4 py-2 text-sm rounded-lg text-slate2 dark:text-slate-300 hover:bg-surface dark:hover:bg-slate-700">Cancelar</button>
                    <button type="submit" class="px-4 py-2 text-sm rounded-lg bg-ink dark:bg-amber dark:text-ink text-white font-semibold hover:bg-ink2 dark:hover:bg-amberD transition-colors">Criar turma</button>
                </div>
            </form>
        </div>
    </div>
</section>

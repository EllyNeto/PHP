<section x-show="activeTab === 'inscricoes'">
    <div class="nameplate rounded-xl p-4 mb-5 flex items-center justify-between text-white">
        <div class="flex items-center gap-3">
            <span class="rivet"></span><span class="rivet"></span>
            <div>
                <p class="text-[11px] font-mono text-white/60 uppercase">Admissões</p>
                <p class="font-display font-semibold">Inscrições</p>
            </div>
        </div>
        <button @click="modalInscricao = true" class="bg-amber text-ink text-sm font-semibold px-4 py-2 rounded-lg hover:bg-amberD hover:text-white transition-colors">+ Nova inscrição</button>
    </div>

    <div class="bg-card dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl overflow-hidden transition-colors">
        <table class="w-full text-sm">
            <thead class="bg-surface dark:bg-slate-700/50 text-xs text-slate2 dark:text-slate-300 uppercase font-mono">
                <tr>
                    <th class="text-left px-4 py-3">Candidato</th>
                    <th class="text-left px-4 py-3">Curso pretendido</th>
                    <th class="text-left px-4 py-3">Data</th>
                    <th class="text-left px-4 py-3">Estado</th>
                    <th class="text-left px-4 py-3">Acção</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                <template x-for="i in inscricoes" :key="i.id">
                    <tr class="hover:bg-surface/60 dark:hover:bg-slate-700/30 text-slate-800 dark:text-slate-200">
                        <td class="px-4 py-3 font-medium text-slate-800 dark:text-slate-100" x-text="i.candidato"></td>
                        <td class="px-4 py-3 text-slate-700 dark:text-slate-300" x-text="i.curso"></td>
                        <td class="px-4 py-3 text-slate2 dark:text-slate-400 font-mono text-xs" x-text="i.data"></td>
                        <td class="px-4 py-3">
                            <span class="text-[11px] font-mono px-2 py-0.5 rounded-full"
                                  :class="{
                                    'bg-amber/15 text-amberD dark:bg-amber/20 dark:text-amber': i.estado === 'Pendente',
                                    'bg-green/10 text-green dark:bg-emerald-500/20 dark:text-emerald-400': i.estado === 'Aprovada',
                                    'bg-red/10 text-red dark:bg-rose-500/20 dark:text-rose-400': i.estado === 'Rejeitada'
                                  }" x-text="i.estado"></span>
                        </td>
                        <td class="px-4 py-3">
                            <button @click="i.estado='Aprovada'" class="text-xs text-green dark:text-emerald-400 font-semibold hover:underline mr-2">Aprovar</button>
                            <button @click="i.estado='Rejeitada'" class="text-xs text-red dark:text-rose-400 font-semibold hover:underline">Rejeitar</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div x-show="modalInscricao" x-cloak class="fixed inset-0 bg-ink/60 dark:bg-slate-950/80 flex items-center justify-center z-50 p-4" @click.self="modalInscricao=false">
        <div class="bg-card dark:bg-slate-800 border dark:border-slate-700 rounded-xl w-full max-w-md p-6 shadow-xl">
            <h3 class="font-display font-semibold text-lg mb-4 text-slate-800 dark:text-slate-100">Nova inscrição</h3>
            <form @submit.prevent="modalInscricao=false" class="space-y-3 text-sm">
                <div>
                    <label class="text-xs font-medium text-slate2 dark:text-slate-300">Nome do candidato</label>
                    <input class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="Nome completo">
                </div>
                <div>
                    <label class="text-xs font-medium text-slate2 dark:text-slate-300">Curso pretendido</label>
                    <select class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50">
                        <template x-for="c in cursos" :key="c.codigo"><option x-text="c.nome"></option></template>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium text-slate2 dark:text-slate-300">Bilhete de Identidade</label>
                        <input class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="00XXXXXXXXX000">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-slate2 dark:text-slate-300">Contacto</label>
                        <input class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="+244 9__ ___ ___">
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="modalInscricao=false" class="px-4 py-2 text-sm rounded-lg text-slate2 dark:text-slate-300 hover:bg-surface dark:hover:bg-slate-700">Cancelar</button>
                    <button type="submit" class="px-4 py-2 text-sm rounded-lg bg-ink dark:bg-amber dark:text-ink text-white font-semibold hover:bg-ink2 dark:hover:bg-amberD transition-colors">Registar inscrição</button>
                </div>
            </form>
        </div>
    </div>
</section>

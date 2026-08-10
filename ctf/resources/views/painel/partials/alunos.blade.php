<section x-show="activeTab === 'alunos'">
    <div class="nameplate rounded-xl p-4 mb-5 flex items-center gap-3 text-white">
        <span class="rivet"></span><span class="rivet"></span>
        <div>
            <p class="text-[11px] font-mono text-white/60 uppercase">Formandos</p>
            <p class="font-display font-semibold">Alunos matriculados</p>
        </div>
    </div>

    <div class="bg-card dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl overflow-hidden transition-colors">
        <table class="w-full text-sm">
            <thead class="bg-surface dark:bg-slate-700/50 text-xs text-slate2 dark:text-slate-300 uppercase font-mono">
                <tr>
                    <th class="text-left px-4 py-3">Nº matrícula</th>
                    <th class="text-left px-4 py-3">Nome</th>
                    <th class="text-left px-4 py-3">Turma</th>
                    <th class="text-left px-4 py-3">Pagamento</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                <template x-for="a in alunos" :key="a.matricula">
                    <tr class="hover:bg-surface/60 dark:hover:bg-slate-700/30 text-slate-800 dark:text-slate-200">
                        <td class="px-4 py-3 font-mono text-xs text-slate-800 dark:text-slate-200" x-text="a.matricula"></td>
                        <td class="px-4 py-3 font-medium text-slate-800 dark:text-slate-100" x-text="a.nome"></td>
                        <td class="px-4 py-3 text-slate2 dark:text-slate-400" x-text="a.turma"></td>
                        <td class="px-4 py-3">
                            <span class="text-[11px] font-mono px-2 py-0.5 rounded-full"
                                  :class="a.pagamento === 'Em dia' ? 'bg-green/10 text-green dark:bg-emerald-500/20 dark:text-emerald-400' : 'bg-red/10 text-red dark:bg-rose-500/20 dark:text-rose-400'"
                                  x-text="a.pagamento"></span>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</section>

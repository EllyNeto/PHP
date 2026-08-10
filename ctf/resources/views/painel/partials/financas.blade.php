<section x-show="activeTab === 'financas'">
    <div class="nameplate rounded-xl p-4 mb-5 flex items-center justify-between text-white">
        <div class="flex items-center gap-3">
            <span class="rivet"></span><span class="rivet"></span>
            <div>
                <p class="text-[11px] font-mono text-white/60 uppercase">Tesouraria</p>
                <p class="font-display font-semibold">Finanças &amp; Pagamentos</p>
            </div>
        </div>
        <button @click="modalPagamento = true" class="bg-amber text-ink text-sm font-semibold px-4 py-2 rounded-lg hover:bg-amberD hover:text-white transition-colors">+ Registar pagamento</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">
        <div class="bg-card dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700/80 p-4 transition-colors">
            <p class="text-xs text-slate2 dark:text-slate-400 font-mono uppercase">Recebido este mês</p>
            <p class="font-display text-2xl font-semibold mt-1 text-green dark:text-emerald-400">Kz 4.280.000</p>
        </div>
        <div class="bg-card dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700/80 p-4 transition-colors">
            <p class="text-xs text-slate2 dark:text-slate-400 font-mono uppercase">Em atraso</p>
            <p class="font-display text-2xl font-semibold mt-1 text-red dark:text-rose-400">Kz 615.000</p>
        </div>
        <div class="bg-card dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700/80 p-4 transition-colors">
            <p class="text-xs text-slate2 dark:text-slate-400 font-mono uppercase">Propinas por cobrar</p>
            <p class="font-display text-2xl font-semibold mt-1 text-slate-800 dark:text-slate-100">Kz 1.120.000</p>
        </div>
    </div>

    <div class="bg-card dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl overflow-hidden transition-colors">
        <table class="w-full text-sm">
            <thead class="bg-surface dark:bg-slate-700/50 text-xs text-slate2 dark:text-slate-300 uppercase font-mono">
                <tr>
                    <th class="text-left px-4 py-3">Aluno</th>
                    <th class="text-left px-4 py-3">Curso</th>
                    <th class="text-left px-4 py-3">Valor</th>
                    <th class="text-left px-4 py-3">Método</th>
                    <th class="text-left px-4 py-3">Data</th>
                    <th class="text-left px-4 py-3">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                <template x-for="p in pagamentos" :key="p.id">
                    <tr class="hover:bg-surface/60 dark:hover:bg-slate-700/30 text-slate-800 dark:text-slate-200">
                        <td class="px-4 py-3 font-medium text-slate-800 dark:text-slate-100" x-text="p.aluno"></td>
                        <td class="px-4 py-3 text-slate2 dark:text-slate-400" x-text="p.curso"></td>
                        <td class="px-4 py-3 font-mono text-slate-800 dark:text-slate-200" x-text="p.valor"></td>
                        <td class="px-4 py-3 text-slate2 dark:text-slate-400" x-text="p.metodo"></td>
                        <td class="px-4 py-3 text-slate2 dark:text-slate-400 font-mono text-xs" x-text="p.data"></td>
                        <td class="px-4 py-3">
                            <span class="text-[11px] font-mono px-2 py-0.5 rounded-full"
                                  :class="p.estado === 'Pago' ? 'bg-green/10 text-green dark:bg-emerald-500/20 dark:text-emerald-400' : 'bg-red/10 text-red dark:bg-rose-500/20 dark:text-rose-400'"
                                  x-text="p.estado"></span>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div x-show="modalPagamento" x-cloak class="fixed inset-0 bg-ink/60 dark:bg-slate-950/80 flex items-center justify-center z-50 p-4" @click.self="modalPagamento=false">
        <div class="bg-card dark:bg-slate-800 border dark:border-slate-700 rounded-xl w-full max-w-md p-6 shadow-xl">
            <h3 class="font-display font-semibold text-lg mb-4 text-slate-800 dark:text-slate-100">Registar pagamento</h3>
            <form @submit.prevent="modalPagamento=false" class="space-y-3 text-sm">
                <div>
                    <label class="text-xs font-medium text-slate2 dark:text-slate-300">Aluno</label>
                    <select class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50">
                        <template x-for="a in alunos" :key="a.matricula"><option x-text="a.nome"></option></template>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium text-slate2 dark:text-slate-300">Valor (Kz)</label>
                        <input type="number" class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="35000">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-slate2 dark:text-slate-300">Método</label>
                        <select class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50">
                            <option>Transferência</option>
                            <option>Multicaixa</option>
                            <option>Numerário</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="modalPagamento=false" class="px-4 py-2 text-sm rounded-lg text-slate2 dark:text-slate-300 hover:bg-surface dark:hover:bg-slate-700">Cancelar</button>
                    <button type="submit" class="px-4 py-2 text-sm rounded-lg bg-ink dark:bg-amber dark:text-ink text-white font-semibold hover:bg-ink2 dark:hover:bg-amberD transition-colors">Confirmar pagamento</button>
                </div>
            </form>
        </div>
    </div>
</section>

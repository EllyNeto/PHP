<section x-show="activeTab === 'docentes'">
    <div class="nameplate rounded-xl p-4 mb-5 flex items-center justify-between text-white">
        <div class="flex items-center gap-3">
            <span class="rivet"></span><span class="rivet"></span>
            <div>
                <p class="text-[11px] font-mono text-white/60 uppercase">Corpo docente</p>
                <p class="font-display font-semibold">Formadores</p>
            </div>
        </div>
        <button @click="modalDocente = true" class="bg-amber text-ink text-sm font-semibold px-4 py-2 rounded-lg hover:bg-amberD hover:text-white transition-colors">+ Novo docente</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <template x-for="d in docentes" :key="d.id">
            <div class="bg-card dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl p-4 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-ink dark:bg-amber dark:text-ink text-white flex items-center justify-center font-display text-sm font-semibold" x-text="d.iniciais"></div>
                    <div>
                        <p class="font-medium text-slate-800 dark:text-slate-100" x-text="d.nome"></p>
                        <p class="text-xs text-slate2 dark:text-slate-400" x-text="d.especialidade"></p>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between text-xs">
                    <span class="text-slate2 dark:text-slate-400 font-mono" x-text="d.contacto"></span>
                    <span class="font-mono px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-700 text-slate2 dark:text-slate-300" x-text="d.turmas + ' turma(s)'"></span>
                </div>
            </div>
        </template>
    </div>

    <div x-show="modalDocente" x-cloak class="fixed inset-0 bg-ink/60 dark:bg-slate-950/80 flex items-center justify-center z-50 p-4" @click.self="modalDocente=false">
        <div class="bg-card dark:bg-slate-800 border dark:border-slate-700 rounded-xl w-full max-w-md p-6 shadow-xl">
            <h3 class="font-display font-semibold text-lg mb-4 text-slate-800 dark:text-slate-100">Novo docente</h3>
            <form @submit.prevent="modalDocente=false" class="space-y-3 text-sm">
                <div>
                    <label class="text-xs font-medium text-slate2 dark:text-slate-300">Nome completo</label>
                    <input class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="ex.: João Baptista">
                </div>
                <div>
                    <label class="text-xs font-medium text-slate2 dark:text-slate-300">Especialidade</label>
                    <input class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="ex.: Redes e Telecomunicações">
                </div>
                <div>
                    <label class="text-xs font-medium text-slate2 dark:text-slate-300">Contacto</label>
                    <input class="w-full mt-1 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg px-3 py-2 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber/50" placeholder="+244 9__ ___ ___">
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="modalDocente=false" class="px-4 py-2 text-sm rounded-lg text-slate2 dark:text-slate-300 hover:bg-surface dark:hover:bg-slate-700">Cancelar</button>
                    <button type="submit" class="px-4 py-2 text-sm rounded-lg bg-ink dark:bg-amber dark:text-ink text-white font-semibold hover:bg-ink2 dark:hover:bg-amberD transition-colors">Guardar docente</button>
                </div>
            </form>
        </div>
    </div>
</section>

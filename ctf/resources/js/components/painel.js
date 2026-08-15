// Estado e dados do painel do Centro de Formação.
// Regista-se em resources/js/app.js via Alpine.data('painel', painel)
// e é usado na view com x-data="painel()".
export default function painel() {
  return {
    activeTab: 'dashboard',
    darkMode: localStorage.getItem('theme') === 'dark',
    modalCurso: false,
    modalTurma: false,
    modalFormador: false,
    modalDocente: false,
    modalInscricao: false,
    modalPagamento: false,

    init() {
      if (this.darkMode) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    },

    toggleDarkMode() {
      this.darkMode = !this.darkMode;
      localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
      if (this.darkMode) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    },

    navItems: [
      { id: 'dashboard',   label: 'Dashboard',   subtitle: 'Visão geral do centro',            icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>' },
      { id: 'cursos',      label: 'Cursos',       subtitle: 'Catálogo de cursos ministrados',   icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>' },
      { id: 'turmas',      label: 'Turmas',       subtitle: 'Organização de turmas e horários', icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>' },
      { id: 'formadores',  label: 'Formadores',   subtitle: 'Corpo de formadores',              icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>' },
      { id: 'inscricoes',  label: 'Inscrições',   subtitle: 'Candidaturas a novos cursos',       icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>' },
      { id: 'alunos',      label: 'Alunos',       subtitle: 'Formandos matriculados',            icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.5 3 3 6 3s6-1.5 6-3v-5"/></svg>' },
      { id: 'financas',    label: 'Finanças',     subtitle: 'Propinas e pagamentos',             icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9 9.5c0-1.5 1.5-2 3-2s3 .8 3 2-1.5 1.8-3 2-3 .7-3 2 1.5 2 3 2 3-.5 3-2"/></svg>' },
      { id: 'relatorios',  label: 'Relatórios',   subtitle: 'Indicadores e exportações',         icon: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><rect x="7" y="12" width="3" height="6"/><rect x="12" y="8" width="3" height="10"/><rect x="17" y="5" width="3" height="13"/></svg>' },
    ],

    get currentNav() {
      return this.navItems.find(n => n.id === this.activeTab) || this.navItems[0];
    },

    kpis: [
      { label: 'Formandos activos', value: '812',  trend: '+38 este trimestre', trendUp: true },
      { label: 'Turmas em curso',   value: '27',   trend: '4 a iniciar em Set.', trendUp: true },
      { label: 'Taxa de ocupação',  value: '86%',  trend: '+5% face ao trimestre anterior', trendUp: true },
      { label: 'Inadimplência',     value: '12,6%',trend: '+1,2% — acima da meta', trendUp: false },
    ],

    ocupacaoAreas: [
      { nome: 'Tecnologias de Informação',    ocupadas: 210, vagas: 240 },
      { nome: 'Electricidade e Mecatrónica',  ocupadas: 168, vagas: 200 },
      { nome: 'Mecânica e Produção',          ocupadas: 140, vagas: 180 },
      { nome: 'Metrologia',                   ocupadas: 54,  vagas: 90  },
      { nome: 'Energias Renováveis',          ocupadas: 76,  vagas: 100 },
    ],

    cursos: [
      { codigo: 'TIC-204', nome: 'Redes e Infraestruturas de TI', area: 'Tecnologias de Informação', nivel: 'Técnico', duracao: '9 meses', turmasAtivas: 3 },
      { codigo: 'ELM-118', nome: 'Electricidade Industrial',       area: 'Electricidade e Mecatrónica', nivel: 'Técnico', duracao: '6 meses', turmasAtivas: 2 },
      { codigo: 'MPR-072', nome: 'Soldagem e Caldeiraria',         area: 'Mecânica e Produção', nivel: 'Qualificação', duracao: '4 meses', turmasAtivas: 2 },
      { codigo: 'MET-031', nome: 'Metrologia Dimensional',         area: 'Metrologia', nivel: 'Aperfeiçoamento', duracao: '3 meses', turmasAtivas: 1 },
      { codigo: 'ENR-055', nome: 'Sistemas Fotovoltaicos',         area: 'Energias Renováveis', nivel: 'Técnico', duracao: '6 meses', turmasAtivas: 2 },
      { codigo: 'EMP-009', nome: 'Empreendedorismo e Gestão',      area: 'Empreendedorismo', nivel: 'Aperfeiçoamento', duracao: '2 meses', turmasAtivas: 1 },
    ],

    turmas: [
      { id: 'T-TIC204-A', curso: 'Redes e Infraestruturas de TI', formador: 'João Baptista', horario: 'Seg/Qua/Sex · 08h–12h', ocupadas: 24, capacidade: 25, estado: 'Em curso' },
      { id: 'T-ELM118-B', curso: 'Electricidade Industrial',       formador: 'Manuel Sacaia', horario: 'Ter/Qui · 14h–18h',    ocupadas: 18, capacidade: 20, estado: 'Em curso' },
      { id: 'T-MPR072-A', curso: 'Soldagem e Caldeiraria',         formador: 'Isabel Chindenga', horario: 'Seg–Sex · 07h–11h', ocupadas: 15, capacidade: 18, estado: 'A iniciar' },
      { id: 'T-ENR055-A', curso: 'Sistemas Fotovoltaicos',         formador: 'Carlos Muatxinene', horario: 'Sáb · 08h–17h',    ocupadas: 20, capacidade: 22, estado: 'Em curso' },
    ],

    formadores: [
      { id: 1, nome: 'João Baptista',     especialidade: 'Redes e Telecomunicações', contacto: '+244 923 000 111', turmas: 2, iniciais: 'JB' },
      { id: 2, nome: 'Manuel Sacaia',     especialidade: 'Instalações Eléctricas',   contacto: '+244 912 222 333', turmas: 1, iniciais: 'MS' },
      { id: 3, nome: 'Isabel Chindenga',  especialidade: 'Soldagem Industrial',       contacto: '+244 934 444 555', turmas: 1, iniciais: 'IC' },
      { id: 4, nome: 'Carlos Muatxinene', especialidade: 'Energias Renováveis',       contacto: '+244 945 666 777', turmas: 1, iniciais: 'CM' },
    ],

    inscricoes: [
      { id: 1, candidato: 'Domingos Kiala',   curso: 'Redes e Infraestruturas de TI', data: '05/08/2026', estado: 'Pendente' },
      { id: 2, candidato: 'Ana Paula Neto',   curso: 'Sistemas Fotovoltaicos',        data: '04/08/2026', estado: 'Aprovada' },
      { id: 3, candidato: 'Fernando Bumba',   curso: 'Soldagem e Caldeiraria',        data: '03/08/2026', estado: 'Pendente' },
      { id: 4, candidato: 'Marta Cassinda',   curso: 'Electricidade Industrial',      data: '01/08/2026', estado: 'Rejeitada' },
      { id: 5, candidato: 'Pedro Sumbo',      curso: 'Metrologia Dimensional',        data: '29/07/2026', estado: 'Aprovada' },
    ],

    alunos: [
      { matricula: 'CF-2026-0341', nome: 'Domingos Kiala',  turma: 'T-TIC204-A', pagamento: 'Em dia' },
      { matricula: 'CF-2026-0298', nome: 'Ana Paula Neto',  turma: 'T-ENR055-A', pagamento: 'Em dia' },
      { matricula: 'CF-2026-0255', nome: 'Fernando Bumba',  turma: 'T-MPR072-A', pagamento: 'Em atraso' },
      { matricula: 'CF-2026-0212', nome: 'Marta Cassinda',  turma: 'T-ELM118-B', pagamento: 'Em dia' },
    ],

    pagamentos: [
      { id: 1, aluno: 'Domingos Kiala', curso: 'Redes e Infraestruturas de TI', valor: 'Kz 45.000', metodo: 'Multicaixa', data: '05/08/2026', estado: 'Pago' },
      { id: 2, aluno: 'Ana Paula Neto', curso: 'Sistemas Fotovoltaicos',        valor: 'Kz 38.000', metodo: 'Transferência', data: '03/08/2026', estado: 'Pago' },
      { id: 3, aluno: 'Fernando Bumba', curso: 'Soldagem e Caldeiraria',        valor: 'Kz 30.000', metodo: 'Numerário', data: '20/07/2026', estado: 'Em atraso' },
      { id: 4, aluno: 'Marta Cassinda', curso: 'Electricidade Industrial',      valor: 'Kz 42.000', metodo: 'Multicaixa', data: '01/08/2026', estado: 'Pago' },
    ],
  };
}

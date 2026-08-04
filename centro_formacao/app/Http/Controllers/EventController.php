<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\Enrollment;

class EventController extends Controller
{
    public function index()
    {
           return view('login');
    }

    public function dashboard()
    {
        $inscricoes = Enrollment::latest()->get();
        $totalInscricoes = $inscricoes->count();
        $aprovados = $inscricoes->where('payment_status', 'Confirmado')->count();
        $pendentes = $inscricoes->where('payment_status', 'Pendente')->count();
        $rejeitados = $inscricoes->where('payment_status', 'Rejeitado')->count();
        $taxaConfirmacao = $totalInscricoes > 0 ? (int) round(($aprovados / $totalInscricoes) * 100) : 0;

        $turmas = DB::table('classes')
            ->leftJoin('curses', 'classes.curse_id', '=', 'curses.id')
            ->leftJoin('enrollments', 'enrollments.class_id', '=', 'classes.id')
            ->select(
                'classes.id', 'classes.room', 'classes.teacher_name', 'classes.capacity', 'classes.status', 'classes.created_at',
                DB::raw('COALESCE(classes.course_name, curses.name) as course_name'),
                DB::raw('COUNT(enrollments.id) as student_count')
            )
            ->groupBy('classes.id', 'classes.room', 'classes.teacher_name', 'classes.capacity', 'classes.status', 'classes.created_at', 'classes.course_name', 'curses.name')
            ->orderByDesc('classes.created_at')
            ->get();

        $capacidadeTotal = $turmas->sum('capacity');
        $alunosAtribuidos = $turmas->sum('student_count');
        $vagasDisponiveis = max(0, $capacidadeTotal - $alunosAtribuidos);

        $matriculasPorCurso = $inscricoes->groupBy('course')->map->count();
        $areasChart = [
            'labels' => $matriculasPorCurso->keys()->values(),
            'data' => $matriculasPorCurso->values(),
        ];

        $inicioPeriodo = now()->copy()->subMonths(3)->startOfMonth();
        $inscricoesRecentes = $inscricoes->filter(function (Enrollment $inscricao) use ($inicioPeriodo) {
            return $inscricao->created_at && $inscricao->created_at->greaterThanOrEqualTo($inicioPeriodo);
        });
        $conclusaoChart = ['labels' => [], 'data' => []];
        for ($mes = 3; $mes >= 0; $mes--) {
            $data = now()->copy()->subMonths($mes);
            $conclusaoChart['labels'][] = $data->format('M Y');
            $conclusaoChart['data'][] = $inscricoesRecentes->filter(function (Enrollment $inscricao) use ($data) {
                return $inscricao->created_at->format('Y-m') === $data->format('Y-m');
            })->count();
        }

        $kpis = [
            ['label' => 'Formandos aprovados', 'value' => $aprovados, 'accent' => 'amber', 'icon' => 'formandos'],
            ['label' => 'Turmas em curso', 'value' => $turmas->where('status', 'Em curso')->count(), 'accent' => 'teal', 'icon' => 'turmas'],
            ['label' => 'Vagas disponíveis', 'value' => $vagasDisponiveis, 'accent' => 'green', 'icon' => 'vagas'],
            ['label' => 'Inscrições pendentes', 'value' => $pendentes, 'accent' => 'red', 'icon' => 'alerta'],
        ];
        $estadoInscricoes = [
            ['nome' => 'Confirmadas', 'total' => $aprovados, 'pct' => $totalInscricoes ? (int) round(($aprovados / $totalInscricoes) * 100) : 0],
            ['nome' => 'Pendentes', 'total' => $pendentes, 'pct' => $totalInscricoes ? (int) round(($pendentes / $totalInscricoes) * 100) : 0],
            ['nome' => 'Rejeitadas', 'total' => $rejeitados, 'pct' => $totalInscricoes ? (int) round(($rejeitados / $totalInscricoes) * 100) : 0],
        ];

        return view('dashboard', compact('kpis', 'areasChart', 'conclusaoChart', 'taxaConfirmacao', 'estadoInscricoes', 'turmas'));
    }
    public function matriculas()
    {
        $matriculas = Enrollment::latest('enrollment_date')->latest()->get();
        $totalMatriculas = $matriculas->count();
        $paymentConfirmationRate = $totalMatriculas > 0
            ? (int) round(($matriculas->where('payment_status', 'Confirmado')->count() / $totalMatriculas) * 100)
            : 0;
        $cursos = DB::table('curses')->orderBy('name')->get();

        return view('matriculas', compact('matriculas', 'paymentConfirmationRate', 'cursos'));
    }
    public function relatorios()
    {
        return view('relatorios');
    }
        public function definicoes()
    {
        return view('definicoes');
    }
        public function certificacoes()
    {
        return view('certificacoes');
    }
    public function cursos_turmas()
    {
        $cursos = DB::table('curses')->orderBy('name')->get();
        $turmas = DB::table('classes')
            ->leftJoin('curses', 'classes.curse_id', '=', 'curses.id')
            ->leftJoin('enrollments', 'enrollments.class_id', '=', 'classes.id')
            ->select(
                'classes.id',
                'classes.room',
                'classes.teacher_name',
                'classes.capacity',
                'classes.status',
                'classes.shift',
                'classes.schedule',
                DB::raw('COALESCE(classes.course_name, curses.name) as course_name'),
                DB::raw('COUNT(enrollments.id) as student_count')
            )
            ->groupBy('classes.id', 'classes.room', 'classes.teacher_name', 'classes.capacity', 'classes.status', 'classes.shift', 'classes.schedule', 'classes.course_name', 'curses.name')
            ->orderByDesc('classes.created_at')
            ->get();

        $turmasEmCurso = $turmas->where('status', 'Em curso')->count();
        $capacidadeTotal = $turmas->sum('capacity');
        $alunosEmTurmas = $turmas->sum('student_count');
        $ocupacaoMedia = $capacidadeTotal > 0 ? (int) round(($alunosEmTurmas / $capacidadeTotal) * 100) : 0;

        return view('cursos_turmas', compact('cursos', 'turmas', 'turmasEmCurso', 'capacidadeTotal', 'ocupacaoMedia'));
    }
    public function formandos()
    {
        $formandos = Enrollment::where('payment_status', 'Confirmado')->latest()->get();
        $inscritosAprovados = Enrollment::where('payment_status', 'Confirmado')
            ->whereNull('class_id')
            ->latest()
            ->get();
        $turmasDisponiveis = DB::table('classes')
            ->leftJoin('curses', 'classes.curse_id', '=', 'curses.id')
            ->select('classes.id', 'classes.room', DB::raw('COALESCE(classes.course_name, curses.name) as course_name'))
            ->orderBy('classes.room')
            ->get();
        $totalFormandos = $formandos->count();
        $novosEsteMes = $formandos->filter(function (Enrollment $formando) {
            return $formando->created_at && $formando->created_at->isCurrentMonth();
        })->count();

        return view('formandos', compact(
            'formandos',
            'inscritosAprovados',
            'turmasDisponiveis',
            'totalFormandos',
            'novosEsteMes'
        ));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'bilhete_identidade' => ['required', 'string', 'max:14'],
            'course' => ['required', 'string', 'max:100'],
            'payment_status' => ['required', 'string', 'in:Confirmado,Pendente,Rejeitado'],
        ]);

        Enrollment::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'bilhete_identidade' => $data['bilhete_identidade'],
            'course' => $data['course'],
            'status' => 'Em análise',
            'payment_status' => $data['payment_status'],
            'enrollment_date' => now()->toDateString(),
        ]);

        return redirect('/matriculas')->with('success', 'Matrícula registada com sucesso.');
    }

    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $data = $request->validate([
            'payment_status' => ['required', 'string', 'in:Confirmado,Pendente,Rejeitado'],
        ]);

        $enrollment->update(['payment_status' => $data['payment_status']]);

        return redirect('/matriculas')->with('success', 'Estado do pagamento atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return redirect('/matriculas')->with('success', 'Inscrição eliminada com sucesso.');
    }

    public function storeFormando(Request $request)
    {
        $data = $request->validate([
            'enrollment_id' => ['required', 'integer'],
            'class_id' => ['required', 'integer'],
        ]);

        $formando = Enrollment::where('id', $data['enrollment_id'])
            ->where('payment_status', 'Confirmado')
            ->whereNull('class_id')
            ->firstOrFail();
        $turma = DB::table('classes')->where('id', $data['class_id'])->first();

        if (! $turma) {
            return back()->withErrors(['class_id' => 'A turma selecionada não está disponível.'])->withInput();
        }

        $formando->update([
            'class_id' => $turma->id,
            'class_name' => $turma->room,
        ]);

        return redirect('/formandos')->with('success', 'Formando associado à turma com sucesso.');
    }

    public function storeTurma(Request $request)
    {
        $data = $request->validate([
            'room' => ['required', 'string', 'max:20'],
            'course_name' => ['required', 'string', 'max:100'],
            'teacher_name' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1', 'max:1000'],
            'status' => ['required', 'string', 'in:Planeada,Em curso,Concluída'],
            'shift' => ['required', 'string', 'in:Manhã,Tarde,Noite'],
            'schedule' => ['nullable', 'string', 'max:100'],
        ]);

        DB::table('classes')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        return redirect('/cursos_turmas')->with('success', 'Turma criada com sucesso.');
    }

    public function updateTurma(Request $request, $id)
    {
        $data = $request->validate([
            'room' => ['required', 'string', 'max:20'],
            'course_name' => ['required', 'string', 'max:100'],
            'teacher_name' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1', 'max:1000'],
            'status' => ['required', 'string', 'in:Planeada,Em curso,Concluída'],
            'shift' => ['required', 'string', 'in:Manhã,Tarde,Noite'],
            'schedule' => ['nullable', 'string', 'max:100'],
        ]);

        DB::table('classes')->where('id', $id)->update(array_merge($data, [
            'updated_at' => now(),
        ]));

        return redirect('/cursos_turmas')->with('success', 'Turma atualizada com sucesso.');
    }

    public function destroyTurma($id)
    {
        DB::table('classes')->where('id', $id)->delete();

        return redirect('/cursos_turmas')->with('success', 'Turma eliminada com sucesso.');
    }

    public function storeCurso(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:curses,name'],
            'description' => ['nullable', 'string'],
            'duration' => ['required', 'integer', 'min:1', 'max:10000'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        DB::table('curses')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        return redirect('/cursos_turmas')->with('success', 'Curso adicionado com sucesso.');
    }

    public function updateCurso(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:curses,name,' . $id],
            'description' => ['nullable', 'string'],
            'duration' => ['required', 'integer', 'min:1', 'max:10000'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        DB::table('curses')->where('id', $id)->update(array_merge($data, [
            'updated_at' => now(),
        ]));

        return redirect('/cursos_turmas')->with('success', 'Curso atualizado com sucesso.');
    }

    public function destroyCurso($id)
    {
        DB::table('curses')->where('id', $id)->delete();

        return redirect('/cursos_turmas')->with('success', 'Curso eliminado com sucesso.');
    }

    public function show($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        return view('matriculas.show', compact('enrollment'));
    }
}

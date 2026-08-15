<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inscription_model;
use App\Models\Finance_model;
use App\Models\ClasseModel;
use App\Models\TeacherModel;
use App\Models\CourseModel;
use App\Models\StudentModel;


class CentroF_Controller extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    protected function getValidationMessages()
    {
        return [
            'required' => 'Erraste o dado no campo ":attribute": este campo é de preenchimento obrigatório e deves retificar.',
            'email' => 'Erraste o dado no campo ":attribute": o formato do email introduzido é inválido e deves retificar.',
            'numeric' => 'Erraste o dado no campo ":attribute": deves introduzir um valor numérico válido para retificar.',
            'min' => 'Erraste o dado no campo ":attribute": o valor introduzido está abaixo do mínimo permitido e deves retificar.',
            'max' => 'Erraste o dado no campo ":attribute": ultrapassou o limite máximo de caracteres e deves retificar.',
            'unique' => 'Erraste o dado no campo ":attribute": este dado já se encontra registado no sistema e deves retificar.',
        ];
    }

    protected function getValidationAttributes()
    {
        return [
            'name' => 'Nome',
            'student_name' => 'Nome do Aluno',
            'student_info' => 'Aluno Seleccionado',
            'teacher_name' => 'Formador Responsável',
            'course' => 'Curso Pretendido',
            'course_name' => 'Curso Associado',
            'email' => 'Email',
            'phone' => 'Contacto Telefónico',
            'bi' => 'Bilhete de Identidade (BI)',
            'amount' => 'Valor em Kz',
            'method' => 'Método de Pagamento',
            'status' => 'Estado',
            'schedule' => 'Horário das Aulas',
            'capacity' => 'Vagas Máximas',
            'duration' => 'Duração do Curso',
            'description' => 'Descrição do Curso',
            'type' => 'Tipo de Curso',
            'inscription_id' => 'Formando / Candidato',
            'classe_id' => 'Turma Atribuída',
        ];
    }

    public function financas()
    {
        $hasFinanceTable = \Illuminate\Support\Facades\Schema::hasTable('finance');

        if ($hasFinanceTable) {
            $pagamentos = Finance_model::orderBy('id', 'desc')->get();

            $hasStatus = \Illuminate\Support\Facades\Schema::hasColumn('finance', 'status');

            if ($hasStatus) {
                $kpiRecebido = Finance_model::whereIn('status', ['pago', 'Pago', '1', 1])->sum('amount');
                $kpiAtraso = Finance_model::whereIn('status', ['em_atraso', 'em-atraso', 'Em atraso'])->sum('amount');
                $kpiPropinas = Finance_model::whereIn('status', ['pendente', 'Pendente', '0', 0])->sum('amount');
            } else {
                $kpiRecebido = Finance_model::sum('amount');
                $kpiAtraso = 0;
                $kpiPropinas = 0;
            }
        } else {
            $pagamentos = collect([]);
            $kpiRecebido = 0;
            $kpiAtraso = 0;
            $kpiPropinas = 0;
        }

        // Se a tabela de inscrições existir, carrega os alunos para o dropdown do modal
        if (\Illuminate\Support\Facades\Schema::hasTable('inscriptions')) {
            $alunos = Inscription_model::orderBy('name', 'asc')->get();
        } else {
            $alunos = collect([]);
        }

        return view('financas', compact('pagamentos', 'kpiRecebido', 'kpiAtraso', 'kpiPropinas', 'alunos'));
    }

    public function storePagamento(Request $request)
    {
        $validated = $request->validate([
            'student_info' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string|max:100',
        ], $this->getValidationMessages(), $this->getValidationAttributes());

        $parts = explode('|', $validated['student_info']);

        if (count($parts) >= 3) {
            $inscriptionId = trim($parts[0]);
            $studentName = trim($parts[1]);
            $courseName = trim($parts[2]);
        } elseif (count($parts) == 2) {
            $inscriptionId = null;
            $studentName = trim($parts[0]);
            $courseName = trim($parts[1]);
        } else {
            $inscriptionId = null;
            $studentName = trim($parts[0]);
            $courseName = 'Curso Geral';
        }

        // Tenta encontrar a inscrição correspondente se o ID não foi enviado
        if (!$inscriptionId) {
            $inscription = Inscription_model::where('name', $studentName)->first();
            if ($inscription) {
                $inscriptionId = $inscription->id;
            }
        } else {
            $inscription = Inscription_model::find($inscriptionId);
        }

        $pagamento = new Finance_model();
        $pagamento->inscription_id = $inscriptionId;
        $pagamento->student_name = $studentName;
        $pagamento->course = $courseName;
        $pagamento->amount = $validated['amount'];
        $pagamento->method = $validated['method'];
        $pagamento->payment_date = now();
        $pagamento->status = 'pago';
        $pagamento->description = 'Pagamento registado na tesouraria';
        $pagamento->save();

        // Atualiza a situação financeira do aluno na tabela de inscrições
        if (isset($inscription) && $inscription) {
            if (\Illuminate\Support\Facades\Schema::hasColumn('inscriptions', 'pagamento_info')) {
                $inscription->pagamento_info = '✅ Confirmado pelas Finanças — Pago';
            }
            if (\Illuminate\Support\Facades\Schema::hasColumn('inscriptions', 'status')) {
                $inscription->status = 'aprovado';
            }
            $inscription->save();
        }

        return redirect()->route('financas.index')->with('success', 'Pagamento de ' . $pagamento->student_name . ' (Kz ' . number_format($pagamento->amount, 0, ',', '.') . ') registado com sucesso!');
    }

    public function updatePagamento(Request $request, $id)
    {
        $pagamento = Finance_model::find($id);
        if (!$pagamento) {
            return redirect()->back()->with('error', 'Registo de pagamento não encontrado.');
        }

        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string|max:100',
            'status' => 'required|string|max:50',
        ], $this->getValidationMessages(), $this->getValidationAttributes());

        $pagamento->student_name = $validated['student_name'];
        $pagamento->course = $validated['course'];
        $pagamento->amount = $validated['amount'];
        $pagamento->method = $validated['method'];
        $pagamento->status = $validated['status'];
        $pagamento->save();

        if ($pagamento->inscription_id) {
            $inscription = Inscription_model::find($pagamento->inscription_id);
            if ($inscription) {
                if (in_array(strtolower($validated['status']), ['pago', 'confirmado', '1'])) {
                    if (\Illuminate\Support\Facades\Schema::hasColumn('inscriptions', 'pagamento_info')) {
                        $inscription->pagamento_info = '✅ Confirmado pelas Finanças — Pago';
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('inscriptions', 'status')) {
                        $inscription->status = 'aprovado';
                    }
                    $inscription->save();
                }
            }
        }

        return redirect()->route('financas.index')->with('success', 'Dados do pagamento de "' . $pagamento->student_name . '" atualizados com sucesso!');
    }

    public function destroyPagamento($id)
    {
        $pagamento = Finance_model::find($id);
        if (!$pagamento) {
            return redirect()->back()->with('error', 'Pagamento não encontrado.');
        }

        $nome = $pagamento->student_name;
        $pagamento->delete();

        return redirect()->route('financas.index')->with('success', 'Registro de pagamento de "' . $nome . '" eliminado com sucesso!');
    }

    public function cursos()
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('courses')) {
            $cursos = CourseModel::orderBy('id', 'desc')->get();
        } else {
            $cursos = collect([]);
        }

        return view('cursos', compact('cursos'));
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'duration' => 'required|numeric|min:1',
        ], $this->getValidationMessages(), $this->getValidationAttributes());

        $course = new CourseModel();
        $course->name = $validated['name'];
        $course->type = $validated['type'];
        $course->description = $validated['description'];
        $course->duration = $validated['duration'];
        $course->save();

        return redirect()->route('cursos.index')->with('success', 'Curso "' . $course->name . '" adicionado com sucesso!');
    }

    public function updateCourse(Request $request, $id)
    {
        $course = CourseModel::find($id);
        if (!$course) {
            return redirect()->back()->with('error', 'Curso não encontrado.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'duration' => 'required|numeric|min:1',
        ], $this->getValidationMessages(), $this->getValidationAttributes());

        $course->name = $validated['name'];
        $course->type = $validated['type'];
        $course->description = $validated['description'];
        $course->duration = $validated['duration'];
        $course->save();

        return redirect()->route('cursos.index')->with('success', 'Dados do curso "' . $course->name . '" atualizados com sucesso!');
    }

    public function destroyCourse($id)
    {
        $course = CourseModel::find($id);
        if (!$course) {
            return redirect()->back()->with('error', 'Curso não encontrado.');
        }

        $nome = $course->name;
        $course->delete();

        return redirect()->route('cursos.index')->with('success', 'Curso "' . $nome . '" eliminado com sucesso!');
    }

    public function turmas()
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('classes')) {
            $turmas = ClasseModel::with(['course', 'teacher'])->orderBy('id', 'desc')->get();
        } else {
            $turmas = collect([]);
        }

        $cursos = CourseModel::all();
        $formadores = TeacherModel::all();
        $docentes = $formadores;

        return view('turmas', compact('turmas', 'cursos', 'formadores', 'docentes'));
    }

    public function storeTurma(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'teacher_name' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'capacity' => 'required|numeric|min:1',
            'code' => 'nullable|string|max:100',
        ], $this->getValidationMessages(), $this->getValidationAttributes());

        $course = CourseModel::where('name', $validated['course_name'])->first();
        $teacher = TeacherModel::where('name', $validated['teacher_name'])->first();

        $code = $request->input('code');
        if (!$code) {
            $prefix = $course ? strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $course->name), 0, 3)) : 'TRM';
            $code = 'T-' . $prefix . rand(100, 999) . '-A';
        }

        $turma = new ClasseModel();
        $turma->code = $code;
        $turma->name = 'Turma ' . $code;
        $turma->course_name = $validated['course_name'];
        $turma->course_id = $course ? $course->id : null;
        $turma->teacher_name = $validated['teacher_name'];
        $turma->teacher_id = $teacher ? $teacher->id : null;
        $turma->schedule = $validated['schedule'];
        $turma->enrolled = 0;
        $turma->capacity = $validated['capacity'];
        $turma->status = 'Em Curso';
        $turma->save();

        return redirect()->route('turmas.index')->with('success', 'Turma "' . $turma->code . '" criada com sucesso!');
    }

    public function updateTurma(Request $request, $id)
    {
        $turma = ClasseModel::find($id);
        if (!$turma) {
            return redirect()->back()->with('error', 'Turma não encontrada.');
        }

        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'teacher_name' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'capacity' => 'required|numeric|min:1',
            'enrolled' => 'nullable|numeric|min:0',
            'status' => 'required|string|max:50',
        ], $this->getValidationMessages(), $this->getValidationAttributes());

        $course = CourseModel::where('name', $validated['course_name'])->first();
        $teacher = TeacherModel::where('name', $validated['teacher_name'])->first();

        $turma->course_name = $validated['course_name'];
        $turma->course_id = $course ? $course->id : null;
        $turma->teacher_name = $validated['teacher_name'];
        $turma->teacher_id = $teacher ? $teacher->id : null;
        $turma->schedule = $validated['schedule'];
        $turma->enrolled = $request->input('enrolled', $turma->enrolled);
        $turma->capacity = $validated['capacity'];
        $turma->status = $validated['status'];
        $turma->save();

        return redirect()->route('turmas.index')->with('success', 'Dados da turma "' . $turma->code . '" atualizados com sucesso!');
    }

    public function destroyTurma($id)
    {
        $turma = ClasseModel::find($id);
        if (!$turma) {
            return redirect()->back()->with('error', 'Turma não encontrada.');
        }

        $code = $turma->code;
        $turma->delete();

        return redirect()->route('turmas.index')->with('success', 'Turma "' . $code . '" eliminada com sucesso!');
    }

    public function formadores()
    {
        return view('formadores');
    }

    public function docentes()
    {
        return $this->formadores();
    }

    public function inscricoes()
    {
        $inscricoes = Inscription_model::orderBy('id', 'desc')->get();

        $hasStatus = \Illuminate\Support\Facades\Schema::hasColumn('inscriptions', 'status');

        if ($hasStatus) {
            $kpiPendentes = Inscription_model::whereIn('status', ['pendente', 'Pendente Avaliação'])->orWhereNull('status')->count();
            $kpiAprovadas = Inscription_model::whereIn('status', ['aprovado', 'aprovada', 'Aprovada (Pago)'])->count();
            $kpiRejeitadas = Inscription_model::whereIn('status', ['rejeitado', 'rejeitada', 'Rejeitada'])->count();
        } else {
            $kpiPendentes = $inscricoes->count();
            $kpiAprovadas = 0;
            $kpiRejeitadas = 0;
        }

        $cursos = CourseModel::all();

        return view('inscricoes', compact('inscricoes', 'kpiPendentes', 'kpiAprovadas', 'kpiRejeitadas', 'cursos'));
    }

    public function storeInscriptions(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:50',
                'bi' => 'nullable|string|max:20',
                'course' => 'required|string|max:255',
            ], $this->getValidationMessages(), $this->getValidationAttributes());

            $existing = Inscription_model::where('email', $validated['email'])->first();
            if ($existing) {
                return redirect()->back()->withInput()->with('error', 'Erraste o dado no campo "Email": o email "' . $validated['email'] . '" já se encontra registado no sistema e deves retificar.');
            }

            $inscription = new Inscription_model();
            $inscription->name = $validated['name'];
            $inscription->email = $validated['email'];
            $inscription->phone = $request->input('phone', '') ?: '';
            $inscription->bi = $request->input('bi', '') ?: '';
            $inscription->course = $validated['course'];
            
            if (\Illuminate\Support\Facades\Schema::hasColumn('inscriptions', 'status')) {
                $inscription->status = 'pendente';
            }
            if (\Illuminate\Support\Facades\Schema::hasColumn('inscriptions', 'pagamento_info')) {
                $inscription->pagamento_info = '⏳ Pendente nas Finanças — Aguardando Pagamento';
            }
            
            $inscription->save();

            if (\Illuminate\Support\Facades\Schema::hasTable('students') && \Illuminate\Support\Facades\Schema::hasTable('classes')) {
                $turma = ClasseModel::where('course_name', $inscription->course)->first();
                if ($turma) {
                    StudentModel::updateOrCreate(
                        ['inscription_id' => $inscription->id],
                        ['classe_id' => $turma->id]
                    );
                }
            }

            return redirect()->route('inscricoes.index')->with('success', 'Nova candidatura de "' . $inscription->name . '" submetida com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erro ao registar candidatura: ' . $e->getMessage());
        }
    }

    public function updateInscription(Request $request, $id)
    {
        $inscription = Inscription_model::find($id);
        if (!$inscription) {
            return redirect()->back()->with('error', 'Inscrição não encontrada.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'bi' => 'nullable|string|max:20',
            'course' => 'required|string|max:255',
        ], $this->getValidationMessages(), $this->getValidationAttributes());

        $inscription->name = $validated['name'];
        $inscription->email = $validated['email'];
        $inscription->phone = $request->input('phone', $inscription->phone);
        $inscription->bi = $request->input('bi', $inscription->bi);
        $inscription->course = $validated['course'];
        $inscription->save();

        return redirect()->route('inscricoes.index')->with('success', 'Dados do formando "' . $inscription->name . '" atualizados com sucesso!');
    }

    public function destroyInscription($id)
    {
        $inscription = Inscription_model::find($id);
        if (!$inscription) {
            return redirect()->back()->with('error', 'Inscrição não encontrada.');
        }

        $nome = $inscription->name;
        $inscription->delete();

        return redirect()->route('inscricoes.index')->with('success', 'Inscrição de "' . $nome . '" eliminada com sucesso!');
    }
    public function formandos()
    {
        return view('formandos');
    }

    public function matriculas()
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('students')) {
            $matriculas = StudentModel::with(['inscription', 'classe'])->orderBy('id', 'desc')->get();
        } else {
            $matriculas = collect([]);
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('inscriptions')) {
            $candidatosPagos = Inscription_model::orderBy('name', 'asc')->get();
        } else {
            $candidatosPagos = collect([]);
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('classes')) {
            $turmas = ClasseModel::orderBy('code', 'asc')->get();
        } else {
            $turmas = collect([]);
        }

        $kpiMatriculados = $matriculas->count();
        $kpiAguardando = Inscription_model::whereIn('status', ['aprovado', 'aprovada', 'Pago'])->count();

        return view('matriculas', compact('matriculas', 'candidatosPagos', 'turmas', 'kpiMatriculados', 'kpiAguardando'));
    }

    public function storeMatricula(Request $request)
    {
        $validated = $request->validate([
            'inscription_id' => 'required|numeric|exists:inscriptions,id',
            'classe_id' => 'required|numeric|exists:classes,id',
        ], $this->getValidationMessages(), $this->getValidationAttributes());

        $existing = StudentModel::where('inscription_id', $validated['inscription_id'])->first();
        if ($existing) {
            $existing->classe_id = $validated['classe_id'];
            $existing->save();
            $inscription = Inscription_model::find($validated['inscription_id']);
            $nome = $inscription ? $inscription->name : 'Aluno';
            return redirect()->route('matriculas.index')->with('success', 'Matrícula do formando "' . $nome . '" atualizada com sucesso!');
        }

        $student = new StudentModel();
        $student->inscription_id = $validated['inscription_id'];
        $student->classe_id = $validated['classe_id'];
        $student->save();

        $inscription = Inscription_model::find($validated['inscription_id']);
        $nome = $inscription ? $inscription->name : 'Aluno';

        return redirect()->route('matriculas.index')->with('success', 'Matrícula de "' . $nome . '" formalizada com sucesso!');
    }

    public function updateMatricula(Request $request, $id)
    {
        $student = StudentModel::find($id);
        if (!$student) {
            return redirect()->back()->with('error', 'Registo de matrícula não encontrado.');
        }

        $validated = $request->validate([
            'classe_id' => 'required|numeric|exists:classes,id',
        ], $this->getValidationMessages(), $this->getValidationAttributes());

        $student->classe_id = $validated['classe_id'];
        $student->save();

        return redirect()->route('matriculas.index')->with('success', 'Turma da matrícula MTR-2026-' . sprintf('%03d', $student->id) . ' atualizada com sucesso!');
    }

    public function destroyMatricula($id)
    {
        $student = StudentModel::find($id);
        if (!$student) {
            return redirect()->back()->with('error', 'Registo de matrícula não encontrado.');
        }

        $code = 'MTR-2026-' . sprintf('%03d', $student->id);
        $student->delete();

        return redirect()->route('matriculas.index')->with('success', 'Matrícula "' . $code . '" eliminada com sucesso!');
    }

    public function certificacoes()
    {
        return view('certificacoes');
    }

    public function relatorios()
    {
        return view('relatorios');
    }

    public function definicoes()
    {
        return view('definicoes');
    }

    public function login()
    {
        return view('login');
    }
}

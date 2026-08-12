<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inscription_model;
use App\Models\Finance_model;

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
        ]);

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
        return view('cursos');
    }

    public function turmas()
    {
        return view('turmas');
    }

    public function docentes()
    {
        return view('docentes');
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

        return view('inscricoes', compact('inscricoes', 'kpiPendentes', 'kpiAprovadas', 'kpiRejeitadas'));
    }

    public function storeInscriptions(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'bi' => 'nullable|string|max:20',
            'course' => 'required|string|max:255',
        ]);

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

        return redirect()->route('inscricoes.index')->with('success', 'Nova candidatura de "' . $inscription->name . '" submetida com sucesso!');
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
        ]);

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
        return view('matriculas');
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

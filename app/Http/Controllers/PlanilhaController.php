<?php

namespace App\Http\Controllers;

use App\Exports\PlanilhaExport;
use App\Imports\PlanilhaImport;
use App\Models\DadoPlanilha;
use App\Models\Planilha;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PlanilhaController extends Controller
{
    public function index()
    {
        $planilhas = Planilha::all();

        return view('processos', compact('planilhas'));
    }

    public function import(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
            'arquivo' => 'required|mimes:csv,xlsx',
        ]);

        $file = $request->file('arquivo');
        $path = $file->store('planilhas', 'public');

        $data['arquivo'] = $path;
        $planilha = Planilha::create($data);

        $import = new PlanilhaImport($planilha->id);
        Excel::import($import, $file);

        return back()->with('success', "Planilha importada com {$import->rows} registros");
    }

    public function editar($id)
    {
        $dados = DadoPlanilha::where('planilha_id', $id)->get();

        if ($dados->isEmpty()) {
            return redirect()->back()->with('error', 'Nenhum dado encontrado para esta planilha.');
        }

        // dd($dados);

        return view('editar', compact('dados', 'id'));
    }

    public function atualizar(Request $request, $id)
    {
        $dados = $request->input('dados');

        foreach ($dados as $dadoId => $dado) {
            DadoPlanilha::where('id', $dadoId)->update($dado);
        }

        return redirect()->route('planilha.editar', $id)->with('success', 'Planilha atualizada com sucesso.');
    }

    public function show($id)
    {
        $planilha = Planilha::findOrFail($id);

        $dados = $planilha->getDadosFormatados();

        return view('show_planilha', compact('planilha', 'dados'));
    }

    public function atualizarValor(Request $request, $id)
    {
        $request->validate([
            'linha' => 'required|integer',
            'coluna_id' => 'required|exists:colunas_planilha,id',
            'valor' => 'required',
        ]);

        DadoPlanilha::updateOrCreate(
            [
                'planilha_id' => $id,
                'coluna_id' => $request->coluna_id,
                'linha' => $request->linha,
            ],
            ['valor' => $request->valor]
        );

        return response()->json(['success' => true]);
    }

    public function export(Request $request, $id)
    {
        // Validação do ID da planilha (opcional)
        $planilha = Planilha::findOrFail($id);

        // Cria a exportação com o ID da planilha
        $export = new PlanilhaExport($planilha->id);

        // Define o nome do arquivo
        $fileName = 'planilha_'.$planilha->id.'.xlsx';

        // Faz o download do arquivo
        return Excel::download($export, $fileName);
    }

    public function destroy($id)
    {

        $planilha = Planilha::findOrFail($id);

        $planilha->delete();

        return back()->with('success', 'Planilha deletada com sucesso');
    }
}

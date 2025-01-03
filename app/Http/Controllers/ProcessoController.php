<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('processos');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        $path = $request->file('file')->getRealPath();

        $data = Excel::toArray([], $path);

        if (empty($data) || count($data[0]) === 0) {
            return back()->with('error', 'O arquivo está vazio ou inválido.');
        }

        return view('processos', ['data' => $data[0]]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ], [
            'file.required' => 'Selecione um arquivo para fazer upload.',
            'file.mimes' => 'O arquivo deve estar em formato xlsx, xls ou csv.',
            'file.max' => 'O arquivo não pode ultrapassar 2 MB.',
        ]);

        // Salvar o arquivo no armazenamento padrão (local, S3, etc.)
        $path = $request->file('file')->store('planilhas');

        return back()->with('success', 'Arquivo enviado com sucesso!')->with('filePath', $path);
    }

    public function showProcessos()
    {
        // Lista todos os arquivos de planilha na pasta uploads
        $files = Storage::disk('public')->files('uploads');

        return view('processos', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

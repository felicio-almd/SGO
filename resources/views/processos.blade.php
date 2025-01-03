<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SGO</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased text-black">
        <header class="!bg-black text-white/50 flex justify-between px-10 py-5">
            <h1>Sistema de Gerenciamento de Obras</h1>
            <div class="flex gap-10 items-center">
                <p>Olá, {{ Auth::user()->name }}!</p>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-500 hover:underline">Sair</button>
                </form>
            </div>
        </header>
        <main class="flex gap-10">
    <aside class="bg-blue-500 h-screen p-10 gap-3 flex flex-col">
        <a href="/processos" class="bg-blue-600 p-3 rounded hover:scale-105 hover:cursor-pointer transition-all">Processos</a>
        <a href="/cronogramas" class="bg-blue-600 p-3 rounded hover:scale-105 hover:cursor-pointer transition-all">Cronogramas</a>
    </aside>
    <div class="p-4 flex-1">
        <h1 class="text-3xl mb-4">PROCESSOS</h1>

        {{-- Formulário para Importar Planilha --}}
        <form action="{{ route('processos.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="mb-2">
            <button class="rounded border p-2 bg-green-500">Importar Planilha</button>
        </form>

        {{-- Exibe Mensagem de Erro ou Sucesso --}}
        @if(session('error'))
            <div class="text-red-500">{{ session('error') }}</div>
        @endif

        {{-- Exibir a Tabela Importada --}}
        @if(isset($data))
            <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
                <thead>
                    <tr>
                        @foreach ($data[0] as $key => $value)
                            <th class="border border-gray-300 px-4 py-2">{{ $key }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td class="border border-gray-300 px-4 py-2">{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <form action="{{ route('processos.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Selecione a Planilha:</label>
                <input type="file" name="file" id="file" accept=".xls,.xlsx,.csv" 
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:ring-primary focus:border-primary">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                Upload Planilha
            </button>
        </form>

        {{-- Exibir planilhas disponíveis --}}
        @if (isset($files) && count($files) > 0)
            <div class="mt-6">
                <h2 class="text-xl font-semibold">Planilhas Disponíveis</h2>
                <ul class="list-disc pl-5">
                    @foreach ($files as $file)
                        <li>
                            <a href="{{ Storage::disk('public')->url($file) }}" class="text-blue-600 hover:underline" target="_blank">
                                {{ basename($file) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif


        </div>
    </main>

    </body>
</html>

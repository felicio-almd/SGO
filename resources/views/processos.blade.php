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
            <a href="/">
                <h1>Sistema de Gerenciamento de Obras</h1>
            </a>
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
                <a href="/cronogramas" class="bg-blue-600 p-3 rounded hover:scale-105 hover:cursor-pointer transition-all">Cronogramas</a>
            </aside>
            <div class="p-4 flex-1">
                <h1 class="text-3xl mb-4">PROCESSOS</h1>
                <form class="flex flex-col gap-2" action="{{ route('planilhas.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input class="border rounded px-3 py-1" type="text" name="nome" placeholder="Nome da planilha">
                    <textarea class="border rounded px-3 py-1" name="descricao" placeholder="Descrição"></textarea>
                    <input class="border rounded px-3 py-1" type="file" name="arquivo">
                    <button class="border rounded px-3 py-1 bg-green-500" type="submit">Importar</button>
                </form>
                <div class="py-6">
                    <h3>Planilhas:</h3>
                    @foreach ($planilhas as $planilha)
                    <div class="flex border p-2 gap-5">
                        <h3 class="border px-5 py-2 w-1/2 text-lg">{{ $planilha->nome }}</h3>
                        <a href="{{ route('planilha.editar', $planilha->id) }}" class="border bg-yellow-400 p-2">Abrir Planilha</a>
                        <a href="{{ route('planilha.baixar', $planilha->id) }}" class="border bg-green-400 p-2">Baixar Planilha</a>
                        <form action="{{ route('planilha.excluir', $planilha->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta planilha?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border bg-red-600 p-2">Excluir Planilha</button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @if (session('success'))
                    <div class="alert alert-success bg-green-500 text-white p-4 rounded-lg shadow-md flex justify-between items-center">
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.style.display='none'" class="ml-4 text-white">&times;</button>
                    </div>
                @endif
            </div>
        </main>
    </body>
</html>

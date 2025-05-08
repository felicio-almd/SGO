<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar Planilha - {{ $planilha->nome }}</title>
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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">{{ $planilha->nome }}</h1>
                <a href="{{ url()->previous() }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Voltar
                </a>
            </div>

            <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 shadow-sm" style="border-collapse: collapse;">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th class="py-2 px-3 border border-gray-300 text-left bg-gray-100 font-semibold text-gray-700 sticky top-0" style="background-color: #f1f1f1;">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $index => $row)
                <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-blue-50">
                    @foreach ($headers as $header)
                        <td class="py-1.5 px-3 border border-gray-200">
                                {{ $row[$header] }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


    </main>
</body>
</html>
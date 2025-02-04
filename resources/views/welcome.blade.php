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
                <a href="/planilhas" class="bg-blue-600 p-3 rounded hover:scale-105 hover:cursor-pointer transition-all">Processos</a>
                <a href="/cronogramas" class="bg-blue-600 p-3 rounded hover:scale-105 hover:cursor-pointer transition-all">Cronogramas</a>
            </aside>
            <div class="p-4">
                <h1 class="text-3xl">Bem-vindo à Dashboard!</h1>
            </div>
        </main>
    </body>
</html>

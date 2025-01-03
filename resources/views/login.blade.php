<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - SGO</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="space-y-8">
            <div>
                <h1 class="mt-6 text-center text-3xl font-extrabold">Sistema de Gerenciamento de Obras</h1>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Acesse sua conta para continuar
                </p>
            </div>
            <form class="mt-8 space-y-6" action="/login" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" name="email" type="email" required placeholder="Email" value="test@example.com"
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary-700 sm:text-sm">
                    </div>
                    <div class="mt-4">
                        <label for="password" class="sr-only">Senha</label>
                        <input id="password" name="password" type="password" required placeholder="Senha" value="secret"
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary-700 sm:text-sm">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                               class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Lembrar-me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-primary hover:underline">Esqueceu sua senha?</a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border text-sm font-medium rounded-md text-white bg-slate-600 hover:bg-primary-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

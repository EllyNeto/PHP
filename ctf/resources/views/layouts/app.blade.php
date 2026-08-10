<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Painel de Gestão — Centro de Formação')</title>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-[#16202B] dark:bg-slate-900 dark:text-slate-100 antialiased font-body transition-colors duration-200">

    <div x-data="painel()" x-cloak class="flex h-screen overflow-hidden">

        @include('painel.partials.sidebar')

        <div class="flex-1 flex flex-col min-w-0">

            @include('painel.partials.topbar')

            <main class="flex-1 overflow-y-auto p-6 space-y-6">
                @yield('conteudo')
            </main>

        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="ro_RO">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Scoli Bucuresti</title>

        <link rel="icon" type="image/png" sizes="96x96" href="/icons/favicon96.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon16.png">

        <link rel="canonical" href="https://scoli-bucuresti.ro">
        <meta property="og:locale" content="ro_RO">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Compara scolile din bucuresti">
        <meta property="og:description" content="">
        <meta property="og:url" content="https://scoli-bucuresti.ro">
        <meta property="og:site_name" content="">
        <meta property="og:image" content="/icons/favicon96.png">
        <meta name="twitter:card" content="https://cryptoatm.ro/img/cover-min.png">
        <meta name="twitter:description" content="">
        <meta name="twitter:title" content="">

        <style>
                [x-cloak] { display: none !important; }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
            <!-- Page Content -->
            @include('partials.navbar')
            <main>
                {{ $slot }}
            </main>
            @livewireScripts
    </body>
</html>

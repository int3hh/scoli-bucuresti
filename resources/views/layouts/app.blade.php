<!DOCTYPE html>
<html lang="ro_RO">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>:: ScoliBune.ro ::</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
       
        <link rel="icon" type="image/png" sizes="96x96" href="/icons/favicon96.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon16.png">

        <link rel="canonical" href="https://scolibune.ro">
        <meta property="og:locale" content="ro_RO">
        <meta property="og:type" content="website">
        <meta property="og:title" content="ScoliBune.ro">
        <meta property="og:description" content="Agregator al scolilor din Bucuresti si Ilfov">
        <meta property="og:url" content="https://scolibune.ro">
        <meta property="og:site_name" content="">
        <meta property="og:image" content="/icons/favicon96.png">
        <meta name="twitter:description" content="Agregator al scolilor din Bucuresti si Ilfov">
        <meta name="twitter:title" content="ScoliBune.ro">
        
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css' rel='stylesheet' />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        @include('partials.navbar')
            <!-- Page Content -->
            <main class="pt-24 py-4 z-5 relative">
                {{ $slot }}
            </main>
            
        @livewireScripts
    </body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- TITLO --}}
    <title>{{ config('app.name', 'Boolfolio') }} | @yield('title')</title>

    {{-- STYLE BODY --}}
    <style>
        body{
            visibility: hidden;
        }
    </style>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- FONTAWESOME --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'
        integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=='
        crossorigin='anonymous' />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        {{-- NAVBAR --}}
        @include('includes.navbar')

        <main>

            {{-- ALERT MESSAGGI --}}
            @include('includes.alerts.alert')

            {{-- CONTENUTO PRINCIPALE --}}
            @yield('content')

        </main>
        
    </div>

    {{-- TOAST --}}
    @include('includes.alerts.toast')
    {{-- MODALE --}}
    @include('includes.alerts.modal')

    {{-- JS --}}
    @yield('js')
</body>

</html>

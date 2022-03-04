<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @section('title')
            Admin
        @show
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
          rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}">
    @livewireStyles
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed font-sans antialiased">
<div id="app" class="wrapper">
    @include('layouts._partials.navbar')

    @include('layouts._partials.sidebar')

    @include('layouts._partials.content')

    @include('layouts._partials.footer')
</div>

<!-- Scripts -->
<script>window.Laravel = {!! json_encode(['tenantId' => auth()->check() ? auth()->user()->tenant_id : '']) !!}</script>

@stack('modals')

@livewireScripts

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/dashboard/dashboard.js') }}"></script>
<script src="{{ mix('js/dashboard/component.js') }}"></script>

@stack('scripts')

</body>
</html>

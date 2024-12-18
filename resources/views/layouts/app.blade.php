<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta name="description" content="{{ config('app.description', '') }}">
    <meta name="keyword" content="{{ config('app.keywords', '') }}">
    <meta name="author" content="{{ config('app.author', '') }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title', 'Dashboard')</title>

    <!-- template duralux -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme.min.css') }}">
        
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #app {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .nxl-container {
            display: flex;
            flex-grow: 1;
            overflow: hidden;
        }

        .nxl-navigation.minimized {
            width: 80px;
        }

        h1 i {
            font-size: inherit; 
            vertical-align: middle;
        }

        .main-content {
            flex-grow: 1;
            width: calc(100% - 250px);
            transition: width 0.3s ease;
            overflow-x: auto;
        }

        .nxl-navigation.minimized + .main-content {
            width: calc(100% - 80px);
        }
    </style>

    @stack('styles')

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'baseUrl' => url('/'),
            'routes' => collect(\Route::getRoutes())->mapWithKeys(function ($route) {
                return [$route->getName() => $route->uri()];
            })->toJson()
        ]) !!};
    </script>
</head>
<body class="@yield('body-class')">
    <div id="loading-state" class="loading-state">
        <div class="loading-state-inner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div id="app">
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')
        <div class="nxl-container">
            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/js/common-init.min.js') }}"></script>

    @stack('scripts')

    <script>
        window.addEventListener('load', function() {
            document.getElementById('loading-state').style.display = 'none';
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const menuMiniButton = document.getElementById('menu-mini-button');
            const menuExpendButton = document.getElementById('menu-expend-button');
            const navigation = document.querySelector('.nxl-navigation');

            if (menuMiniButton && menuExpendButton && navigation) {
                menuMiniButton.addEventListener('click', function() {
                    navigation.classList.add('minimized');
                    menuMiniButton.style.display = 'none';
                    menuExpendButton.style.display = 'block';
                });

                menuExpendButton.addEventListener('click', function() {
                    navigation.classList.remove('minimized');
                    menuMiniButton.style.display = 'block';
                    menuExpendButton.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>
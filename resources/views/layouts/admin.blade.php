<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyPortfolio') }} @yield('title')</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body id="admin">
    <div id="app">

        {{-- header --}}
        <header id="admin-header" class="navbar navbar-dark sticky-top flex-md-nowrap p-2 shadow">
            <div class="row justify-content-between ">
                <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">Portfolio</a>
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap ms-2">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        {{-- container sidebar e main --}}
        <div class="container-fluid">
            <div class="row h-100">
                {{-- sidebar --}}
                <nav id="sidebar-menu"
                    class="col-md-3 col-lg-2 d-md-block navbar-dark sidebar collapse position-fixed ">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            {{-- MAIN DASHBOARD --}}
                            <li class="nav-item rounded-1 overflow-hidden">
                                <div class="nav-link subtitle fw-b">
                                    Dashboard
                                </div>
                            </li>
                            {{-- dashboard --}}
                            <li class="nav-item rounded-1 overflow-hidden">
                                <a class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'link-selected' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                                </a>
                            </li>

                            {{-- PROJECTS --}}
                            <li class="nav-item rounded-1 overflow-hidden">
                                <div class="nav-link subtitle fw-b">
                                    Projects
                                </div>
                            </li>
                            {{-- project list --}}
                            <li class="nav-item rounded-1 overflow-hidden">
                                <a class="nav-link {{ Route::currentRouteName() == 'admin.projects.index' ? 'link-selected' : '' }}"
                                    href="{{ route('admin.projects.index') }}">
                                    <i class="fa-solid fa-folder fa-lg fa-fw"></i> Projects List
                                </a>
                            </li>

                            {{-- create project --}}
                            <li class="nav-item rounded-1 overflow-hidden">
                                <a class="nav-link {{ Route::currentRouteName() == 'admin.projects.create' ? 'link-selected' : '' }}"
                                    href="{{ route('admin.projects.create') }}">
                                    <i class="fa-solid fa-plus fa-lg fa-fw"></i> New Project
                                </a>
                            </li>

                            {{-- TYPES --}}
                            <li class="nav-item rounded-1 overflow-hidden">
                                <div class="nav-link subtitle fw-b">
                                    Types
                                </div>
                            </li>
                            {{-- types list --}}
                            <li class="nav-item rounded-1 overflow-hidden">
                                <a class="nav-link {{ Route::currentRouteName() == 'admin.types.index' ? 'link-selected' : '' }}"
                                    href="{{ route('admin.types.index') }}">
                                    <i class="fa-solid fa-folder fa-lg fa-fw"></i> Types List
                                </a>
                            </li>
                            {{-- create type --}}
                            <li class="nav-item rounded-1 overflow-hidden">
                                <a class="nav-link {{ Route::currentRouteName() == 'admin.types.create' ? 'link-selected' : '' }}"
                                    href="{{ route('admin.types.create') }}">
                                    <i class="fa-solid fa-plus fa-lg fa-fw"></i> New Type
                                </a>
                            </li>
                        </ul>
                    </div>

                </nav>

                {{-- main --}}
                <main
                    class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-3 {{ Route::currentRouteName() !== 'admin.projects.index' ? 'main-height' : '' }}">
                    @yield('content')
                </main>
            </div>
        </div>

        {{-- notifications --}}
        <div class="notification">
            {{-- avviso creazione project --}}
            @if (session('message_create'))
                <div class="toast align-items-center border-0 fade show" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('message_create') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif

            {{-- avviso cancellazione project --}}
            @if (session('message_delete'))
                <div class="toast align-items-center border-0 fade show" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('message_delete') }}
                        </div>

                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif

            {{-- avviso modifica project --}}
            @if (session('message_update'))
                <div class="toast align-items-center border-0 fade show" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('message_update') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>

        {{-- scroll up button --}}
        <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    {{-- importo js in base alla pagina --}}
    @if (Route::currentRouteName() == 'admin.projects.create')
        <script src="{{ asset('js/image_preview.js') }}"></script>
    @endif

    @if (Route::currentRouteName() == 'admin.projects.edit')
        <script src="{{ asset('js/image_edit.js') }}"></script>
    @endif

    @if (Route::currentRouteName() == 'admin.projects.edit' || Route::currentRouteName() == 'admin.projects.create')
        <script src="{{ asset('js/remove_image.js') }}"></script>
    @endif

</html>

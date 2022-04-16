<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>haiker575</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light bg-pink p-3">
        <div class="container">
            <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <h1 class="app-name">haiker575</h1>
                </a>
                <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                @else
                    <ul class="nav d-flex ml-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}"><h2 class="auth-button">{{ __('Login') }}</h2></a>
                        </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white auth-button" href="{{ route('register') }}"><h2 class="auth-button">{{ __('Register') }}</h2></a>
                        </li>
                    @endif
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
    <main class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-md-5">
                <div class="d-flex justify-content-center">
                    <img src="{{ secure_asset('applogo.jpeg') }}" class="app-logo" alt="...">
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item h1">
                        <a class="nav-link" href="/home">
                            <i class="fas fa-list"></i>
                            <span class="ml-2 menu">投句一覧</span>
                        </a>
                    </li>
                    <li class="nav-item h1">
                        <a class="nav-link" href="/home">
                            <i class="fas fa-search"></i>
                            <span class="ml-2 menu">俳句検索</span>
                        </a>
                    </li>
                    <li class="nav-item h1">
                        <a class="nav-link" href="/create">
                            <i class="fas fa-pen-fancy"></i>
                            <span class="ml-2 menu">新規投句</span>
                        </a>
                    </li>
                    @auth
                    <li class="nav-item h1">
                        <a class="nav-link" href="/users/{{ Auth::id() }}">
                            <i class="fas fa-user-circle"></i>
                            <span class="ml-2 menu">マイページ</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
        <div id="main-center" class="col-md-5 ml-auto px-0 ichiran">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <a href="/home" class="text-reset">
                        投句一覧
                    </a>
                    <a href="/create" data-bs-toggle="tooltip" data-bs-placement="top" title="新規投句">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
                <div class="card-body overflow-scrol">
        @foreach($posts as $post)
                    <div class="card-body border border-secondary rounded px-5 mx-3 mt-3" id="post">
                        <div class="d-flex justify-content-center">
                            <h1 class="ku">{{ $post['ku'] }}</h2>
                        </div>
                        <p class="description p-3">{{ $post['description'] }}</p>
                        <p class="px-3"><i class="fas fa-user"></i><a href="/users/{{ $post->user_id }}" class='px-3'>{{ $post->user->name }}</a></p>
                        @if (Auth::id() == $post->user_id)
                            <a href="/edit/{{ $post['id'] }}" class='px-3 text-reset'><i class="fas fa-edit"></i></a>
                        @endif
                        <a href="/show/{{ $post['id'] }}" class='px-3 text-reset'><i class="fas fa-comment"></i></a>
                    </div>
        @endforeach
                </div>    
            </div>
        </div>
        <div id="main-right" class="col-md-4 p-0">
            @yield('content')
        </div>
    </div>
    </main>
    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
</body>
<div id="app"></div>
</html>

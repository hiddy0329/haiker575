<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>haiker575</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md bg-pink shadow-sm">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/') }}">
            <h1 class="app-name">haiker575</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}"><h2 class="auth-button">{{ __('Login') }}</h2></a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white auth-button" href="{{ route('register') }}"><h2 class="auth-button">{{ __('Register') }}</h2></a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white auth-button" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
    </nav>
    <main class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-md-5">
                <div class="d-flex justify-content-center">
                    <img src="アプリロゴ.png" class="app-logo h-75 w-75" alt="...">
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item h1">
                        <a class="nav-link" href="/home">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span class="ml-2">投句一覧</span>
                        </a>
                    </li>
                    <li class="nav-item h1">
                        <a class="nav-link" href="/home">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                            <span class="ml-2">俳句検索</span>
                        </a>
                    </li>
                    <li class="nav-item h1">
                        <a class="nav-link" href="/users/{{ Auth::id() }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <span class="ml-2">マイページ</span>
                        </a>
                    </li>
                    <li class="nav-item h1">
                        <a class="nav-link" href="/create">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                            <span class="ml-2">新規投句</span>
                        </a>
                    </li>
                    <li class="nav-item h1">
                        <a class="nav-link" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                            <span class="ml-2">その他</span>
                        </a>
                    </li>
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
                <div class="card-header d-flex">
                    投句一覧
                </div>
                <div class="card-body overflow-scrol">
        @foreach($posts as $post)
                <div class="card-body border border-light">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <h1 class="ku">{{ $post['ku'] }}</h2>
                        </div>
                        <p class="description p-3">{{ $post['description'] }}</p>
                        <p class="px-3">作者：<a href="/users/{{ $post->user_id }}" class='px-3'>{{ $post->user->name }}</a></p>
                        @if (Auth::id() == $post->user_id)
                            <a href="/edit/{{ $post['id'] }}" class='px-3'>推敲</a>
                        @endif
                        <a href="/show/{{ $post['id'] }}" class='px-3'>詳細</a>
                    </div>
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
</body>
</html>

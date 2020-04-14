<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <title>Task Manager</title>
  </head>
<body>
        <!--Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded border-bottom">
            <img src="/icons/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            <h5 class="my-0 mr-md-auto ml-2 font-weight-normal">Task Manager</h5>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto ml-5">
                    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
                        <a class="p-2 nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item {{ (request()->is('tasks') || request()->is('tasks/*')) ? 'active' : '' }}">
                        <a class="p-2 nav-link" href="{{ route('tasks.index') }}">{{ __('Tasks') }}</a>
                    </li>
                    <li class="nav-item {{ (request()->is('statuses') || request()->is('statuses/*')) ? 'active' : '' }}">
                        <a class="p-2 nav-link" href="{{ route('statuses.index') }}">{{ __('Statuses') }}</a>
                    </li>
                    <li class="nav-item {{ (request()->is('labels') || request()->is('labels/*')) ? 'active' : '' }}">
                        <a class="p-2 nav-link" href="{{ route('labels.index') }}">{{ __('Labels') }}</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right mr-5">
                    @guest
                        <li class="nav-item">
                            <a class="p-2 nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="p-2 nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item dropdown {{ (request()->is('users') || request()->is('users/*')) ? 'active' : '' }}">
                            <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu dropdown-menu-right text-center font-weight-light">
                                <a class="p-2 nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                    {{Form::open(['url' => route('logout'), 'method' => 'POST', 'id' => 'logout-form', 'class' => 'invisible'])}}
                                    {{Form::close()}}
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
      <!--/.Navbar -->
<div class="container my-3">
    @include('flash::message')

    @yield('content')
</div>
<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
</body>
</html>

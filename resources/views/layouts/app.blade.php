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
                    <li class="nav-item {{ (request()->is('task_statuses') || request()->is('task_statuses/*')) ? 'active' : '' }}">
                        <a class="p-2 nav-link" href="{{ route('task_statuses.index') }}">{{ __('Statuses') }}</a>
                    </li>
                    <li class="nav-item {{ (request()->is('labels') || request()->is('labels/*')) ? 'active' : '' }}">
                        <a class="p-2 nav-link" href="{{ route('labels.index') }}">{{ __('Labels') }}</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav ml-auto">
                    @guest
                        <li class="nav-item {{ (request()->is('register')) ? 'active' : '' }}">
                            <a class="p-2 nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        <li class="nav-item {{ (request()->is('login')) ? 'active' : '' }}">
                            <a class="p-2 nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item dropdown {{ (request()->is('users') || request()->is('users/*')) ? 'active' : '' }}">
                            <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu dropdown-menu-right text-center font-weight-light">
                                <a class="p-2 nav-link" href="{{ route('users.show', ['user' => Auth::user()]) }}">
                                    {{ __('Profile') }}
                                </a>
                                <a class="p-2 nav-link" href="{{ route('users.edit', ['user' => Auth::user()]) }}">
                                    {{ __('Edit profile') }}
                                </a>
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

<script>
    $('div.alert').not('.alert-important').delay(2000).fadeOut(2000);
</script>
<script>
    $('#flash-overlay-modal').modal();
</script>

</body>
</html>

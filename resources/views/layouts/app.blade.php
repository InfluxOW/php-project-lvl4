<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Requi meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    {{-- CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Semantic UI CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
    <link rel='stylesheet prefetch' type="text/css" href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/icon.min.css'>

    <title>Task Manager</title>
  </head>
<body>
    <div class="ui secondary pointing blue menu">
        <div class="item">
            <h4 class="helvetica bigger-font"><i class="calendar alternate icon"></i>Task Manager</h4>
        </div>
        <a class="helvetica bigger-font item {{ (request()->is('/')) ? 'active' : '' }}" href="{{ route('home') }}">
            <div><i class="home icon"></i>{{ __('Home') }}</div>
        </a>
        <a class="helvetica bigger-font item {{ (request()->is('tasks') || request()->is('tasks/*')) ? 'active' : '' }}" href="{{ route('tasks.index') }}">
            <div><i class="tasks icon"></i>{{ __('Tasks') }}</div>
        </a>
        <a class="helvetica bigger-font item {{ (request()->is('task_statuses') || request()->is('task_statuses/*')) ? 'active' : '' }}" href="{{ route('task_statuses.index') }}">
            <div><i class="info circle icon"></i>{{ __('Statuses') }}</div>
        </a>
        <a class="helvetica bigger-font item {{ (request()->is('labels') || request()->is('labels/*')) ? 'active' : '' }}" href="{{ route('labels.index') }}">
            <div><i class="tags icon"></i>{{ __('Labels') }}</div>
        </a>

        <div class="right menu">
                @guest
                    <a class="helvetica bigger-font item {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                    <a class="helvetica bigger-font item {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endguest
                @auth
                <div class="ui dropdown item helvetica bigger-font">
                    <div><i class="user icon"></i>{{ Auth::user()->name }}</div><i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="helvetica bigger-font item" href="{{ route('users.show', Auth::user()) }}">Profile</a>
                        <a class="helvetica bigger-font item" href="{{ route('users.edit', Auth::user()) }}">Edit profile</a>
                        <div class="helvetica bigger-font item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</div>
                                {{Form::open(['url' => route('logout'), 'method' => 'POST', 'id' => 'logout-form', 'class' => 'invisible'])}}
                                {{Form::close()}}
                    </div>
                </div>
                @endauth
        </div>
    </div>

<div class="ui container">
    @include('flash::message')

    <div class="custom-top">
        @yield('content')
    </div>
</div>

<!-- Optional JavaScript -->
<script src="{{ asset('js/app.js') }}"></script>
{{-- Semantic UI JavaScript --}}
<script src="{{ asset('js/semantic.min.js') }}"></script>

<script>
$('select.dropdown')
    .dropdown()
;
$('.ui.dropdown')
  .dropdown()
;
</script>

<script>
$('div.message').not('div.important').delay(2000).fadeOut(2000);
$('.message .close')
    .on('click', function() {
$(this)
    .closest('.message')
    .transition('fade')
;
    });
</script>

</body>
</html>

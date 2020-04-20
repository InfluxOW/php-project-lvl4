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
            <h4><i class="calendar alternate icon"></i>Task Manager</h4>
        </div>
        <a class=" item {{ (request()->is('/')) ? 'active' : '' }}" href="{{ route('home') }}">
            {{ __('Home') }}
        </a>
        <a class=" item {{ (request()->is('tasks') || request()->is('tasks/*')) ? 'active' : '' }}" href="{{ route('tasks.index') }}">
            {{ __('Tasks') }}
        </a>
        <a class=" item {{ (request()->is('statuses') || request()->is('statuses/*')) ? 'active' : '' }}" href="{{ route('statuses.index') }}">
            {{ __('Statuses') }}
        </a>
        <a class=" item {{ (request()->is('labels') || request()->is('labels/*')) ? 'active' : '' }}" href="{{ route('labels.index') }}">
            {{ __('Labels') }}
        </a>

        <div class="right menu">
                @guest
                    <a class=" item {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                    <a class=" item {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endguest
                @auth
                <div class="ui dropdown item">
                    {{ Auth::user()->name }}<i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="{{ route('users.show', Auth::user()) }}">Profile</a>
                        <a class="item" href="{{ route('users.edit', Auth::user()) }}">Edit profile</a>
                        <div class="item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</div>
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
<script src="//code.jquery.com/jquery.js"></script>
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

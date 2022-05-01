<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('pageTitle')</title>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">

  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        @guest
        <a class="navbar-brand" href="{{ url('/') }}">
          @yield('pageTitle')
        </a>
        @endif
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            @guest

            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
              <a  href="{{ route('welcome') }}" class="nav-link"> Home</a></li>

              <li class="nav-item {{ Request::is('/about') ? 'active' : '' }}">
              <a  href="{{ route('about') }}" class="nav-link">About</a></li>


              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
              @endif
              @else

              <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                <a  href="{{ route('home') }}"  class="nav-link">  Dashboard</a></li>

                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                  <a  href="{{ route('contact') }}"  class="nav-link">  Contact</a></li>


                  
                  <li class="{{ Request::is('video') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('video') }}">Video</a>
                        </li>

                        
             <li class="nav-item {{ Request::is('fqa') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('fqa') }}">{{ __('FAQ') }}</a>
            </li>



                <li class="dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>

                </li>
                @endguest
              </ul>
            </div>

        </nav>

        <main class="py-4">
          @yield('content')
        </main>
      </div>

         @include('layouts.footer')

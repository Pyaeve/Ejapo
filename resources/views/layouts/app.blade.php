<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">



 
    <!-- Styles 
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.css"> -->
       <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('css/app.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('css/select2.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('css/select2-bootstrap.css') !!}">
   
  <link href='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css' rel='stylesheet' />


  <link href='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css' rel='stylesheet' />

  <link href='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.css' rel='stylesheet' />

  <link href='https://unpkg.com/@fullcalendar/list@4.4.0/main.min.css' rel='stylesheet' />

  <link href="{{ URL::asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
 
</head>
   

<body>
    <div id="app">
         @guest

         @else
          <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.dashboard.home') }}">
                    {{ config('app.name', 'Ejepao Pyaeve') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::check())

    

                        @include(config('laravel-menu.views.bootstrap-items'), ['items' => $BackeckAdminNavBar->roots()])
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                                     <a class="dropdown-item" href="{{ route('admin.usuarios.perfil') }}">
                                      Perfil
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
          @endguest
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<!-- Scripts -->
 
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"  ></script>
    <script type="text/javascript" src="{!! asset('js/jquery.mask.js') !!}"></script>
       <script type="text/javascript" src="{!! asset('js/popper.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/tooltips.min.js') !!}"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/js/bootstrap.js"></script>
<script src='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js'></script>




  <script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/list@4.4.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/bootstrap@4.4.0/main.min.js'></script>


 
 
 <script type="text/javascript" src="{!! asset('js/select2.js') !!}"></script>


    <script type="text/javascript">
        $(document).ready(function(){
             @yield('scripts')
        });
    </script>
</html>

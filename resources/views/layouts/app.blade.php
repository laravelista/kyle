<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('meta_title') | Kyle</title>

    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Kyle
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="{{ Ekko::isActiveUrl('/') }}">
                        <a href="{{ url('/') }}">
                            <i class="fa fa-fw fa-bullseye"></i> Overview
                        </a>
                    </li>
                    @if(Auth::check())
                    <li class="dropdown {{ Ekko::areActiveRoutes(['services.*', 'categories.*']) }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-fw fa-ship"></i> Services <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li class="{{ Ekko::isActiveRoute('services.index') }}">
                                <a href="{{ route('services.index') }}">
                                    Index
                                </a>
                            </li>
                            <li class="{{ Ekko::isActiveRoute('categories.*') }}">
                                <a href="{{ route('categories.index') }}">
                                    Categories
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Ekko::isActiveRoute('clients.*') }}">
                        <a href="{{ route('clients.index') }}">
                            <i class="fa fa-fw fa-users"></i> Clients
                        </a>
                    </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="{{ Ekko::isActiveUrl('/login') }}">
                            <a href="{{ url('/login') }}">Login</a>
                        </li>
                        {{-- <li><a href="{{ url('/register') }}">Register</a></li> --}}
                    @else
                        <li class="{{ Ekko::isActiveUrl('/report') }}">
                            <a href="{{ url('/report') }}">
                                <i class="fa fa-fw fa-line-chart"></i> Report
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @include('flash::message')

    @yield('content')

    @if (Auth::check())
    <script>
        var api_token = "{{ Auth::user()->api_token }}";
    </script>
    @endif

    <script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>

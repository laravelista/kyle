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
                    <li class="dropdown {{ Ekko::isActiveUrl('/settings') }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li class="{{ Ekko::isActiveUrl('/settings') }}">
                                <a href="{{ url('/settings') }}">
                                    <i class="fa fa-fw fa-cogs"></i> Settings
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-fw fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
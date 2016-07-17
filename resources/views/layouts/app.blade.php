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
    @include('layouts.partials.navbar')

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

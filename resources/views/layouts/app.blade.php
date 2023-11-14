<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title-block')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    @if(session('theme') == 'dark')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
    <body class="container">
        @include('inc.header')
            @yield('content')
        @include('inc.footer')
    </body>
</html>

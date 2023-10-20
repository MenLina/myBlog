<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title-block')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
    <body class="container">
        @include('inc.header')

        @if(Request::is('/'))
            @include('inc.hero')
        @endif
{{--        отображение на одной определенной страницк с помощью условного оператора if и Request(если находимся на главной странице , то..)--}}
        <div>
            <div class="row mt-5">
                <div class="col-8">
                    @yield('content')
                </div>
                <div class="col-4">
                    @include('inc.aside')
                </div>
            </div>
        </div>
        @include('inc.footer')
    </body>
</html>

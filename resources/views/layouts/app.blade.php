<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Сервис Графиков</title>

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
</head>
<body>

@includeIf('templates.navbar')


@yield('content')

@includeIf('templates.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/all.js') }}"></script>
</body>
</html>

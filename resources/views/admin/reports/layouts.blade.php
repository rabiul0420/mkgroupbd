<!doctype html>
<html lang="bn">

<head>

    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-pdf.css') }}">
    @stack('css')
</head>

<body>
    @yield('content')
</body>

</html>
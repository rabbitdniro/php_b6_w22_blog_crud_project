<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>

<body>
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>

</html>
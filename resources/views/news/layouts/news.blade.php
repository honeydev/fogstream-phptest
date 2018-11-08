<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="frontend/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>{{ config('app.name') }} | {{ $page }}</title>
</head>
<body>
@include('news.nav')
@yield('content')
<script src="frontend/js/dist/bundle.js"></script>
</body>
</html>

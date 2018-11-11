<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }} | {{ $page }}</title>
    {!! NoCaptcha::renderJs() !!}
</head>
<body id="body">
@include('news.nav')
@yield('content')
<script src="{{ url('/') }}/frontend/js/dist/bundle.js"></script>
</body>
</html>

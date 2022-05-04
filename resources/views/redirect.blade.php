<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@if(View::hasSection('title'))@yield('title')@else{{ config('app.name', 'Tinre') }}@endif</title>
    <meta name="description" content="@yield('meta_description')">
    @foreach($metaData as $key => $value)
        <meta name="{{ $key }}" content="{{ $value }}">
    @endforeach
</head>
<body>
<script>
    let url = @json($url);
    window.location.href  = url.long_url
</script>
</body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Search Platform</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    
    <body>
        @include('common.header')
        @yield('content')
        @include('common.footer')
        @include('common.scripts')
    </body>
</html>
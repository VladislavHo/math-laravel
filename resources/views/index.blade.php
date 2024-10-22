<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
        <link rel="icon" type="image/svg+xml" href="{{ asset('Favicon.png') }}" />
        <title>Math</title>
        {{-- <link rel="stylesheet" crossorigin href="{{ asset('./public/build/assets/main-t3g_usmV.css') }}"> --}}
        @viteReactRefresh
        @vite('resources/react/main.tsx')
        {{-- @vite('resources/react/App.css') --}}
    </head>
    <body>
        <div id="root"></div>
    </body>
</html>
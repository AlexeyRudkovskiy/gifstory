<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite('resources/css/app.css')
    </head>
    <body class="text-3xl font-bold underline">
        <div id="app">
            <div class="text-large">test</div>
            <example-component></example-component>
        </div>

        @vite('resources/js/app.js')
    </body>
</html>

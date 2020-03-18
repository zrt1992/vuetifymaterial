<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{asset('public/css/app.css')}}"/>
        <!-- Fonts -->

    </head>
    <body>
        <div id="app">
            <app-component></app-component>
        </div>
    <script src="public/js/app.js"></script>
    </body>
</html>

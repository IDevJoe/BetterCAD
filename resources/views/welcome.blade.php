<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BetterCAD</title>

        <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
    </head>
    <body>
        <div id="app"></div>
        <noscript>Javascript is required to run this app.</noscript>
        <script src="{{ asset('/js/manifest.js') }}"></script>
        <script src="{{ asset('/js/vendor.js') }}"></script>
        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>

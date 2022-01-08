<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BetterCAD - Error</title>

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
</head>
<body>
    <div class="container mt-5 mb-5">
        <h1>Error</h1>
        <div class="alert alert-danger mt-2">
            <strong>{{ $error }}</strong>
        </div>
        <div class="mt-2 d-flex justify-content-center">
            <a href="/" class="btn btn-primary">Return to BetterCAD</a>
        </div>
    </div>
</body>
</html>

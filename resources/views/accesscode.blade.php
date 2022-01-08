<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BetterCAD - Access Code</title>

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
</head>
<body>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 ml-auto mr-auto">
            <img src="{{ \App\Models\Setting::getValue("BRAND_ICON_FILE", "/img/BetterCAD-433.png") }}" alt="BetterCAD" class="w-100">
            <h1>Access Code</h1>
            <p>Welcome, {{ $username }}. You're almost there. Enter the access code that was provided to you to complete your
                registration. Didn't get an access code? Contact the managers of this CAD.</p>
            <form action="{{ route('login.accesscode') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="accesscode">Access Code</label>
                    <input type="password" name="accesscode" id="accesscode" class="form-control">
                </div>
                <button class="btn btn-primary">Continue</button>
                <a href="/" class="btn btn-outline-danger">Cancel</a>
            </form>
        </div>
    </div>

</div>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{env('icone')}}"  type="image/x-icon" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>

</head>
<body style="background-color: indianred;">
<div class="container-fluid" id="app">
    <div class="row border" style="background-color: indianred;">
        <div class="col">
            <h1>MENU</h1>
        </div>
    </div>
    <hr>
    <div class="row" id="vm">
        <calendar></calendar>
    </div>
</div>
<script src="{{ mix('/js/app.js') }}"></script>





</body>
</html>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{env('icone')}}"  type="image/x-icon" />
    <script>
        window.money = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>

</head>
<body class="app">
<div id="app">


@section('navbar')
    navbar
@show
    <div class="container-fluid  " >
        <div class="row mr-2"> &nbsp; </div>

        @yield('content')
    </div>

    <footer class="footer">
        <div class="container-fluid ">
            @yield('footer')
        </div>
    </footer>

</div>
    <script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
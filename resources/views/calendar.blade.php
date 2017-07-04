<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        .border{
            border:solid 1px red;
        }
        .pad-content{
            padding: 50px;
        }
    </style>
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>
</head>
<body>
<div class="container-fluid pad-content">
    <ul>
        <li style ="list-style-image: url('/image.jpeg')">Devis gratuit envoyé dans les 48-72h suivant la réception du matériel </li>
        <li>Enlèvement possible par notre transporteur partenaire  </li>
        <li>Renvoi du matériel réparé dans les 48-72h</li>
    </ul>
    <div class="row border" id="app">
        <div class="col border">

            <calendar></calendar>


        </div>
    </div>
</div>

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
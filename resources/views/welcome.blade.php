<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">


    <div class="content">
        <img src="data:image/png;base64,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" />
        <br>
        @if (Route::has('login'))

            @auth
                <a href="{{ url('/home') }}"><button class="btn btn-success">Home</button></a>
            @else
                <a href="{{ route('login') }}"><button class="btn btn-success">Login</button> </a>
            @endauth

        @endif

    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>LOGIN</title>
    <style>
        body{
            background-color: #000000;
        }
    </style>
</head>

<body>
    <div class="login">
        <h1>LOGIN</h1>
        @if ($errors->any())
            {!! implode('', $errors->all('<div class="alert danger">:message</div>')) !!}
        @elseif (Session::has('success'))
            <div class="alert success">{{ Session::get('success') }}</div>
        @elseif (Session::has('danger'))
            <div class="alert danger">{{ Session::get('danger') }}</div>
        @endif
        <form action="{{ route('login.proccess') }}" method="POST">
            @csrf
            <div class="group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me?</label>
            </div>
            <button type="submit">LOGIN</button>
            <a href="{{ route('register') }}">Belum Punya Akun?</a>
        </form>
    </div>
</body>

</html>

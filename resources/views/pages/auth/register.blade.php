<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>REGISTER</title>
    <style>
        body {
            background-color: #000000;
        }
    </style>
</head>

<body>
    <div class="login">
        <h1>REGISTER</h1>

        <form action="{{ route('register.proccess') }}" method="POST">
            @csrf
            <div class="group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name">
                @error('name')
                    <div class="alert danger mini">{{ $message }}</div>
                @enderror
            </div>
            <div class="group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                @error('email')
                    <div class="alert danger mini">{{ $message }}</div>
                @enderror
            </div>
            <div class="group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                @error('password')
                    <div class="alert danger mini">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">DAFTAR</button>
            <a href="{{ route('login') }}">Sudah Punya Akun?</a>
        </form>
    </div>
</body>

</html>

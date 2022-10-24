<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/7750908ac9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <title>LOGIN</title>
    <style>
        body {
            background-color: #000000;
        }
    </style>
</head>

<body>
    <div class="login">

        <form action="{{ route('login.proccess') }}" method="POST">
            @csrf
            <div class="larger">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert danger">:message</div>')) !!}
                @elseif (Session::has('success'))
                    <div class="alert success">{{ Session::get('success') }}</div>
                @elseif (Session::has('danger'))
                    <div class="alert danger">{{ Session::get('danger') }}</div>
                @endif
                <h1>LOGIN</h1>
                <div class="group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="group">
                    <label for="password">Password</label>
                    <div class="password">
                        <input type="password" name="password" id="password">
                        <div class="show">
                            <i class="fa-solid fa-eye" id="show"></i>
                            <input type="checkbox" name="show_password" id="checkbox">
                        </div>
                    </div>
                </div>
                <div class="remember">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me?</label>
                </div>
                <button type="submit">LOGIN</button>
            </div>
            <a href="{{ route('register') }}" class="register">Belum Punya Akun?</a>
        </form>
    </div>
    <script>
        (function($) {
            $.fn.replaceClass = function(pFromClass, pToClass) {
                return this.removeClass(pFromClass).addClass(pToClass);
            };
        }(jQuery));
        $(document).ready(function() {
            $('#checkbox').on('change', function() {
                $('#password').attr('type', $('#checkbox').prop('checked') == true ? "text" : "password");
                if ($('#checkbox').prop('checked') == true) {
                    $('#show').replaceClass("fa-solid fa-eye", "fa-solid fa-eye-slash")
                } else {
                    $('#show').replaceClass("fa-solid fa-eye-slash", "fa-solid fa-eye")
                }
            });
        });
    </script>
</body>

</html>

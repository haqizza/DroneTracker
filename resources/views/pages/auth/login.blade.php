<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/7750908ac9.js" crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="/css/style.css"> --}}
    @vite('resources/css/app.css')
    <title>LOGIN</title>
    <style>
        body {
            background-color: #393E46;

            :root {
                --bg: #222831;
                --sub: #393E46;
                --acc: #1e56ee;
                --txt: #EEEEEE;
            }
        }
    </style>
</head>

<body>
    <div class="absolute top-[50%] left-[50%] m-auto flex translate-x-[-50%] translate-y-[-50%] flex-col gap-[1rem] p-[1rem]">
        <form action="{{ route('login.proccess') }}" method="POST" class="flex flex-col">
            @csrf
            <div class="flex w-[500px] flex-col gap-[1.25rem] rounded-[20px] bg-[#222831] p-[1.5rem] shadow-[0px_10px_30px_-7px_#222831]">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert danger">:message</div>')) !!}
                @elseif (Session::has('success'))
                    <div class="alert success">{{ Session::get('success') }}</div>
                @elseif (Session::has('danger'))
                    <div class="alert danger">{{ Session::get('danger') }}</div>
                @endif
                <h1 class="text-center text-[24px] font-[600] text-[#eeeeee]">LOGIN</h1>
                <div class="flex flex-col gap-[10px]">
                    <label for="email" class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]">Email</label>
                    <input type="email" name="email" id="email" required placeholder="Your Email Here..."
                        class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]">
                </div>
                <div class="flex flex-col gap-[10px]">
                    <label for="password" class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]">Password</label>
                    <div class="flex gap-0">
                        <input type="password" name="password" id="password" required placeholder="Your Password Here..."
                            class="peer w-[90%] rounded-l-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-l-[2px]">
                        <div class="relative w-[10%] rounded-[0_10px_10px_0px] border-[#1e56ee] bg-[#393E46] text-[#eeeeee] peer-focus:border-r-[2px]">
                            <i class="fa-solid fa-eye absolute left-[50%] top-[50%] translate-x-[-50%] translate-y-[-50%] text-[18px]" id="show"></i>
                            <input type="checkbox" name="show_password" id="checkbox" class="absolute h-[100%] w-[100%] translate-x-[-3px] opacity-0">
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-[1rem]">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="text-[#eeeeee]">Remember me?</label>
                </div>
                <button type="submit"
                    class="cursor-pointer rounded-[10px] border-0 bg-[#1e56ee] p-[0.5rem_0.75rem] text-[15px] font-[700] text-[#eeeeee] outline-0 transition-[0.2s] hover:bg-[#376cfd] active:bg-[#376cfd]">LOGIN</button>
            </div>
            <a href="{{ route('register') }}"
                class="m-auto w-[80%] rounded-b-[10px] border-0 p-[0.25rem_0.5rem] text-center font-[700] text-[#eeeeee] no-underline outline-none transition-[0.4s] hover:w-[85%]">Belum
                Punya Akun?</a>
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
    @include('template.alert')
</body>

</html>

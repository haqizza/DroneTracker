<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/7750908ac9.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <title>REGISTER</title>
    <style>
        body {
            background-color: #393E46;
        }
    </style>
</head>

<body>
    <div
        class="absolute top-[50%] left-[50%] m-auto flex flex-col gap-[1rem] translate-x-[-50%] translate-y-[-50%] p-[1rem]">
        <form action="{{ route('register.proccess') }}" method="POST"class="flex flex-col">
            @csrf
            <div
                class="flex flex-col gap-[1.25rem] shadow-[0px_10px_30px_-7px_#222831] bg-[#222831] w-[500px] rounded-[20px] p-[1.5rem]">
                <h1 class="text-center text-[#eeeeee] text-[24px] font-[600]">REGISTER</h1>
                <div class="flex flex-col gap-[10px]">
                    <label class="text-[14px] px-[0.25rem] uppercase font-[400] rounded-t-[5px] w-fit text-[#eeeeee]"
                        for="name">Nama</label>
                    <input type="text" name="name" id="name" required
                        class="p-[0.75rem_0.75rem] text-[15px] bg-[#393E46] text-[#eeeeee]  border-[#1e56ee] rounded-[5px] outline-none focus:border-r-[2px] focus:border-l-[2px]"
                        placeholder="Your Name Here...">
                    @error('name')
                        <div class="alert danger mini">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col gap-[10px]">
                    <label class="text-[14px] px-[0.25rem] uppercase font-[400] rounded-t-[5px] w-fit text-[#eeeeee]"
                        for="email">Email</label>
                    <input type="email" name="email" id="email" required
                        class="p-[0.75rem_0.75rem] text-[15px] bg-[#393E46] text-[#eeeeee]  border-[#1e56ee] rounded-[5px] outline-none focus:border-r-[2px] focus:border-l-[2px]"
                        placeholder="Your Email Here">
                    @error('email')
                        <div class="alert danger mini">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col gap-[10px]">
                    <label class="text-[14px] px-[0.25rem] uppercase font-[400] rounded-t-[5px] w-fit text-[#eeeeee]"
                        for="password">Password</label>
                    <div class="flex gap-0">
                        <input type="password" name="password" id="password" required
                            placeholder="Your Password Here..."
                            class="p-[0.75rem_0.75rem] text-[15px] w-[90%] bg-[#393E46] text-[#eeeeee] rounded-l-[5px] outline-none border-[#1e56ee] focus:border-l-[2px] peer">
                        <div
                            class="w-[10%] relative bg-[#393E46] text-[#eeeeee] rounded-[0_10px_10px_0px] border-[#1e56ee] peer-focus:border-r-[2px]">
                            <i class="fa-solid fa-eye text-[18px] absolute left-[50%] top-[50%] translate-x-[-50%] translate-y-[-50%]"
                                id="show"></i>
                            <input type="checkbox" name="show_password" id="checkbox"
                                class="absolute w-[100%] h-[100%] translate-x-[-3px] opacity-0">
                        </div>
                    </div>
                    @error('password')
                        <div class="alert danger mini" z>{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit"
                    class="p-[0.5rem_0.75rem] text-[15px] bg-[#1e56ee] rounded-[10px] text-[#eeeeee] border-0 outline-0 font-[700] transition-[0.2s] cursor-pointer hover:bg-[#376cfd] active:bg-[#376cfd]]">DAFTAR</button>
            </div>
            <a href="{{ route('login') }}"
                class="w-[80%] text-[#eeeeee] rounded-b-[10px] border-0 outline-none font-[700] transition-[0.4s] no-underline m-auto text-center p-[0.25rem_0.5rem] hover:w-[85%]">Sudah
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

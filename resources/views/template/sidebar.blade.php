{{-- --bg: #222831;
    --sub: #393E46;
    --acc: #1e56ee;
    --txt: #EEEEEE; --}}

<div id="sidebar" class="fixed left-0 bottom-0 top-0 z-[99999] mt-[1rem] mb-[1rem] ml-[1rem] flex w-[15%] flex-col overflow-hidden rounded-[20px] bg-[#222831] transition-[0.4s]">
    <div class="m-[1rem] flex items-center justify-between gap-[0.5rem] rounded-[10px] p-[0.5rem] text-[14px] font-[700] text-[#222831] transition-[0.4s]">
        <div class="flex items-center justify-center gap-[10px] transition-[0.4s]">
            @isset($navbars->image)
                <img class="w-[50px] rounded-[50%] border-0 transition-[0.4s]" src="{{ asset($navbars->image) }}" alt="">
                {{-- <span class="text-[20px] transition-[0.4s] text-[#eeeeee]">{{ $navbars->name }}</span> --}}
            @endisset
        </div>
        {{-- <span id="clock" class="text-[18px] text-[#eeeeee] mr-[1rem]"></span> --}}
    </div>
    {{-- <div class="flex rounded-[10px] items-center justify-center mt-[1rem] mb-[2rem]"> --}}
    {{-- <div class="w-fit flex items-end justify-between h-[20px] m-[10px_0px] mb-[1rem] flex-col relative">
            <input type="checkbox" name="toggle" id="toggle"
                class="h-[100%] w-[100%] top-[-4px] left-[-4px] absolute z-[99] cursor-pointer checked:">
            <span class="h-[3px] w-[30px] rounded-[20px] transition-[0.4s] bg-[#eeeeee]"></span>
            <span class="h-[3px] w-[30px] rounded-[20px] transition-[0.4s] bg-[#eeeeee]"></span>
            <span class="h-[3px] w-[30px] rounded-[20px] transition-[0.4s] bg-[#eeeeee]"></span>
        </div> --}}
    {{-- </div> --}}
    <nav class="relative flex flex-col justify-center gap-[10px] rounded-r-[20px]">
        <div class="flex flex-col gap-[10px] rounded-[10px] p-[1rem]">
            <a class="{{ request()->is('/') ? 'bg-[#393e46]' : '' }} flex cursor-pointer items-center gap-[1rem] rounded-[10px] p-[0.75rem] text-[15px] font-[500] uppercase text-[#eeeeee] no-underline transition-[0.2s] hover:bg-[#393E46]"
                href="{{ route('dashboard') }}"><i class="fa-solid fa-house rounded-[10px] text-[15px] text-[#eeeeee] transition-[0.2s]"></i><span class="link transition-[0.4s]">
                    Dashboard</span></a>
            <div class="flex flex-col">
                <button id="open-master"
                    class="relative flex cursor-pointer items-center gap-[1rem] rounded-[10px] p-[0.75rem] text-[15px] font-[500] uppercase text-[#eeeeee] no-underline transition-[0.2s] hover:bg-[#393E46]"><i
                        class="fa-solid fa-list rounded-[10px] text-[15px] text-[#eeeeee] transition-[0.2s]"></i><span class="link transition-[0.4s]">Data
                        Master</span>
                    <i class="fa-solid fa-chevron-down absolute right-[1rem] top-[50%] translate-y-[-50%]" id="dataMasterArrow"></i></button>
                <div id="master-menu" class="mt-[0.5rem] flex flex-col gap-[5px] rounded-[10px] bg-[#393E46] p-[0.5rem]">
                    <a class="{{ request()->is('management/drone*') ? 'bg-[#222831]' : '' }} flex items-center gap-[1rem] rounded-[5px] p-[0.5rem_1rem] transition hover:bg-[#222831]"
                        href="{{ route('management.drone') }}">
                        <div class="ball h-[5px] w-[5px] rounded-full bg-[#eeeeee]">
                        </div>
                        <span>Drone</span>
                    </a>
                    <a class="{{ request()->is('management/user*') ? 'bg-[#222831]' : '' }} flex items-center gap-[1rem] rounded-[5px] p-[0.5rem_1rem] transition hover:bg-[#222831]"
                        href="{{ route('management.user') }}">
                        <div class="ball h-[5px] w-[5px] rounded-full bg-[#eeeeee]">
                        </div>
                        <span>User</span>
                    </a>
                    <a class="{{ request()->is('management/securities*') ? 'bg-[#222831]' : '' }} flex items-center gap-[1rem] rounded-[5px] p-[0.5rem_1rem] transition hover:bg-[#222831]"
                        href="{{ route('management.security') }}">
                        <div class="ball h-[5px] w-[5px] rounded-full bg-[#eeeeee]">
                        </div>
                        <span>Security</span>
                    </a>
                    <a class="{{ request()->is('management/legends*') ? 'bg-[#222831]' : '' }} flex items-center gap-[1rem] rounded-[5px] p-[0.5rem_1rem] transition hover:bg-[#222831]"
                        href="{{ route('management.legend') }}">
                        <div class="ball h-[5px] w-[5px] rounded-full bg-[#eeeeee]">
                        </div>
                        <span>Legends</span>
                    </a>
                </div>
            </div>
            <div class="flex flex-col">
                <button id="open-report"
                    class="relative flex cursor-pointer items-center gap-[1rem] rounded-[10px] p-[0.75rem] text-[15px] font-[500] uppercase text-[#eeeeee] no-underline transition-[0.2s] hover:bg-[#393E46]"><i
                        class="fa-solid fa-book rounded-[10px] text-[15px] text-[#eeeeee] transition-[0.2s]"></i><span class="link transition-[0.4s]">Report</span>
                    <i id="logsArrow" class="fa-solid fa-chevron-down absolute right-[1rem] top-[50%] translate-y-[-50%]"></i></button>
                <div id="report-menu" class="mt-[0.5rem] flex flex-col gap-[5px] rounded-[10px] bg-[#393E46] p-[0.5rem]">
                    <a class="{{ request()->is('logs/user*') ? 'bg-[#222831]' : '' }} flex items-center gap-[1rem] rounded-[5px] p-[0.5rem_1rem] transition hover:bg-[#222831]"
                        href="{{ route('logs.user') }}">
                        <div class="ball h-[5px] w-[5px] rounded-full bg-[#eeeeee]"></div>
                        <span>User Log</span>
                    </a>
                </div>
            </div>
            <a class="{{ request()->is('setting*') ? 'bg-[#393e46]' : '' }} flex cursor-pointer items-center gap-[1rem] rounded-[10px] p-[0.75rem] text-[15px] font-[500] uppercase text-[#eeeeee] no-underline transition-[0.2s] hover:bg-[#393E46]"
                href="{{ route('setting') }}">
                <i class="fa-solid fa-gear rounded-[10px] text-[15px] text-[#eeeeee] transition-[0.2s]"></i>
                <span class="link transition-[0.4s]">
                    Setting</span></a>
        </div>
    </nav>
    <div class="absolute bottom-0 flex w-[100%] items-center justify-between overflow-hidden bg-[#1e56ee] p-[1rem]">
        <a class="flex items-center gap-[10px] transition-[0.4s] p-[10px] rounded-[5px] hover:bg-[#2f66ff]" href="{{ route('user.setting') }}"><i class="fa-solid fa-user"></i><span>Profile</span></a>
        <a class="flex items-center gap-[10px] rounded-[5px] bg-red-400 p-[0.5rem] transition hover:translate-x-1" href="{{ route('user.logout') }}"><i
                class="fa-solid fa-right-from-bracket"></i><span>Keluar</span></a>
    </div>
</div>
<script>
    (function($) {
        $.fn.replaceClass = function(pFromClass, pToClass) {
            return this.removeClass(pFromClass).addClass(pToClass);
        };
    }(jQuery));
    $("document").ready(function() {
        let openmaster = localStorage.getItem('openmaster')
        if (openmaster == 1 || !openmaster) {
            $("#master-menu").slideDown(200)
            $('#dataMasterArrow').replaceClass("fa-solid fa-chevron-down", "fa-solid fa-chevron-up")
        } else {
            $('#dataMasterArrow').replaceClass("fa-solid fa-chevron-up", "fa-solid fa-chevron-down")
            $("#master-menu").slideUp(0)
        }
        $("#open-master").click(function() {
            let checkopenmaster = localStorage.getItem('openmaster')
            if (checkopenmaster == 1) {
                localStorage.setItem('openmaster', 0)
                $("#master-menu").slideUp(200)
                $('#dataMasterArrow').replaceClass("fa-solid fa-chevron-up", "fa-solid fa-chevron-down")
            } else {
                localStorage.setItem('openmaster', 1)
                $('#dataMasterArrow').replaceClass("fa-solid fa-chevron-down", "fa-solid fa-chevron-up")
                $("#master-menu").slideDown(200)
                localStorage.setItem('openreport', 0)
                $("#report-menu").slideUp(200)
                $('#logsArrow').replaceClass("fa-solid fa-chevron-up", "fa-solid fa-chevron-down")

            }
        })

        let openreport = localStorage.getItem('openreport')
        if (openreport == 1 || !openreport) {
            $('#logsArrow').replaceClass("fa-solid fa-chevron-down", "fa-solid fa-chevron-up")
            $("#report-menu").slideDown(200)
        } else {
            $('#logsArrow').replaceClass("fa-solid fa-chevron-up", "fa-solid fa-chevron-down")
            $("#report-menu").slideUp(0)
        }
        $("#open-report").click(function() {
            let checkopenreport = localStorage.getItem('openreport')
            if (checkopenreport == 1) {
                localStorage.setItem('openreport', 0)
                $("#report-menu").slideUp(200)
                $('#logsArrow').replaceClass("fa-solid fa-chevron-up", "fa-solid fa-chevron-down")
            } else {
                $('#logsArrow').replaceClass("fa-solid fa-chevron-down", "fa-solid fa-chevron-up")
                $("#report-menu").slideDown(200)
                localStorage.setItem('openreport', 1)
                localStorage.setItem('openmaster', 0)
                $("#master-menu").slideUp(200)
                $('#dataMasterArrow').replaceClass("fa-solid fa-chevron-up", "fa-solid fa-chevron-down")

            }
        })
    })
</script>

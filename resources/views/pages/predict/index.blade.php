{{-- --bg: #222831;
    --sub: #393E46;
    --acc: #1e56ee;
    --txt: #EEEEEE; --}}
@extends('layouts.index')
@section('content')
    <div class="flex w-full p-[1rem]" id="middle">
        <div class="flex-col h-[100%] text-center font-bold">
            <a href="/" class="w-12 flex items-center justify-center h-[50%] rounded-[20px] bg-[#222831] hover:bg-[#2c3440] py-[0.5rem] px-[0.25rem] align-middle">
                <div class="-rotate-90">Back</div>
            </a>
            <a href="/predict/set-photo" class="w-12 flex items-center justify-center h-[50%] rounded-[20px] bg-[#222831] hover:bg-[#2c3440] py-[0.5rem] px-[0.25rem] align-middle">
                <div class="-rotate-90">Set_Photo</div>
            </a>
        </div>
        <div class="flex w-[100%] gap-[1rem]">
            <div class="flex w-full flex-col rounded-[20px] bg-[#222831] ml-4 p-[1rem]  overflow-y-scroll scrollbar-hide">
                <div class="min-h-[80%]">
                    <div id="map" class="h-[100%] rounded-[10px]"></div>
                </div>
                <!-- <div class="mt-2 p-2">
                    <h3 class="text-xl font-[700] mb-4">Input Images</h3>

                </div> -->
            </div>
        </div>
    </div>
    @include('pages.predict.script')
@endsection

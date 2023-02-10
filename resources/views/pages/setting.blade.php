@extends('layouts.index')
@section('content')
    <div class="flex w-[85%] flex-col p-[1rem]">
        <div class="flex w-[500px] flex-col rounded-[20px] bg-[#222831] p-[1rem]">
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert p-[10px] mb-[1rem] rounded-[5px] text-[#eeeeee] bg-red-500">:message</div>')) !!}
            @elseif (Session::has('success'))
                <div class="alert mb-[1rem] rounded-[5px] bg-green-600 p-[10px] text-[#eeeeee]">{{ Session::get('success') }}</div>
            @endif
            <form class="flex flex-col gap-[10px]" action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col">
                    <div class="flex flex-col gap-[10px]">
                        @isset($navbars->image)
                            <div class="flex items-center justify-center">
                                <img src="{{ asset($navbars->image) }}" alt="" class="w-[100px]">
                            </div>
                        @endisset
                        <div class="flex flex-col gap-[10px]">
                            <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="image">LOGO</label>
                            <input type="file" name="image" id="image"
                                class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none file:mr-[1rem] file:rounded-[5px] file:border-0 file:bg-[#1e56ee] file:px-[1rem] file:text-[#eeeeee] focus:border-r-[2px] focus:border-l-[2px]">
                        </div>
                        <div class="flex flex-col gap-[10px]">
                            <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="name">Nama aplikasi</label>
                            <input class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]" type="text"
                                name="name" id="name" value="{{ $navbars->name ?? '' }}">
                        </div>
                    </div>
                    <div class="flex flex-col gap-[10px]">
                        <div class="flex flex-col gap-[10px]">
                            <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="version">Versi Aplikasi</label>
                            <input class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]" type="text"
                                name="version" id="version" value="{{ $navbars->version ?? '' }}">
                        </div>
                        <div class="flex flex-col gap-[10px]">
                            <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="description">Deskripsi</label>
                            <textarea class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]" name="description" id="description"
                                cols="30" rows="10">{{ $navbars->description ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="cursor-pointer rounded-[10px] border-0 bg-[#1e56ee] p-[0.5rem_0.75rem] text-[15px] font-[700] text-[#eeeeee] outline-0 transition-[0.2s] hover:bg-[#376cfd] active:bg-[#376cfd]">UPDATE</button>
            </form>
        </div>
    </div>
    @include('template.alert')
@endsection

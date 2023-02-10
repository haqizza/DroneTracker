@extends('layouts.index')
@section('content')
    <div class="flex w-[85%] flex-col p-[1rem]">
        <div class="flex h-fit w-[25%] flex-col rounded-[10px] bg-[#222831] p-[1rem]" id="create">
            <form class="profile" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-[10px]">
                @csrf
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert p-[10px] mb-[1rem] rounded-[5px] text-[#eeeeee] bg-red-500">:message</div>')) !!}
                @elseif (Session::has('success'))
                    <div class="alert mb-[1rem] rounded-[5px] bg-green-600 p-[10px] text-[#eeeeee]">{{ Session::get('success') }}</div>
                @elseif (Session::has('danger'))
                    <div class="alert mb-[1rem] rounded-[5px] bg-red-500 p-[10px] text-[#eeeeee]">{{ Session::get('danger') }}</div>
                @endif
                <div class="flex flex-col">
                    <div class="flex flex-col">
                        @if ($user->image)
                            <img src="{{ asset($user->image) }}" alt="" class="mb-[1rem] h-[200px] w-[100%] rounded-[5px] object-cover">
                        @else
                            <span>No Profile Picture</span>
                        @endif
                    </div>
                    <div class="flex flex-col gap-[10px]">
                        <div class="flex flex-col gap-[10px]">
                            <label for="image">Foto</label>
                            <input type="file" name="image" id="image"
                                class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none file:mr-[1rem] file:rounded-[5px] file:border-0 file:bg-[#1e56ee] file:px-[1rem] file:text-[#eeeeee] focus:border-r-[2px] focus:border-l-[2px]">
                        </div>
                        <div class="flex flex-col gap-[10px]">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}"
                                class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]">
                        </div>
                        <div class="flex flex-col gap-[10px]">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}"
                                class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]">
                        </div>
                        <div class="flex flex-col gap-[10px]">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]">
                        </div>
                    </div>
                    <button type="submit"
                        class="mt-[1rem] cursor-pointer rounded-[10px] border-0 bg-[#1e56ee] p-[0.5rem_0.75rem] text-[15px] font-[700] text-[#eeeeee] outline-0 transition-[0.2s] hover:bg-[#376cfd] active:bg-[#376cfd]">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
    @include('template.alert')
@endsection

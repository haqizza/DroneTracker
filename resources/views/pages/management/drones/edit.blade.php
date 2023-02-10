@extends('layouts.index')
@section('content')
    <div class="flex w-[85%] flex-col p-[1rem]">
        <div class="flex flex-col">
            <label for="" class="text-[20px] uppercase">Management DRONE</label>
            <span class="mb-[2rem] text-[16px] font-[400] leading-[19px]">Drone yang terdaftar terdapat {{ $counted->count() }} unit</span>
        </div>
        <div class="flex gap-[1rem]">
            <div class="flex h-fit w-[25%] flex-col rounded-[10px] bg-[#222831] p-[1rem]" id="create">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert p-[10px] mb-[1rem] rounded-[5px] text-[#eeeeee] bg-red-500">:message</div>')) !!}
                @elseif (Session::has('success'))
                    <div class="alert mb-[1rem] rounded-[5px] bg-green-600 p-[10px] text-[#eeeeee]">{{ Session::get('success') }}</div>
                @endif
                <form action="{{ route('management.drone.update', $drone->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-[10px]">
                    @csrf
                    <div class="flex flex-col">
                        <div class="flex flex-col gap-[10px]">
                            <div class="flex flex-col gap-[10px]">
                                <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="image">Foto</label>
                                <input type="file" name="image" id="image" accept="image/*" placeholder="Gambar alat . . ." value="{{ $drone->image }}"
                                    class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none file:mr-[1rem] file:rounded-[5px] file:border-0 file:bg-[#1e56ee] file:px-[1rem] file:text-[#eeeeee] focus:border-r-[2px] focus:border-l-[2px]">
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="id">Nomor Seri</label>
                                <input type="text" name="id" id="id" required placeholder="Masukan nomor seri perangkat . . ." value="{{ $drone->id }}"
                                    class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]">
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="merk">Merk</label>
                                <input type="text" name="merk" id="merk" required placeholder="Masukan merk perangkat . . ." value="{{ $drone->merk }}"
                                    class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]">
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="description">Deskripsi</label>
                                <textarea name="description" id="description" cols="50" rows="10" required placeholder="Deskripsi perangkat . . ."
                                    class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]">{{ $drone->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="cursor-pointer rounded-[10px] border-0 bg-[#1e56ee] p-[0.5rem_0.75rem] text-[15px] font-[700] text-[#eeeeee] outline-0 transition-[0.2s] hover:bg-[#376cfd] active:bg-[#376cfd]">UPDATE</button>
                </form>
            </div>
            <div class="flex w-[calc(100%_-_25%)] flex-col">
                <div class="flex flex-wrap justify-between gap-[1rem]">
                    @foreach ($drones as $drone)
                        <div class="flex flex-[1_1_20%] flex-col rounded-[10px] bg-[#222831] p-[10px]">
                            <div class="mb-[20px] flex flex-col">
                                <img src="{{ asset($drone->image) }}" alt="{{ $drone->name }}" class="h-[200px] w-[100%] rounded-[10px] border-0 object-cover outline-0">
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <div class="flex">
                                    <label for="name" class="w-[100px]">Nomor Seri</label>
                                    <span>{{ $drone->id }}</span>
                                </div>
                                <div class="flex">
                                    <label for="email" class="w-[100px]">Merk</label>
                                    <span>{{ $drone->merk }}</span>
                                </div>
                            </div>
                            <div class="mt-[15px] flex gap-[10px]">
                                <a href="{{ route('management.drone.edit', $drone->id) }}" class="w-[100%] rounded-[5px] bg-orange-400 p-[10px] text-center uppercase text-[#eeeeee]" title="Edit"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('management.drone.destroy', $drone->id) }}" class="w-[100%] rounded-[5px] bg-red-500 p-[10px] text-center uppercase text-[#eeeeee]" title="Delete"
                                    onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa-solid fa-delete-left"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $drones->links() }}
            </div>
        </div>
    </div>
    @include('template.alert')
@endsection

@extends('layouts.index')
@section('content')
    <div class="flex w-[85%] flex-col p-[1rem]">
        <div class="flex flex-col">
            <label for="" class="text-[20px] uppercase">Management Legend</label>
            <span class="mb-[2rem] text-[16px] font-[400] leading-[19px]">Legend Pada Peta Terdapat {{ $legends->count() }} Legend</span>
        </div>
        <div class="flex gap-[1rem]">
            <div class="flex h-fit w-[25%] flex-col rounded-[10px] bg-[#222831] p-[1rem]" id="create">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert p-[10px] mb-[1rem] rounded-[5px] text-[#eeeeee] bg-red-500">:message</div>')) !!}
                @elseif (Session::has('success'))
                    <div class="alert mb-[1rem] rounded-[5px] bg-green-600 p-[10px] text-[#eeeeee]">{{ Session::get('success') }}</div>
                @endif
                <form class="flex flex-col gap-[10px]" action="{{ route('management.legend.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col">
                        <div class="flex flex-col gap-[10px]">
                            <div class="flex flex-col gap-[10px]">
                                <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="logo">Logo</label>
                                <input required
                                    class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none file:mr-[1rem] file:rounded-[5px] file:border-0 file:bg-[#1e56ee] file:px-[1rem] file:text-[#eeeeee] focus:border-r-[2px] focus:border-l-[2px]"
                                    type="file" name="logo" id="logo" accept="image/*">
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="name">Nama</label>
                                <input class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]"
                                    type="text" name="name" id="name" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="cursor-pointer rounded-[10px] border-0 bg-[#1e56ee] p-[0.5rem_0.75rem] text-[15px] font-[700] text-[#eeeeee] outline-0 transition-[0.2s] hover:bg-[#376cfd] active:bg-[#376cfd]">TAMBAH</button>
                </form>
            </div>
            <div class="flex w-[75%] flex-col">
                <div class="flex flex-col justify-between gap-[1rem]">
                    @foreach ($legends as $legend)
                        <div class="flex items-center justify-between rounded-[10px] bg-[#222831] p-[10px]">
                            <div class="flex gap-[1rem]">
                                <div class="flex flex-col">
                                    <img src="{{ asset($legend->logo) }}" alt="{{ $legend->name }}" class="h-[75px] w-[100%] rounded-[10px] border-0 object-contain outline-0">
                                </div>
                                <div class="flex flex-col gap-[10px]">
                                    <div class="flex flex-col">
                                        <label for="name" class="w-[75px]">Nama</label>
                                        <span>{{ $legend->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-[15px] flex gap-[10px]">
                                <a href="{{ route('management.legend.edit', $legend->id) }}" class="w-[100%] rounded-[5px] bg-orange-400 p-[10px] text-center uppercase text-[#eeeeee]" title="Edit"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('management.legend.destroy', $legend->id) }}" class="w-[100%] rounded-[5px] bg-red-500 p-[10px] text-center uppercase text-[#eeeeee]" title="Delete"
                                    onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa-solid fa-delete-left"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $legends->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
    @include('template.alert')
@endsection

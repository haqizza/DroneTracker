@extends('layouts.index')
@section('content')
    <div class="flex w-[85%] flex-col p-[1rem]">
        <div class="flex flex-col">
            <label for="" class="text-[20px] uppercase">Management Security Status</label>
            <span class="mb-[2rem] text-[16px] font-[400] leading-[19px]">Security Status Yang Terdaftar Terdapat {{ $securities->count() }} Status</span>
        </div>
        <div class="flex gap-[1rem]">
            <div class="flex h-fit w-[25%] flex-col rounded-[10px] bg-[#222831] p-[1rem]" id="create">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert p-[10px] mb-[1rem] rounded-[5px] text-[#eeeeee] bg-red-500">:message</div>')) !!}
                @elseif (Session::has('success'))
                    <div class="alert mb-[1rem] rounded-[5px] bg-green-600 p-[10px] text-[#eeeeee]">{{ Session::get('success') }}</div>
                @endif
                <form class="flex flex-col gap-[10px]" action="{{ route('management.security.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col">
                        <div class="flex flex-col gap-[10px]">
                            <div class="flex flex-col gap-[10px]">
                                <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="part">Part</label>
                                <input placeholder="Part kerusakan . . ." type="text" name="part" id="part" required
                                    class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]">
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="tingkat_resiko">Tingkat Resiko</label>
                                <input placeholder="Tingkat resiko kerusakan . . ." type="text" name="tingkat_resiko" id="tingkat_resiko" required
                                    class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]">
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <label class="w-fit rounded-t-[5px] px-[0.25rem] text-[14px] font-[400] uppercase text-[#eeeeee]" for="dampak">Dampak</label>
                                <input placeholder="Dampak dari kerusakan . . ." type="text" name="dampak" id="dampak"
                                    class="rounded-[5px] border-[#1e56ee] bg-[#393E46] p-[0.75rem_0.75rem] text-[15px] text-[#eeeeee] outline-none focus:border-r-[2px] focus:border-l-[2px]" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="cursor-pointer rounded-[10px] border-0 bg-[#1e56ee] p-[0.5rem_0.75rem] text-[15px] font-[700] text-[#eeeeee] outline-0 transition-[0.2s] hover:bg-[#376cfd] active:bg-[#376cfd]">TAMBAH</button>
                </form>
            </div>
            <div class="flex w-[75%] flex-col">
                <div class="flex flex-wrap justify-between gap-[1rem]">
                    @foreach ($securities as $security)
                        <div class="flex flex-[1_1_20%] flex-col rounded-[10px] bg-[#222831] p-[10px]">
                            <div class="flex justify-between gap-[10px]">
                                <div class="flex flex-col">
                                    <label for="name">Part</label>
                                    <span>{{ $security->part }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <label for="name">Tingkat Resiko</label>
                                    <span>{{ $security->tingkat_resiko }} %</span>
                                </div>
                                <div class="flex flex-col">
                                    <label for="email">Dampak</label>
                                    <span>{{ $security->dampak }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <label for="aksi">Aksi</label>
                                    <div class="flex gap-[10px]">
                                        <a href="{{ route('management.security.edit', $security->id) }}" class="w-[100%] rounded-[5px] bg-orange-400 p-[10px] text-center uppercase text-[#eeeeee]"
                                            title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{ route('management.security.destroy', $security->id) }}" class="w-[100%] rounded-[5px] bg-red-500 p-[10px] text-center uppercase text-[#eeeeee]"
                                            title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa-solid fa-delete-left"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $securities->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
    @include('template.alert')
@endsection

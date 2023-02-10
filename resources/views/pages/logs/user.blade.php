@extends('layouts.index')
@section('content')
    {{-- --bg: #222831;
    --sub: #393E46;
    --acc: #1e56ee;
    --txt: #EEEEEE; --}}
    <div class="flex w-[85%] flex-col p-[1rem]">
        <div class="flex flex-col">
            <label for="" class="text-[20px] uppercase">LOGS</label>
            <span class="mb-[2rem] text-[16px] font-[400] leading-[19px]">USER LOGS</span>
        </div>
        <div class="rounded-[10px]">
            <div class="flex flex-col">
                <div class="flex flex-col">
                    {{-- <form class="flex gap-[1rem]" action="">
                        @csrf
                        <div class="group">
                            <label for="from">Dari</label>
                            <input type="date" name="from" id="from">
                        </div>
                        <div class="group">
                            <label for="to">Sampai</label>
                            <input type="date" name="to" id="to">
                        </div>
                        <div class="group">
                            <button type="submit">filter</button>
                        </div>
                    </form> --}}
                    <table border="0" cellspacing="0" cellpadding="0" class="table-auto">
                        <thead>
                            <tr class="bg-[#1e56ee]">
                                <th class="p-[10px] text-start">No.</th>
                                <th class="p-[10px] text-start">Nama</th>
                                <th class="p-[10px] text-start">Email</th>
                                <th class="p-[10px] text-start">Waktu Login</th>
                                <th class="p-[10px] text-start">Waktu Logout</th>
                                <th class="p-[10px] text-start">Durasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr class="bg-[#222831]">
                                    <td class="p-[10px] text-start">{{ $loop->iteration }}</td>
                                    <td class="p-[10px] text-start">{{ $log->name }}</td>
                                    <td class="p-[10px] text-start">{{ $log->email }}</td>
                                    <td class="p-[10px] text-start">{{ $log->login }}</td>
                                    <td class="p-[10px] text-start">{{ $log->logout }}</td>
                                    <td class="p-[10px] text-start">
                                        @if ($log->duration >= 60 && $log->duration < 3600)
                                            {{ number_format($log->duration / 60, 2) }} Menit
                                        @elseif ($log->duration >= 3600 && $log->duration < 86400)
                                            {{ number_format($log->duration / 3600, 2) }} Jam
                                        @elseif($log->duration >= 86400)
                                            {{ number_format($log->duration / 86400, 2) }} Hari
                                        @elseif($log->duration == null)
                                        @else
                                            {{ $log->duration }} Detik
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- --bg: #222831;
    --sub: #393E46;
    --acc: #1e56ee;
    --txt: #EEEEEE; --}}
@extends('layouts.index')
@section('content')
    <div class="flex w-full p-[1rem]" id="middle">
        <div class="flex w-[100%] gap-[1rem]">
            <div class="flex w-[80%] flex-col rounded-[20px] bg-[#222831] ml-4 p-[1rem]  overflow-y-scroll scrollbar-hide">
                <div class="min-h-[70%]">
                    <div id="map" class="h-[100%] rounded-[10px]"></div>
                </div>
                <div class="mt-2 p-2">
                    <h3 class="text-xl font-[700] mb-4">Telemetri Logs</h3>
                    <table class="table w-full">
                        <tr class="w-full">
                            <td class="p-2 border border-white rounded rounded">No</td>
                            <td class="p-2 border border-white rounded rounded">Payload Time</td>
                            <td class="p-2 border border-white rounded rounded">Latitude</td>
                            <td class="p-2 border border-white rounded rounded">Longitude</td>
                            <td class="p-2 border border-white rounded rounded">Barometer</td>
                            <td class="p-2 border border-white rounded rounded">SoG</td>
                            <td class="p-2 border border-white rounded rounded">CoG</td>
                            <td class="p-2 border border-white rounded rounded">Current</td>
                            <td class="p-2 border border-white rounded rounded">Voltage</td>
                            <td class="p-2 border border-white rounded rounded">Power</td>
                            <td class="p-2 border border-white rounded rounded">Class</td>
                            <td class="p-2 border border-white rounded rounded">AX</td>
                            <td class="p-2 border border-white rounded rounded">AY</td>
                            <td class="p-2 border border-white rounded rounded">AZ</td>
                            <td class="p-2 border border-white rounded rounded">GX</td>
                            <td class="p-2 border border-white rounded rounded">GY</td>
                            <td class="p-2 border border-white rounded rounded">GZ</td>
                            <td class="p-2 border border-white rounded rounded">MX</td>
                            <td class="p-2 border border-white rounded rounded">MY</td>
                            <td class="p-2 border border-white rounded rounded">MZ</td>
                            <td class="p-2 border border-white rounded rounded">Roll</td>
                            <td class="p-2 border border-white rounded rounded">Pitch</td>
                            <td class="p-2 border border-white rounded rounded">Yaw</td>
                            <td class="p-2 border border-white rounded rounded">Temp</td>
                            <td class="p-2 border border-white rounded rounded">Hum</td>
                        </tr>
                        @foreach ($logs as $log)
                        <tr>
                            <td class="p-2 border border-white rounded rounded">{{ $loop->index + 1 }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->payload_time }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->latitude }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->longitude }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->altitude }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->SoG }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->CoG }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->current }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->voltage }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->power }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->classification }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->ax }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->ay }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->az }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->gx }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->gy }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->gz }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->mx }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->my }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->mz }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->roll }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->pitch }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->yaw }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->temprature }}</td>
                            <td class="p-2 border border-white rounded rounded">{{ $log->humidity }}</td>
                        </tr>
                        @endforeach
                    </table>
                    <!-- <div class="border border-white rounded p-2">
                    </div> -->
                </div>
            </div>
            @include('pages.right-panel')
        </div>

    </div>
    @include('pages.script.script')
@endsection

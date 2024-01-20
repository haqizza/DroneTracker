{{-- --bg: #222831;
    --sub: #393E46;
    --acc: #1e56ee;
    --txt: #EEEEEE; --}}
@extends('layouts.index')
@section('content')
    <div class="flex w-[85%] p-[1rem]" id="middle">
        <div class="flex w-[100%] gap-[1rem]">
            <div class="flex w-[80%] flex-col rounded-[20px] bg-[#222831] ml-4 p-[1rem]">
                <div class="relative h-[70%]">
                    <div class="absolute bottom-0 right-0 z-[9999] rounded-tl-[5px] bg-[#222831] p-[0.75rem] text-[#222831]">
                        <h5 class="mb-[0.5rem] text-center font-[600] text-[#eeeeee]">LEGENDA</h5>
                        <div class="flex flex-col">
                            @foreach ($legends as $legend)
                                <p class="mb-[10px] flex gap-[1rem] rounded-[5px] bg-[#eeeeee] p-[5px] text-[#222831]"><img src="{{ asset($legend->logo) }}" alt=""
                                        class="w-[20px]">{{ $legend->name }}</p>
                            @endforeach
                            <select name="code_id" id="code_id" class="rounded-[5px] border-0 p-[0.25rem] outline-none">
                                <option>Silahkan Pilih Flight Code</option>
                                @foreach ($codes as $code)
                                    <option value="{{ $code->id }}">{{ $code->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="map" class="h-[100%] rounded-[10px]"></div>
                </div>
                <!-- <div class="flex h-[30%] justify-between p-[1rem] mb-16">
                    <div class="flex flex-col">
                        <div class="flex flex-col items-center">
                            <h5 class="text-[15px] font-[600] uppercase">Speedometer</h5>
                            <canvas id="speedo"></canvas>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-col items-center">
                            <h5 class="text-[15px] font-[600] uppercase">Accelerometer</h5>
                            <canvas id="acl"></canvas>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-col items-center">
                            <h5 class="text-[15px] font-[600] uppercase">Gyro</h5>
                            <div id="gyro"></div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-col items-center">
                            <h5 class="text-[15px] font-[600] uppercase">COMPAS</h5>
                            <canvas id="compas"></canvas>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-col items-center">
                            <h5 class="text-[15px] font-[600] uppercase">Altimeter</h5>
                            <canvas id="altmeter"></canvas>
                        </div>
                    </div>
                </div> -->
                <div class="mx-2 my-4 p-2 ">
                    <h3 class="text-xl font-[700] mb-4">Telemetri Logs</h3>
                    <div class="border border-white rounded p-2 overflow-scroll">
                        <table class="table">
                            <tr>
                                <td class="p-2 border border-white rounded rounded">Timestamp</td>
                                <td class="p-2 border border-white rounded rounded">Latitude</td>
                                <td class="p-2 border border-white rounded rounded">Longitude</td>
                                <td class="p-2 border border-white rounded rounded">Altitude</td>
                                <td class="p-2 border border-white rounded rounded">SoG</td>
                                <td class="p-2 border border-white rounded rounded">CoG</td>
                                <td class="p-2 border border-white rounded rounded">Current</td>
                                <td class="p-2 border border-white rounded rounded">Voltage</td>
                                <td class="p-2 border border-white rounded rounded">Power</td>
                                <td class="p-2 border border-white rounded rounded">Status</td>
                                <td class="p-2 border border-white rounded rounded">AX</td>
                                <td class="p-2 border border-white rounded rounded">AY</td>
                                <td class="p-2 border border-white rounded rounded">AZ</td>
                                <td class="p-2 border border-white rounded rounded">GX</td>
                                <td class="p-2 border border-white rounded rounded">GY</td>
                                <td class="p-2 border border-white rounded rounded">GZ</td>
                            </tr>
                            @foreach ($logs as $log)
                            <tr>
                                <td class="p-2 border border-white rounded rounded">{{ $log->created_at }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->latitude }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->longitude }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->altitude }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->SoG }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->CoG }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->current }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->voltage }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->power }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->status }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->ax }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->ay }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->az }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->gx }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->gy }}</td>
                                <td class="p-2 border border-white rounded rounded">{{ $log->gz }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex w-[20%] flex-col gap-[1rem] overflow-y-scroll rounded-[20px] scrollbar-hide">
                <div class="rounded-[20px] bg-[#222831] p-[1rem]">
                    <div class="flex flex-col gap-[0.75rem]">
                        <h5 class="text-center text-[15px] font-[500] uppercase">Jarak Tempuh</h5>
                        <div class="fix flex flex-col gap-[0.25rem]">
                            <label class="mx-[0.25rem] text-[13px] uppercase" for="start">Koordinat Awal</label>
                            <span id="start" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">
                                @isset($oldest)
                                    {{ $oldest->latitude }}, {{ $oldest->longitude }}
                                @endisset
                            </span>
                        </div>
                        <div class="fix flex flex-col gap-[0.25rem]">
                            <label class="mx-[0.25rem] text-[13px] uppercase" for="end">Koordinat Akhir</label>
                            <span id="end" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">
                                @isset($latest)
                                    <p id="latend">{{ $latest->latitude }}</p>,
                                    <p id="lngend">{{ $latest->longitude }}</p>
                                @endisset
                            </span>
                        </div>
                        <!-- <div class="flex flex-col gap-[0.25rem]" id="header">
                            <div class="flex justify-between">
                                <label class="mx-[0.25rem] text-[13px] uppercase" for="jaraketempuh">Jarak Tempuh Drone</label>
                                <button title="Ubah Ke Meter" onclick="ganti()" id="switch"><i class="fa-solid fa-repeat"></i></button>
                            </div>
                            <span id="hasil" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">{{ number_format($counted ?? 0, 3, '.', ',') }} KM</span>
                        </div> -->
                        <!-- <div class="flex flex-col gap-[0.25rem]">
                            <div class="flex justify-between">
                                <label class="mx-[0.25rem] text-[13px] uppercase" for="haversine">Jarak Garis titik awal-akhir</label>
                                <button title="Ubah Ke Meter" onclick="change()" id="change"><i class="fa-solid fa-repeat"></i></button>
                            </div>
                            <span id="haversine" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">{{ number_format($starttoend ?? 0, 3, '.', ',') }} KM</span>
                        </div> -->
                    </div>
                </div>
                <div class="rounded-[20px] bg-[#222831] p-[1rem]">
                    <div class="flex flex-col gap-[0.75rem]">
                        <h5 class="text-center text-[15px] font-[500] uppercase">Waktu Tempuh</h5>
                        <div class="fix flex flex-col gap-[0.25rem]">
                            <label class="mx-[0.25rem] text-[13px] uppercase" for="waktu_awal">Waktu Awal</label>
                            <span id="waktu_awal"
                                class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">{{ !empty($oldest->created_at) ? date('D, d F Y H:i:s', strtotime($oldest->created_at)) : null }}</span>
                        </div>
                        <div class="fix flex flex-col gap-[0.25rem]">
                            <label class="mx-[0.25rem] text-[13px] uppercase" for="waktu_akhir">Waktu Akhir</label>
                            <span id="waktu_akhir"
                                class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">{{ !empty($latest->created_at) ? date('D, d F Y H:i:s', strtotime($latest->created_at)) : null }}</span>
                        </div>
                        <div class="fix flex flex-col gap-[0.25rem]">
                            <label class="mx-[0.25rem] text-[13px] uppercase" for="waktu">Total Waktu Tempuh</label>
                            <span id="waktu" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">
                                @if ($waktu >= 60 and $waktu < 3600)
                                    {{ number_format($waktu / 60, 2) }} Menit
                                @elseif ($waktu >= 3600)
                                    {{ number_Format($waktu / 3600, 2) }} Jam
                                @else
                                    {{ $waktu }} Detik
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="rounded-[20px] bg-[#222831] p-[1rem]">
                    <div class="flex flex-col gap-[0.75rem]">
                        <h5 class="text-center text-[15px] font-[500] uppercase">Penggunaan Daya</h5>
                        <div class="fix flex flex-col gap-[0.25rem]">
                            <label class="mx-[0.25rem] text-[13px] uppercase" for="volt_start">Voltase Awal</label>
                            <span id="volt_start" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">{{ $oldest->tegangan ?? '' }}</span>
                        </div>
                        <div class="fix flex flex-col gap-[0.25rem]">
                            <label class="mx-[0.25rem] text-[13px] uppercase" for="volt_end">Voltase Akhir</label>
                            <span id="volt_end" class="flex min-h-[2rem] rounded-[5px] bg-[#393E46] p-[0.25rem_0.5rem]">{{ $latest->tegangan ?? '' }}</span>
                        </div>
                    </div>
                </div>
                <div class="rounded-[20px] bg-[#222831] p-[1rem]">
                    <div class="flex flex-col"></div>
                </div>
                <div class="rounded-[20px] bg-[#222831] p-[1rem]">
                    <div class="flex flex-col"></div>
                </div>
            </div>
        </div>

    </div>
    <script>
        // Echo.channel('SecurityEvent').listen('SecurityEvent', (e) => {
        //     document.getElementById('security').scrollIntoView();
        //     if (e.tingkat > 50) {
        //         document.getElementById('security_body').classList.add('danger');
        //     } else {
        //         document.getElementById('security_body').classList.add('warning');
        //     }
        //     document.getElementById('part').innerHTML = e.part;
        //     document.getElementById('risk').innerHTML = e.tingkat + " %";
        //     document.getElementById('dampak').innerHTML = e.dampak;
        // });

        // const attitudeElement = document.querySelector("#gyro")
        // const pengaturan = {
        //     size: 225,
        //     roll: 0,
        //     pitch: 0,
        //     imagesDirectory: "/js/flight-indicators-js/img/",
        // };
        // const attitude = new FlightIndicators(
        //     attitudeElement, FlightIndicators.TYPE_ATTITUDE, pengaturan, );
    </script>
    @include('pages.script.script')
@endsection

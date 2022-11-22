@extends('layouts.index')
@section('content')
    <div class="main-container" id="middle">
        <div class="sub-content">
            <div class="display">
                <div class="map">
                    <div class="legend">
                        <h5>LEGENDA</h5>
                        <div class="content">
                            @foreach ($legends as $legend)
                                <p><img src="{{ asset($legend->logo) }}" alt="">{{ $legend->name }}</p>
                            @endforeach
                            <select name="code_id" id="code_id">>
                                <option>Silahkan Pilih Flight Code</option>
                                @foreach ($codes as $code)
                                    <option value="{{ $code->id }}">{{ $code->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
                <div class="box">
                    <div class="gauge">
                        <div class="body">
                            <h5>Speedometer</h5>
                            <canvas id="speedo"></canvas>
                        </div>
                    </div>
                    <div class="gauge">
                        <div class="body">
                            <h5>Accelerometer</h5>
                            <canvas id="acl"></canvas>
                        </div>
                    </div>
                    <div class="gauge">
                        <div class="body">
                            <h5>Gyro</h5>
                            <div id="gyro"></div>
                        </div>
                    </div>
                    <div class="gauge">
                        <div class="body">
                            <h5>COMPAS</h5>
                            <canvas id="compas"></canvas>
                        </div>
                    </div>
                    <div class="gauge">
                        <div class="body">
                            <h5>Altimeter</h5>
                            <canvas id="altmeter"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cards">
                <div class="card">
                    <div class="content">
                        <h5>Jarak Tempuh</h5>
                        <div class="item fix">
                            <label for="start">Koordinat Awal</label>
                            <span id="start">
                                @isset($oldest)
                                    {{ $oldest->latitude }}, {{ $oldest->longitude }}
                                @endisset
                            </span>
                        </div>
                        <div class="item fix">
                            <label for="end">Koordinat Akhir</label>
                            <span id="end">
                                @isset($latest)
                                    <p id="latend">{{ $latest->latitude }}</p>,
                                    <p id="lngend">{{ $latest->longitude }}</p>
                                @endisset
                            </span>
                        </div>
                        <div class="item" id="header">
                            <div class="head">
                                <label for="jaraketempuh">Jarak Tempuh Drone</label>
                                <button title="Ubah Ke Meter" onclick="ganti()" id="switch"><i
                                        class="fa-solid fa-repeat"></i></button>
                            </div>
                            <span id="hasil">{{ number_format($counted ?? 0, 3, '.', ',') }} KM</span>
                        </div>
                        <div class="item">
                            <div class="head">
                                <label for="haversine">Jarak Garis titik awal-akhir</label>
                                <button title="Ubah Ke Meter" onclick="change()" id="change"><i
                                        class="fa-solid fa-repeat"></i></button>
                            </div>
                            <span id="haversine">{{ number_format($starttoend ?? 0, 3, '.', ',') }} KM</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <h5>Waktu Tempuh</h5>
                        <div class="item fix">
                            <label for="waktu_awal">Waktu Awal</label>
                            <span
                                id="waktu_awal">{{ !empty($oldest->created_at) ? date('D, d F Y H:i:s', strtotime($oldest->created_at)) : null }}</span>
                        </div>
                        <div class="item fix">
                            <label for="waktu_akhir">Waktu Akhir</label>
                            <span
                                id="waktu_akhir">{{ !empty($latest->created_at) ? date('D, d F Y H:i:s', strtotime($latest->created_at)) : null }}</span>
                        </div>
                        <div class="item fix">
                            <label for="waktu">Total Waktu Tempuh</label>
                            <span id="waktu">
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
                <div class="card">
                    <div class="content">
                        <h5>Penggunaan Daya</h5>
                        <div class="item fix">
                            <label for="volt_start">Voltase Awal</label>
                            <span id="volt_start">{{ $oldest->tegangan ?? '' }}</span>
                        </div>
                        <div class="item fix">
                            <label for="volt_end">Voltase Akhir</label>
                            <span id="volt_end">{{ $latest->tegangan ?? '' }}</span>
                        </div>
                    </div>
                </div>
                <div class="card" id="security">
                    <div class="content" id="security_body">
                        <h5>Security</h5>
                        <div class="item">
                            <label for="part">Part Yang Terkena</label>
                            <span id="part">{{ $latest->security->part ?? '' }}</span>
                        </div>
                        <div class="item">
                            <label for="risk">Tingkat Resiko</label>
                            <span id="risk">{{ $latest->security->tingkat_resiko ?? '' }} %</span>
                        </div>
                        <div class="item">
                            <label for="dampak">Dampak Terhadap Drone</label>
                            <span id="dampak">{{ $latest->security->dampak ?? '' }}</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content"></div>
                </div>
                <div class="card">
                    <div class="content"></div>
                </div>
            </div>
        </div>

    </div>
    <script>
        Echo.channel('SecurityEvent').listen('SecurityEvent', (e) => {
            document.getElementById('security').scrollIntoView();
            if (e.tingkat > 50) {
                document.getElementById('security_body').classList.add('danger');
            } else {
                document.getElementById('security_body').classList.add('warning');
            }
            document.getElementById('part').innerHTML = e.part;
            document.getElementById('risk').innerHTML = e.tingkat + " %";
            document.getElementById('dampak').innerHTML = e.dampak;
        });

        const attitudeElement = document.querySelector("#gyro")
        const pengaturan = {
            size: 225,
            roll: 0,
            pitch: 0,
            imagesDirectory: "/js/flight-indicators-js/img/",
        };
        const attitude = new FlightIndicators(
            attitudeElement, FlightIndicators.TYPE_ATTITUDE, pengaturan, );
    </script>
    @include('pages.script.script')
@endsection

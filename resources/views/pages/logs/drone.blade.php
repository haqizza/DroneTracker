@extends('layouts.index')
@section('content')
    <div class="main-container">
        <div class="title">
            <label for="">LOGS</label>
            <span>DRONE FLIGHTS</span>
        </div>
        <div class="card-log-container">
            <div class="card" id="logDrone">
                <div class="card-body">
                    <div class="card-title">
                        <div class="group">
                            <label for="drone">Drone</label>
                            <select name="drone" id="drone">
                                <option>PILIH DRONE</option>
                                @foreach ($logs as $drone)
                                    <option value="{{ $drone->id }}">{{ $drone->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="group">
                            <label for="code">Flight Code</label>
                            <select name="code" id="code">
                            </select>
                        </div>
                    </div>
                    <div class="body">
                        <div class="left">
                            <div class="group" id="droneimg">
                                <img src="" alt="" id="gambarDrone">
                            </div>
                            <div class="map">
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="largeGroup">
                            <div class="data">
                                <div class="group">
                                    <label for="">Waktu Pertama Terbang</label>
                                    <span id="first_flight_time"></span>
                                </div>
                                <div class="group">
                                    <label for="">Waktu Terakhir Terbang</label>
                                    <span id="last_flight_time"></span>
                                </div>
                                <div class="group">
                                    <label for="">Total Jarak Yang Ditempuh</label>
                                    <span id="total_haversine"></span>
                                </div>
                                <div class="group">
                                    <label for="">data</label>
                                    <span id="total_haversine"></span>
                                </div>
                                <div class="group">
                                    <label for="">data</label>
                                    <span id="total_haversine"></span>
                                </div>
                                <div class="group">
                                    <label for="">data</label>
                                    <span id="total_haversine"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.logs.script.drone')
@endsection

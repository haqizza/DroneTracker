@extends('layouts.index')
@section('content')
    <div class="container">
        <div class="nav">
            <div class="toggle" id="navbar">
                <input type="checkbox" name="" id="expand">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <nav class="sidebar">
                <a href="" class="nav-brand">drone tracking</a>
                <div class="link-group">
                    <a href="" class="nav-link"><i class="fa-solid fa-house"></i><span> Home</span></a>
                    <a href="" class="nav-link"><i class="fa-solid fa-list"></i><span> Drone List</span></a>
                    <a href="" class="nav-link"><i class="fa-solid fa-book"></i><span> Report</span></a>
                    <a href="" class="nav-link"><i class="fa-solid fa-gear"></i><span> Setting</span></a>
                </div>
                <div class="profile">
                    <a href="" class="profile-link"><i class="fa-solid fa-user"></i><span>Profile</span></a>
                    <a href="" class="log"><i class="fa-solid fa-right-from-bracket"></i><span>Log Out</span></a>
                </div>
            </nav>
        </div>
        <div class="map">
            <div class="header">
                <div class="item" id="header">
                    <label for="jaraketempuh">Jarak Tempuh Drone</label>
                    <span id="hasil"></span>
                    <button title="Ubah Ke Meter" onclick="ganti()" id="switch"><i
                            class="fa-solid fa-repeat"></i></button>
                </div>
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
            </div>
            <div id="map"></div>
        </div>
        <div class="cards">
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
        </div>
    </div>
    @include('pages.script.script')
@endsection

@extends('layouts.index')
@section('content')
    <div class="main-container">
        <div class="manage">
            <div class="header">
                <div class="info">
                    <h5>Management Drone</h5>
                    <p>Drone yang terdaftar terdapat {{ $drones->count() }} unit.</p>
                </div>
                <div class="action">
                    <a href="{{ route('management.drone.create') }}" class="btn">Tambah</a>
                </div>
            </div>
            <div class="drones">
                @foreach ($drones as $drone)
                    <div class="card">
                        <div class="card-body">
                            <div class="card-img">
                                <img src="{{ asset($drone->image) }}" alt="">
                            </div>
                            <div class="card-header">
                                <h5>{{ $drone->id }}</h5>
                            </div>
                            <div class="card-text">
                                <label for="merk">Merk</label>
                                <span>{{ $drone->merk }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $drones->onEachSide(0)->links() }}
        </div>
    </div>
@endsection

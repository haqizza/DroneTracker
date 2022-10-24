@extends('layouts.index')
@section('content')
    <div class="main-container">
        <div class="show">
            <div class="card">
                <div class="card-img">
                    <img src="{{ asset($drone->image) }}" alt="">
                </div>
                <div class="card-body">
                    <div class="card-header">
                        <h3>{{ $drone->id }}</h3>
                    </div>
                    <div class="group">
                        <label for="merk">Merk</label>
                        <span>{{ $drone->merk }}</span>
                    </div>
                    <div class="group">
                        <label for="description">Description</label>
                        <span>{{ $drone->description }}</span>
                    </div>
                    <div class="group">
                        <label for="terbang">Jam Terbang</label>
                        <span>
                            @if ($terbang >= 60 && $terbang < 3600)
                                {{ number_format($terbang / 60, 2, '.') }} Menit
                            @elseif($terbang >= 360)
                                {{ number_format($terbang / 3600, 2, '.') }} Jam
                            @else
                                {{ number_format($terbang, 2, '.') }} Detik
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

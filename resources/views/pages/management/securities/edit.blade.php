@extends('layouts.index')
@section('content')
    <div class="main-container">
        @if ($errors->any())
            {!! implode('', $errors->all('<div class="alert danger">:message</div>')) !!}
        @elseif (Session::has('success'))
            <div class="alert success">{{ Session::get('success') }}</div>
        @endif
        <div class="form-container">
            <div class="form">
                <h1>Tambah Data Legenda</h1>
                <form action="{{ route('management.legends.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div class="group">
                        <label for="log">Icon</label>
                        <input type="file" name="logo" id="logo" class="file" required>
                    </div>
                    <button type="submit">SUBMIT</button>
                </form>
                <div class="data">
                    @foreach ($legends as $legend)
                        <div class="card">
                            <div class="info">
                                <div class="group">
                                    <label for="logo">Logo</label>
                                    <img src="{{ asset($legend->logo) }}" alt="">
                                </div>
                                <div class="group">
                                    <label for="name">Nama</label>
                                    <span>{{ $legend->name }}</span>
                                </div>
                            </div>
                            <div class="action">
                                <a href="{{ route('management.legends.edit', $legend->id) }}" class="btn warning"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a href="" class="btn danger"><i class="fa-solid fa-delete-left"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="form">
                <h1>Tambah Data Security Status</h1>
                <form action="{{ route('management.security.update', $security->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="group">
                        <label for="part">Part</label>
                        <input type="text" name="part" id="part" required value="{{ $security->part }}">
                    </div>
                    <div class="group">
                        <label for="tingkat_resiko">Tingkat Resiko</label>
                        <input type="number" name="tingkat_resiko" id="tingkat_resiko" required
                            value="{{ $security->tingkat_resiko }}">
                    </div>
                    <div class="group">
                        <label for="dampak">Dampak</label>
                        <input type="text" name="dampak" id="dampak" required
                            value="{{ $security->dampak }}">
                    </div>
                    <button type="submit">SUBMIT</button>
                </form>
                <div class="data">
                    @foreach ($securities as $security)
                        <div class="card">
                            <div class="info">
                                <div class="group">
                                    <label for="part">Part</label>
                                    <span>{{ $security->part }}</span>
                                </div>
                                <div class="group">
                                    <label for="dampak">Dampak</label>
                                    <span>{{ $security->dampak }}</span>
                                </div>
                                <div class="group">
                                    <label for="tingkat_resiko">Tingkat Resiko (%)</label>
                                    <span>{{ $security->tingkat_resiko }}</span>
                                </div>
                            </div>
                            <div class="action">
                                <a href="{{ route('management.security.edit',$security->id) }}" class="btn warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="" class="btn danger"><i class="fa-solid fa-delete-left"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

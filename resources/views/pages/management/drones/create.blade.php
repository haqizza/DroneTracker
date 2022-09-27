@extends('layouts.index')
@section('content')
    <div class="main-container">
        <div class="create">
            <form action="{{ route('management.drone.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="group">
                    <label for="image">Foto</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="group">
                    <label for="id">Nomor Seri</label>
                    <input type="text" name="id" id="id" required>
                </div>
                <div class="group">
                    <label for="merk">Merk</label>
                    <input type="text" name="merk" id="merk" required>
                </div>
                <div class="group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" cols="50" rows="10" required></textarea>
                </div>
                <button type="submit">TAMBAH</button>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.index')
@section('content')
    <div class="main-container">
        <div class="title">
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert danger">:message</div>')) !!}
            @elseif (Session::has('success'))
                <div class="alert success">{{ Session::get('success') }}</div>
            @endif
            <label for="">Management DRONE</label>
            <span>Drone yang terdaftar terdapat {{ $counted->count() }} unit</span>
        </div>
        <div class="sub-content">
            <div class="create">
                <form action="{{ route('management.drone.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="body">
                        <div class="larger">
                            <div class="group">
                                <label for="image">Foto</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="group">
                                <label for="id">Nomor Seri</label>
                                <input type="text" name="id" id="id" required>
                            </div>
                        </div>
                        <div class="larger">
                            <div class="group">
                                <label for="merk">Merk</label>
                                <input type="text" name="merk" id="merk" required>
                            </div>
                            <div class="group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" cols="50" rows="10" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn">TAMBAH</button>
                </form>
            </div>
            <div class="manage">
                <div class="drones">
                    @foreach ($drones as $drone)
                        <div class="card">
                            <a href="{{ route('management.drone.show', $drone->id) }}" class="link-stretch"></a>
                            <div class="card-img">
                                <img src="{{ asset($drone->image) }}" alt="">
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    <label for="id">Nomor Seri</label>
                                    <span>{{ $drone->id }}</span>
                                </div>
                                <div class="card-text">
                                    <label for="merk">Merk</label>
                                    <span>{{ $drone->merk }}</span>
                                </div>
                            </div>
                            <div class="card-action">
                                <a href="{{ route('management.drone.edit', $drone->id) }}" class="btn warning"
                                    title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('management.drone.destroy', $drone->id) }}" class="btn danger"
                                    title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fa-solid fa-delete-left"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $drones->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection

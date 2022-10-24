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
                <form action="{{ route('management.drone.update', $drone->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="body">
                        <div class="larger">
                            <div class="group">
                                <label for="image">Foto</label>
                                <input type="file" name="image" id="image" value="{{ $drone->image }}">
                            </div>
                            <div class="group">
                                <label for="id">Nomor Seri</label>
                                <input type="text" name="id" id="id" required value="{{ $drone->id }}">
                            </div>
                        </div>
                        <div class="larger">
                            <div class="group">
                                <label for="merk">Merk</label>
                                <input type="text" name="merk" id="merk" required value="{{ $drone->merk }}">
                            </div>
                            <div class="group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" cols="50" rows="10" required>{{ $drone->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn">UPDATE</button>
                </form>
            </div>
            <div class="manage">
                <div class="drones">
                    @foreach ($drones as $drone)
                        <div class="card">
                            <a href="" class="link-stretch"></a>
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
                                <a href="{{ route('management.drone.delete', $drone->id) }}" class="btn danger"
                                    title="Delete" onclick="return confirm()"><i class="fa-solid fa-delete-left"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $drones->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection

@extends('layouts.index')
@section('content')
    <div class="main-container">
        <div class="title">
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert danger">:message</div>')) !!}
            @elseif (Session::has('success'))
                <div class="alert success">{{ Session::get('success') }}</div>
            @endif
            <label for="">Management Legend</label>
        </div>
        <div class="sub-content">
            <div class="create">
                <form action="{{ route('management.legend.update', $legend->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="body">
                        <div class="larger">
                            <div class="group">
                                <label for="image">Foto</label>
                                <input type="file" name="image" id="image" value="{{ $legend->logo }}">
                            </div>
                        </div>
                        <div class="larger">
                            <div class="group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" required value="{{ $legend->name }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn">UPDATE</button>
                </form>
            </div>
            <div class="manage">
                <div class="drones">
                    @foreach ($legends as $legend)
                        <div class="card">
                            <a href="" class="link-stretch"></a>
                            <div class="card-img">
                                <img src="{{ asset($legend->logo) }}" alt="">
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    <label for="name">Name</label>
                                    <span>{{ $legend->name }}</span>
                                </div>
                            </div>
                            <div class="card-action">
                                <a href="{{ route('management.legend.edit', $legend->id) }}" class="btn warning"
                                    title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('management.legend.destroy', $legend->id) }}" class="btn danger"
                                    title="Delete" onclick="return confirm()"><i class="fa-solid fa-delete-left"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $legends->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection

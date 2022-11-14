@extends('layouts.index')
@section('content')
    <div class="main-container">
        <div class="title">
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert danger">:message</div>')) !!}
            @elseif (Session::has('success'))
                <div class="alert success">{{ Session::get('success') }}</div>
            @endif
            <label for="">Management Security Status</label>
        </div>
        <div class="sub-content">
            <div class="create">
                <form action="{{ route('management.security.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="body">
                        <div class="larger">
                            <div class="group">
                                <label for="part">Part</label>
                                <input type="text" name="part" id="part" required>
                            </div>
                        </div>
                        <div class="larger">
                            <div class="group">
                                <label for="tingkat_resiko">Tingkat Resiko</label>
                                <input type="text" name="tingkat_resiko" id="tingkat_resiko" required>
                            </div>
                            <div class="group">
                                <label for="dampak">Dampak</label>
                                <input type="text" name="dampak" id="dampak">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn">TAMBAH</button>
                </form>
            </div>
            <div class="manage">
                <div class="drones">
                    @foreach ($securities as $security)
                        <div class="card">
                            <div class="card-body">
                                <div class="card-text">
                                    <label for="part">Security Code</label>
                                    <span>{{ $security->id }}</span>
                                </div>
                                <div class="card-text">
                                    <label for="part">Part</label>
                                    <span>{{ $security->part }}</span>
                                </div>
                                <div class="card-text">
                                    <label for="tingkat_resiko">Tingkat Resiko</label>
                                    <span>{{ $security->tingkat_resiko }}</span>
                                </div>
                                <div class="card-text">
                                    <label for="dampak">Dampak</label>
                                    <span>{{ $security->dampak }}</span>
                                </div>
                            </div>
                            <div class="card-action">
                                <a href="{{ route('management.security.edit', $security->id) }}" class="btn warning"
                                    title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('management.security.destroy', $security->id) }}" class="btn danger"
                                    title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i
                                        class="fa-solid fa-delete-left"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $securities->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
    @include('template.alert')
@endsection

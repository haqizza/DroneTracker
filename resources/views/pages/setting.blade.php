@extends('layouts.index')
@section('content')
    <div class="main-container" id="middle">
        <div class="setting">
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert danger">:message</div>')) !!}
            @elseif (Session::has('success'))
                <div class="alert success">{{ Session::get('success') }}</div>
            @endif
            <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="body">
                    <div class="larger">
                        @isset($navbars->image)
                            <img src="{{ asset($navbars->image) }}" alt="">
                        @endisset
                        <div class="group">
                            <label for="image">LOGO</label>
                            <input type="file" name="image" id="image">
                        </div>
                        <div class="group">
                            <label for="name">Nama aplikasi</label>
                            <input type="text" name="name" id="name" value="{{ $navbars->name ?? '' }}">
                        </div>
                    </div>
                    <div class="larger">
                        <div class="group">
                            <label for="version">Versi Aplikasi</label>
                            <input type="text" name="version" id="version" value="{{ $navbars->version ?? '' }}">
                        </div>
                        <div class="group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" cols="30" rows="10">{{ $navbars->description ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit">UPDATE</button>
            </form>
        </div>
    </div>
@endsection

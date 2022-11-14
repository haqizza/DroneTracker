@extends('layouts.index')
@section('content')
    <div class="main-container">
        <form class="profile" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert danger">:message</div>')) !!}
            @elseif (Session::has('success'))
                <div class="alert success">{{ Session::get('success') }}</div>
            @elseif (Session::has('danger'))
                <div class="alert danger">{{ Session::get('danger') }}</div>
            @endif
            <div class="body">
                <div class="card-img">
                    @if ($user->image)
                        <img src="{{ asset($user->image) }}" alt="">
                    @else
                        <span>No Profile Picture</span>
                    @endif
                </div>
                <div class="info">
                    <div class="group">
                        <label for="image">Foto</label>
                        <input type="file" name="image" id="image" class="input-form">
                    </div>
                    <div class="group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="input-form">
                    </div>
                    <div class="group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="input-form">
                    </div>
                    <div class="group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="input-form">
                    </div>
                </div>
            </div>
            <button type="submit" class="link">UPDATE</button>
        </form>
    </div>
    @include('template.alert')
@endsection

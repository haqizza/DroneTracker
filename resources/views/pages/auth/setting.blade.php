@extends('layouts.index')
@section('content')
    <div class="main-container">
        <div class="profile">
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
                        <label for="name">Nama</label>
                        <span>{{ $user->name }}</span>
                    </div>
                    <div class="group">
                        <label for="email">Email</label>
                        <span>{{ $user->email }}</span>
                    </div>
                </div>
            </div>
            <a href="{{ route('user.edit') }}" class="link">UPDATE PROFILE</a>
        </div>
    </div>
    @include('template.alert')
@endsection

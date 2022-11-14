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
            <span>User yang terdaftar terdapat {{ $counted->count() }} user</span>
        </div>
        <div class="sub-content">
            <div class="create">
                <form action="{{ route('management.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="body">
                        <div class="larger">
                            <div class="group">
                                <label for="image">Foto</label>
                                <input type="file" name="image" id="image" value="{{ $user->image }}" accept="image/*">
                            </div>
                            <div class="group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" required value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="larger">
                            <div class="group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required value="{{ $user->email }}">
                            </div>
                            <div class="group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn">UPDATE</button>
                </form>
            </div>
            <div class="manage">
                <div class="drones">
                    @foreach ($users as $user)
                        <div class="card">
                            <a href="" class="link-stretch"></a>
                            <div class="card-img">
                                <img src="{{ asset($user->image) }}" alt="" class="profile">
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    <label for="name">Nama</label>
                                    <span>{{ $user->name }}</span>
                                </div>
                                <div class="card-text">
                                    <label for="email">Email</label>
                                    <span>{{ $user->email }}</span>
                                </div>
                            </div>
                            <div class="card-action">
                                <a href="{{ route('management.user.edit', $user->id) }}" class="btn warning"
                                    title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('management.user.delete', $user->id) }}" class="btn danger"
                                    title="Delete" onclick="return confirm()"><i class="fa-solid fa-delete-left"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $users->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
    @include('template.alert')
@endsection

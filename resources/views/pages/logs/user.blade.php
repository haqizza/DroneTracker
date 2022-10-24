@extends('layouts.index')
@section('content')
    <div class="main-container">
        <div class="logs">
            <div class="header">
                <form action="">
                    @csrf
                    <div class="group">
                        <label for="from">Dari</label>
                        <input type="date" name="from" id="from">
                    </div>
                    <div class="group">
                        <label for="to">Sampai</label>
                        <input type="date" name="to" id="to">
                    </div>
                    <div class="group">
                        <button type="submit">filter</button>
                    </div>
                </form>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Waktu Login</th>
                        <th>Waktu Logout</th>
                        <th>Durasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $log->name }}</td>
                            <td>{{ $log->email }}</td>
                            <td>{{ $log->login }}</td>
                            <td>{{ $log->logout }}</td>
                            <td>
                                @if ($log->duration >= 60 && $log->duration < 3600)
                                    {{ number_format($log->duration / 60, 2) }} Menit
                                @elseif ($log->duration >= 3600)
                                    {{ number_format($log->duration / 3600, 2) }} Jam
                                @elseif($log->duration == null)
                                @else
                                    {{ $log->duration }} Detik
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

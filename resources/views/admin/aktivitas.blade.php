@extends('layouts.main')

@section('title')
    <title>{{ config('app.name') }} - Aktivitas Log</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('container')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-dark">Riwayat Aktivitas</h2>
            <form action="{{ route('aktivitas.delete') }}" method="post" onsubmit="return confirm('Yakin ingin menghapus semua aktivitas?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="bx bx-trash"></i> Reset Aktivitas
                </button>
            </form>
        </div>
        <hr>

        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Pengguna</th>
                                <th>Aktivitas</th>
                                <th>Tindakan</th>
                                <th>waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activities as $activity)
                                <tr>
                                    <td>{{ $activity->causer->name ?? '-' }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>{{ $activity->log_name }}</td>
                                    <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tidak ada aktivitas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

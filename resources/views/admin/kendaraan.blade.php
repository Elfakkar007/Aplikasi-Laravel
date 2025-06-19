@extends('layouts.main')

@section('title')
    <title>{{ config('app.name') }} - Kendaraan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('container')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark">Daftar Kendaraan</h2>
        <a href="{{ route('kendaraan.create') }}" class="btn btn-primary btn-sm">
            <i class="bx bx-plus"></i> Tambah Kendaraan
        </a>
    </div>
    <hr>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Jenis</th>
                            <th>Tahun Pembuatan</th>
                            <th>Status</th>
                            <th>stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kendaraan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->jenis }}</td>
                            <td>{{ $data->tahun_pembuatan }}</td>
                            <td>
                                <span class="badge {{ $data->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $data->status == 1 ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </td>
                            <td>
                              {{ $data->stok }}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('kendaraan.edit', $data->id) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="bx bx-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('kendaraan.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bx bx-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data kendaraan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('partials.toastr')
@endsection

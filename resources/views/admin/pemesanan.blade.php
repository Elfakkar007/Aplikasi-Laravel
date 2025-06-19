@extends('layouts.main')

@section('title')
    <title>{{ config('app.name') }} - Pemesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('container')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark">Daftar Pemesanan Kendaraan</h2>
        <div>
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('pemesanan.create') }}" class="btn btn-sm btn-primary">
                    <i class="bx bx-plus"></i> Tambah
                </a>
            @endif
            <a href="{{ route('export') }}" class="btn btn-sm btn-success mx-1">
                <i class="bx bx-download"></i> Export Excel
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Jenis Kendaraan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemesanan as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->kendaraan->jenis }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_pemesanan)->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            1 => 'warning text-dark',
                                            0 => 'danger',
                                            2 => 'success'
                                        ];
                                        $statusText = [
                                            1 => 'Diajukan',
                                            0 => 'Ditolak',
                                            2 => 'Disetujui'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusClass[$data->status] ?? 'secondary' }}">
                                        {{ $statusText[$data->status] ?? 'Tidak Diketahui' }}
                                    </span>
                                </td>
                                <td>
                                    @if(auth()->user()->role === 'approver')
                                    
                                        <div class="d-flex gap-1">
                                        <form action="{{ route('pemesanan.approve', $data->id) }}" method="POST">

                                            @csrf
                                            @method('PATCH')
                                            <button  class="btn btn-sm btn-success">Setujui</button>
                                        </form>

                                        <form action="{{ route('pemesanan.reject', $data->id) }}" method="POST">

                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-danger">Tolak</button>
                                        </form>
                                        </div>
                                    @elseif(auth()->user()->role === 'admin')
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('pemesanan.edit', $data->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                            <form action="{{ route('pemesanan.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pemesanan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data pemesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    @if (Session::has('success'))
        toastr.options = { "positionClass": "toast-top-right" };
        toastr.success("{{ Session::get('success') }}");
    @endif
</script>
@endsection

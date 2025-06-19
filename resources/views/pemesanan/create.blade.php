@extends('layouts.main')

@section('title')
    <title>{{ config('app.name') }} - Tambah Pemesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('container')
<div class="container mt-4">
    <h2 class="mb-3">Tambah Pemesanan Kendaraan</h2>
    <hr>

    <form method="POST" action="{{ route('pemesanan.store') }}" class="col-lg-8">
        @csrf

        <div class="mb-3">
            <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
            <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan"
                class="form-control @error('tanggal_pemesanan') is-invalid @enderror"
                value="{{ old('tanggal_pemesanan') }}">
            @error('tanggal_pemesanan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="kendaraan_id" class="form-label">Jenis Kendaraan</label>
            <select name="kendaraan_id" id="kendaraan_id"
                class="form-select @error('kendaraan_id') is-invalid @enderror">
                <option disabled selected>-- Pilih Kendaraan --</option>
                @foreach ($kendaraans as $kendaraan)
                    <option value="{{ $kendaraan->id }}"
                        {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>
                        {{ $kendaraan->jenis }}
                    </option>
                @endforeach
            </select>
            @error('kendaraan_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status"
                class="form-select @error('status') is-invalid @enderror" readonly>
                <option value="1" selected>Diajukan</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="{{ route('pemesanan.index') }}" class="btn btn-warning">Kembali</a>
        </div>
    </form>
</div>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    @if (Session::has('success'))
        toastr.options = {
            positionClass: 'toast-top-right',
        };
        toastr.success("{{ Session::get('success') }}");
    @endif
</script>
@endsection

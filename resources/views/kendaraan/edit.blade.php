@extends('layouts.main')

@section('title')
    <title>{{ config('app.name') }} - Edit Kendaraan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('container')
<div class="container mt-4">
    <h2 class="mb-3">Edit Kendaraan</h2>
    <hr>

    <form method="POST" action="{{ route('kendaraan.update', $kendaraan->id) }}">
        @csrf
        @method('PUT')

        <div class="col-lg-8">
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis</label>
                <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" value="{{ old('jenis', $kendaraan->jenis) }}">
                @error('jenis')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tahun_pembuatan" class="form-label">Tahun Pembuatan</label>
                <input type="number" class="form-control @error('tahun_pembuatan') is-invalid @enderror" id="tahun_pembuatan" name="tahun_pembuatan" value="{{ old('tahun_pembuatan', $kendaraan->tahun_pembuatan) }}">
                @error('tahun_pembuatan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                    <option value="1" {{ $kendaraan->status == 1 ? 'selected' : '' }}>Tersedia</option>
                    <option value="0" {{ $kendaraan->status == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $kendaraan->stok) }}">
                @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('kendaraan.index') }}" class="btn btn-warning mx-2">Kembali</a>
            </div>
        </div>
    </form>
</div>

@include('partials.toastr')
@endsection

@extends('layouts.main')

@section('container')
<div class="container-fluid py-4 px-3">
    <div class="row g-4">

        <!-- Selamat Datang -->
        <div class="col-12">
            <div class="p-4 rounded-4 shadow bg-dark text-white bg-opacity-50 border border-white border-opacity-10">
                <h2 class="fw-bold mb-1">Halo, {{ auth()->user()->name }} 👋</h2>
                <p class="mb-0" style="font-size: 0.95rem;">Selamat datang di Dashboard. Semoga harimu menyenangkan!</p>
            </div>
        </div>

        <!-- Statistik -->
        <div class="col-md-6 col-xl-3">
            <div class="p-4 rounded-4 shadow-sm bg-white bg-opacity-10 text-white border border-white border-opacity-10">
                <div class="d-flex align-items-center">
                    <i class='bx bxs-car fs-1 me-3'></i>
                    <div>
                        <h5 class="mb-0 fw-bold">{{ $jumlahKendaraan }}</h5>
                        <small class="text-light">Total Kendaraan</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="p-4 rounded-4 shadow-sm bg-white bg-opacity-10 text-white border border-white border-opacity-10">
                <div class="d-flex align-items-center">
                    <i class='bx bxs-message-alt-detail fs-1 me-3'></i>
                    <div>
                        <h5 class="mb-0 fw-bold">{{ $jumlahPemesanan }}</h5>
                        <small class="text-light">Total Pemesanan</small>
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user()->role === 'admin')
        <div class="col-md-6 col-xl-3">
            <div class="p-4 rounded-4 shadow-sm bg-white bg-opacity-10 text-white border border-white border-opacity-10">
                <div class="d-flex align-items-center">
                    <i class='bx bxs-user-check fs-1 me-3'></i>
                    <div>
                        <h5 class="mb-0 fw-bold">{{ $jumlahUser }}</h5>
                        <small class="text-light">Total Pengguna</small>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-6 col-xl-3">
            <div class="p-4 rounded-4 shadow-sm bg-white bg-opacity-10 text-white border border-white border-opacity-10">
                <div class="d-flex align-items-center">
                    <i class='bx bxs-report fs-1 me-3'></i>
                    <div>
                        <h5 class="mb-0 fw-bold">{{ $jumlahAktivitas }}</h5>
                        <small class="text-light">Log Aktivitas</small>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

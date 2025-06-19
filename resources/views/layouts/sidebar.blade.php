<nav class="offcanvas-body d-md-flex flex-column p-4 overflow-y-auto"
     style="
        position: sticky;
        top: 0;
        height: 100vh;
        z-index: 1000;
        background: rgba(20, 20, 30, 0.4); /* Lebih gelap dan elegan */
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-right: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: inset -1px 0 0 rgba(255, 255, 255, 0.05);
     ">

    <ul class="nav flex-column">
        <!-- Dashboard -->
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center fw-semibold text-light" href="{{ route('admin.home') }}"
               style="font-size: 1rem;">
                <i class='bx bxs-home me-3 fs-5 text-primary'></i>
                Dashboard <span class="ms-auto p-1 fw-bold text-secondary">{{ auth()->user()->role }}</span>
            </a>
        </li>

        <!-- Pemesanan -->
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center fw-semibold text-light" href="{{ route('pemesanan.index') }}"
               style="font-size: 0.95rem;">
                <i class='bx bxs-message-alt-detail me-3 fs-5 text-warning'></i> Pemesanan
            </a>
        </li>

        <!-- Kendaraan -->
        @if(auth()->user()->role === 'admin')
            <li class="nav-item mb-3">
                <a class="nav-link d-flex align-items-center fw-semibold text-light" href="{{ route('kendaraan.index') }}"
                   style="font-size: 0.95rem;">
                    <i class='bx bxs-car me-3 fs-5 text-info'></i> Kendaraan
                </a>
            </li>
        @endif

        <!-- Grafik -->
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center fw-semibold text-light" href="{{ route('admin.grafik') }}"
               style="font-size: 0.95rem;">
                <i class='bx bx-line-chart me-3 fs-5 text-success'></i> Grafik Kendaraan
            </a>
        </li>

        <!-- Aktivitas -->
        <li class="nav-item mb-4">
            <a class="nav-link d-flex align-items-center fw-semibold text-light" href="{{ route('admin.aktivitas') }}"
               style="font-size: 0.95rem;">
                <i class='bx bxs-report me-3 fs-5 text-danger'></i> Aktivitas
            </a>
            <hr class="my-3" style="border-color: rgba(255, 255, 255, 0.1);">
        </li>

        <!-- Logout -->
        <li class="nav-item">
            <form action="/logout" method="post">
                @csrf
                <button type="submit"
                        class="nav-link d-flex align-items-center btn btn-link p-0 text-danger fw-semibold"
                        style="text-decoration: none; font-size: 0.95rem;">
                    <i class='bx bx-log-out me-3 fs-5'></i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>

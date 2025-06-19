<header class="navbar sticky-top p-2 shadow-sm"
        style="background: rgba(31, 41, 55, 0.6); backdrop-filter: blur(12px); z-index: 1050;"
        data-bs-theme="dark">
  <div class="container-fluid d-flex justify-content-between align-items-center px-3 py-2 position-relative overflow-hidden">

    <!-- Tombol sidebar untuk mobile -->
    <div class="d-md-none">
      <button class="btn text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
        <i class='bx bx-menu fs-4'></i>
      </button>
    </div>

    <!-- Judul Tengah Bergerak -->
    <div class="position-absolute start-0 end-0 mx-auto text-center d-none d-md-block"
         style="white-space: nowrap; overflow: hidden; max-width: 100%;">
      <div id="animatedText" class="fw-bold"
           style="font-size: 1.6rem; letter-spacing: 1px; color: white; transition: opacity 0.6s;">
      </div>
    </div>

    <!-- Tombol Search untuk Mobile -->
    <div class="d-md-none">
      <button class="btn text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch">
        <i class='bx bx-search fs-4'></i>
      </button>
    </div>

    <!-- Info User (Desktop Only) -->
    <div class="d-none d-md-flex align-items-center text-white gap-2">
      <i class='bx bxs-user-circle fs-4 text-white'></i>
      <div class="d-flex flex-column">
        <span style="font-size: 0.95rem;">{{ auth()->user()->name }}</span>
        <small class="text-secondary" style="font-size: 0.75rem;">{{ ucfirst(auth()->user()->role) }}</small>
      </div>
    </div>

  </div>
</header>

<style>
  #animatedText {
    opacity: 1;
    transition: opacity 0.8s ease-in-out;
  }

  .fade-out {
    opacity: 0;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const role = "{{ auth()->user()->role }}";
    const textArray = [
      "Selamat Datang 👋",
      role === "admin" ? "Halo Admin 🔧" : "Halo Approval 📋",
      "Semoga harimu menyenangkan 😊"
    ];

    let index = 0;
    const animatedText = document.getElementById("animatedText");

    function showNextText() {
      animatedText.classList.add("fade-out");

      setTimeout(() => {
        animatedText.textContent = textArray[index];
        animatedText.classList.remove("fade-out");
        index = (index + 1) % textArray.length;
      }, 800); // waktu fade-out
    }

    // Inisialisasi animasi
    showNextText();
    setInterval(showNextText, 2500); // interval antar teks
  });
</script>

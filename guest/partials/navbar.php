<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 d-flex justify-content-between align-items-center">
    <a href="index.php" class="navbar-brand d-flex align-items-center border-end px-3">
        <img src="../assets/img/bkl.png" alt="Logo" style="height: 60px;">
        <h2 class="m-0 text-primary ms-3">Desa Alas Kokon</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.php" class="nav-item nav-link <?= ($page == 'beranda') ? 'active' : '' ?>">Beranda</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?= ($page == 'profil') ? 'active' : '' ?>" data-bs-toggle="dropdown">Profil</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="profilumum.php" class="dropdown-item">Profil Umum</a>
                    <a href="visimisi.php" class="dropdown-item">Visi & Misi</a>
                    <a href="strukturdesa.php" class="dropdown-item">Struktur Perangkat Desa</a>
                    <a href="peta.php" class="dropdown-item">Peta Desa</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?= ($page == 'kabar') ? 'active' : '' ?>" data-bs-toggle="dropdown">Kabar Desa</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="berita.php" class="dropdown-item">Berita Desa</a>
                    <a href="agenda.php" class="dropdown-item">Agenda</a>
                    <a href="galeri.php" class="dropdown-item">Galeri</a>
                </div>
            </div>


            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?= ($page == 'informasi') ? 'active' : '' ?>" data-bs-toggle="dropdown">Informasi</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="laporan.php" class="dropdown-item">Laporan</a>
                    <a href="produkhukum.php" class="dropdown-item">Produk Hukum</a>
                    <a href="apbd.php" class="dropdown-item">APBDes</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?= ($page == 'potensi') ? 'active' : '' ?>" data-bs-toggle="dropdown">Potensi Desa</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="lembaga.php" class="dropdown-item">Lembaga</a>
                    <a href="umkm.php" class="dropdown-item">UMKM</a>
                </div>
            </div>

            <a href="statistik.php" class="nav-item nav-link <?= ($page == 'statistik') ? 'active' : '' ?>">Statistik Desa</a>
            <a href="#" class="nav-item nav-link <?= ($page == 'ai') ? 'active' : '' ?>">Tanya AI</a>

            <!-- Desktop -->
            <a href="../warga/login.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
                Layanan Mandiri<i class="fa fa-arrow-right ms-3"></i>
            </a>

            <!-- Mobile -->
            <a href="../warga/login.php" class="btn btn-success d-block d-lg-none w-100 rounded-3 py-4">
                Layanan Mandiri <i class="fa fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</nav>
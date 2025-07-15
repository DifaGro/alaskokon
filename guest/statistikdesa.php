<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sistem Informasi Website Desa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../assets/img/logo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #ffffff;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .sidebar h5 {
            margin-top: 1rem;
        }

        .sidebar a {
            display: block;
            padding: 0.35rem 0;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover {
            text-decoration: none;
        }

        .content-box {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .rotate-icon i {
            transition: transform 0.3s ease;
        }

        .rotate-icon.rotate i {
            transform: rotate(90deg);
        }

        .active {
            font-weight: bold;
            color: #0d6efd;
        }

        .statistik-section {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            display: none;
        }

        .statistik-section.show {
            opacity: 1;
            transform: translateY(0);
            display: block;
        }

        @media (max-width: 991.98px) {
            #sidebarMenu {
                position: fixed;
                top: 0;
                left: -100%;
                width: 250px;
                height: 100%;
                background: white;
                z-index: 1050;
                overflow-y: auto;
                transition: left 0.3s ease-in-out;
                padding: 1rem;
                box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
            }

            #sidebarMenu.active {
                left: 0;
            }

            #sidebarBackdrop {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background-color: rgba(0, 0, 0, 0.4);
                z-index: 1040;
            }

            #sidebarBackdrop.show {
                display: block;
            }
        }

        @media (min-width: 992px) {
            #sidebarMenu {
                position: static !important;
                left: 0 !important;
                height: auto;
                box-shadow: none;
                padding: 0;
                background: none;
            }

            #sidebarBackdrop {
                display: none !important;
            }

            .sidebar {
                padding: 1rem;
                background-color: #fff;
                border-radius: 0.5rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }
        }

        .chart-container {
            height: 600px;
            width: 100%;
            max-width: 80%;
            margin: 0 auto;
            position: relative;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <?php include 'partials/topbar.php'; ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php $page = 'statistik'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-3">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Statistik Desa</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Statistik Desa</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Content -->
    <div id="sidebarBackdrop"></div>
    <div class="container-fluid mt-3">
        <!-- Tombol toggle sidebar untuk mobile -->
        <div class="d-block d-lg-none mb-3">
            <button id="toggleSidebar" class="btn btn-outline-primary w-100">
                <i class="fas fa-bars me-2"></i> Menu Statistik
            </button>
        </div>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div id="sidebarMenu" class="bg-white border rounded shadow-sm p-3 mb-4">
                    <h4>Statistik</h4>

                    <!-- Kependudukan -->
                    <h5 class="text-primary d-flex justify-content-between align-items-center mt-4"
                        data-bs-toggle="collapse" data-bs-target="#group-kependudukan" style="cursor: pointer;">
                        Kependudukan
                        <span class="rotate-icon"><i class="fas fa-chevron-right"></i></span>
                    </h5>
                    <div class="collapse" id="group-kependudukan">
                        <a href="#umur" class="statistik-link d-block mb-2" data-target="umur">Umur</a>
                        <a href="#jenis-kelamin" class="statistik-link d-block mb-2" data-target="jenis-kelamin">Jenis Kelamin</a>
                        <a href="#status-penduduk" class="statistik-link d-block mb-2" data-target="status-penduduk">Status Penduduk</a>
                        <a href="#status-kawin" class="statistik-link d-block mb-2" data-target="status-kawin">Status Kawin</a>
                        <a href="#agama" class="statistik-link d-block mb-2" data-target="agama">Agama</a>
                    </div>

                    <!-- Pendidikan -->
                    <h5 class="text-primary d-flex justify-content-between align-items-center mt-4"
                        data-bs-toggle="collapse" data-bs-target="#group-pendidikan" style="cursor: pointer;">
                        Pendidikan
                        <span class="rotate-icon"><i class="fas fa-chevron-right"></i></span>
                    </h5>
                    <div class="collapse" id="group-pendidikan">
                        <a href="#pendidikan" class="statistik-link d-block mb-2" data-target="pendidikan">Pendidikan Terakhir</a>
                        <a href="#fasilitas-pendidikan" class="statistik-link d-block mb-2" data-target="fasilitas-pendidikan">Fasilitas Pendidikan</a>
                    </div>

                    <!-- Kesehatan -->
                    <h5 class="text-primary d-flex justify-content-between align-items-center mt-4"
                        data-bs-toggle="collapse" data-bs-target="#group-kesehatan" style="cursor: pointer;">
                        Kesehatan
                        <span class="rotate-icon"><i class="fas fa-chevron-right"></i></span>
                    </h5>
                    <div class="collapse" id="group-kesehatan">
                        <a href="#disabilitas" class="statistik-link d-block mb-2" data-target="disabilitas">Disabilitas</a>
                        <a href="#fasilitas-kesehatan" class="statistik-link d-block mb-2" data-target="fasilitas-kesehatan">Fasilitas Kesehatan</a>
                    </div>

                    <!-- Ekonomi -->
                    <h5 class="text-primary d-flex justify-content-between align-items-center mt-4"
                        data-bs-toggle="collapse" data-bs-target="#group-ekonomi" style="cursor: pointer;">
                        Ekonomi
                        <span class="rotate-icon"><i class="fas fa-chevron-right"></i></span>
                    </h5>
                    <div class="collapse" id="group-ekonomi">
                        <a href="#pekerjaan" class="statistik-link d-block mb-2" data-target="pekerjaan">Pekerjaan</a>
                        <a href="#umkm" class="statistik-link d-block mb-2" data-target="umkm">UMKM</a>
                    </div>

                    <!-- Wilayah & Lainnya -->
                    <h5 class="text-primary d-flex justify-content-between align-items-center mt-4"
                        data-bs-toggle="collapse" data-bs-target="#group-wilayah" style="cursor: pointer;">
                        Wilayah & Lainnya
                        <span class="rotate-icon"><i class="fas fa-chevron-right"></i></span>
                    </h5>
                    <div class="collapse" id="group-wilayah">
                        <a href="#wilayah" class="statistik-link d-block mb-2" data-target="wilayah">Wilayah Dusun</a>
                        <a href="#rumah" class="statistik-link d-block mb-2" data-target="rumah">Kepemilikan Rumah</a>
                        <a href="#tempat-ibadah" class="statistik-link d-block mb-2" data-target="tempat-ibadah">Tempat Ibadah</a>
                    </div>
                </div>

            </div>

            <!-- Konten Statistik -->
            <div class="col-lg-9">
                <!-- Umur -->
                <div id="umur" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section">
                    <h4 class="text-primary mb-3">Umur</h4>
                    <select class="form-select mb-3" data-chart="umur">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-umur"></canvas>
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div id="jenis-kelamin" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Jenis Kelamin</h4>
                    <select class="form-select mb-3" data-chart="jenis-kelamin">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-jenis-kelamin"></canvas>
                    </div>
                </div>

                <!-- Status Penduduk -->
                <div id="status-penduduk" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Status Penduduk</h4>
                    <select class="form-select mb-3" data-chart="status-penduduk">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-status-penduduk"></canvas>
                    </div>
                </div>

                <!-- Status Kawin -->
                <div id="status-kawin" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Status Kawin</h4>
                    <select class="form-select mb-3" data-chart="status-kawin">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-status-kawin"></canvas>
                    </div>
                </div>

                <!-- Agama -->
                <div id="agama" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Agama</h4>
                    <select class="form-select mb-3" data-chart="agama">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-agama"></canvas>
                    </div>
                </div>

                <!-- Pendidikan Terakhir -->
                <div id="pendidikan" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Pendidikan Terakhir</h4>
                    <select class="form-select mb-3" data-chart="pendidikan">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-pendidikan"></canvas>
                    </div>
                </div>

                <!-- Fasilitas Pendidikan -->
                <div id="fasilitas-pendidikan" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Fasilitas Pendidikan</h4>
                    <select class="form-select mb-3" data-chart="fasilitas-pendidikan">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-fasilitas-pendidikan"></canvas>
                    </div>
                </div>

                <!-- Disabilitas -->
                <div id="disabilitas" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Disabilitas</h4>
                    <select class="form-select mb-3" data-chart="disabilitas">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-disabilitas"></canvas>
                    </div>
                </div>

                <!-- Fasilitas Kesehatan -->
                <div id="fasilitas-kesehatan" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Fasilitas Kesehatan</h4>
                    <select class="form-select mb-3" data-chart="fasilitas-kesehatan">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-fasilitas-kesehatan"></canvas>
                    </div>
                </div>

                <!-- Pekerjaan -->
                <div id="pekerjaan" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Pekerjaan</h4>
                    <select class="form-select mb-3" data-chart="pekerjaan">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-pekerjaan"></canvas>
                    </div>
                </div>

                <!-- UMKM -->
                <div id="umkm" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">UMKM</h4>
                    <select class="form-select mb-3" data-chart="umkm">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-umkm"></canvas>
                    </div>
                </div>

                <!-- Wilayah Dusun -->
                <div id="wilayah" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Wilayah Dusun</h4>
                    <select class="form-select mb-3" data-chart="wilayah">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-wilayah"></canvas>
                    </div>
                </div>

                <!-- Kepemilikan Rumah -->
                <div id="rumah" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Kepemilikan Rumah</h4>
                    <select class="form-select mb-3" data-chart="rumah">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-rumah"></canvas>
                    </div>
                </div>

                <!-- Tempat Ibadah -->
                <div id="tempat-ibadah" class="bg-white border rounded shadow-sm p-4 mb-4 statistik-section" style="display: none;">
                    <h4 class="text-primary mb-3">Tempat Ibadah</h4>
                    <select class="form-select mb-3" data-chart="tempat-ibadah">
                        <option value="bar">Diagram Batang</option>
                        <option value="pie">Diagram Lingkaran</option>
                        <option value="map">Peta Persebaran</option>
                    </select>
                    <div class="chart-container">
                        <canvas id="chart-tempat-ibadah"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer Start -->
    <?php include 'partials/footer.php'; ?>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/counterup/counterup.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../assets/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/statistik-chart.js"></script>

    <!-- Sidebar Scroll Interaction -->
    <script>
        // Tunggu sampai semua elemen DOM siap
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen section statistik
            const sections = document.querySelectorAll('.statistik-section');

            // Ambil semua link navigasi di sidebar
            const links = document.querySelectorAll('.statistik-link');

            // Tombol toggle sidebar (untuk mobile)
            const toggleBtn = document.getElementById('toggleSidebar');

            // Sidebar element
            const sidebar = document.getElementById('sidebarMenu');

            // Backdrop untuk klik di luar sidebar (mobile)
            const backdrop = document.getElementById('sidebarBackdrop');

            // --- BAGIAN 1 ---
            // Sembunyikan semua konten section statistik
            sections.forEach(section => {
                section.classList.remove('show'); // Hapus class animasi show
                section.style.display = 'none'; // Sembunyikan
            });

            // Tampilkan section pertama secara default
            if (sections.length > 0) {
                sections[0].style.display = 'block'; // Tampilkan section pertama
                setTimeout(() => sections[0].classList.add('show'), 10);
                // Tambah class show dengan delay agar animasi muncul
            }

            // --- BAGIAN 2 ---
            // Tambahkan event listener untuk setiap link sidebar
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault(); // Hentikan link default

                    const targetId = this.getAttribute('data-target');
                    // Ambil ID target section

                    // Sembunyikan semua section
                    sections.forEach(section => {
                        section.classList.remove('show');
                        section.style.display = 'none';
                    });

                    // Tampilkan section yang diklik
                    const targetSection = document.getElementById(targetId);
                    targetSection.style.display = 'block';
                    setTimeout(() => targetSection.classList.add('show'), 10);

                    // Hapus class aktif dari semua link, lalu aktifkan link ini
                    links.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');

                    // Tutup sidebar dan backdrop jika di mobile
                    sidebar.classList.remove('active');
                    backdrop.classList.remove('show');
                });
            });

            // --- BAGIAN 3 ---
            // Tombol toggle sidebar di mobile
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.add('active'); // Tampilkan sidebar
                backdrop.classList.add('show'); // Tampilkan backdrop
            });

            // Klik backdrop untuk menutup sidebar
            backdrop.addEventListener('click', () => {
                sidebar.classList.remove('active'); // Sembunyikan sidebar
                backdrop.classList.remove('show'); // Sembunyikan backdrop
            });

            // --- BAGIAN 4 ---
            // Untuk handle animasi icon panah collapse (Bootstrap Collapse)
            const headers = document.querySelectorAll('[data-bs-toggle="collapse"]');
            headers.forEach(header => {
                const icon = header.querySelector('.rotate-icon');
                if (!icon) return; // Skip jika tidak ada icon

                const targetId = header.getAttribute('data-bs-target');
                const collapseEl = document.querySelector(targetId);

                // Tambahkan class rotate saat group dibuka
                collapseEl.addEventListener('show.bs.collapse', () => {
                    icon.classList.add('rotate');
                });

                // Hapus class rotate saat group ditutup
                collapseEl.addEventListener('hide.bs.collapse', () => {
                    icon.classList.remove('rotate');
                });
            });
        });
    </script>

</body>

</html>
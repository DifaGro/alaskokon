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
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 1rem;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .service-icon-box {
            border-radius: 1rem;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
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
    <div class="container-fluid page-header py-5 mb-5">
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

    <!-- Jumlah Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center mb-4">
                        <div class="btn-lg-square bg-primary rounded-circle me-3">
                            <i class="fa fa-users text-white"></i>
                        </div>
                        <h1 class="mb-0" data-toggle="counter-up">3453</h1>
                    </div>
                    <h5 class="mb-3">Jumlah Penduduk</h5>
                    <span>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit</span>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center mb-4">
                        <div class="btn-lg-square bg-primary rounded-circle me-3">
                            <i class="fa fa-industry text-white"></i>
                        </div>
                        <h1 class="mb-0" data-toggle="counter-up">205</h1>
                    </div>
                    <h5 class="mb-3">Jumlah UMKM</h5>
                    <span>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit</span>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center mb-4">
                        <div class="btn-lg-square bg-primary rounded-circle me-3">
                            <i class="fa fa-school text-white"></i>
                        </div>
                        <h1 class="mb-0" data-toggle="counter-up">5</h1>
                    </div>
                    <h5 class="mb-3">Jumlah Sarana Pendidikan</h5>
                    <span>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit</span>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <div class="d-flex align-items-center mb-4">
                        <div class="btn-lg-square bg-primary rounded-circle me-3">
                            <i class="fa fa-praying-hands text-white"></i>
                        </div>
                        <h1 class="mb-0" data-toggle="counter-up">3</h1>
                    </div>
                    <h5 class="mb-3">Jumlah Tempat Ibadah</h5>
                    <span>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumlah End -->

    <!-- Daftar Kriteria Start -->
    <div class="d-flex flex-wrap justify-content-start gap-4" style="max-width: 1540px; margin: auto;">
        <!-- Umur -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #e3f2fd;">
                    <i class="fas fa-birthday-cake fa-2x text-primary"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Umur</h5>
                <p class="text-muted mb-0">Distribusi penduduk menurut kelompok usia</p>
            </div>
        </div>

        <!-- Jenis Kelamin -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #f3e5f5;">
                    <i class="fas fa-venus-mars fa-2x text-danger"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Jenis Kelamin</h5>
                <p class="text-muted mb-0">Jumlah penduduk laki-laki & perempuan</p>
            </div>
        </div>

        <!-- Pendidikan Terakhir -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #e8f5e9;">
                    <i class="fas fa-user-graduate fa-2x text-success"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Pendidikan</h5>
                <p class="text-muted mb-0">Tingkat pendidikan terakhir warga</p>
            </div>
        </div>

        <!-- Status Kawin -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #fff3e0;">
                    <i class="fas fa-ring fa-2x text-warning"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Status Kawin</h5>
                <p class="text-muted mb-0">Kawin, belum kawin, cerai hidup/mati</p>
            </div>
        </div>

        <!-- Pekerjaan -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #e1f5fe;">
                    <i class="fas fa-briefcase fa-2x text-info"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Pekerjaan</h5>
                <p class="text-muted mb-0">Petani, pedagang, PNS, buruh, dll</p>
            </div>
        </div>

        <!-- Agama -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #ede7f6;">
                    <i class="fas fa-praying-hands fa-2x text-secondary"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Agama</h5>
                <p class="text-muted mb-0">Komposisi kepercayaan penduduk</p>
            </div>
        </div>

        <!-- Status Penduduk -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #fbe9e7;">
                    <i class="fas fa-id-badge fa-2x text-danger"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Status Penduduk</h5>
                <p class="text-muted mb-0">Aktif, pindah, atau meninggal</p>
            </div>
        </div>

        <!-- Wilayah Dusun -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #f1f8e9;">
                    <i class="fas fa-map-marked-alt fa-2x text-success"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Wilayah Dusun</h5>
                <p class="text-muted mb-0">Distribusi penduduk per dusun</p>
            </div>
        </div>

        <!-- Kepemilikan Rumah -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #ede7f6;">
                    <i class="fas fa-home fa-2x text-primary"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Kepemilikan Rumah</h5>
                <p class="text-muted mb-0">Status kepemilikan tempat tinggal</p>
            </div>
        </div>

        <!-- Kewarganegaraan -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #fce4ec;">
                    <i class="fas fa-flag fa-2x text-danger"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Kewarganegaraan</h5>
                <p class="text-muted mb-0">WNI dan WNA</p>
            </div>
        </div>

        <!-- Disabilitas -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #fff8e1;">
                    <i class="fas fa-wheelchair fa-2x text-warning"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Disabilitas</h5>
                <p class="text-muted mb-0">Jumlah penduduk penyandang disabilitas</p>
            </div>
        </div>

        <!-- Golongan Darah -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #fce4ec;">
                    <i class="fas fa-tint fa-2x text-danger"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Golongan Darah</h5>
                <p class="text-muted mb-0">Statistik golongan darah A, B, AB, O</p>
            </div>
        </div>

        <!-- UMKM -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #fff3e0;">
                    <i class="fas fa-store fa-2x text-warning"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">UMKM</h5>
                <p class="text-muted mb-0">Jumlah usaha mikro & kecil di desa</p>
            </div>
        </div>

        <!-- Tempat Ibadah -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #ede7f6;">
                    <i class="fas fa-mosque fa-2x text-secondary"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Tempat Ibadah</h5>
                <p class="text-muted mb-0">Jumlah masjid, musholla, dan lainnya</p>
            </div>
        </div>

        <!-- Fasilitas Pendidikan -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #f3e5f5;">
                    <i class="fas fa-school fa-2x text-primary"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Fasilitas Pendidikan</h5>
                <p class="text-muted mb-0">Jumlah TK, SD, SMP, dan seterusnya</p>
            </div>
        </div>

        <!-- Fasilitas Kesehatan -->
        <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
            <div class="me-4">
                <div class="service-icon-box" style="background-color: #e8f5e9;">
                    <i class="fas fa-clinic-medical fa-2x text-success"></i>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mb-1 m-0 text-dark">Fasilitas Kesehatan</h5>
                <p class="text-muted mb-0">Puskesmas, polindes, posyandu, dll</p>
            </div>
        </div>


        <!-- Tombol Lihat Statistik Lengkap -->
        <div class="container-fluid px-0 mt-5">
            <div class="row gx-0">
                <div class="col-12">
                    <a href="statistikdesa.php"
                        class="btn btn-primary w-100 py-3 px-4 fw-semibold d-flex align-items-center justify-content-center shadow-lg"
                        style="border-radius: 50px; font-size: 1.25rem; transition: all 0.3s ease;">
                        <i class="fas fa-chart-bar me-3"></i> Lihat Statistik Lengkap
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Daftar Kriteria End -->


    <!-- Footer Start -->
    <?php include 'partials/footer.php'; ?>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/counterup/counterup.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../assets/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>
</body>

</html>
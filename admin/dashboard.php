<?php
session_start();
include '../connect.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id_petugas'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: index.php");
    exit;
}

// Ambil pesan sukses kalau ada
$success = '';
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']); 
}

$id_petugas = $_SESSION['id_petugas'];

$query = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = '$id_petugas'");
$data_petugas = mysqli_fetch_assoc($query);

$jmlpenduduk = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS jml FROM warga")
);

$jmlkeluarga = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(DISTINCT kk) AS jml FROM warga WHERE kk IS NOT NULL AND kk != ''")
);

$jmllembaga = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS jml FROM lembaga_desa WHERE status = 'Aktif'")
);

$jmlpengunjung = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT SUM(jumlah) AS jml FROM statistik_pengunjung")
);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sistem Informasi Website Desa || Admin</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <!-- Favicon -->
    <link href="../assets/img/logo.png" rel="icon">

    <!-- Fonts and icons -->
    <script src="../assets/admin/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["../assets/admin/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/admin/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/admin/css/kaiadmin.min.css" />

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="../dashboard.php" class="logo">
                        <img src="../assets/admin/img/logo.png" alt="navbar brand" class="navbar-brand" height="150" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->

            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">

                        <li class="nav-item">
                            <a href="dashboard.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="profildesa/datadesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-info-circle"></i>
                                <p>Data Profil Desa / Website</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="perangkatdesa/perangkatdesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-users-cog"></i>
                                <p>Perangkat Desa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="beritadesa/beritadesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita Desa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="agendadesa/agendadesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-calendar-alt"></i>
                                <p>Agenda Desa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="dokumendesa/dokumendesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-file-alt"></i>
                                <p>Dokumen Desa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="lembagadesa/lembagadesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-university"></i>
                                <p>Lembaga</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="umkmdesa/umkmdesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-store"></i>
                                <p>UMKM</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="statistikdesa/statistikdesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-chart-bar"></i>
                                <p>Statistik Desa</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="../dashboard.php" class="logo">
                            <img src="../assets/admin/img/logo.png" alt="navbar brand" class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">

                        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div>
                                <h1>Selamat Datang, <b class="text-primary"><?php echo $data_petugas['level'] ?>!</b></h1>
                            </div>
                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="../assets/admin/img/profil.png" alt="Profil" class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold"><?php echo $data_petugas['level'] ?></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="../assets/admin/img/profil.png" alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4><?php echo $data_petugas['level'] ?></h4>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="logout.php">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <!-- Content -->
            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body alert alert-success text-center">
                                    <div>
                                        <h3 class="fw-bold mb-2">
                                            <i class="fas fa-user-shield text-primary me-2"></i>Selamat Datang, Admin!
                                        </h3>
                                        <p class="mb-1">
                                            Anda telah login sebagai administrator Sistem Informasi Website Desa.
                                        </p>
                                        <p class="mb-0">
                                            Sebagai admin, Anda bertanggung jawab untuk mengelola data profil desa, penduduk, kelembagaan, perangkat desa, serta memastikan informasi yang disajikan selalu akurat dan dapat diakses oleh masyarakat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- Jumlah Penduduk -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Jumlah Penduduk</p>
                                                <h4 class="card-title"><?php echo $jmlpenduduk['jml'] ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Keluarga -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fas fa-home"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Jumlah Keluarga</p>
                                                <h4 class="card-title"><?php echo $jmlkeluarga['jml'] ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Lembaga -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                                <i class="fas fa-university"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Jumlah Lembaga</p>
                                                <h4 class="card-title"><?php echo $jmllembaga['jml'] ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Pengunjung Website -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Jumlah Pengunjung Website</p>
                                                <h4 class="card-title"><?php echo $jmlpengunjung['jml'] ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
            <!-- End Content -->

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <div>
                        Sistem Informasi Website Desa || BPS Kabupaten Bangkalan @ <?php echo date("Y"); ?>
                    </div>
                </div>
            </footer>
            <!-- End Footer -->
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="../assets/admin/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/admin/js/core/popper.min.js"></script>
    <script src="../assets/admin/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/admin/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/admin/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../assets/admin/js/kaiadmin.min.js"></script>

    <script>
        <?php if (!empty($success)) : ?>
            $(document).ready(function() {
                swal({
                    title: 'Berhasil!',
                    text: '<?= htmlspecialchars($success) ?>',
                    icon: 'success',
                    button: 'OK'
                });
            });
        <?php endif; ?>
    </script>

</body>

</html>
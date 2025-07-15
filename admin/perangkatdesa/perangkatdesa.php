<?php
session_start();
include "../../connect.php";

// Cek login
if (!isset($_SESSION['id_petugas'])) {
    header("Location: index.php");
    exit;
}

$id_petugas = $_SESSION['id_petugas'];
$query = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = '$id_petugas'");
$data_petugas = mysqli_fetch_assoc($query);

$id_desa = 1;

$query = "
    SELECT sd.jabatan, w.nama_warga, sd.level
    FROM struktur_desa sd
    JOIN warga w ON sd.id_warga = w.id_warga
    WHERE sd.id_desa = $id_desa
    ORDER BY sd.level ASC, sd.id_struktur_desa ASC
";

$result = mysqli_query($conn, $query);

$perangkat = [];
while ($row = mysqli_fetch_assoc($result)) {
    $perangkat[$row['level']][] = $row;
}

// Ambil data sekali
$datadesa = mysqli_query($conn, "SELECT * FROM desa WHERE id_desa = $id_desa");
$desa = mysqli_fetch_assoc($datadesa);

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sistem Informasi Website Desa || Admin</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <!-- Favicon -->
    <link href="../../assets/img/logo.png" rel="icon">

    <!-- Fonts and icons -->
    <script src="../../assets/admin/js/plugin/webfont/webfont.min.js"></script>

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
                urls: ["../../assets/admin/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../assets/admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/admin/css/plugins.min.css" />
    <link rel="stylesheet" href="../../assets/admin/css/kaiadmin.min.css" />

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="../dashboard.php" class="logo">
                        <img src="../../assets/admin/img/logo.png" alt="navbar brand" class="navbar-brand" height="150" />
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
                            <a href="../dashboard.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../profildesa/datadesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-info-circle"></i>
                                <p>Data Profil Desa / Website</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../perangkatdesa/perangkatdesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-users-cog"></i>
                                <p>Perangkat Desa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../beritadesa/beritadesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita Desa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../agendadesa/agendadesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-calendar-alt"></i>
                                <p>Agenda Desa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../dokumendesa/dokumendesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-file-alt"></i>
                                <p>Dokumen Desa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../lembagadesa/lembagadesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-university"></i>
                                <p>Lembaga</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../umkmdesa/umkmdesa.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-store"></i>
                                <p>UMKM</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../statistikdesa/statistikdesa.php" class="collapsed" aria-expanded="false">
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
                            <img src="../../assets/admin/img/logo.png" alt="navbar brand" class="navbar-brand" height="20" />
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
                                        <img src="../../assets/admin/img/profil.png" alt="Profil" class="avatar-img rounded-circle" />
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
                                                    <img src="../../assets/admin/img/profil.png" alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4><?php echo $data_petugas['level'] ?></h4>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="../logout.php">Logout</a>
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

                    <!-- Struktur Aparat Desa -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="mb-5 p-4 bg-light rounded shadow-sm border">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-dark mb-0">
                                        <i class="fas fa-sitemap text-success me-2"></i>Struktur Organisasi Pemerintahan Desa
                                    </h5>
                                    <a href="editstruktur.php?id_desa=<?= $desa['id_desa'] ?>" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <p class="mb-4">Struktur organisasi desa dengan relasi antar jabatan.</p>

                                <div class="text-center mb-4">
                                    <img src="../../assets/img/struktur-desa/<?= htmlspecialchars($desa['foto_struktur']) ?>" alt="Struktur Aparat Desa" class="img-fluid rounded shadow-sm">
                                </div>

                                <h6 class="fw-bold mb-3 text-primary">Perangkat Desa</h6>
                                <?php foreach ($perangkat as $level => $jabatans) : ?>
                                    <div class="row mb-3">
                                        <?php
                                        $count = count($jabatans);
                                        $col = 12;
                                        if ($count == 1) {
                                            $col = 12;
                                        } elseif ($count == 2) {
                                            $col = 6;
                                        } elseif ($count == 3) {
                                            $col = 4;
                                        } elseif ($count == 4) {
                                            $col = 3;
                                        } else {
                                            $col = 3;
                                        }
                                        ?>
                                        <?php foreach ($jabatans as $jabatan) : ?>
                                            <div class="col-md-<?= $col ?>">
                                                <div class="p-3 border rounded bg-white shadow-sm text-center">
                                                    <strong class="text-primary"><?= htmlspecialchars($jabatan['jabatan']) ?></strong><br>
                                                    <?= htmlspecialchars($jabatan['nama_warga']) ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
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
    <script src="../../assets/admin/js/core/jquery-3.7.1.min.js"></script>
    <script src="../../assets/admin/js/core/popper.min.js"></script>
    <script src="../../assets/admin/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../../assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="../../assets/admin/js/plugin/datatables/datatables.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="../../assets/admin/js/kaiadmin.min.js"></script>
    <!-- Sweet Alert -->
    <script src="../../assets/admin/js/plugin/sweetalert/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#data').DataTable();
            $('#datanum').DataTable();
        });

        function confirmDelete(id) {
            // Gunakan SweetAlert untuk konfirmasi penghapusan
            swal({
                title: "Apakah Anda yakin?",
                icon: "warning",
                buttons: ["Batal", "Hapus"],
                dangerMode: true,
                content: {
                    element: "p",
                    attributes: {
                        innerHTML: "Data jamu ini akan dihapus permanen!",
                        style: "text-align: center;"
                    },
                },
            }).then((willDelete) => {
                if (willDelete) {
                    // Jika user memilih untuk menghapus
                    window.location.href = 'hapusjamu.php?id_jamu=' + id;
                }
            });
        }

        <?php if (isset($_SESSION['success'])): ?>
            swal({
                title: 'Sukses!',
                text: '<?php echo $_SESSION['success']; ?>',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['success']); // Menghapus pesan sukses setelah ditampilkan 
            ?>
        <?php elseif (isset($_SESSION['error'])): ?>
            swal({
                title: 'Error!',
                text: '<?php echo $_SESSION['error']; ?>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['error']); // Menghapus pesan error setelah ditampilkan 
            ?>
        <?php endif; ?>

        <?php if (isset($_GET['status'])) : ?>
            <?php if ($_GET['status'] == 'cancel') : ?>
                swal({
                    icon: 'error',
                    title: 'Canceled!',
                    text: 'Batal menambahkan Data jamu!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    history.replaceState(null, '', window.location.pathname);
                });
            <?php elseif ($_GET['status'] == 'canceled') : ?>
                swal({
                    icon: 'error',
                    title: 'Canceled!',
                    text: 'Batal mengubah Data Jamu!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    history.replaceState(null, '', window.location.pathname);
                });
            <?php elseif ($_GET['status'] == 'success') : ?>
                swal({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Berhasil menambahkan Data jamu!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    history.replaceState(null, '', window.location.pathname);
                });
            <?php elseif ($_GET['status'] == 'updated') : ?>
                swal({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Berhasil mengubah Data jamu!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    history.replaceState(null, '', window.location.pathname);
                });
            <?php else : ?>
                swal({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal menambahkan Data jamu!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    history.replaceState(null, '', window.location.pathname);
                });
            <?php endif; ?>
        <?php endif; ?>

        function alertJenisKosong() {
            swal({
                icon: 'warning',
                title: 'Tidak Bisa Menambahkan Data Jamu!',
                text: 'Belum ada data jenis jamu. Silakan tambahkan jenis jamu terlebih dahulu.',
                buttons: {
                    confirm: {
                        text: 'Tambah Jenis Jamu',
                        value: true,
                        visible: true,
                        className: 'btn btn-primary'
                    }
                }
            }).then((value) => {
                if (value) {
                    window.location.href = '../jenisjamu/jenis.php';
                }
            });
        }
    </script>
</body>

</html>
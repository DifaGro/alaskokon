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

$datadesa = mysqli_query($conn, "SELECT * FROM desa WHERE id_desa = $id_desa");
$desa = mysqli_fetch_assoc($datadesa);

// Ambil data UMKM + Jenis UMKM
$dataUMKM = mysqli_query($conn, "
  SELECT umkm.*, jenis_umkm.nama_jenis 
  FROM umkm 
  JOIN jenis_umkm ON umkm.id_jenis_umkm = jenis_umkm.id_jenis_umkm 
  WHERE umkm.id_desa = $id_desa
");

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
                    <!-- Tabel UMKM -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Data UMKM</h4>
                                    <a href="tambahumkm.php" class="btn btn-info btn-sm">
                                        <i class="fa fa-plus"></i> Tambah UMKM
                                    </a>
                                </div>
                                <div class="card-body">
                                    <?php if (mysqli_num_rows($dataUMKM) > 0): ?>
                                        <div class="table-responsive">
                                            <table id="dataUMKM" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nama UMKM</th>
                                                        <th>Jenis</th>
                                                        <th>Alamat</th>
                                                        <th>No HP</th>
                                                        <th>Instagram</th>
                                                        <th>Tiktok</th>
                                                        <th>Website</th>
                                                        <th style="text-align: right;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = mysqli_fetch_assoc($dataUMKM)) { ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['nama_umkm']) ?></td>
                                                            <td><?= htmlspecialchars($row['nama_jenis']) ?></td>
                                                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                                                            <td><?= htmlspecialchars($row['no_hp']) ?></td>
                                                            <td>
                                                                <?php if ($row['link_instagram']): ?>
                                                                    <a href="<?= htmlspecialchars($row['link_instagram']) ?>" target="_blank">Instagram</a>
                                                                <?php else: ?> - <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($row['link_tiktok']): ?>
                                                                    <a href="<?= htmlspecialchars($row['link_tiktok']) ?>" target="_blank">Tiktok</a>
                                                                <?php else: ?> - <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($row['link_website']): ?>
                                                                    <a href="<?= htmlspecialchars($row['link_website']) ?>" target="_blank">Website</a>
                                                                <?php else: ?> - <?php endif; ?>
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <a href="editumkm.php?id_umkm=<?= $row['id_umkm'] ?>" class="btn btn-info btn-sm me-1">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteUMKM('<?= $row['id_umkm'] ?>');">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-warning text-center">
                                            <p>Belum ada UMKM ditambahkan.</p>
                                            <a href="tambahumkm.php" class="btn btn-primary btn-sm">
                                                <i class="fa fa-plus"></i> Tambah UMKM
                                            </a>
                                        </div>
                                    <?php endif; ?>
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
            $('#dataUMKM').DataTable();
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
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

// Ambil data sekali
$datadesa = mysqli_query($conn, "SELECT * FROM desa WHERE id_desa = $id_desa");
$desa = mysqli_fetch_assoc($datadesa);

// Jalur GeoJSON
$geojson_desa = !empty($desa['geojson_batasdesa']) ? '../../assets/geojson/' . rawurlencode($desa['geojson_batasdesa']) : null;
$geojson_dusun = !empty($desa['geojson_batasdusun']) ? '../../assets/geojson/' . rawurlencode($desa['geojson_batasdusun']) : null;

// Reset pointer kalau mau loop
mysqli_data_seek($datadesa, 0);

// Ambil fasilitas per desa
$dataFasilitas = mysqli_query($conn, "SELECT * FROM fasilitas WHERE id_desa = $id_desa");

// Ambil data info berjalan
$dataInfo = mysqli_query($conn, "SELECT * FROM info_berjalan");

// Ambil data statistik_pengunjung
$dataPengunjung = mysqli_query($conn, "SELECT YEAR(tanggal) AS tahun, SUM(jumlah) AS total_kunjungan FROM statistik_pengunjung WHERE id_desa = $id_desa GROUP BY YEAR(tanggal) ORDER BY tahun DESC");
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

                    <!-- Tabel 1: Data Umum Desa -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Data Umum Desa</h4>
                                    <a href="editdesa.php?id_desa=<?= $desa['id_desa'] ?>" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </div>
                                <div class="card-body">
                                    <?php if (mysqli_num_rows($datadesa) > 0): ?>
                                        <div class="table-responsive">
                                            <table id="dataUmum" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Desa</th>
                                                        <th>Kecamatan</th>
                                                        <th>Kabupaten</th>
                                                        <th>Provinsi</th>
                                                        <th>Luas Wilayah</th>
                                                        <th>Sejarah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    mysqli_data_seek($datadesa, 0);
                                                    while ($rowdesa = mysqli_fetch_assoc($datadesa)) { ?>
                                                        <tr>
                                                            <td><?= !empty($rowdesa['nama_desa']) ? htmlspecialchars($rowdesa['nama_desa']) : '<em>Belum diisi</em>' ?></td>
                                                            <td><?= !empty($rowdesa['kecamatan']) ? htmlspecialchars($rowdesa['kecamatan']) : '<em>Belum diisi</em>' ?></td>
                                                            <td><?= !empty($rowdesa['kabupaten']) ? htmlspecialchars($rowdesa['kabupaten']) : '<em>Belum diisi</em>' ?></td>
                                                            <td><?= !empty($rowdesa['provinsi']) ? htmlspecialchars($rowdesa['provinsi']) : '<em>Belum diisi</em>' ?></td>
                                                            <td><?= !empty($rowdesa['luas_wilayah']) ? htmlspecialchars($rowdesa['luas_wilayah']) . ' km²' : '<em>Belum diisi</em>' ?></td>
                                                            <td><?= !empty($rowdesa['sejarah']) ? htmlspecialchars($rowdesa['sejarah']) : '<em>Belum diisi</em>' ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-warning text-center">
                                            <h5>Belum ada Data Desa.</h5>
                                            <p>Silakan tambahkan Data Desa terlebih dahulu.</p>
                                            <a href="formdesa.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data Desa</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel 2: Data Detail Desa -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Detail Desa</h4>
                                    <a href="editdesa.php?id_desa=<?= $desa['id_desa'] ?>" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </div>
                                <div class="card-body">
                                    <?php if (mysqli_num_rows($datadesa) > 0): ?>
                                        <div class="table-responsive">
                                            <table id="dataDetail" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Email</th>
                                                        <th>No HP</th>
                                                        <th>Visi</th>
                                                        <th>Misi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    mysqli_data_seek($datadesa, 0);
                                                    while ($rowdesa = mysqli_fetch_assoc($datadesa)) { ?>
                                                        <tr>
                                                            <td><?= !empty($rowdesa['email']) ? htmlspecialchars($rowdesa['email']) : '<em>Belum diisi</em>' ?></td>
                                                            <td><?= !empty($rowdesa['no_hp']) ? htmlspecialchars($rowdesa['no_hp']) : '<em>Belum diisi</em>' ?></td>
                                                            <td><?= !empty($rowdesa['visi']) ? htmlspecialchars($rowdesa['visi']) : '<em>Belum diisi</em>' ?></td>
                                                            <td>
                                                                <ul style="padding-left: 18px;">
                                                                    <?php
                                                                    $idmisi = $rowdesa['id_desa'];
                                                                    $qmisi = mysqli_query($conn, "SELECT isi FROM misi WHERE id_desa = $idmisi");
                                                                    if (mysqli_num_rows($qmisi) > 0) {
                                                                        while ($rowMisi = mysqli_fetch_assoc($qmisi)) {
                                                                            echo "<li>" . htmlspecialchars($rowMisi['isi']) . "</li>";
                                                                        }
                                                                    } else {
                                                                        echo "<li><em>Belum ada misi</em></li>";
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-warning text-center">
                                            <p>Detail Desa belum tersedia.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel 3: Peta Desa -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Peta Desa</h4>
                                    <div class="d-flex gap-2">
                                        <a href="editdesa.php?id_desa=<?= $desa['id_desa'] ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <?php if (!empty($desa['geojson_batasdesa'])): ?>
                                            <a href="../../assets/geojson/<?= htmlspecialchars($desa['geojson_batasdesa']) ?>" class="btn btn-success btn-sm" download>
                                                <i class="fa fa-download"></i> Batas Desa
                                            </a>
                                        <?php endif; ?>

                                        <?php if (!empty($desa['geojson_batasdusun'])): ?>
                                            <a href="../../assets/geojson/<?= htmlspecialchars($desa['geojson_batasdusun']) ?>" class="btn btn-success btn-sm" download>
                                                <i class="fa fa-download"></i> Batas Dusun
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php if ($desa): ?>
                                        <div class="table-responsive mb-4">
                                            <table class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Koordinat</th>
                                                        <th>GeoJSON Batas Desa</th>
                                                        <th>GeoJSON Batas Dusun</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            $lat = !empty($desa['latitude']) ? htmlspecialchars($desa['latitude']) : '<em>Belum diisi</em>';
                                                            $lon = !empty($desa['longitude']) ? htmlspecialchars($desa['longitude']) : '<em>Belum diisi</em>';
                                                            echo $lat !== '<em>Belum diisi</em>' && $lon !== '<em>Belum diisi</em>' ? $lat . ', ' . $lon : '<em>Belum diisi</em>';
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?= !empty($desa['geojson_batasdesa']) ? htmlspecialchars($desa['geojson_batasdesa']) : '<em>Belum ada</em>' ?>
                                                        </td>
                                                        <td>
                                                            <?= !empty($desa['geojson_batasdusun']) ? htmlspecialchars($desa['geojson_batasdusun']) : '<em>Belum ada</em>' ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Elemen Peta -->
                                        <div class="row">
                                            <?php if (!empty($desa['geojson_batasdesa'])): ?>
                                                <div class="col-md-6">
                                                    <h5 class="mb-2">Peta Batas Desa</h5>
                                                    <div id="mapDesa" style="height: 400px;"></div>
                                                </div>
                                            <?php else: ?>
                                                <div class="col-md-6">
                                                    <div class="alert alert-warning text-center">
                                                        <p>Belum ada data GeoJSON Batas Desa.</p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($desa['geojson_batasdusun'])): ?>
                                                <div class="col-md-6">
                                                    <h5 class="mb-2">Peta Batas Dusun</h5>
                                                    <div id="mapDusun" style="height: 400px;"></div>
                                                </div>
                                            <?php else: ?>
                                                <div class="col-md-6">
                                                    <div class="alert alert-warning text-center">
                                                        <p>Belum ada data GeoJSON Batas Dusun.</p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                                        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                                        <script>
                                            var lat = <?= !empty($desa['latitude']) ? $desa['latitude'] : '0' ?>;
                                            var lon = <?= !empty($desa['longitude']) ? $desa['longitude'] : '0' ?>;

                                            <?php if (!empty($desa['geojson_batasdesa'])): ?>
                                                // PETA BATAS DESA
                                                var mapDesa = L.map('mapDesa').setView([lat, lon], 14);
                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                    attribution: '© OpenStreetMap contributors'
                                                }).addTo(mapDesa);

                                                L.marker([lat, lon]).addTo(mapDesa).bindPopup("Lokasi Kantor Desa");

                                                fetch('<?= $geojson_desa ?>')
                                                    .then(res => res.json())
                                                    .then(data => {
                                                        L.geoJSON(data, {
                                                            style: {
                                                                color: 'blue',
                                                                fillColor: 'blue',
                                                                fillOpacity: 0.1
                                                            },
                                                            onEachFeature: function(feature, layer) {
                                                                layer.bindPopup("Desa <?= $desa['nama_desa'] ?>");
                                                                layer.on('mouseover', function() {
                                                                    this.openPopup();
                                                                });
                                                                layer.on('mouseout', function() {
                                                                    this.closePopup();
                                                                });
                                                            }
                                                        }).addTo(mapDesa);
                                                    });
                                            <?php endif; ?>

                                            <?php if (!empty($desa['geojson_batasdusun'])): ?>
                                                // PETA BATAS DUSUN
                                                var mapDusun = L.map('mapDusun').setView([lat, lon], 14);
                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                    attribution: '© OpenStreetMap contributors'
                                                }).addTo(mapDusun);

                                                L.marker([lat, lon]).addTo(mapDusun).bindPopup("Lokasi Kantor Desa");

                                                fetch('<?= $geojson_dusun ?>')
                                                    .then(res => res.json())
                                                    .then(data => {
                                                        const colors = {};
                                                        const used = [];

                                                        data.features.forEach(f => {
                                                            const nama = f.properties.nmsls || 'unknown';
                                                            if (!colors[nama]) {
                                                                let color;
                                                                do {
                                                                    color = '#' + Math.floor(Math.random() * 16777215).toString(16);
                                                                } while (used.includes(color));
                                                                colors[nama] = color;
                                                                used.push(color);
                                                            }
                                                        });

                                                        L.geoJSON(data, {
                                                            style: function(feature) {
                                                                const nama = feature.properties.nmsls || 'unknown';
                                                                return {
                                                                    color: colors[nama],
                                                                    fillColor: colors[nama],
                                                                    fillOpacity: 0.3
                                                                };
                                                            },
                                                            onEachFeature: function(feature, layer) {
                                                                const nama = feature.properties.nmsls || 'Tanpa Nama';
                                                                layer.bindPopup("Dusun: " + nama);
                                                                layer.on('mouseover', function() {
                                                                    this.openPopup();
                                                                });
                                                                layer.on('mouseout', function() {
                                                                    this.closePopup();
                                                                });
                                                            }
                                                        }).addTo(mapDusun);
                                                    });
                                            <?php endif; ?>
                                        </script>

                                    <?php else: ?>
                                        <div class="alert alert-warning text-center">
                                            <p>Detail Peta belum tersedia.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel 4: Fasilitas Desa -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Fasilitas Desa</h4>
                                    <a href="tambahfasilitas.php?id_desa=<?= $desa['id_desa'] ?>" class="btn btn-info btn-sm">
                                        <i class="fa fa-plus"></i> Tambah
                                    </a>
                                </div>
                                <div class="card-body">
                                    <?php if (mysqli_num_rows($dataFasilitas) > 0): ?>
                                        <div class="table-responsive">
                                            <table id="dataFasilitas" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Fasilitas</th>
                                                        <th style="text-align: right;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    while ($row = mysqli_fetch_assoc($dataFasilitas)) { ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td>
                                                                <?= !empty($row['fasilitas']) ? htmlspecialchars($row['fasilitas']) : '<em>Belum diisi</em>' ?>
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <a href="editfasilitas.php?id_fasilitas=<?= $row['id_fasilitas'] ?>" class="btn btn-info btn-sm me-1">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('<?= $row['id_fasilitas'] ?>');">
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
                                            <p>Belum ada data fasilitas desa.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel 5: Info Berjalan -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Info Berjalan Website Desa</h4>
                                    <a href="tambahinfo.php?id_desa=<?= $desa['id_desa'] ?>" class="btn btn-info btn-sm">
                                        <i class="fa fa-plus"></i> Tambah
                                    </a>
                                </div>
                                <div class="card-body">
                                    <?php if (mysqli_num_rows($dataInfo) > 0): ?>
                                        <div class="table-responsive">
                                            <table id="dataInfo" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Emoji</th>
                                                        <th>Informasi</th>
                                                        <th style="text-align: right;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    while ($rowinfo = mysqli_fetch_assoc($dataInfo)) { ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td>
                                                                <?= !empty($rowinfo['emoji']) ? htmlspecialchars($rowinfo['emoji']) : '<em>Belum diisi</em>' ?>
                                                            </td>
                                                            <td>
                                                                <?= !empty($rowinfo['isi_info']) ? htmlspecialchars($rowinfo['isi_info']) : '<em>Belum diisi</em>' ?>
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <a href="editinfo.php?id_info=<?= $rowinfo['id_info'] ?>" class="btn btn-info btn-sm me-1">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteInfo('<?= $rowinfo['id_info'] ?>');">
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
                                            <p>Belum ada info berjalan.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <<!-- Tabel 6: Statistik Pengunjung -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">Statistik Pengunjung Website (Per Tahun)</h4>
                                        <a href="reset_statistik.php?id_desa=<?= $desa['id_desa'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin mereset semua data statistik?')">
                                            <i class="fa fa-sync-alt"></i> Reset
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <?php if (mysqli_num_rows($dataPengunjung) > 0): ?>
                                            <div class="table-responsive">
                                                <table id="dataStatistik" class="display table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tahun</th>
                                                            <th>Total Kunjungan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no = 1;
                                                        while ($rowpengunjung = mysqli_fetch_assoc($dataPengunjung)) { ?>
                                                            <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td><?= !empty($rowpengunjung['tahun']) ? htmlspecialchars($rowpengunjung['tahun']) : '<em>Belum ada data kunjungan</em>' ?></td>
                                                                <td>
                                                                    <?= isset($rowpengunjung['total_kunjungan']) && $rowpengunjung['total_kunjungan'] !== null
                                                                        ? number_format($rowpengunjung['total_kunjungan']) . ' orang'
                                                                        : '<em>Belum ada data kunjungan</em>' ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-warning text-center">
                                                <p>Belum ada data kunjungan.</p>
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
            $('#dataFasilitas').DataTable();
            $('#dataInfo').DataTable();
            $('#dataStatistik').DataTable();
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
            <?php unset($_SESSION['success']);
            ?>
        <?php elseif (isset($_SESSION['error'])): ?>
            swal({
                title: 'Error!',
                text: '<?php echo $_SESSION['error']; ?>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['error']);
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
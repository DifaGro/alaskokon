<?php
include '../connect.php';

// Ambil data desa
$queryDesa = mysqli_query($conn, "SELECT * FROM desa WHERE id_desa = 1");
$dataDesa = mysqli_fetch_assoc($queryDesa);

// Format tanggal manual Bahasa Indonesia
$hariIndoTop = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
];

$bulanIndoTop = [
    'January' => 'Januari',
    'February' => 'Februari',
    'March' => 'Maret',
    'April' => 'April',
    'May' => 'Mei',
    'June' => 'Juni',
    'July' => 'Juli',
    'August' => 'Agustus',
    'September' => 'September',
    'October' => 'Oktober',
    'November' => 'November',
    'December' => 'Desember'
];

$hariTop = $hariIndoTop[date('l')];
$tanggalTop = date('d');
$bulanTop = $bulanIndoTop[date('F')];
$tahunTop = date('Y');

$tanggalHariIniTop = "$hariTop, $tanggalTop $bulanTop $tahunTop";
?>

<div class="container-fluid bg-dark p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <!-- Tanggal -->
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center">
                <small class="far fa-calendar text-primary me-2"></small>
                <small><?= htmlspecialchars($tanggalHariIniTop); ?></small>
            </div>
        </div>

        <!-- Telepon & Email -->
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="fa fa-phone-alt text-primary me-2"></small>
                <small><?= !empty($dataDesa['no_hp']) ? htmlspecialchars($dataDesa['no_hp']) : 'Nomor HP belum tersedia.'; ?></small>
            </div>
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="fa fa-envelope text-primary me-2"></small>
                <small><?= !empty($dataDesa['email']) ? htmlspecialchars($dataDesa['email']) : 'Email belum tersedia.'; ?></small>
            </div>
        </div>
    </div>
</div>

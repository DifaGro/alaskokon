<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['pin'], $_POST['file'])) {
    header('Content-Type: application/json');
    $username = $_POST['username'];
    $pin = $_POST['pin'];
    $dokumen_path = $_POST['file'];

    // Cek data warga
    $check = mysqli_query($conn, "SELECT * FROM warga WHERE id_warga = '$username' AND pin = '$pin'");
    if (mysqli_num_rows($check) === 1) {
        // Ambil ID dokumen dari path file
        $nama_file = basename($dokumen_path);
        $get_doc = mysqli_query($conn, "SELECT id_dokumen FROM dokumen WHERE dokumen = '$nama_file'");
        if ($row_doc = mysqli_fetch_assoc($get_doc)) {
            $id_dokumen = $row_doc['id_dokumen'];
            $insert = mysqli_query($conn, "INSERT INTO log_unduh_dokumen (id_dokumen, id_warga, waktu_unduh) VALUES ('$id_dokumen', '$username', NOW())");
        }
        echo json_encode(['status' => 'success', 'id_dokumen' => $id_dokumen]);
    } else {
        echo json_encode(['status' => 'invalid']);
    }
    exit;
}

$query = mysqli_query($conn, "
    SELECT d.*, 
           (SELECT COUNT(*) FROM log_unduh_dokumen l WHERE l.id_dokumen = d.id_dokumen) AS jumlah_unduh 
    FROM dokumen d 
    WHERE tipe = 'Laporan'
");

?>

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
    <?php $page = 'informasi'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Laporan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Informasi</li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Laporan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten -->
    <div class="container-fluid mt-3">
        <div class="p-4 bg-white border rounded shadow-sm">

            <h4 class="text-primary mb-4">Daftar Dokumen Laporan Desa</h4>

            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($query)) :
                    $nama_dokumen = htmlspecialchars($row['nama_dokumen']);
                    $file = '../assets/file/laporan/' . $row['dokumen'];
                    $tanggal = date('d-m-Y', strtotime($row['tanggal']));
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                ?>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm h-100 border">
                            <div style="height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9;">
                                <?php if ($ext == 'pdf'): ?>
                                    <iframe src="<?= $file ?>#toolbar=0" style="width:100%; height:400px; pointer-events: none; border: none;"></iframe>
                                <?php elseif (in_array($ext, ['jpg', 'jpeg', 'png'])): ?>
                                    <img src="<?= $file ?>" alt="<?= $nama_dokumen ?>" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                <?php elseif ($ext == 'docx'): ?>
                                    <div class="text-center p-3">
                                        <i class="fas fa-file-word fa-4x text-primary"></i>
                                        <p class="text-muted mt-2">Dokumen Word</p>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center p-3">
                                        <i class="fas fa-file-alt fa-4x text-secondary"></i>
                                        <p class="text-muted mt-2">Pratinjau tidak tersedia</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title"><?= $nama_dokumen ?></h6>
                                <p class="mb-1">
                                    <strong>Diunduh:</strong> <span id="unduh-<?= $row['id_dokumen'] ?>"><?= $row['jumlah_unduh'] ?></span> kali
                                </p>
                                <p class="mb-3"><strong>Tanggal:</strong> <?= $tanggal ?></p>
                                <button class="btn btn-sm btn-primary" onclick="showVerificationModal('<?= $file ?>')">
                                    <i class="fas fa-download"></i> Unduh
                                </button>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>

                <?php if (mysqli_num_rows($query) == 0): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Tidak ada dokumen laporan desa yang tersedia saat ini.
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>

    <!-- Modal Verifikasi -->
    <div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="verifyModalLabel">Verifikasi Data Penduduk</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="verificationForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="pin" class="form-label">PIN</label>
                            <input type="password" class="form-control" id="pin" required>
                        </div>
                        <input type="hidden" id="downloadUrl">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="verifyAndDownload()">Verifikasi & Unduh</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/counterup/counterup.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../assets/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>

    <script>
        function showVerificationModal(fileUrl) {
            document.getElementById('downloadUrl').value = fileUrl;
            const modal = new bootstrap.Modal(document.getElementById('verifyModal'));
            modal.show();
        }

        function verifyAndDownload() {
            const username = document.getElementById('username').value.trim();
            const pin = document.getElementById('pin').value.trim();
            const url = document.getElementById('downloadUrl').value;

            if (!username || !pin) {
                bootstrap.Modal.getInstance(document.getElementById('verifyModal')).hide();
                Swal.fire({
                    icon: 'info',
                    title: 'Lengkapi Dulu!',
                    text: 'Username dan PIN tidak boleh kosong',
                    confirmButtonColor: '#3085d6',
                });
                return;
            }

            if (username.length < 8 || pin.length < 4) {
                bootstrap.Modal.getInstance(document.getElementById('verifyModal')).hide();
                Swal.fire({
                    icon: 'warning',
                    title: 'Format Salah!',
                    html: '<b>Username</b> minimal 8 angka dan <b>PIN</b> minimal 4 karakter.',
                    confirmButtonColor: '#f39c12'
                });
                return;
            }

            // AJAX ke server untuk verifikasi
            fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `username=${encodeURIComponent(username)}&pin=${encodeURIComponent(pin)}&file=${encodeURIComponent(url)}`
                })
                .then(response => response.json())
                .then(result => {
                    bootstrap.Modal.getInstance(document.getElementById('verifyModal')).hide();

                    if (result.status === 'success') {
                        // Tambah 1 ke jumlah unduhan
                        const id = result.id_dokumen;
                        const countEl = document.getElementById('unduh-' + id);
                        if (countEl) {
                            countEl.textContent = parseInt(countEl.textContent) + 1;
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Verifikasi Berhasil!',
                            text: 'File akan segera diunduh',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            const link = document.createElement('a');
                            link.href = url;
                            link.target = '_blank';
                            link.download = '';
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                            document.getElementById('verificationForm').reset();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Verifikasi Gagal!',
                            text: 'Username atau PIN yang Anda masukkan tidak sesuai.',
                            confirmButtonColor: '#d33',
                            footer: 'Silakan cek kembali datanya atau hubungi perangkat desa.'
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Gagal memproses verifikasi.',
                        confirmButtonColor: '#d33',
                    });
                });
        }

        // Reset form saat modal ditutup manual (tombol X atau Batal)
        document.getElementById('verifyModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('verificationForm').reset();
            document.getElementById('downloadUrl').value = '';
        });
    </script>


</body>

</html>
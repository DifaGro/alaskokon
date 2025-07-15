<?php
include '../connect.php';

$id_desa = 1;

// Ambil filter & page dari AJAX
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

$per_page = 9;
$offset = ($current_page - 1) * $per_page;

$where = "WHERE u.id_desa = $id_desa";
if ($current_filter !== 'all') {
    $where .= " AND LOWER(REPLACE(ju.nama_jenis, ' ', '-')) = '" . mysqli_real_escape_string($conn, $current_filter) . "'";
}

// Hitung total
$total_umkm_result = mysqli_query($conn, "
  SELECT COUNT(*) AS total 
  FROM umkm u 
  JOIN jenis_umkm ju ON u.id_jenis_umkm = ju.id_jenis_umkm 
  $where
");
$total_umkm_row = mysqli_fetch_assoc($total_umkm_result);
$total_umkm = $total_umkm_row['total'];
$total_pages = ceil($total_umkm / $per_page);

// Query data UMKM
$queryUmkm = "
  SELECT u.*, ju.nama_jenis 
  FROM umkm u
  JOIN jenis_umkm ju ON u.id_jenis_umkm = ju.id_jenis_umkm
  $where
  LIMIT $per_page OFFSET $offset
";
$resultUmkm = mysqli_query($conn, $queryUmkm);
?>

<!-- Bagian List UMKM -->
<div id="umkm-list" class="row g-4 mt-3">
    <?php if (mysqli_num_rows($resultUmkm) > 0): ?>
        <?php while ($umkm = mysqli_fetch_assoc($resultUmkm)) : ?>
            <div class="col-lg-4 col-md-6 portfolio-item <?= strtolower(str_replace(' ', '-', $umkm['nama_jenis'])) ?> wow fadeInUp">
                <div class="team-item rounded overflow-hidden mt-2">
                    <div class="d-flex">
                        <img class="img-fluid w-75"
                            src="../assets/img/umkm/<?= htmlspecialchars($umkm['foto']) ?>"
                            alt="<?= htmlspecialchars($umkm['nama_umkm']) ?>"
                            style="height: 250px; object-fit: cover;">
                        <div class="team-social w-25">
                            <?php if (!empty($umkm['link_tiktok'])) : ?>
                                <a class="btn btn-lg-square btn-outline-primary rounded-circle mt-3"
                                    href="<?= htmlspecialchars($umkm['link_tiktok']) ?>" target="_blank">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($umkm['link_instagram'])) : ?>
                                <a class="btn btn-lg-square btn-outline-primary rounded-circle mt-3"
                                    href="<?= htmlspecialchars($umkm['link_instagram']) ?>" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($umkm['no_hp'])) : ?>
                                <a class="btn btn-lg-square btn-outline-primary rounded-circle mt-3"
                                    href="https://wa.me/<?= htmlspecialchars($umkm['no_hp']) ?>" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($umkm['link_website'])) : ?>
                                <a class="btn btn-lg-square btn-outline-primary rounded-circle mt-3"
                                    href="<?= htmlspecialchars($umkm['link_website']) ?>" target="_blank">
                                    <i class="fas fa-globe"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><?= htmlspecialchars($umkm['nama_umkm']) ?></h5>
                            <small class="text-muted"><?= htmlspecialchars($umkm['nama_jenis']) ?></small>
                        </div>
                        <button
                            class="btn btn-sm btn-outline-primary rounded-circle btn-detail-umkm"
                            data-nama="<?= htmlspecialchars($umkm['nama_umkm']) ?>"
                            data-deskripsi="<?= htmlspecialchars($umkm['deskripsi']) ?>"
                            data-alamat="<?= htmlspecialchars($umkm['alamat']) ?>"
                            title="Detail UMKM">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="text-center">
            <h5 class="text-muted">Belum ada UMKM pada kategori ini.</h5>
        </div>
    <?php endif; ?>
</div>

<!-- Bagian Pagination -->
<div id="umkm-pagination" class="text-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($current_page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="#" data-page="<?= $current_page - 1 ?>">« Prev</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                    <a href="#" class="page-link" data-page="<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="#" data-page="<?= $current_page + 1 ?>">Next »</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
require_once 'models.php';

$obj = new Barang();
$keyword = $_GET['cari'] ?? '';
$halamanAktif = $_GET['p'] ?? 1;
$jumlahPerHalaman = 5;
$awalData = ($jumlahPerHalaman * $halamanAktif) - $jumlahPerHalaman;

$barang = $obj->tampilSemua($jumlahPerHalaman, $awalData, $keyword);
$totalData = $obj->countData($keyword);
$jumlahHalaman = ceil($totalData / $jumlahPerHalaman);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sembako Barokah - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .card { border-radius: 15px; border: none; }
        .btn-beli { background-color: #0dcaf0; color: white; }
        .pagination .page-link { color: #212529; }
        .pagination .active .page-link { background-color: #212529; border-color: #212529; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark shadow-sm px-4">
        <div class="container">
            <span class="navbar-brand">🏪 SEMBAKO BAROKAH</span>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">Halo, <?= $_SESSION['username']; ?></span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow p-4">
            <div class="row mb-4">
                <div class="col-md-6">
                    <a href="tambah.php" class="btn btn-success fw-bold">+ Tambah Barang</a>
                </div>
                <div class="col-md-6">
                    <form class="d-flex">
                        <input name="cari" class="form-control me-2" type="search" placeholder="Cari sembako..." value="<?= $keyword ?>">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=$awalData+1; foreach($barang as $b): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td class="fw-bold"><?= $b['nama_barang'] ?></td>
                            <td><span class="badge bg-secondary"><?= $b['stok'] ?> Pcs</span></td>
                            <td>Rp <?= number_format($b['harga']) ?></td>
                            <td class="text-center">
                                <a href="beli.php?id=<?= $b['id'] ?>" class="btn btn-beli btn-sm">Beli</a>
                                <a href="edit.php?id=<?= $b['id'] ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                                <button onclick="hapusBarang(<?= $b['id'] ?>)" class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <nav class="mt-3">
                <ul class="pagination justify-content-center">
                    <?php for($j=1; $j<=$jumlahHalaman; $j++): ?>
                        <li class="page-item <?= ($j==$halamanAktif)?'active':'' ?>">
                            <a class="page-link" href="?p=<?= $j ?>&cari=<?= $keyword ?>"><?= $j ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function hapusBarang(id) {
            Swal.fire({
                title: 'Yakin hapus, Bang Cuy?',
                text: "Data yang dihapus nggak bisa balik lagi lho!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'hapus.php?id=' + id;
                }
            })
        }
    </script>
</body>
</html>
<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
require_once 'models.php';

$obj = new Barang();
$id = $_GET['id'];
$data = $obj->getById($id);

if(isset($_POST['proses_beli'])) {
    $jumlah_beli = $_POST['jumlah'];
    
    if($jumlah_beli > $data['stok']) {
        echo "<script>alert('Stok tidak mencukupi!'); window.location='index.php';</script>";
    } else {
        $stok_baru = $data['stok'] - $jumlah_beli;
        
        // Memanggil method edit untuk update stok agar aman
        $obj->edit($id, $data['nama_barang'], $stok_baru, $data['harga']);

        echo "<script>
                alert('Pembelian Berhasil!');
                window.location='struk.php?id=$id&jml=$jumlah_beli';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Beli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="card mx-auto shadow" style="max-width: 400px;">
        <div class="card-body">
            <h4 class="text-center">Beli <?= $data['nama_barang']; ?></h4>
            <hr>
            <p>Harga Satuan: <strong>Rp<?= number_format($data['harga']); ?></strong></p>
            <p>Stok Tersedia: <?= $data['stok']; ?></p>
            <form method="post">
                <label>Jumlah Beli:</label>
                <input type="number" name="jumlah" class="form-control mb-3" min="1" max="<?= $data['stok']; ?>" required>
                <button type="submit" name="proses_beli" class="btn btn-success w-100">Proses & Cetak Struk</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>
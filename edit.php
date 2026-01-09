<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
require_once 'models.php';

$obj = new Barang();
$id = $_GET['id'];
$data = $obj->getById($id);

if(isset($_POST['submit'])) {
    if($obj->update($id, $_POST['nama'], $_POST['stok'], $_POST['harga'])) {
        echo "<script>alert('Data berhasil diubah!'); window.location='index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Barang</title>
</head>
<body class="container mt-5">
    <div class="card p-4 shadow-sm col-md-6 mx-auto">
        <h3>Edit Data Barang</h3>
        <form action="" method="post">
            <div class="mb-2">
                <label>Nama Barang</label>
                <input type="text" name="nama" class="form-control" value="<?= $data['nama_barang']; ?>" required>
            </div>
            <div class="mb-2">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-warning">Update Data</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
<?php
require_once 'models.php';
if(isset($_POST['submit'])) {
    $obj = new Barang();
    $obj->tambah($_POST['nama'], $_POST['stok'], $_POST['harga']);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h3>Tambah Stok Barang</h3>
    <form action="" method="post" class="col-md-6">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Barang" required>
        <input type="number" name="stok" class="form-control mb-2" placeholder="Stok" required>
        <input type="number" name="harga" class="form-control mb-3" placeholder="Harga" required>
        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>
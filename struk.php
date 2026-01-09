<?php
require_once 'models.php';
$id = $_GET['id'];
$jml = $_GET['jml'];
$obj = new Barang();
$b = $obj->getById($id);
$total = $b['harga'] * $jml;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Struk - Sembako Barokah</title>
    <style>
        @media print { .no-print { display: none; } }
        body { font-family: 'Courier New', Courier, monospace; width: 300px; margin: 20px auto; border: 1px solid #eee; padding: 15px; }
        .line { border-top: 1px dashed #000; margin: 10px 0; }
        .text-center { text-align: center; }
        .flex { display: flex; justify-content: space-between; }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center">
        <h2 style="margin:0;">SEMBAKO BAROKAH</h2>
        <small>Bekasi, Indonesia</small>
    </div>
    <div class="line"></div>
    <p>Tgl: <?= date('d/m/Y H:i') ?></p>
    <div class="flex">
        <span><?= $b['nama_barang'] ?></span>
        <span>x<?= $jml ?></span>
    </div>
    <div class="flex">
        <span>@ Rp<?= number_format($b['harga']) ?></span>
        <span>Rp<?= number_format($total) ?></span>
    </div>
    <div class="line"></div>
    <div class="flex" style="font-weight:bold;">
        <span>TOTAL</span>
        <span>Rp<?= number_format($total) ?></span>
    </div>
    <div class="line"></div>
    <p class="text-center">Terima Kasih, Semoga Barokah!</p>
    
    <div class="text-center no-print">
        <button onclick="window.location='index.php'">Kembali ke Dashboard</button>
    </div>
</body>
</html>
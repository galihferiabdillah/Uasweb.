<?php
require_once 'models.php';
$id = $_GET['id'];
$obj = new Barang();
if($obj->hapus($id)) {
    header("Location: index.php");
}
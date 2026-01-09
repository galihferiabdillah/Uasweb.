<?php
require_once 'config/Database.php';

class Barang extends Database {
    
    // Menampilkan data dengan fitur Cari & Pagination
    public function tampilSemua($limit, $offset, $keyword = '') {
        $query = "SELECT * FROM barang WHERE nama_barang LIKE :keyword LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':keyword', "%$keyword%");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menghitung total data (untuk nomor halaman pagination)
    public function countData($keyword = '') {
        $query = "SELECT COUNT(*) as total FROM barang WHERE nama_barang LIKE :keyword";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':keyword', "%$keyword%");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Fungsi Tambah Barang
    public function tambah($nama, $stok, $harga) {
        $query = "INSERT INTO barang (nama_barang, stok, harga) VALUES (:nama, :stok, :harga)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'nama' => $nama,
            'stok' => $stok,
            'harga' => $harga
        ]);
    }

    // Fungsi Ambil 1 Data (untuk Edit dan Beli)
    public function getById($id) {
        $query = "SELECT * FROM barang WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi Update/Edit Barang
    public function edit($id, $nama, $stok, $harga) {
        $query = "UPDATE barang SET nama_barang = :nama, stok = :stok, harga = :harga WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'id' => $id,
            'nama' => $nama,
            'stok' => $stok,
            'harga' => $harga
        ]);
    }

    // Fungsi Hapus Barang
    public function hapus($id) {
        $query = "DELETE FROM barang WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}
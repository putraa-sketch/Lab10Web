<?php
/**
 * Module: Delete Barang
 * Menggunakan Class Database
 */

// Cek ID
if (!isset($_GET['id'])) {
    header('Location: index.php?page=user/list');
    exit;
}

$id = (int)$_GET['id'];

// Ambil data untuk mendapatkan nama file gambar menggunakan method get
$data = $db->get('data_barang', "id_barang = '$id'");

if ($data) {
    // Hapus file gambar jika ada
    if (!empty($data['gambar']) && file_exists($data['gambar'])) {
        unlink($data['gambar']);
    }
    
    // Hapus data dari database menggunakan method delete dari class Database
    if ($db->delete('data_barang', "id_barang = '$id'")) {
        header('Location: index.php?page=user/list&status=deleted');
    } else {
        header('Location: index.php?page=user/list&status=err');
    }
} else {
    header('Location: index.php?page=user/list&status=err');
}

exit;
?>
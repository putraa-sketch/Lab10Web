<?php
/**
 * Index.php - Main Controller dengan OOP
 * Menggunakan Class Database untuk koneksi
 */

// Include class libraries
require_once 'lib/Database.php';
require_once 'lib/Form.php';

// Inisialisasi Database
$db = new Database();

// Set page title default
$page_title = 'Aplikasi Data Barang - OOP';

// Ambil parameter page dari URL
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Daftar halaman yang diizinkan (whitelist)
$allowed_pages = [
    'user/list',
    'user/add',
    'user/edit',
    'user/delete'
];

// Include header
include 'views/header.php';

// Routing
if ($page == 'dashboard') {
    // Load dashboard
    include 'views/dashboard.php';
} elseif (in_array($page, $allowed_pages)) {
    // Load modules
    $file_path = 'modules/' . $page . '.php';
    
    // Cek apakah file exists
    if (file_exists($file_path)) {
        include $file_path;
    } else {
        // Jika file tidak ditemukan
        echo '<div class="alert alert-error">';
        echo '<h2>❌ Error 404</h2>';
        echo '<p>Halaman yang Anda cari tidak ditemukan!</p>';
        echo '<a href="index.php" class="btn">Kembali ke Dashboard</a>';
        echo '</div>';
    }
} else {
    // Halaman tidak ada dalam whitelist
    echo '<div class="alert alert-error">';
    echo '<h2>⛔ Akses Ditolak</h2>';
    echo '<p>Anda tidak memiliki akses ke halaman ini!</p>';
    echo '<a href="index.php" class="btn">Kembali ke Dashboard</a>';
    echo '</div>';
}

// Include footer
include 'views/footer.php';
?>
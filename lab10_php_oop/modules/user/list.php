<?php
/**
 * Module: List/Tampil Data Barang
 * Menggunakan Class Database
 */

$page_title = "Data Barang";

// Query untuk menampilkan data menggunakan method getAll dari class Database
$barang = $db->getAll('data_barang', null, 'id_barang DESC');
?>

<div class="page-header">
    <h2>📋 Data Barang</h2>
    <a href="index.php?page=user/add" class="btn btn-primary">➕ Tambah Barang</a>
</div>

<?php
// Tampilkan notifikasi jika ada
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'ok') {
        echo '<div class="alert alert-success">✅ Data berhasil disimpan!</div>';
    } elseif ($_GET['status'] == 'err') {
        echo '<div class="alert alert-error">❌ Terjadi kesalahan saat menyimpan data!</div>';
    } elseif ($_GET['status'] == 'deleted') {
        echo '<div class="alert alert-success">✅ Data berhasil dihapus!</div>';
    }
}
?>

<?php if (count($barang) > 0): ?>
<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($barang as $item): 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td>
                    <?php if (!empty($item['gambar']) && file_exists($item['gambar'])): ?>
                        <img src="<?php echo htmlspecialchars($item['gambar']); ?>" 
                             alt="<?php echo htmlspecialchars($item['nama']); ?>" 
                             class="thumb">
                    <?php else: ?>
                        <span class="noimg">📷</span>
                    <?php endif; ?>
                </td>
                <td><strong><?php echo htmlspecialchars($item['nama']); ?></strong></td>
                <td><span class="badge"><?php echo htmlspecialchars($item['kategori']); ?></span></td>
                <td>Rp <?php echo number_format($item['harga_beli'], 0, ',', '.'); ?></td>
                <td>Rp <?php echo number_format($item['harga_jual'], 0, ',', '.'); ?></td>
                <td><span class="stock-badge"><?php echo (int)$item['stok']; ?></span></td>
                <td class="actions">
                    <a href="index.php?page=user/edit&id=<?php echo $item['id_barang']; ?>" 
                       class="btn-action btn-edit" 
                       title="Ubah">✏️</a>
                    <a href="index.php?page=user/delete&id=<?php echo $item['id_barang']; ?>" 
                       class="btn-action btn-delete" 
                       onclick="return confirm('⚠️ Yakin ingin menghapus data ini?')" 
                       title="Hapus">🗑️</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="table-info">
    <p>📊 Menampilkan <strong><?php echo count($barang); ?></strong> data barang (menggunakan Class Database OOP)</p>
</div>

<?php else: ?>
<div class="alert alert-info">
    <h3>📦 Belum Ada Data</h3>
    <p>Belum ada data barang yang tersedia. Silakan tambah data terlebih dahulu.</p>
    <a href="index.php?page=user/add" class="btn btn-primary">➕ Tambah Data Pertama</a>
</div>
<?php endif; ?>
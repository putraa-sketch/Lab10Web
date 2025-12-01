<?php
/**
 * Module: Edit Barang
 * Menggunakan Class Form dan Database
 */

$page_title = "Ubah Barang";

// Cek ID
if (!isset($_GET['id'])) {
    header('Location: index.php?page=user/list');
    exit;
}

$id = (int)$_GET['id'];

// Ambil data berdasarkan ID menggunakan method get dari class Database
$data = $db->get('data_barang', "id_barang = '$id'");

if (!$data) {
    echo '<div class="alert alert-error">❌ Data tidak ditemukan!</div>';
    echo '<a href="index.php?page=user/list" class="btn">Kembali</a>';
    exit;
}

// Proses form submit
if (isset($_POST['submit'])) {
    $nama = $db->escape($_POST['nama']);
    $kategori = $db->escape($_POST['kategori']);
    $harga_jual = (int)$_POST['harga_jual'];
    $harga_beli = (int)$_POST['harga_beli'];
    $stok = (int)$_POST['stok'];
    $gambar_lama = $db->escape($_POST['gambar_lama']);
    $gambar = $gambar_lama;
    
    // Handle upload gambar baru
    if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] == 0) {
        $file_gambar = $_FILES['file_gambar'];
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        
        if (in_array($file_gambar['type'], $allowed_types)) {
            $filename = time() . '_' . str_replace(' ', '_', $file_gambar['name']);
            $destination_dir = 'gambar/';
            
            if (!is_dir($destination_dir)) {
                mkdir($destination_dir, 0755, true);
            }
            
            $destination = $destination_dir . $filename;
            
            if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
                // Hapus gambar lama
                if (!empty($gambar_lama) && file_exists($gambar_lama)) {
                    unlink($gambar_lama);
                }
                $gambar = $destination;
            }
        }
    }
    
    // Siapkan data untuk update
    $update_data = [
        'nama' => $nama,
        'kategori' => $kategori,
        'harga_jual' => $harga_jual,
        'harga_beli' => $harga_beli,
        'stok' => $stok,
        'gambar' => $gambar
    ];
    
    // Update menggunakan method update dari class Database
    if ($db->update('data_barang', $update_data, "id_barang = '$id'")) {
        header('Location: index.php?page=user/list&status=ok');
        exit;
    } else {
        $error = "Gagal mengupdate data!";
    }
}
?>

<div class="page-header">
    <h2>✏️ Ubah Data Barang</h2>
</div>

<?php if (isset($error)): ?>
<div class="alert alert-error">
    <p>❌ <?php echo $error; ?></p>
</div>
<?php endif; ?>

<div class="form-container">
    <?php
    // Membuat instance Form
    $form = new Form('', 'Simpan Perubahan');
    $form->setEnctype('multipart/form-data');
    
    // Hidden field untuk gambar lama
    $form->addHiddenField('gambar_lama', $data['gambar']);
    
    // Menambahkan field-field form dengan value dari database
    $form->addTextField('nama', 'Nama Barang', $data['nama'], true);
    
    // Field kategori dengan options dan selected value
    $kategori_options = [
        'Elektronik' => 'Elektronik',
        'Komputer' => 'Komputer',
        'Hand Phone' => 'Hand Phone',
        'Aksesoris' => 'Aksesoris',
        'Lainnya' => 'Lainnya'
    ];
    $form->addSelectField('kategori', 'Kategori', $kategori_options, $data['kategori'], true);
    
    $form->addNumberField('harga_beli', 'Harga Beli', $data['harga_beli'], true, 0);
    $form->addNumberField('harga_jual', 'Harga Jual', $data['harga_jual'], true, 0);
    $form->addNumberField('stok', 'Stok', $data['stok'], true, 0);
    ?>
    
    <!-- Tampilkan gambar saat ini -->
    <div class="form-group">
        <label>Gambar Saat Ini</label>
        <?php if (!empty($data['gambar']) && file_exists($data['gambar'])): ?>
            <div class="current-image">
                <img src="<?php echo htmlspecialchars($data['gambar']); ?>" 
                     alt="<?php echo htmlspecialchars($data['nama']); ?>"
                     style="max-width: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            </div>
        <?php else: ?>
            <p class="text-muted">Tidak ada gambar</p>
        <?php endif; ?>
    </div>
    
    <?php
    // Field upload gambar baru
    $form->addFileField('file_gambar', 'Upload Gambar Baru (Opsional)', false);
    
    // Tampilkan form
    $form->displayForm();
    ?>
    
    <div class="form-info">
        <h4>ℹ️ Petunjuk:</h4>
        <ul>
            <li>Kosongkan field gambar jika tidak ingin mengubah gambar</li>
            <li>Gambar lama akan otomatis terhapus jika upload gambar baru</li>
        </ul>
    </div>
</div>
<?php
/**
 * Module: Tambah Barang
 * Menggunakan Class Form dan Database
 */

$page_title = "Tambah Barang";

// Proses form submit
if (isset($_POST['submit'])) {
    $nama = $db->escape($_POST['nama']);
    $kategori = $db->escape($_POST['kategori']);
    $harga_jual = (int)$_POST['harga_jual'];
    $harga_beli = (int)$_POST['harga_beli'];
    $stok = (int)$_POST['stok'];
    $gambar = null;
    
    // Handle upload gambar
    if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] == 0) {
        $file_gambar = $_FILES['file_gambar'];
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        
        // Validasi tipe file
        if (in_array($file_gambar['type'], $allowed_types)) {
            // Buat nama file unique
            $filename = time() . '_' . str_replace(' ', '_', $file_gambar['name']);
            $destination_dir = 'gambar/';
            
            // Buat folder jika belum ada
            if (!is_dir($destination_dir)) {
                mkdir($destination_dir, 0755, true);
            }
            
            $destination = $destination_dir . $filename;
            
            // Upload file
            if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
                $gambar = $destination;
            }
        }
    }
    
    // Siapkan data untuk insert menggunakan array
    $data = [
        'nama' => $nama,
        'kategori' => $kategori,
        'harga_jual' => $harga_jual,
        'harga_beli' => $harga_beli,
        'stok' => $stok,
        'gambar' => $gambar
    ];
    
    // Insert menggunakan method insert dari class Database
    if ($db->insert('data_barang', $data)) {
        header('Location: index.php?page=user/list&status=ok');
        exit;
    } else {
        $error = "Gagal menyimpan data!";
    }
}
?>

<div class="page-header">
    <h2>➕ Tambah Barang Baru</h2>
</div>

<?php if (isset($error)): ?>
<div class="alert alert-error">
    <p>❌ <?php echo $error; ?></p>
</div>
<?php endif; ?>

<div class="form-container">
    <?php
    // Membuat instance Form menggunakan Class Form
    $form = new Form('', 'Simpan Data');
    $form->setEnctype('multipart/form-data');
    
    // Menambahkan field-field form
    $form->addTextField('nama', 'Nama Barang', '', true);
    
    // Field kategori dengan options
    $kategori_options = [
        'Elektronik' => 'Elektronik',
        'Komputer' => 'Komputer',
        'Hand Phone' => 'Hand Phone',
        'Aksesoris' => 'Aksesoris',
        'Lainnya' => 'Lainnya'
    ];
    $form->addSelectField('kategori', 'Kategori', $kategori_options, '', true);
    
    $form->addNumberField('harga_beli', 'Harga Beli', '', true, 0);
    $form->addNumberField('harga_jual', 'Harga Jual', '', true, 0);
    $form->addNumberField('stok', 'Stok', '', true, 0);
    $form->addFileField('file_gambar', 'Gambar Produk', false);
    
    // Tampilkan form
    $form->displayForm();
    
    // Tampilkan info form
    $form->displayFormInfo([
        'Field yang bertanda <span class="required">*</span> wajib diisi',
        'Harga beli harus lebih kecil dari harga jual',
        'Upload gambar dalam format JPG, PNG, atau GIF',
        'Pastikan semua data diisi dengan benar sebelum menyimpan'
    ]);
    ?>
</div>
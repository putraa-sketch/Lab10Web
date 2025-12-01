# Praktikum 10: PHP OOP (Object-Oriented Programming)

## Informasi Mahasiswa
- **Nama**: Abdi Putra Perdana
- **NIM**: 312410426
- **Kelas**: TI 24 A3
- **Mata Kuliah**: Pemrograman Web
- **Topik**: PHP OOP - Class dan Object

---

## Tujuan Praktikum
1. Memahami konsep dasar OOP (Object-Oriented Programming)
2. Memahami konsep dasar Class dan Object
3. Mampu membuat program OOP sederhana menggunakan PHP
4. Mengimplementasikan konsep modularisasi dengan Class Library

---

## Langkah-langkah Praktikum

### **Latihan OOP Dasar - Class Mobil**

**File: `mobil.php`**

Membuat class sederhana dengan properties dan methods:

```php
class Mobil {
    private $warna;
    private $merk;
    private $harga;
    
    public function __construct() {
        $this->warna = "Biru";
        $this->merk = "BMW";
        $this->harga = "10000000";
    }
    
    public function gantiWarna($warnaBaru) {
        $this->warna = $warnaBaru;
    }
    
    public function tampilWarna() {
        echo "Warna mobilnya : " . $this->warna;
    }
}
```

**Screenshot:**
<img width="1919" height="955" alt="image" src="https://github.com/user-attachments/assets/1ffa1adb-76b4-4401-845f-0da4480eea23" />


**Penjelasan:**
- `private` = property hanya bisa diakses dari dalam class
- `public` = method bisa diakses dari luar class
- `__construct()` = constructor yang otomatis dijalankan saat objek dibuat
- `$this` = referensi ke object saat ini

---

### **Contoh Implementasi: form_input.php**

File ini mendemonstrasikan penggunaan Class Form untuk membuat form mahasiswa sederhana.

**Screenshot:**
<img width="1919" height="950" alt="image" src="https://github.com/user-attachments/assets/a8523c80-8363-46d9-8e79-5826a3a33d4a" />


---

### **Refactoring dengan OOP**

#### **Update Dashboard (views/dashboard.php)**

Menggunakan method dari class Database:

```php
// Sebelum (Procedural)
$result = query("SELECT COUNT(*) as total FROM data_barang");
$total_barang = fetch($result)['total'];

// Sesudah (OOP)
$total_barang = $db->count('data_barang');

// Get data
$items = $db->getAll('data_barang', null, 'id_barang DESC LIMIT 5');
```

**Screenshot:**
<img width="1656" height="2790" alt="image" src="https://github.com/user-attachments/assets/4de9250b-f2db-4b0b-a89f-8e68ee5b65cd" />

---

#### **Update Module Add (modules/user/add.php)**

Menggunakan Class Form dan Database:

```php
// Menggunakan Class Form
$form = new Form('', 'Simpan Data');
$form->setEnctype('multipart/form-data');

$form->addTextField('nama', 'Nama Barang', '', true);
// ... field lainnya

$form->displayForm();

// Insert menggunakan Class Database
$data = [
    'nama' => $nama,
    'kategori' => $kategori,
    'harga_jual' => $harga_jual,
    'harga_beli' => $harga_beli,
    'stok' => $stok,
    'gambar' => $gambar
];

$db->insert('data_barang', $data);
```

**Screenshot:**
<img width="1656" height="2442" alt="image" src="https://github.com/user-attachments/assets/e5eb02d7-c372-4760-99d3-f666d86c12e0" />


---

#### **Update Module Edit (modules/user/edit.php)**

```php
// Get data
$data = $db->get('data_barang', "id_barang = '$id'");

// Form dengan value dari database
$form = new Form('', 'Simpan Perubahan');
$form->addTextField('nama', 'Nama Barang', $data['nama'], true);
// ... field lainnya

// Update data
$update_data = [
    'nama' => $nama,
    'kategori' => $kategori,
    // ...
];

$db->update('data_barang', $update_data, "id_barang = '$id'");
```

**Screenshot:**
<img width="1656" height="2439" alt="image" src="https://github.com/user-attachments/assets/ecf006f7-c00b-4165-a349-b4360b1563d9" />


---

#### **Update Module List (modules/user/list.php)**

```php
// Sebelum (Procedural)
$sql = 'SELECT * FROM data_barang ORDER BY id_barang DESC';
$result = query($sql);
$barang = fetchAll($result);

// Sesudah (OOP)
$barang = $db->getAll('data_barang', null, 'id_barang DESC');
```

**Screenshot:**
<img width="1656" height="1361" alt="image" src="https://github.com/user-attachments/assets/e787d5aa-7e19-479e-b728-8cd5918817ec" />


---

#### **Update Module Delete (modules/user/delete.php)**

```php
// Get data
$data = $db->get('data_barang', "id_barang = '$id'");

// Delete menggunakan method delete
$db->delete('data_barang', "id_barang = '$id'");
```

**Screenshot:**
<img width="1919" height="959" alt="Cuplikan layar 2025-12-01 203513" src="https://github.com/user-attachments/assets/f93d1701-769a-4414-9fe8-4a164666312b" />


---

## Cara Menjalankan

1. **Clone/Download Project**
   ```bash
   git clone <repository-url>
   ```

2. **Pindahkan ke Folder htdocs**
   ```
   C:/xampp/htdocs/lab10_php_oop/
   ```

3. **Import Database**
   - Buka phpMyAdmin
   - Import file `latihan1.sql` 
   - Atau buat database `latihan1` dan tabel `data_barang`

4. **Jalankan XAMPP**
   - Start Apache
   - Start MySQL

5. **Akses**
   ```
   http://localhost/lab10_php_oop/
   ```

---

## Testing

### Test 1: Latihan Dasar OOP
- Buka: `http://localhost/lab10_php_oop/mobil.php`
- Cek output class Mobil

### Test 2: Form dengan Class
- Buka: `http://localhost/lab10_php_oop/form_input.php`
- Lihat form yang di-generate oleh Class Form

### Test 3: Pertanyaan dan Tugas
- Buka: `http://localhost/lab10_php_oop/`

---

## Kesimpulan

1. **OOP** membuat kode lebih terstruktur dan reusable
2. **Class Library** memudahkan development dan maintenance
3. **Database Class** menyederhanakan operasi CRUD
4. **Form Class** mempercepat pembuatan form
5. Aplikasi lebih **scalable** dan **professional**

---

**© 2025 Universitas Pelita Bangsa - Teknik Informatika**

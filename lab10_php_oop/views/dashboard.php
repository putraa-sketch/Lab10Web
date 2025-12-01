<div class="dashboard">
    <div class="hero-section">
        <h2>Selamat Datang! 👋</h2>
        <p>Kelola data barang Anda dengan mudah dan efisien menggunakan <strong>PHP OOP</strong></p>
    </div>

    <div class="stats-container">
        <?php
        // Total Barang - Menggunakan method count dari class Database
        $total_barang = $db->count('data_barang');
        
        // Total Kategori
        $result = $db->query("SELECT COUNT(DISTINCT kategori) as total FROM data_barang");
        $row = $result->fetch_assoc();
        $total_kategori = $row['total'];
        
        // Total Stok
        $result = $db->query("SELECT SUM(stok) as total FROM data_barang");
        $row = $result->fetch_assoc();
        $total_stok = $row['total'] ?? 0;
        
        // Total Nilai Stok (Harga Jual)
        $result = $db->query("SELECT SUM(harga_jual * stok) as total FROM data_barang");
        $row = $result->fetch_assoc();
        $total_nilai = $row['total'] ?? 0;
        ?>
        
        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-info">
                <h3><?php echo $total_barang; ?></h3>
                <p>Total Barang</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-info">
                <h3><?php echo $total_kategori; ?></h3>
                <p>Kategori</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">📈</div>
            <div class="stat-info">
                <h3><?php echo number_format($total_stok, 0, ',', '.'); ?></h3>
                <p>Total Stok</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-info">
                <h3>Rp <?php echo number_format($total_nilai, 0, ',', '.'); ?></h3>
                <p>Nilai Inventori</p>
            </div>
        </div>
    </div>

    <div class="quick-actions">
        <h3>Menu Cepat</h3>
        <div class="action-buttons">
            <a href="index.php?page=user/list" class="action-btn">
                <span class="btn-icon">📋</span>
                <span class="btn-text">Lihat Data Barang</span>
            </a>
            <a href="index.php?page=user/add" class="action-btn">
                <span class="btn-icon">➕</span>
                <span class="btn-text">Tambah Barang Baru</span>
            </a>
        </div>
    </div>

    <div class="recent-items">
        <h3>Data Barang Terbaru</h3>
        <?php
        // Menggunakan method getAll dari class Database
        $items = $db->getAll('data_barang', null, 'id_barang DESC LIMIT 5');
        ?>
        
        <?php if (count($items) > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <?php if (!empty($item['gambar']) && file_exists($item['gambar'])): ?>
                            <img src="<?php echo htmlspecialchars($item['gambar']); ?>" 
                                 alt="<?php echo htmlspecialchars($item['nama']); ?>" 
                                 class="thumb">
                        <?php else: ?>
                            <span class="noimg">📷</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($item['nama']); ?></td>
                    <td><span class="badge"><?php echo htmlspecialchars($item['kategori']); ?></span></td>
                    <td>Rp <?php echo number_format($item['harga_jual'], 0, ',', '.'); ?></td>
                    <td><?php echo (int)$item['stok']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="view-all">
            <a href="index.php?page=user/list" class="btn">Lihat Semua Data →</a>
        </div>
        <?php else: ?>
        <div class="alert alert-info">
            <p>📦 Belum ada data barang. <a href="index.php?page=user/add">Tambah data pertama</a></p>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="info-section">
        <h3>ℹ️ Tentang Aplikasi (OOP Version)</h3>
        <p>Aplikasi ini telah di-<strong>refactor</strong> menggunakan konsep <strong>PHP OOP (Object-Oriented Programming)</strong> untuk meningkatkan maintainability dan reusability kode:</p>
        <ul>
            <li>✅ <strong>Class Database</strong> - Menangani semua operasi database (CRUD)</li>
            <li>✅ <strong>Class Form</strong> - Generate form secara dinamis dan reusable</li>
            <li>✅ <strong>Modular Structure</strong> - Pemisahan logic, view, dan library</li>
            <li>✅ <strong>Clean Code</strong> - Kode lebih terstruktur dan mudah di-maintain</li>
        </ul>
        <p><strong>📚 Praktikum 10: PHP OOP</strong> - Universitas Pelita Bangsa</p>
    </div>
</div>
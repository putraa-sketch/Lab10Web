<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Aplikasi Data Barang'; ?></title>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="header-content">
                <h1>📦 Aplikasi Data Barang</h1>
                <p>Sistem Manajemen Inventori</p>
            </div>
        </header>
        
        <nav class="navbar">
            <ul>
                <li><a href="index.php" <?php echo (!isset($_GET['page']) || $_GET['page'] == 'dashboard') ? 'class="active"' : ''; ?>>🏠 Dashboard</a></li>
                <li><a href="index.php?page=user/list" <?php echo (isset($_GET['page']) && $_GET['page'] == 'user/list') ? 'class="active"' : ''; ?>>📋 Data Barang</a></li>
                <li><a href="index.php?page=user/add" <?php echo (isset($_GET['page']) && $_GET['page'] == 'user/add') ? 'class="active"' : ''; ?>>➕ Tambah Barang</a></li>
            </ul>
        </nav>
        
        <main class="container">
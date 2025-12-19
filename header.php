<?php
require_once "config.php";
cek_login();
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Aplikasi Klinik Sekolah</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-main">
<div class="app-wrapper">
    <div class="top-bar">
        <div class="tab <?php echo ($current === 'data_siswa_form.php' || $current === 'data_siswa_list.php') ? 'tab-active' : ''; ?>">
            <a href="data_siswa_form.php">Data Siswa</a>
        </div>
        <div class="tab <?php echo $current === 'laporan.php' ? 'tab-active' : ''; ?>">
            <a href="laporan.php">Laporan</a>
        </div>
        <div class="tab <?php echo $current === 'riwayat.php' ? 'tab-active' : ''; ?>">
            <a href="riwayat.php">Riwayat</a>
        </div>
        <div class="tab-right">
            <span class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a class="logout-link" href="logout.php">Logout</a>
        </div>
    </div>
    <div class="content-card">

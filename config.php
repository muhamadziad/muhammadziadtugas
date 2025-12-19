<?php
session_start();
$conn = new mysqli("localhost", "root", "", "klinik_sekolah");
if ($conn->connect_error) {
    die("Koneksi gagal");
}

function cek_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
}
?>

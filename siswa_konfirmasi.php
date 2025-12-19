<?php
require_once "config.php";
cek_login();
$id = intval($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare("UPDATE students SET status=? WHERE id=?");
    $status = "Sudah diperiksa tidak ada rujukan";
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: data_siswa_list.php");
exit;
?>

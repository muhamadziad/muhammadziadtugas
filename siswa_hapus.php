<?php
require_once "config.php";
cek_login();

$id = intval($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $conn->prepare("SELECT photo FROM students WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($res && $res['photo']) {
        $file = __DIR__ . "/uploads/" . $res['photo'];
        if (is_file($file)) {
            unlink($file);
        }
    }

    $stmt = $conn->prepare("DELETE FROM reports WHERE student_id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();
}

header("Location: data_siswa_list.php");
exit;
?>

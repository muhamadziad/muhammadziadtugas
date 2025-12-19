<?php
require_once "config.php";
cek_login();

$student_hidden = intval($_POST['student_id']);
$student_select = intval($_POST['student_select']);
$student_id = $student_select ?: $student_hidden;

$content = trim($_POST['content']);
$rujukan = $_POST['rujukan'];

if ($content) {
    if ($student_id > 0) {
        $stmt=$conn->prepare("INSERT INTO reports(student_id,content) VALUES (?,?)");
        $stmt->bind_param("is",$student_id,$content);
        $stmt->execute();
        $stmt->close();

        $status = ($rujukan=="perlu") ?
            "Sudah diperiksa perlu rujukan" :
            "Sudah diperiksa tidak ada rujukan";

        $stmt=$conn->prepare("UPDATE students SET status=? WHERE id=?");
        $stmt->bind_param("si",$status,$student_id);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: riwayat.php");
?>

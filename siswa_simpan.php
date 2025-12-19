<?php
require_once "config.php";
cek_login();

$id = intval($_GET['id'] ?? 0);
$name = trim($_POST['name'] ?? '');
$address = trim($_POST['address'] ?? '');
$age = intval($_POST['age'] ?? 0);
$class = trim($_POST['class'] ?? '');
$parent_phone = trim($_POST['parent_phone'] ?? '');
$complaint = trim($_POST['complaint'] ?? '');
$old_photo = trim($_POST['old_photo'] ?? '');

$photo = $old_photo;
if (!empty($_FILES['photo']['name'])) {
    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $newName = time().rand(1000,9999).".".$ext;
    move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__."/uploads/".$newName);
    $photo = $newName;
}

if ($id > 0) {
    $stmt = $conn->prepare("UPDATE students SET name=?, address=?, age=?, class=?, parent_phone=?, photo=?, complaint=? WHERE id=?");
    $stmt->bind_param("ssissssi", $name, $address, $age, $class, $parent_phone, $photo, $complaint, $id);
    $stmt->execute();
    $stmt->close();
} else {
    $date = date("Y-m-d");
    $status="Belum diperiksa";

    $stmt = $conn->prepare("INSERT INTO students(name,address,age,class,parent_phone,photo,complaint,visit_date,status) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssissssss",$name,$address,$age,$class,$parent_phone,$photo,$complaint,$date,$status);
    $stmt->execute();
    $stmt->close();
}

header("Location: data_siswa_list.php");
?>

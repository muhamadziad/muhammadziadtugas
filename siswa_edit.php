<?php
include "header.php";
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<div class="section-title"><h2>Edit Data Siswa</h2></div>

<form method="post" action="siswa_simpan.php?id=<?=$id?>" enctype="multipart/form-data">
<input type="hidden" name="old_photo" value="<?=$data['photo']?>">

<div class="grid-two">
<div>
<label class="form-label">Nama</label>
<input class="form-input" name="name" value="<?=$data['name']?>">

<label class="form-label mt-20">Alamat</label>
<input class="form-input" name="address" value="<?=$data['address']?>">

<label class="form-label mt-20">Umur</label>
<input class="form-input" name="age" value="<?=$data['age']?>">

<label class="form-label mt-20">Kelas</label>
<input class="form-input" name="class" value="<?=$data['class']?>">

<label class="form-label mt-20">No WA Orang Tua</label>
<input class="form-input" name="parent_phone" value="<?=$data['parent_phone']?>">
</div>

<div>
<label class="form-label">Keluhan</label>
<textarea class="form-textarea" name="complaint"><?=$data['complaint']?></textarea>

<label class="form-label mt-20">Foto Siswa</label>
<?php if($data['photo']): ?>
<img src="uploads/<?=$data['photo']?>" class="photo-thumb">
<?php endif; ?>
<input class="form-input" type="file" name="photo">
</div>
</div>

<div class="btn-row">
<button class="btn-main">Simpan</button>
<a class="btn-secondary" href="data_siswa_list.php">Kembali</a>
</div>
</form>

</div>
</div>
</body>
</html>

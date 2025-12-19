<?php
include "header.php";
$student_id = intval($_GET['student_id'] ?? 0);
$students = $conn->query("SELECT id,name FROM students ORDER BY name ASC");

$detail=null;
if ($student_id>0) {
    $stmt=$conn->prepare("SELECT * FROM students WHERE id=?");
    $stmt->bind_param("i",$student_id);
    $stmt->execute();
    $detail=$stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<div class="section-title">
<h2>Laporan</h2>
<p>Membuat laporan</p>
</div>

<form method="post" action="laporan_simpan.php">
<input type="hidden" name="student_id" value="<?=$student_id?>">

<label class="form-label">Pilih Siswa</label>
<select class="form-input" name="student_select">
<option value="">Pilih Siswa</option>
<?php while($s=$students->fetch_assoc()): ?>
<option value="<?=$s['id']?>" <?=($s['id']==$student_id?'selected':'')?>>
<?=$s['name']?>
</option>
<?php endwhile; ?>
</select>

<?php if($detail): ?>
<div class="form-input mt-20" style="background:#cbeed8;">
Nama: <?=$detail['name']?>,
Umur: <?=$detail['age']?> Tahun,
Kelas: <?=$detail['class']?>,
Alamat: <?=$detail['address']?>,
Keluhan: <?=$detail['complaint']?>
</div>
<?php endif; ?>

<label class="form-label mt-20">Status Rujukan</label>
<select class="form-input" name="rujukan">
<option value="tidak">Tidak ada rujukan</option>
<option value="perlu">Perlu rujukan</option>
</select>

<label class="form-label mt-20">Laporan</label>
<textarea class="form-textarea-large" name="content" placeholder="Nama, umur, alamat, keluhan terjadi, solusi......."></textarea>

<div class="btn-row-right">
<button class="btn-main">Konfirmasi</button>
</div>
</form>

</div>
</div>
</body>
</html>

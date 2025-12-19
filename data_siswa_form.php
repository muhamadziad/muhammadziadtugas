<?php include "header.php"; ?>
<div class="section-title">
<h2>Data Siswa</h2>
<p>isi data siswa</p>
</div>

<form method="post" action="siswa_simpan.php" enctype="multipart/form-data">
<div class="grid-two">
    <div>
        <label class="form-label">Nama Lengkap</label>
        <input class="form-input" name="name">

        <label class="form-label mt-20">Alamat</label>
        <input class="form-input" name="address">

        <label class="form-label mt-20">Umur</label>
        <input class="form-input" name="age" type="number">

        <label class="form-label mt-20">Kelas</label>
        <input class="form-input" name="class">

        <label class="form-label mt-20">No WA Orang Tua</label>
        <input class="form-input" name="parent_phone">
    </div>

    <div>
        <label class="form-label">Keluhan</label>
        <textarea class="form-textarea" name="complaint"></textarea>

        <label class="form-label mt-20">Foto Siswa</label>
        <input class="form-input" type="file" name="photo" accept="image/*">
    </div>
</div>

<div class="btn-row">
<button class="btn-main">Konfirmasi</button>
<a class="btn-secondary" href="data_siswa_list.php">Lihat Data</a>
</div>
</form>

</div>
<div class="dots-nav">
<a href="data_siswa_form.php" class="dot dot-active"></a>
<a href="data_siswa_list.php" class="dot"></a>
</div>
</div>
</body>
</html>

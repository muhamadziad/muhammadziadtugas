<?php include "header.php"; ?>
<div class="section-title"><h2>Data Siswa</h2></div>

<?php $result = $conn->query("SELECT * FROM students ORDER BY id DESC"); ?>

<table class="table-main">
<thead>
<tr>
    <th>ID</th>
    <th>Foto</th>
    <th>Nama</th>
    <th>Kelas</th>
    <th>Alamat</th>
    <th>Tanggal</th>
    <th>Umur</th>
    <th>Keluhan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php printf("%03d", $row['id']); ?></td>
    <td>
        <?php if($row['photo']): ?>
            <img src="uploads/<?=$row['photo']?>" class="photo-thumb">
        <?php endif; ?>
    </td>
    <td><?=$row['name']?></td>
    <td><?=$row['class']?></td>
    <td><?=$row['address']?></td>
    <td><?=date("d-m-Y",strtotime($row['visit_date']))?></td>
    <td><?=$row['age']?> Tahun</td>
    <td><?=$row['complaint']?></td>
    <td><?=$row['status']?></td>
    <td>
        <a href="siswa_edit.php?id=<?=$row['id']?>">Edit</a> |
        <a href="laporan.php?student_id=<?=$row['id']?>">Konfirmasi</a> |
        <a href="siswa_hapus.php?id=<?=$row['id']?>" onclick="return confirm('Hapus data siswa ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<div class="btn-row">
    <a class="btn-secondary" href="data_siswa_form.php">Tambah Siswa</a>
</div>

</div>
<div class="dots-nav">
    <a href="data_siswa_form.php" class="dot"></a>
    <a href="data_siswa_list.php" class="dot dot-active"></a>
</div>
</div>
</body>
</html>

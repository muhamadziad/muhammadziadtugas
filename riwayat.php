<?php
include "header.php";

$data = $conn->query("SELECT * FROM students WHERE status <> 'Belum diperiksa' ORDER BY id DESC");
?>

<div class="section-title">
    <h2>Riwayat</h2>
</div>

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
    <?php while ($r = $data->fetch_assoc()): ?>
        <?php
        $msg  = "Laporan kesehatan siswa\n";
        $msg .= "Nama: ".$r['name']."\n";
        $msg .= "Kelas: ".$r['class']."\n";
        $msg .= "Keluhan: ".$r['complaint']."\n";
        $msg .= "Status: ".$r['status'];

        $phone = preg_replace('/[^0-9]/','',$r['parent_phone']);
        $waLink = "https://api.whatsapp.com/send?phone=".$phone."&text=".urlencode($msg);
        ?>
        <tr>
            <td><?="00".$r['id']?></td>
            <td>
                <?php if ($r['photo']): ?>
                    <img src="uploads/<?=$r['photo']?>" class="photo-thumb">
                <?php endif; ?>
            </td>
            <td><?=$r['name']?></td>
            <td><?=$r['class']?></td>
            <td><?=$r['address']?></td>
            <td><?=date("d-m-Y", strtotime($r['visit_date']))?></td>
            <td><?=$r['age']?> Tahun</td>
            <td><?=$r['complaint']?></td>
            <td><?=$r['status']?></td>
            <td>
                <a href="cetak_siswa.php?id=<?=$r['id']?>" target="_blank">PDF</a> |
                <a href="<?=$waLink?>" target="_blank">WhatsApp</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</div>
</div>
</body>
</html>

<?php
require_once "config.php";
require_once __DIR__ . "/fpdf/fpdf.php";

$id = intval($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stu = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$stu) {
    die("Data tidak ditemukan");
}

$stmt = $conn->prepare("SELECT content FROM reports WHERE student_id=? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$rep = $stmt->get_result()->fetch_assoc();
$stmt->close();

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Laporan Pemeriksaan Siswa',0,1,'C');
$pdf->Ln(5);

$startY = $pdf->GetY();

if (!empty($stu['photo'])) {
    $fotoPath = __DIR__ . '/uploads/' . $stu['photo'];
    if (file_exists($fotoPath)) {
        $pdf->Image($fotoPath, 140, $startY, 40, 40);
    }
}

$pdf->SetFont('Arial','',11);

$labelW = 40;
$colonW = 5;

$pdf->Cell($labelW,7,'Tanggal Kunjungan',0,0);
$pdf->Cell($colonW,7,':',0,0);
$pdf->Cell(0,7,date('d-m-Y',strtotime($stu['visit_date'])),0,1);

$pdf->Cell($labelW,7,'Nama',0,0);
$pdf->Cell($colonW,7,':',0,0);
$pdf->Cell(0,7,$stu['name'],0,1);

$pdf->Cell($labelW,7,'Kelas',0,0);
$pdf->Cell($colonW,7,':',0,0);
$pdf->Cell(0,7,$stu['class'],0,1);

$pdf->Cell($labelW,7,'Umur',0,0);
$pdf->Cell($colonW,7,':',0,0);
$pdf->Cell(0,7,$stu['age'].' Tahun',0,1);

$pdf->Cell($labelW,7,'Alamat',0,0);
$pdf->Cell($colonW,7,':',0,0);
$pdf->MultiCell(0,7,$stu['address'],0,1);

$pdf->Cell($labelW,7,'Keluhan',0,0);
$pdf->Cell($colonW,7,':',0,0);
$pdf->MultiCell(0,7,$stu['complaint'],0,1);

$pdf->Cell($labelW,7,'Status',0,0);
$pdf->Cell($colonW,7,':',0,0);
$pdf->MultiCell(0,7,$stu['status'],0,1);

$pdf->Ln(4);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,7,'Catatan / Laporan Lengkap',0,1);

$pdf->SetFont('Arial','',11);
if ($rep) {
    $pdf->MultiCell(0,7,$rep['content'],0,1);
} else {
    $pdf->Cell(0,7,'Belum ada laporan tertulis.',0,1);
}

$pdf->Output('I','laporan_'.$stu['name'].'.pdf');
?>

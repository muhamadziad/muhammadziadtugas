<?php
require_once "config.php";
require_once "fpdf/fpdf.php";

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Riwayat Pemeriksaan Siswa',0,1,'C');
$pdf->Ln(4);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,8,'ID',1,0,'C');
$pdf->Cell(35,8,'Nama',1,0,'C');
$pdf->Cell(60,8,'Alamat',1,0,'C');
$pdf->Cell(25,8,'Tanggal',1,0,'C');
$pdf->Cell(20,8,'Umur',1,0,'C');
$pdf->Cell(60,8,'Keluhan',1,0,'C');
$pdf->Cell(40,8,'Status',1,1,'C');

$pdf->SetFont('Arial','',9);
$result=$conn->query("SELECT * FROM students WHERE status <> 'Belum diperiksa' ORDER BY id DESC");

while($r=$result->fetch_assoc()){
    $pdf->Cell(15,7,"00".$r['id'],1,0,'C');
    $pdf->Cell(35,7,$r['name'],1,0);
    $pdf->Cell(60,7,substr($r['address'],0,40),1,0);
    $pdf->Cell(25,7,date("d-m-Y",strtotime($r['visit_date'])),1,0);
    $pdf->Cell(20,7,$r['age'].' Th',1,0,'C');
    $pdf->Cell(60,7,substr($r['complaint'],0,40),1,0);
    $pdf->Cell(40,7,$r['status'],1,1);
}

$pdf->Output('D','riwayat_siswa.pdf');
?>

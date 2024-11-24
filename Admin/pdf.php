<?php

require_once('./include/TCPDF/tcpdf.php');
require_once '../php/config.php';

$sql = new Sql();

$animals = $sql->readAnimals();
$novels = $sql->readNovels();

$pdf = new TCPDF();
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Animal and Novel Report', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Animals:', 0, 1);
$pdf->SetFont('helvetica', '', 10);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(50, 8, 'Name', 1, 0, 'C');
$pdf->Cell(50, 8, 'Species', 1, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
foreach ($animals as $animal) {
    $pdf->Cell(50, 8, $animal['aname'], 1, 0, 'C');
    $pdf->Cell(50, 8, $animal['species'], 1, 1, 'C');
}
$pdf->Ln(10); 

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Novels:', 0, 1);
$pdf->SetFont('helvetica', '', 10);


$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(50, 8, 'Title', 1, 0, 'C');
$pdf->Cell(30, 8, 'Publication Year', 1, 0, 'C');
$pdf->Cell(50, 8, 'Publisher', 1, 1, 'C');


$pdf->SetFont('helvetica', '', 10);
foreach ($novels as $novel) {
    $pdf->Cell(50, 8, $novel['title'], 1, 0, 'C');
    $pdf->Cell(30, 8, $novel['pyear'], 1, 0, 'C');
    $pdf->Cell(50, 8, $novel['publisher'], 1, 1, 'C');
}
$pdf->Ln(10); 


$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 10, 'Report Date: ' . date('Y-m-d'), 0, 1, 'R');

$pdf->Output('animal_and_novel_report.pdf', 'D');

?>

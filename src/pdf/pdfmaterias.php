<?php
require_once '../../conexion.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('P', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->Image("../../assets/img/logosep.png", 10, 10, 40, 12, 'PNG');
$pdf->Image("../../assets/img/tecnm.jpeg", 185, 7, 18, 18, 'JPEG');
$pdf->Ln(20);
$pdf->SetTitle("Lista de Materias");
$pdf->SetFont('Arial', 'B', 12);

$asignaturas = mysqli_query($conexion, "SELECT * FROM asignatura");

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "Datos de la Materia", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(10, 5, utf8_decode('ID'), 1, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('Nombre de la Materia'), 1, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('No. Creditos Teoricos'), 1, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('No. Creditos Practicos'), 1, 0, 'L');
$pdf->Cell(36, 5, utf8_decode('Total Credito'), 1, 1, 'L');
$pdf->SetFont('Arial', '', 10);
while($datosC = mysqli_fetch_assoc($asignaturas)){
    $pdf->Cell(10, 5, utf8_decode($datosC['idasignatura']), 1, 0, 'L');
    $pdf->Cell(50, 5, utf8_decode($datosC['asignatura']), 1, 0, 'L');
    $pdf->Cell(50, 5, utf8_decode($datosC['creditoteo']), 1, 0, 'C');
    $pdf->Cell(50, 5, utf8_decode($datosC['creditopra']), 1, 0, 'C');
    $pdf->Cell(36, 5, utf8_decode($datosC['totalcredito']), 1, 1, 'C');
    
}

$pdf->Output("ventas.pdf", "I");

?>

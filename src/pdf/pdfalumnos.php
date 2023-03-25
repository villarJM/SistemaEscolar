<?php
require_once '../../conexion.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('L', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->Image("../../assets/img/logosep.png", 10, 10, 40, 12, 'PNG');
$pdf->Image("../../assets/img/tecnm.jpeg", 250, 7, 18, 18, 'JPEG');
$pdf->Ln(20);
$pdf->SetTitle("Lista de Alumnos");
$pdf->SetFont('Arial', 'B', 12);
$alumnos = mysqli_query($conexion, "SELECT a.idnumcon, a.nombre, a.apellido, a.edad, c.carrera, a.email, a.telefono, a.turno FROM alumnos a INNER JOIN carrera c ON a.idmatricula = c.idmatricula");

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(260, 5, "Datos de los Alumnos", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(25, 5, utf8_decode('ID'), 1, 0, 'L');
$pdf->Cell(30, 5, utf8_decode('Nombre'), 1, 0, 'L');
$pdf->Cell(30, 5, utf8_decode('Apellido'), 1, 0, 'L');
$pdf->Cell(15, 5, utf8_decode('Edad'), 1, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('Carrera'), 1, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('Email'), 1, 0, 'L');
$pdf->Cell(30, 5, utf8_decode('Teléfono'), 1, 0, 'L');
$pdf->Cell(30, 5, utf8_decode('Turno'), 1, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$salto = 40;
while($datosC = mysqli_fetch_assoc($alumnos)){
    $pdf->SetY($salto);
    $pdf->Cell(25, 10, utf8_decode($datosC['idnumcon']), 1, 0, 'L');
    $pdf->Cell(30, 10, utf8_decode($datosC['nombre']), 1, 0, 'L');
    $pdf->Cell(30, 10, utf8_decode($datosC['apellido']), 1, 0, 'L');
    $pdf->Cell(15, 10, utf8_decode($datosC['edad']), 1, 0, 'L');
    $pdf->MultiCell(50, 5, utf8_decode($datosC['carrera']), 1, 0, false);
    $pdf->SetY($salto);
    $pdf->SetX(160);
    $pdf->Cell(50, 10, utf8_decode($datosC['email']), 1, 0, 'L');
    $pdf->Cell(30, 10, utf8_decode($datosC['telefono']), 1, 0, 'L');
    $pdf->Cell(30, 10, utf8_decode($datosC['turno']), 1, 1, 'L');
    $salto = $salto + 10;
}
$pdf->Output("ventas.pdf", "I");
?>

<?php
require_once '../../conexion.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('L', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->Image("../../assets/img/logosep.png", 10, 10, 40, 12, 'PNG');
$pdf->Image("../../assets/img/tecnm.jpeg", 250, 7, 18, 18, 'JPEG');
$pdf->Ln(20);
$pdf->SetTitle("Lista de Profesores");
$pdf->SetFont('Arial', 'B', 12);

$profesores = mysqli_query($conexion, "SELECT p.idprofesor, p.nombre, p.apellido, p.email, p.telefono, c.carrera, p.estado FROM profesores p INNER JOIN carrera c ON p.idmatricula = c.idmatricula");

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(260, 5, "Datos de los Profesores", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(25, 5, utf8_decode('ID'), 1, 0, 'L');
$pdf->Cell(30, 5, utf8_decode('Nombre'), 1, 0, 'L');
$pdf->Cell(30, 5, utf8_decode('Apellido'), 1, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('Email'), 1, 0, 'L');
$pdf->Cell(30, 5, utf8_decode('Teléfono'), 1, 0, 'L');
$pdf->Cell(77, 5, utf8_decode('Imparte en'), 1, 0, 'L');
$pdf->Cell(18, 5, utf8_decode('Estado'), 1, 1, 'L');
$pdf->SetFont('Arial', '', 10);
while($datosC = mysqli_fetch_assoc($profesores)){
    $pdf->Cell(25, 5, utf8_decode($datosC['idprofesor']), 1, 0, 'L');
    $pdf->Cell(30, 5, utf8_decode($datosC['nombre']), 1, 0, 'L');
    $pdf->Cell(30, 5, utf8_decode($datosC['apellido']), 1, 0, 'L');
    $pdf->Cell(50, 5, utf8_decode($datosC['email']), 1, 0, 'L');
    $pdf->Cell(30, 5, utf8_decode($datosC['telefono']), 1, 0, 'L');
    $pdf->Cell(77, 5, utf8_decode($datosC['carrera']), 1, 0, 'L');
    if($datosC['estado'] == 1){
        $pdf->Cell(18, 5, utf8_decode('Activo'), 1, 1, 'L');
    } else {
        $pdf->Cell(18, 5, utf8_decode('Inactivo'), 1, 1, 'L');
    }
    
}
$pdf->Output("ventas.pdf", "I");
?>

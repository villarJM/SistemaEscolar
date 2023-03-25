<?php
require_once '../../conexion.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('L', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->Image("../../assets/img/logosep.png", 10, 10, 40, 12, 'PNG');
$pdf->Image("../../assets/img/tecnm.jpeg", 250, 7, 18, 18, 'JPEG');
$pdf->Ln(20);
$pdf->SetTitle(utf8_decode("Lista de Retículas"));
$pdf->SetFont('Arial', 'B', 12);

$asignaturas = mysqli_query($conexion, "SELECT r.idreticula, r.nombre_ret, c.carrera, r.semestre, a.idasignatura, a.asignatura, a.creditoteo, a.creditopra, a.totalcredito, r.estado FROM reticula r INNER JOIN carrera c ON r.idcarrera = c.idmatricula INNER JOIN asignatura a ON r.idasignatura = a.idasignatura");

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(260, 5, utf8_decode("Datos de la Retícula"), 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetY(35);
$pdf->Cell(10, 10, utf8_decode('ID'), 1, 0, 'L');
$pdf->MultiCell(30, 5, utf8_decode('Nombre de la Retícula'), 1, 0, false);
$pdf->SetY(35);
$pdf->SetX(50);
$pdf->Cell(40, 10, utf8_decode('Carrera'), 1, 0, 'L');
$pdf->Cell(30, 10, utf8_decode('Semestre'), 1, 0, 'L');
$pdf->Cell(25, 10, utf8_decode('ID Materia'), 1, 0, 'L');
$pdf->Cell(45, 10, utf8_decode('Materia'), 1, 0, 'L');
$pdf->MultiCell(20, 5, utf8_decode('Cred. Teoricos'), 1, 0, false);
$pdf->SetY(35);
$pdf->SetX(210);
$pdf->MultiCell(20, 5, utf8_decode('Cred. Practicos'), 1, 0, false);
$pdf->SetY(35);
$pdf->SetX(230);
$pdf->MultiCell(20, 5, utf8_decode('Total Credito'), 1, 0, false);
$pdf->SetY(35);
$pdf->SetX(250);
$pdf->Cell(20, 10, utf8_decode('Estado'), 1, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$Y = 45;
$X = 90;
while($datosC = mysqli_fetch_assoc($asignaturas)){
    $pdf->Cell(10, 10, utf8_decode($datosC['idreticula']), 1, 0, 'L');
    $pdf->Cell(30, 10, utf8_decode($datosC['nombre_ret']), 1, 0, 'L');
    $pdf->MultiCell(40, 5, utf8_decode($datosC['carrera']), 1, 0, false);
    $pdf->SetY($Y);
    $pdf->SetX($X);
    $pdf->Cell(30, 10, utf8_decode($datosC['semestre']), 1, 0, 'C');
    $pdf->Cell(25, 10, utf8_decode($datosC['idasignatura']), 1, 0, 'C');
    $pdf->MultiCell(45, 10, utf8_decode($datosC['asignatura']), 1, 0, false);
    $pdf->SetY($Y);
    $pdf->SetX($X + 100);
    $pdf->Cell(20, 10, utf8_decode($datosC['creditoteo']), 1, 0, 'C');
    $pdf->SetY($Y);
    $pdf->SetX($X + 120);
    $pdf->Cell(20, 10, utf8_decode($datosC['creditopra']), 1, 0, 'C');
    $pdf->SetY($Y);
    $pdf->SetX($X + 140);
    $pdf->Cell(20, 10, utf8_decode($datosC['totalcredito']), 1, 0, 'C');
    $pdf->SetY($Y);
    $pdf->SetX($X + 160);
    if($datosC['estado'] == 1){
        $pdf->Cell(20, 10, utf8_decode('Activo'), 1, 1, 'L');
    } else {
        $pdf->Cell(20, 10, utf8_decode('Inactivo'), 1, 1, 'L');
    }
    $Y = $Y + 10;
}

$pdf->Output("ventas.pdf", "I");

?>

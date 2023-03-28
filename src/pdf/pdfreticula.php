<?php
require_once '../../conexion.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('L', 'mm', array(300,330));
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->Image("../../assets/img/logosep.png", 10, 10, 40, 12, 'PNG');
$pdf->Image("../../assets/img/tecnm.jpeg", 185, 7, 18, 18, 'JPEG');
$pdf->Ln(20);
$pdf->SetTitle("Lista de Grupos");
$pdf->SetFont('Arial', 'B', 12);

$grupo = mysqli_query($conexion, "SELECT r.idreticula, r.nombre_ret, c.carrera, r.semestre, a.idasignatura, a.asignatura, a.creditoteo, a.creditopra, a.totalcredito, r.estado FROM reticula r INNER JOIN carrera c ON r.idmatricula = c.idmatricula INNER JOIN asignatura a ON r.idasignatura = a.idasignatura");

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "Datos de los grupos", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
// $pdf->Cell(10, 5, utf8_decode('ID'), 1, 0, 'L');
// $pdf->Cell(50, 5, utf8_decode('Grupo'), 1, 0, 'L');
// $pdf->Cell(50, 5, utf8_decode('Nom. Alumno'), 1, 0, 'L');
// $pdf->Cell(50, 5, utf8_decode('Materia'), 1, 0, 'L');
// $pdf->Cell(36, 5, utf8_decode('Nom. Profesor'), 1, 1, 'L');
$pdf->SetFont('Arial', '',5);
$YP = 40;
$YS = 40;
$YT = 40;
$YC = 40;
$YQ = 40;
$XS = 45;
$XT = 45;
$YPID = 45;
$YPT = 40;
$YPP = 50;
$YPTT = 60;
$pdf->SetY($YP);
while($datosC = mysqli_fetch_assoc($grupo)){
    
    if ($datosC['semestre'] === 'PRIMERO') {
        $pdf->MultiCell(30,30, utf8_decode($datosC['asignatura']), 1, 'C', false);
        if($datosC['idasignatura']){
            $pdf->SetY($YPID);
            $pdf->MultiCell(30,30, utf8_decode($datosC['idasignatura']), 0, 'C', false);
            $YPID =  $YPID + 35;
            $pdf->SetY($YPID);
        }
        if($datosC['creditoteo']){
            $pdf->SetY($YPT);
            $pdf->MultiCell(5, 10, utf8_decode($datosC['creditoteo']), 1, 'C', false);
            $YPT =  $YPT + 35;
            $pdf->SetY($YPT);
        }
        if($datosC['creditopra']){
            $pdf->SetY($YPP);
            $pdf->MultiCell(5, 10, utf8_decode($datosC['creditopra']), 1, 'C', false);
            $YPP =  $YPP + 35;
            $pdf->SetY($YPP);
        }
        if($datosC['totalcredito']){
            $pdf->SetY($YPTT);
            $pdf->MultiCell(5, 10, utf8_decode($datosC['totalcredito']), 1, 'C', false);
            $YPTT =  $YPTT + 35;
            $pdf->SetY($YPTT);
        }
        $YP =  $YP + 35;
        $pdf->SetY($YP);
    }
    if ($datosC['semestre'] === 'SEGUNDO') {
        if ($YP !== 40) {
            $pdf->SetY($YS);
            $pdf->SetX($XS);
        }
        $pdf->MultiCell(30,30, utf8_decode($datosC['asignatura']), 1, 'C', false);
        $YS =  $YS + 35;
        $pdf->SetY($YS);
        // $pdf->SetXP($XP);
        // $XP =  $XP + 35;
    }
    if ($datosC['semestre'] === 'TERCERO') {
        if ($YS !== 40) {
            $pdf->SetY($YT);
            $pdf->SetX(80);
        }
        $pdf->MultiCell(30,30, utf8_decode($datosC['asignatura']), 1, 'C', false);
        $YT =  $YT + 35;
        $pdf->SetY($YT);
        
    }
    if ($datosC['semestre'] === 'CUARTO') {
        if ($YT !== 40) {
            $pdf->SetY($YC);
            $pdf->SetX(115);
        }
        $pdf->MultiCell(30,30, utf8_decode($datosC['asignatura']), 1, 'C', false);
        $YC =  $YC + 35;
        $pdf->SetY($YC);
        
    }
    if ($datosC['semestre'] === 'QUINTO') {
        if ($YC !== 40) {
            $pdf->SetY($YQ);
            $pdf->SetX(150);
        }
        $pdf->MultiCell(30,30, utf8_decode($datosC['asignatura']), 1, 'C', false);
        $YQ =  $YQ + 35;
        $pdf->SetY($YQ);
        
    }
}
$pdf->Output("ventas.pdf", "I");

?>

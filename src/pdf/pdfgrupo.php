<?php
require_once '../../conexion.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('P', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->Image("../../assets/img/logosep.png", 10, 10, 40, 12, 'PNG');
$pdf->Image("../../assets/img/tecnm.jpeg", 185, 7, 18, 18, 'JPEG');
$pdf->Ln(20);
$pdf->SetTitle("Lista de Grupos");
$pdf->SetFont('Arial', 'B', 12);

$grupo = mysqli_query($conexion, "SELECT g.idgrupo, g.grupo, a.nombre, a.apellido, ag.asignatura, p.nombrep, p.apellidop FROM grupos g INNER JOIN alumnos a ON g.idnumcon = a.idnumcon INNER JOIN asignatura ag ON g.idasignatura = ag.idasignatura INNER JOIN profesores p ON g.idprofesor = p.idprofesor");

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "Datos de los grupos", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(10, 5, utf8_decode('ID'), 1, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('Grupo'), 1, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('Nom. Alumno'), 1, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('Materia'), 1, 0, 'L');
$pdf->Cell(36, 5, utf8_decode('Nom. Profesor'), 1, 1, 'L');
$pdf->SetFont('Arial', '', 10);
while($datosC = mysqli_fetch_assoc($grupo)){
    $pdf->Cell(10, 5, utf8_decode($datosC['idgrupo']), 1, 0, 'L');
    $pdf->Cell(50, 5, utf8_decode($datosC['grupo']), 1, 0, 'L');
    $pdf->Cell(50, 5, utf8_decode($datosC['nombre'].' '.$datosC['apellido']), 1, 0, 'C');
    $pdf->Cell(50, 5, utf8_decode($datosC['asignatura']), 1, 0, 'C');
    $pdf->Cell(36, 5, utf8_decode($datosC['nombrep'].' '.$datosC['apellidop']), 1, 1, 'C');
    
}
$pdf->Output("ventas.pdf", "I");

?>

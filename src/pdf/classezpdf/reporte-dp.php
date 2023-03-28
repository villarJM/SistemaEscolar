<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('letter');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);



/*$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("egresados", $conexion);
$queEmp = "SELECT * FROM activo order by serialemp";
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);*/

 $conexion = mysql_connect("localhost", "root", "");
mysql_select_db("sii", $conexion);
$queEmp = "SELECT * FROM alumno";
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp); 

  //$db = mysql_connect("localhost", "aulacest_santi", "Josejose-18"); 
  //mysql_select_db("aulacest_egresados",$db);
 



$ixx = 0;
while($datatmp = mysql_fetch_assoc($resEmp)) { 
	$ixx = $ixx+1;
	$data[] = array_merge($datatmp, array('num'=>$ixx));
}
$titles = array(
				'no_control'=>'<b>No. Matrícula</b>',
				'nombre'=>'<b>nombre</b>',
				'cal1'=>'<b>Cal 1</b>',
				'cal2'=>'<b>Cal 2</b>',
				'cal3'=>'<b>Cal 3</b>',
		);
$options = array(
'titleFontSize' => 10,
				'fontSize' => 6,
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'setColor'=>array(0.8,0.8,0.8),
				'textCol'=>array(0,0,0),
				'width'=>450
			);
$txttit = "<b>TOTAL DE EGRESADOS</b>\n DATOS PARTICULARES\n ";
$pdf->ezImage("1.jpg", 0, 300, 'none', 'center');
$pdf->ezText($txttit, 12,array('justification'=>'center'));
$pdf->setColor(1,0,0);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
ob_end_clean();
$pdf->ezStream();//abrir el pdf de forma automatica
$output = $pdf->ezOutput(); //Salida de archivo
file_put_contents('Kardex.pdf', $output); //guardar en el server
?>
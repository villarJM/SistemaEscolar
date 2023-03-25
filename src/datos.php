<?php 
require "../conexion.php";
$alumnos = mysqli_query($conexion, "SELECT * FROM alumnos");
$totalA= mysqli_num_rows($alumnos);
$carreras = mysqli_query($conexion, "SELECT * FROM carrera");
$totalC = mysqli_num_rows($carreras);
$usuarios = mysqli_query($conexion, "SELECT * FROM usuarios");
$totalU = mysqli_num_rows($usuarios);
$profesor = mysqli_query($conexion, "SELECT * FROM profesores");
$totalPr = mysqli_num_rows($profesor);

$etiqueta = ['Alumnos', 'Carreras', 'Usuarios', 'Profesores'];
$datosBase = [$totalA, $totalC, $totalU, $totalPr];
$respuesta = [
    "etiquetas" => $etiqueta,
    "datos" => $datosBase,
];
echo json_encode($respuesta);
die();
?>
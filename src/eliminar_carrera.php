<?php
session_start();
require("../conexion.php");
$id_user = $_SESSION['idUser'];
$permiso = "registrar_carrera";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN permisousuario d ON p.idpermiso = d.idpermiso WHERE d.idusuario = $id_user AND p.permiso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE carrera SET estado = 0 WHERE idmatricula = $id");
    mysqli_close($conexion);
    header("Location: clientes.php");
}
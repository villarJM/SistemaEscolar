<?php
include_once "includes/header.php";
require_once "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "reticula";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN permisousuario d ON p.idpermiso = d.idpermiso WHERE d.idusuario = $id_user AND p.permiso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
$query = mysqli_query($conexion, "SELECT v.*, c.idcliente, c.nombre FROM ventas v INNER JOIN cliente c ON v.id_cliente = c.idcliente");
?>
<style>
.contenido {
	background-color: #11D3C7;
	height: 80px;
    width: 90px;
	margin-top: 10px;
    border: white 2px solid;
}
.semestre {
	background-color: #2011D3;
	height: 30px;
    width: 90px;
	margin-top: 10px;
    border: white 2px solid;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-1">
            <div class="semestre"></div>
        </div>
        <div class="col-md-1">
            <div class="semestre"></div>
        </div>
        <div class="col-md-1">
            <div class="semestre"></div>
        </div>
        <div class="col-md-1">
            <div class="semestre"></div>
        </div>
        <div class="col-md-1">
            <div class="semestre"></div>
        </div>
        <div class="col-md-1">
            <div class="semestre"></div>
        </div>
        <div class="col-md-1">
            <div class="semestre"></div>
        </div>
        <div class="col-md-1">
            <div class="semestre"></div>
        </div>
        <div class="col-md-1">
            <div class="semestre"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
        <div class="col-md-1">
            <div class="contenido"></div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>
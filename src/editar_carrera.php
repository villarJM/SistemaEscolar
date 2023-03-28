<?php include_once "includes/header.php";
require "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "registrar_carrera";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN permisousuario d ON p.idpermiso = d.idpermiso WHERE d.idusuario = $id_user AND p.permiso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['idcarrera']) || empty($_POST['carrera'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
    } else {
        $idcarrera = 0;
        $carrera = $_POST['carrera'];
        $idcarrera = $_POST['idcarrera'];
        $sqlid = mysqli_query($conexion,"SELECT idmatricula FROM carrera WHERE idmatricula = '$idcarrera'");
        $data = mysqli_fetch_array($sqlid);
        if ($data > 0) {
            $sql_update = mysqli_query($conexion, "UPDATE carrera SET carrera = '$carrera' WHERE idmatricula = '$idcarrera'");
            $alert = '<div class="alert alert-success" role="alert">Carrera Actualizado</div>';
        }
    }
}

// Mostrar Datos

if (empty($_REQUEST['id'])) {
    header("Location: registrar_carreras.php");
}
$idusuario = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM carrera WHERE idmatricula = '$idusuario'");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header("Location: registrar_carreras.php");
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $idcarrera = $data['idmatricula'];
        $carrera = $data['carrera'];
    }
}
?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Modificar Carrera
            </div>
            <div class="card-body">
                <form class="" action="" method="post">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="idcarrera">Matricula</label>
                        <input type="text" placeholder="Ingrese nombre" class="form-control" name="idcarrera" id="idcarrera" value="<?php echo $idcarrera; ?>">
                    </div>
                    <div class="form-group">
                        <label for="carrera">Carrera</label>
                        <input type="text" placeholder="Ingrese usuario" class="form-control" name="carrera" id="carrera" value="<?php echo $carrera; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                    <a href="registrar_carreras.php" class="btn btn-danger">Atras</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>
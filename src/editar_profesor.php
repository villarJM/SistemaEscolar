<?php 
ob_start();
include_once "includes/header.php";
require "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "registrar_profesor";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN permisousuario d ON p.idpermiso = d.idpermiso WHERE d.idusuario = $id_user AND p.permiso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['apellido'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
    } else {
        $idusuario = $id_user;
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $carrera = $_POST['carrera'];
        $estado = $_POST['estado'];
        $sqlid = mysqli_query($conexion,"SELECT idprofesor FROM profesores WHERE nombre = '$nombre' AND apellido = '$apellido'");
        if ($data = mysqli_fetch_array($sqlid)) {
            $idusuario = $data['idprofesor'];
        }
        $sql_update = mysqli_query($conexion, "UPDATE profesores SET nombre = '$nombre', apellido = '$apellido', email = '$email', telefono = $telefono, estado = $estado WHERE idprofesor = '$idusuario'");
        $alert = '<div class="alert alert-success" role="alert">Profesor Actualizado</div>';
    }
}

// Mostrar Datos

if (empty($_REQUEST['id'])) {
    header("Location: registrar_profesores.php");
}
$idusuario = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT p.nombrep, p.apellidop, p.email, p.telefono, c.carrera, p.estado FROM profesores p INNER JOIN carrera c ON p.idmatricula = c.idmatricula WHERE idprofesor = '$idusuario'");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header("Location: registrar_profesores.php");
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $nombre = $data['nombrep'];
        $apellido = $data['apellidop'];
        $email = $data['email'];
        $telefono = $data['telefono'];
        $carrera = $data['carrera'];
        $estado = $data['estado'];

    }
}
?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Modificar Profesor
            </div>
            <div class="card-body">
                <form class="" action="" method="post">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $apellido; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
                    </div>
                    <div class="form-group">
                        <label for="imparte">Carrera Impartida</label>
                        <input type="text" class="form-control" name="imparte" id="imparte" value="<?php echo $carrera; ?>">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" name="estado" id="estado" value="<?php echo $estado; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                    <a href="registrar_profesores.php" class="btn btn-danger">Atras</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>
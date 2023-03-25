<?php
ob_start(); 
include_once "includes/header.php";
include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "registrar_carrera";
$idhorario;
$idgrupo;
$idprofesor;

$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN permisousuario d ON p.idpermiso = d.idpermiso WHERE d.idusuario = $id_user AND p.permiso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['idcarrera']) || empty($_POST['carrera'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $idcarrera = $_POST['idcarrera'];
        $carrera = $_POST['carrera'];
        $usuario_id = $_SESSION['idUser'];
        $result = 0;
        $query = mysqli_query($conexion, "SELECT * FROM carrera WHERE idmatricula = '$idcarrera' AND carrera = '$carrera'");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    Esa Información ya existe
                                </div>';
        } else {
            
            $queryInsert = "INSERT INTO `carrera` (`idmatricula`, `carrera`, `estado`) VALUES ('$idcarrera', '$carrera', 1)";
            $query_insert = mysqli_query($conexion, $queryInsert);
            if ($query_insert) {
                $alert = '<div class="alert alert-success" role="alert">
                                    Profesor Registrado
                                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                                    Error al registrar
                            </div>';
            }
        }
    }
    mysqli_close($conexion);
}
?>
<button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevo_cliente"><i class="fas fa-plus"></i></button>
<?php echo isset($alert) ? $alert : ''; ?>
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Carrera</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT * FROM carrera");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    if ($data['estado'] == 1) {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        $estado = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                    }
            ?>
                    <tr>
                        <td><?php echo $data['idmatricula']; ?></td>
                        <td><?php echo $data['carrera']; ?></td>
                        <td><?php echo $estado; ?></td>
                        <td>
                            <?php if ($data['estado'] == 1) { ?>
                                <a href="editar_carrera.php?id=<?php echo $data['idmatricula']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                <form action="eliminar_carrera.php?id=<?php echo $data['idmatricula']; ?>" method="post" class="confirmar d-inline">
                                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>

    </table>
    <a href="pdf/generar.php?cl=<?php echo $row['id_cliente'] ?>&v=<?php echo $row['id'] ?>" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
</div>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Registrar Carrera</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                <div class="form-group">
                        <label for="idcarrera">ID</label>
                        <input class="form-control" list="idcarreras" name="idcarrera" id="idcarrera" placeholder="ID de Carrera" required>
                    </div>
                    <div class="form-group">
                        <label for="carrera">Nombre de la Carrera</label>
                        <input class="form-control" list="carrera" name="carrera" id="carrera" placeholder="Nombre de la Carrera" required>
                    </div>
                    <input type="submit" value="Registrar Carrera" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>
<?php
ob_start(); 
include_once "includes/header.php";
include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "registrar_profesor";
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
    if (empty($_POST['nombreprof']) || empty($_POST['apellidoprof']) || empty($_POST['emailprof']) || empty($_POST['telefonoprof'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $nombre = $_POST['nombreprof'];
        $apellido = $_POST['apellidoprof'];
        $email = $_POST['emailprof'];
        $telefono = $_POST['telefonoprof'];
        $idmatricula = $_POST['carreraimp'];
        $idprofesor = $_POST['idprofesor'];
        $usuario_id = $_SESSION['idUser'];
        $result = 0;
        $query = mysqli_query($conexion, "SELECT * FROM profesores WHERE nombrep = '$nombre' AND apellidop = '$apellido' AND email = '$email' AND telefono = $telefono");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    Esa Información ya existe
                                </div>';
        } else {
            
            $queryInsert = "INSERT INTO `profesores` (`idprofesor` ,`idmatricula`, `nombrep`, `apellidop`, `email`, `telefono`, `estado`) VALUES ('$idprofesor' ,$idmatricula, '$nombre', '$apellido', '$email', $telefono, 1)";
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
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Imparte en</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT p.*, c.carrera FROM profesores p INNER JOIN carrera c ON p.idmatricula = c.idmatricula");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    if ($data['estado'] == 1) {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    } else if ($data['estado'] == 0) {
                        $estado = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                    }
            ?>
                    <tr>
                        <td><?php echo $data['idprofesor']; ?></td>
                        <td><?php echo $data['nombrep']; ?></td>
                        <td><?php echo $data['apellidop']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['telefono']; ?></td>
                        <td><?php echo $data['carrera']; ?></td>
                        <td><?php echo $estado; ?></td>
                        <td>
                            <?php if ($data['estado'] == 1) { ?>
                                <a href="editar_profesor.php?id=<?php echo $data['idprofesor']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                <form action="eliminar_profesor.php?id=<?php echo $data['idprofesor']; ?>" method="post" class="confirmar d-inline">
                                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                </form>
                            <?php } else {?>
                                <a href="editar_profesor.php?id=<?php echo $data['idprofesor']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                            <?php } ?>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <a href="pdf/pdfprofesor.php" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
</div>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Registrar Profesor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                <div class="form-group">
                        <label for="idprofesor">ID</label>
                        <input class="form-control" list="idprofesors" name="idprofesor" id="idprofesor" placeholder="ID del profesor" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreprof">Nombres</label>
                        <input class="form-control" list="nombreprofs" name="nombreprof" id="nombreprof" placeholder="Nombre del profesor" required>
                    </div>
                    <div class="form-group">
                        <label for="apellidoprof">Apellidos</label>
                        <input class="form-control" list="apellidoprofs" name="apellidoprof" id="apellidoprof" placeholder="Apellidos del profesor" required>
                    </div>
                    <div class="form-group">
                        <label for="emailprof">Email</label>
                        <input class="form-control" list="" name="emailprof" id="emailprofs" placeholder="Email" requiered>
                    </div>
                    <div class="form-group">
                        <label for="telefonoprof">Teléfono</label>
                        <input class="form-control" list="telefonoprofs" name="telefonoprof" id="telefonoprof" placeholder="Teléfono" requiered>
                    </div>
                    <div class="form-group">
                        <label for="carreraimp">Carrera Que Imparte</label>
                        <input class="form-control" list="carreraimps" name="carreraimp" id="telefonoprof" placeholder="Carrera al que imparte" requiered>
                        <datalist id="carreraimps">
                            <?php
                                $consulta = "SELECT * FROM carrera";
                                $resultado = mysqli_query($conexion , $consulta);
                                $contador=0;
                                while($carrera = mysqli_fetch_assoc($resultado)){ $contador++;?>
                                <option value="<?php echo $carrera["idmatricula"]; ?>">Carrera: <?php echo $carrera["carrera"]; ?></option>
                            <?php }?>
                        </datalist>
                    </div>
                    <input type="submit" value="Registrar Profesor" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>
<?php
ob_start(); 
include_once "includes/header.php";
include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "registrar_materia";
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
    if (empty($_POST['idmateria']) || empty($_POST['materia'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $idmatricula = $_POST['idcarrera'];
        $idasignatura = $_POST['idmateria'];
        $asignatura = $_POST['materia'];
        $credteo = $_POST['credteo'];
        $credpra = $_POST['credpr'];
        $credtot = $_POST['credtotal'];
        $result = 0;
        $query = mysqli_query($conexion, "SELECT * FROM asignatura WHERE idasignatura = '$idasignatura' AND asignatura = '$asignatura'");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    Esa Información ya existe
                                </div>';
        } else {
            
            $queryInsert = "INSERT INTO `asignatura` (`idasignatura`, `asignatura`, `creditoteo`, `creditopra`, `totalcredito`) VALUES ('$idasignatura', '$asignatura', $credteo, $credpra, $credtot)";
            $query_insert = mysqli_query($conexion, $queryInsert);
            $queryInsert = mysqli_query($conexion, "INSERT INTO `asignaturacarrera` (`idasignatura`, `idmatricula`) VALUES ('$idasignatura', $idmatricula)");
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
                <th>Materia</th>
                <th>No. Cred. Teoricos</th>
                <th>No. Cred. Practicos</th>
                <th>No. Cred. Totales</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT * FROM asignatura");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
            ?>
                    <tr>
                        <td><?php echo $data['idasignatura']; ?></td>
                        <td><?php echo $data['asignatura']; ?></td>
                        <td><?php echo $data['creditoteo']; ?></td>
                        <td><?php echo $data['creditopra']; ?></td>
                        <td><?php echo $data['totalcredito']; ?></td>
                        <td>
                            <?php ?>
                                <form action="eliminar_materia.php?id=<?php echo $data['idasignatura']; ?>" method="post" class="confirmar d-inline">
                                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                </form>
                            <?php ?>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <a href="pdf/pdfmaterias.php?cl=<?php echo $row['id_cliente'] ?>&v=<?php echo $row['id'] ?>" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
</div>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Registrar Materia</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="idcarrera">ID Carrera</label>
                        <input class="form-control" list="idcarreras" name="idcarrera" id="idcarrera" placeholder="ID de la Carrera" required>
                        <datalist id="idcarreras">
                                        <?php
                                            $consulta = "SELECT * FROM carrera";
                                            $resultado = mysqli_query($conexion , $consulta);
                                            $contador=0;
                                            while($carrera = mysqli_fetch_assoc($resultado)){ $contador++;?>
                                            <option value="<?php echo $carrera["idmatricula"]; ?>">Carrera: <?php echo $carrera["carrera"]; ?></option>
                                        <?php }?>
                                    </datalist>
                    </div>
                    <div class="form-group">
                        <label for="idmateria">ID</label>
                        <input class="form-control" list="idmaterias" name="idmateria" id="idmateria" placeholder="ID de la Materia" required>
                    </div>
                    <div class="form-group">
                        <label for="materia">Nombre de la Materia</label>
                        <input class="form-control" list="materias" name="materia" id="materia" placeholder="Nombre de la Materia" required>
                    </div>
                    <div class="form-group">
                        <label for="credteo">No. Cred. Teoricos</label>
                        <input class="form-control" list="credteo" name="credteo" id="credteo" placeholder="Número de Credito" required>
                    </div>
                    <div class="form-group">
                        <label for="credpr">No. Cred. Practicos</label>
                        <input class="form-control" list="credpr" name="credpr" id="credpr" placeholder="Número de Credito" required>
                    </div>
                    <div class="form-group">
                        <label for="credtotal">No. Cred. Totales</label>
                        <input class="form-control" list="credtotal" name="credtotal" id="credtotal" placeholder="Número de Credito" required>
                    </div>
                    <input type="submit" value="Registrar Carrera" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>
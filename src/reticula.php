<?php
ob_start();
include_once "includes/header.php";
    include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "reticula";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN permisousuario d ON p.idpermiso = d.idpermiso WHERE d.idusuario = $id_user AND p.permiso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['reticula']) || empty($_POST['idcarrera'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $reticula = $_POST['reticula'];
        $idcarrera = $_POST['idcarrera'];
        $idasignatura = $_POST['materia'];
        $semestre = $_POST['semestre'];
        $usuario_id = $_SESSION['idUser'];
        $result = 0;
        $query = mysqli_query($conexion, "SELECT * FROM reticula WHERE idmatricula = '$idcarrera' AND idasignatura = '$idasignatura' AND nombre_ret = '$reticula' AND semestre = '$semestre'");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    Esa Información ya existe
                                </div>';
        } else {
            
            $queryInsert = "INSERT INTO `reticula` (`idmatricula`, `idasignatura`, `nombre_ret`, `semestre`, `estado`) VALUES ('$idcarrera', '$idasignatura', '$reticula', '$semestre', 1)";
            $query_insert = mysqli_query($conexion, $queryInsert);
            if ($query_insert) {
                $alert = '<div class="alert alert-success" role="alert">
                                    Reticula Registrado
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
                <th>Nom. Reticula</th>
                <th>Carrera</th>
				<th>Semestre</th>
                <th>ID</th>
                <th>Materia</th>
                <th>Cred. Teoricos</th>
                <th>Cred. Practicos</th>
                <th>Total Creditos</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT r.idreticula, r.nombre_ret, c.carrera, r.semestre, a.idasignatura, a.asignatura, a.creditoteo, a.creditopra, a.totalcredito, r.estado FROM reticula r INNER JOIN carrera c ON r.idmatricula = c.idmatricula INNER JOIN asignatura a ON r.idasignatura = a.idasignatura");
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
                        <td><?php echo $data['idreticula']; ?></td>
                        <td><?php echo $data['nombre_ret']; ?></td>
                        <td><?php echo $data['carrera']; ?></td>
                        <td><?php echo $data['semestre']; ?></td>
                        <td><?php echo $data['idasignatura']; ?></td>
                        <td><?php echo $data['asignatura']; ?></td>
                        <td><?php echo $data['creditoteo']; ?></td>
                        <td><?php echo $data['creditopra']; ?></td>
                        <td><?php echo $data['totalcredito']; ?></td>
                        <td><?php echo $estado; ?></td>
                        <td>
                            <?php if ($data['estado'] == 1) { ?>
                                <a href="editar_carrera.php?id=<?php echo $data['idreticula']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                <form action="eliminar_carrera.php?id=<?php echo $data['idreticula']; ?>" method="post" class="confirmar d-inline">
                                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>

    </table>
    <a href="pdf\pdfreticula.php" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
</div>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Registrar Reticula</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="reticula">Nombre de la Reticula</label>
                        <input class="form-control" list="reticula" name="reticula" id="reticula" placeholder="Nombre de la Reticula" required>
                    </div>
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
                        <label for="semestre">Semestre</label>
                        <input class="form-control" list="semestres" name="semestre" id="semestre" placeholder="Selecione el Semestre" required>
						<datalist id="semestres">
							<option value="PRIMERO"></option>
							<option value="SEGUNDO"></option>
							<option value="TERCERO"></option>
							<option value="CUARTO"></option>
							<option value="QUINTO"></option>
							<option value="SEXTO"></option>
							<option value="SEPTIMO"></option>
							<option value="OCTAVO"></option>
							<option value="NOVENO"></option>
							<option value="DECIMO"></option>
						</datalist>
                    </div>
					<div class="form-group">
                        <label for="materia">ID Materia</label>
                        <input class="form-control" list="materias" name="materia" id="materia" placeholder="ID Materia" required>
                        <datalist id="materias">
                                        <?php
                                            $consulta = "SELECT * FROM asignatura";
                                            $resultado = mysqli_query($conexion , $consulta);
                                            while($carrera = mysqli_fetch_assoc($resultado)){;?>
                                            <option value="<?php echo $carrera["idasignatura"]; ?>">Materia: <?php echo $carrera["asignatura"]; ?></option>
                                        <?php }?>
                                    </datalist>
                    </div>
                    <input type="submit" value="Registrar Reticula" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>
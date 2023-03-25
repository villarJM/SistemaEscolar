<?php include_once "includes/header.php";
include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "alumnos";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN permisousuario d ON p.idpermiso = d.idpermiso WHERE d.idusuario = $id_user AND p.permiso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['idnumcon']) || empty($_POST['nombre']) || empty($_POST['apellido'])) {
        $alert = '<div class="alert alert-danger" role="alert">
        Todo los campos son obligatorios
        </div>';
    } else {
        $numcontrol = $_POST['idnumcon'];
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $edad = $_POST['edad'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $semestre = $_POST['semestre'];
        $turno = $_POST['turno'];
        $contrasena = md5($numcontrol);
        $queryAlumno = mysqli_query($conexion, "INSERT INTO `alumnos` (`idnumcon`, `idmatricula`, `nombre`, `apellido`, `edad`, `email`, `telefono`, `turno`) VALUES ($numcontrol, $matricula, '$nombre', '$apellido', $edad, '$email', $telefono, '$turno')");
        if($queryAlumno){
            $queryUsuario = mysqli_query($conexion, "INSERT INTO `usuarios` (`idusuario`, `nombre`, `usuario`, `contrasena`, `estado`) VALUES ($numcontrol, '$nombre $apellido', '$nombre', '$contrasena', 1)");
            if($queryUsuario){
                $queryPermiso = mysqli_query($conexion, "INSERT INTO permisousuario (idpermiso, idusuario) VALUES (4, $numcontrol), (5, $numcontrol)");
                if($queryPermiso){
                    //Cargar Matéria
                    $consult = "SELECT a.idasignatura FROM asignatura a INNER JOIN asignaturacarrera ac ON a.idasignatura = ac.idasignatura WHERE ac.idmatricula = $matricula";
                    $queryAsig = mysqli_query($conexion, $consult);
                    $queryInsert;
                    while($asignar = mysqli_fetch_assoc($queryAsig)){
                        $idmateria = $asignar['idasignatura'];
                        echo $idmateria;
                        $queryInsert = mysqli_query($conexion, "INSERT INTO `asignaturaalumno` (`idasignatura`, `idnumcon`) VALUES ('$idmateria', $numcontrol)");
                    }
                    $alert = '<div class="alert alert-primary" role="alert">
                        Alumno registrado
                    </div>';
                    header("Location: registrar_alumno.php");
                }
            }
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                    Error al registrar
                </div>';
        }
    }
}
?>
<button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevo_cliente"><i class="fas fa-plus"></i></button>
<?php echo isset($alert) ? $alert : ''; ?>
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>No. Control</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Edad</th>
                <th>Carrera</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Turno</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT a.idnumcon, a.nombre, a.apellido, a.edad, c.carrera, a.email, a.telefono, a.turno FROM alumnos a INNER JOIN carrera c ON a.idmatricula = c.idmatricula INNER JOIN usuarios u ON a.idnumcon = u.idusuario");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
            ?>
                    <tr>
                        <td><?php echo $data['idnumcon']; ?></td>
                        <td><?php echo $data['nombre']; ?></td>
                        <td><?php echo $data['apellido']; ?></td>
                        <td><?php echo $data['edad']; ?></td>
                        <td><?php echo $data['carrera']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['telefono']; ?></td>
                        <td><?php echo $data['turno']; ?></td>
                        <td>
                            <?php ?>
                                <a href="editar_cliente.php?id=<?php echo $data['idnumcon']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                <form action="eliminar_cliente.php?id=<?php echo $data['idnumcon']; ?>" method="post" class="confirmar d-inline">
                                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                </form>
                            <?php?>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <a href="pdf/pdfalumnos.php" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
</div>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Registrar Alumno</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <form action="" method="post" autocomplete="on">
        <?php echo isset($alert) ? $alert : ''; ?>
        <div class="form-group"><h3 class="text-center">Registrar Alumno</h3></div>
        <div class="form-group">
            <label for="idnumcon">No. Control</label>
            <input type="number" class="form-control" placeholder="Ingrese el No. Control" name="idnumcon" id="idnumcon">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" placeholder="Ingrese Nombre" name="nombre" id="nombre">
        </div>
        <div class="form-group">
            <label for="apellido">Apellidos</label>
            <input type="text" class="form-control" placeholder="Ingrese el Apellido" name="apellido" id="apellido">
        </div>
        <div class="form-group">
            <label for="edad">Edad</label>
            <input type="number" class="form-control" placeholder="Ingrese la Edad" name="edad" id="edad">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="number" class="form-control" placeholder="Ingrese el Telefono" name="telefono" id="telefono">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Ingrese el Email">
        </div>
        <div class="form-group"><h3 class="text-center">Datos de Carrera</h3></div>
        <div class="form-group">
            <label for="matricula">Matricula de la Carrera</label>
            <input type="number" class="form-control" list="matriculas" placeholder="Selecione la Matrícula" required name="matricula" id="matricula">
            <datalist id="matriculas">
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
            <label for="turno">Turno</label>
            <input type="text" class="form-control" list="turnos" name="turno" id="turno" placeholder="Selecione el Turno">
            <datalist id="turnos">
                <option value="MATUTINO">
                <option value="VERPERTINO">
            </datalist>
    </div>
        <input type="submit" value="Registrar" class="btn btn-primary">
    </form>
</div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>
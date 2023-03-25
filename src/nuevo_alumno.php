<?php 
ob_start();
include_once "includes/header.php";
include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "nuevo_alumno";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN permisousuario d ON p.idpermiso = d.idpermiso WHERE d.idusuario = $id_user AND p.permiso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
echo "HOLA";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['control']) || empty($_POST['matricula']) || empty($_POST['carrera']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['edad']) || empty($_POST['email']) || empty($_POST['tel_cliente'])) {
        $alert = '<div class="alert alert-danger" role="alert">
        Todo los campos son obligatorios
        </div>';
    } else {
        
        $numcontrol = $_POST['control'];
        echo $numcontrol;
        $matricula = $_POST['matricula'];
        $carrera = $_POST['carrera'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $edad = $_POST['edad'];
        $email = $_POST['email'];
        $telefono = $_POST['tel_cliente'];
        $semestre = $_POST['semestre'];
        $claveasign = $_POST['clave_asig'];
        $nomasign = $_POST['nom_asig'];
        $docente = $_POST['docente'];
        $grupo = $_POST['grupo'];
        $turno = $_POST['turno'];

        $query_consult = mysqli_query($conexion, "SELECT * FROM grupo WHERE grupo = '$grupo'");
        $data = mysqli_fetch_assoc($query_consult);
        $idgrupo = $data['idgrupo'];

        $query_consult = mysqli_query($conexion, "SELECT * FROM profesores WHERE nombre = '$docente'");
        $dos = mysqli_fetch_assoc($query_consult);
        $idprofesor = $dos['idprofesor'];

        $query = mysqli_query($conexion, "INSERT INTO `alumnos` (`idnumcon`, `idmatricula`, `nombre`, `apellido`, `edad`, `email`, `telefono`, `semestre`, `turno`) VALUES ($numcontrol, $matricula, '$nombre', '$apellido', $edad, '$email', $telefono, '$semestre', '$turno')");
        $query = mysqli_query($conexion, "INSERT INTO `grupos` (`idmatricula`, `idprofesor`, `idnumcon`, `idasignatura`, `idgrupo`) VALUES ($matricula, $idprofesor, $numcontrol, '$claveasign', $idgrupo)");
        $query = mysqli_query($conexion, "INSERT INTO `usuarios` (`idusuario`, `nombre`, `usuario`, `contrasena`, `estado`) VALUES ($numcontrol, '$nombre.` `.$apellido', '$nombre', '$numcontrol', 1)");
        $query = mysqli_query($conexion, "INSERT INTO permisousuario(idusuario, idpermiso) VALUES ($numcontrol, 4), ($numcontrol, 5)");

        //Cargar Matéria
        $query = mysqli_query($conexion, "SELECT a.idasignatura FROM asignatura a INNER JOIN asignaturacarrera ac ON a.idasignatura = ac.idasignatura WHERE a.idmatricula = $matricula");
        $contador=0;
        while($asignar = mysqli_fetch_assoc($query)){ $contador++;
            $idmateria = $asignar['idasignatura'];
            echo $idmateria;
            $query = mysqli_query($conexion, "INSERT INTO `asignaturaalumno` (`idasignatura`, `idnumcon`) VALUES ('$idmateria', $numcontrol)");
        }
        if ($query) {
            $alert = '<div class="alert alert-primary" role="alert">
                        Usuario registrado
                    </div>';
            header("Location: usuarios.php");
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                    Error al registrar
                </div>';
        }
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <h4 class="text-center">Registrar Nuevo Alumno</h4>
        </div>
        <div class="card">
        <div class="form-group">
            <h5 class="text-center">Datos Personales</h5>
        </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>No. Control</label>
                                <input class="form-control" id="control" name="control" type="number" placeholder="Ingrese el Número de Control" required/>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese Nombre del Alumno" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese el Apellido" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Edad</label>
                                <input type="number" name="edad" id="edad" class="form-control" placeholder="Ingrese la Edad" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="number" name="tel_cliente" id="tel_cliente" class="form-control" placeholder="Ingrese el Teléfono" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Ingrese el Email" required>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="card">
        <div class="form-group">
            <h5 class="text-center">Dato de Carrera</h5>
        </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="browser" class="form-label">Matricula</label>
                                    <input class="form-control" list="matriculas" name="matricula" id="matricula" placeholder="Selecione la Matrícula" required>
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
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="browser" class="form-label">Nombre de la Carrera</label>
                                    <input class="form-control" list="carreras" name="carrera" id="carrera" placeholder="Selecione la Carrera" required>
                                    <datalist id="carreras">
                                        <?php
                                            $consulta = "SELECT * FROM carrera";
                                            $resultado = mysqli_query($conexion , $consulta);
                                            $contador=0;
                                            while($carrera = mysqli_fetch_assoc($resultado)){ $contador++;?>
                                            <option value="<?php echo $carrera["carrera"]; ?>">Matricula: <?php echo $carrera["idmatricula"]; ?></option>
                                        <?php }?>
                                    </datalist>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Semestre</label>
                                <input type="text" name="semestre" id="semestre" class="form-control" placeholder="Ingrese el Semestre" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="browser" class="form-label">Turno</label>
                                    <input class="form-control" list="turnos" name="turno" id="turno" placeholder="Selecione el Turno" required>
                                    <datalist id="turnos">
                                        <option value="MATUTINO">
                                        <option value="VERPERTINO">
                                    </datalist>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="container">            
                    <button type="submit" class="btn btn-info btn-block"><h3>Registrar</h3></button>
                </div>
        </div>
</div>
<?php include_once "includes/footer.php"; ?>
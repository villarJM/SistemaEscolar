<?php
ob_start();
include_once "includes/header.php";
require "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "grupo";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN permisousuario d ON p.idpermiso = d.idpermiso WHERE d.idusuario = $id_user AND p.permiso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['grupo']) || empty($_POST['idalumno']) || empty($_POST['idmateria']) || empty($_POST['idprofesor'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
    } else {
        $grupo = $_POST['grupo'];
        $idalumno = $_POST['idalumno'];
        $idmateria = $_POST['idmateria'];
        $idprofesor = $_POST['idprofesor'];
        $usuario_id = $_SESSION['idUser'];
        $result = 0;
        $query = mysqli_query($conexion, "SELECT * FROM grupos WHERE idnumcon = $idalumno AND grupo = '$grupo' AND idasignatura = '$idmateria'");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            echo $alert = '<div class="alert alert-danger" role="alert">
                                    El alumno ya pertenece a un grupo
                                </div>';
        } else {
            $idgrupo = $_REQUEST['id'];
            $sql_update = mysqli_query($conexion, "UPDATE grupos SET idasignatura = '$idmateria', idprofesor = '$idprofesor', idnumcon = $idalumno, grupo = '$grupo' WHERE idgrupo = $idgrupo");
            echo $alert = '<div class="alert alert-success" role="alert">Grupo Actualizado</div>';
        }
    }
}

// Mostrar Datos
if (empty($_REQUEST['id'])) {
    header("Location: registrar_profesores.php");
}
$idgrupo = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT g.grupo, a.idnumcon, ag.idasignatura, p.idprofesor FROM grupos g INNER JOIN alumnos a ON g.idnumcon = a.idnumcon INNER JOIN asignatura ag ON g.idasignatura = ag.idasignatura INNER JOIN profesores p ON g.idprofesor = p.idprofesor WHERE g.idgrupo = $idgrupo");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header("Location: registrar_grupo.php");
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $grupo = $data['grupo'];
        $idalumno = $data['idnumcon'];
        $idmateria = $data['idasignatura'];
        $idprofesor = $data['idprofesor'];

    }
}
?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Modificar Grupo
            </div>
            <div class="card-body">
            <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="grupo">Grupo</label>
                        <input class="form-control" list="grupos" name="grupo" id="grupo" placeholder="Seleccione el Grupo" value="<?php echo $grupo; ?>" required>
                        <datalist id="grupos">
                            <option value="A"></option>
                            <option value="B"></option>
                            <option value="C"></option>
                            <option value="D"></option>
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="idalumno">ID Alumno</label>
                        <input class="form-control" list="idalumnos" name="idalumno" id="idalumno" placeholder="Seleccione el Alumno" value="<?php echo $idalumno; ?>"  required>
                        <datalist id="idalumnos">
                            <?php
                                $consulta = "SELECT * FROM alumnos";
                                $resultado = mysqli_query($conexion , $consulta);
                                while($alumnos = mysqli_fetch_assoc($resultado)){?>
                                <option value="<?php echo $alumnos["idnumcon"]; ?>">Nombre: <?php echo $alumnos["nombre"].' '.$alumnos["apellido"]; ?></option>
                            <?php }?>
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="idmateria">ID Materia</label>
                        <input class="form-control" list="idmaterias" name="idmateria" id="idmateria" placeholder="Seleccione la Materia" value="<?php echo $idmateria; ?>" requiered>
                        <datalist id="idmaterias">
                            <?php
                                $consulta = "SELECT * FROM asignatura";
                                $resultado = mysqli_query($conexion , $consulta);
                                while($materias = mysqli_fetch_assoc($resultado)){?>
                                <option value="<?php echo $materias["idasignatura"]; ?>">Materia: <?php echo $materias["asignatura"]; ?></option>
                            <?php }?>
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="idprofesor">ID Profesor</label>
                        <input class="form-control" list="idprofesors" name="idprofesor" id="idprofesor" placeholder="Seleccione el Profesor" value="<?php echo $idprofesor; ?>" requiered>
                        <datalist id="idprofesors">
                            <?php
                                $consulta = "SELECT * FROM profesores";
                                $resultado = mysqli_query($conexion , $consulta);
                                while($profesors = mysqli_fetch_assoc($resultado)){?>
                                <option value="<?php echo $profesors["idprofesor"]; ?>">Nombre: <?php echo $profesors["nombre"].' '.$profesors["apellido"]; ?></option>
                            <?php }?>
                        </datalist>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                    <a href="registrar_grupo.php" class="btn btn-danger">Atras</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>
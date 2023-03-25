<?php
require "../conexion.php";
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $datos = array();
    $queryAlumno = mysqli_query($conexion, "SELECT * FROM Alumnos WHERE idmatricula = $id");
    while ($row = mysqli_fetch_assoc($queryAlumno)) {
        $data['idmatricula'] = $row['idmatricula'];
        $data['idnumcon'] = $row['idnumcon'];
        $data['nombrea'] = $row['nombre'];
        array_push($datos, $data);
    }
    echo json_encode($datos);
    die();
} else if (isset($_GET['idnum'])) {
    $dato = array();
    $idalumno = $_GET['idnum'];
    $idmateria = $_GET['idmate'];
    $idprofesor = $_GET['idprof'];
    $grupo = $_GET['grup'];
    $datos = [$idalumno, $idmateria, $idprofesor, $grupo];
    $queryGrupo = mysqli_query($conexion, "INSERT INTO `grupos` (`idasignatura`, `idprofesor`, `idnumcon`, `grupo`) VALUES ('$idmateria', '$idprofesor', $idalumno, '$grupo')");
    array_push($dato, $datos);
    echo json_encode($dato);
    die();
} else if (isset($_GET['idmat'])) {
    $id = $_GET['idmat'];
    $datosM = array();
    $queryAlumno = mysqli_query($conexion, "SELECT a.idasignatura, a.asignatura FROM asignaturacarrera ag INNER JOIN asignatura a ON ag.idasignatura = a.idasignatura WHERE ag.idmatricula = $id");
    while ($row = mysqli_fetch_assoc($queryAlumno)) {
        $data['idasignatura'] = $row['idasignatura'];
        $data['asignatura'] = $row['asignatura'];
        array_push($datosM, $data);
    }
    echo json_encode($datosM);
    die();
} else if (isset($_GET['idpro'])) {
    $id = $_GET['idpro'];
    $datosP = array();
    $queryAlumno = mysqli_query($conexion, "SELECT idprofesor, nombrep FROM profesores WHERE idmatricula = $id");
    while ($row = mysqli_fetch_assoc($queryAlumno)) {
        $data['idprofesor'] = $row['idprofesor'];
        $data['profesor'] = $row['nombrep'];
        array_push($datosP, $data);
    }
    echo json_encode($datosP);
    die();
}
?>
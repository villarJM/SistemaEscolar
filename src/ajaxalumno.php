<?php
require "../conexion.php";
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $datos = array();
    $queryAlumno = mysqli_query($conexion, "SELECT * FROM Alumnos WHERE idmatricula = '$id'");
    while ($row = mysqli_fetch_assoc($queryAlumno)) {
        $data['idmatricula'] = $row['idmatricula'];
        $data['idnumcon'] = $row['idnumcon'];
        $data['nombrea'] = $row['nombre'];
        array_push($datos, $data);
    }
    echo json_encode($datos);
    die();
} else if (isset($_GET['idnum'])) {
    $alertG = array();
    $alert;
    if (empty($_GET['idnum']) || empty($_GET['idmate']) || empty($_GET['grup']) || empty($_GET['idprof']) || empty($_GET['idsem'])) {
        $alert = "empty";
    } else {
        $idalumno = $_GET['idnum'];
        $idmateria = $_GET['idmate'];
        $idprofesor = $_GET['idprof'];
        $idgrupo = $_GET['grup'];
        $idsemestre = $_GET['idsem'];
        $query = mysqli_query($conexion, "SELECT * FROM grupos WHERE idnumcon = $idalumno AND idgrupo = '$idgrupo' AND idasignatura = '$idmateria'");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = "occupied";
        } else {
            $queryGrupo = mysqli_query($conexion, "INSERT INTO `grupos` (`idgrupo`,`idasignatura`, `idprofesor`, `idnumcon`, `idsemestre`) VALUES ('$idgrupo','$idmateria', '$idprofesor', $idalumno, $idsemestre)");
            if ($queryGrupo) {
                $alert = true;
            } else {
                $alert = false;
            }
        }
    }
    array_push($alertG, $alert);
    echo json_encode($alertG);
    die();
} else if (isset($_GET['idmat'])) {
    $id = $_GET['idmat'];
    $idsemestre = $_GET['ids'];
    $datosM = array();
    $queryAlumno = mysqli_query($conexion, "SELECT a.idasignatura, a.asignatura FROM asignaturacarrera ag INNER JOIN asignatura a ON ag.idasignatura = a.idasignatura WHERE ag.idmatricula = '$id' AND a.idsemestre = $idsemestre");
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
    $queryAlumno = mysqli_query($conexion, "SELECT idprofesor, nombrep FROM profesores WHERE idmatricula = '$id'");
    while ($row = mysqli_fetch_assoc($queryAlumno)) {
        $data['idprofesor'] = $row['idprofesor'];
        $data['profesor'] = $row['nombrep'];
        array_push($datosP, $data);
    }
    echo json_encode($datosP);
    die();
}
?>
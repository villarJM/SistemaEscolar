<?php
ob_start(); 
include_once "includes/header.php";
include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "grupo";
$idhorario;
global $idgrupo;
$idprofesor;

$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN permisousuario d ON p.idpermiso = d.idpermiso WHERE d.idusuario = $id_user AND p.permiso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
?>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevo_cliente"><i class="fas fa-plus"></i></button>
<?php echo isset($alert) ? $alert : ''; ?>
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Grupo</th>
                <th>Nom. del Alumno</th>
                <th>Materia</th>
                <th>Nom. del Profesor</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT g.idgrupo, g.grupo, a.nombre, a.apellido, ag.asignatura, p.nombrep, p.apellidop FROM grupos g INNER JOIN alumnos a ON g.idnumcon = a.idnumcon INNER JOIN asignatura ag ON g.idasignatura = ag.idasignatura INNER JOIN profesores p ON g.idprofesor = p.idprofesor");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
            ?>
                    <tr>
                        <td><?php echo $data['idgrupo']; ?></td>
                        <td><?php echo $data['grupo']; ?></td>
                        <td><?php echo $data['nombre'].' '.$data['apellido']; ?></td>
                        <td><?php echo $data['asignatura']; ?></td>
                        <td><?php echo $data['nombrep'].' '.$data['apellidop']; ?></td>
                        <td>
                                <a href="editar_grupo.php?id=<?php echo $data['idgrupo'];?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                <form action="eliminar_grupo.php?id=<?php echo $data['idgrupo']; ?>" method="post" class="confirmar d-inline">
                                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                </form>
                            
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <a href="pdf/pdfgrupo.php" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
</div>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Registrar Grupos</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="grupo">Grupo</label>
                        <input class="form-control" list="grupos" name="grupo" id="grupo" placeholder="Seleccione el Grupo." required>
                        <datalist id="grupos">
                            <option value="A"></option>
                            <option value="B"></option>
                            <option value="C"></option>
                            <option value="D"></option>
                        </datalist>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="carrera">Carrera</label>
                            <input class="form-control" list="carreras" name="carrera" id="carrera" placeholder="Seleccione la Carrera." required>
                            <datalist id="carreras">
                                <?php
                                    $consulta = "SELECT * FROM carrera";
                                    $resultado = mysqli_query($conexion , $consulta);
                                    $contador=0;
                                    while($carrera = mysqli_fetch_assoc($resultado)){?>
                                    <option id="car" value="<?php echo $carrera["idmatricula"]; ?>">Carrera: <?php echo $carrera["carrera"]; ?></option>
                                <?php }?>
                            </datalist>
                            <script type="text/javascript" src="js/JQfunciones.js"></script>
                        </div>
                        <div class="col-lg-4">
                            <button type="button" class="btn btn-primary" id="idcar" >Cargar</button>
                        </div>
                        </div>
                        <hr>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Alumno</th>
                                        <th>Materia</th>
                                        <th>Profesor</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-group-divider datos">
                                        
                                    </tbody>
                            </table>
                            <div class="alerta">
                                
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>
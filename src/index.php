<?php 
include_once "includes/header.php";
require "../conexion.php";
$usuarios = mysqli_query($conexion, "SELECT * FROM usuarios");
$totalU= mysqli_num_rows($usuarios);
$clientes = mysqli_query($conexion, "SELECT * FROM profesores");
$totalC = mysqli_num_rows($clientes);
$productos = mysqli_query($conexion, "SELECT * FROM alumnos");
$totalP = mysqli_num_rows($productos);
$ventas = mysqli_query($conexion, "SELECT * FROM carrera");
$totalV = mysqli_num_rows($ventas);
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray">Panel de Administración</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <a class="col-xl-3 col-md-6 mb-4" href="usuarios.php">
            <div class="card border-left-primary shadow h-100 py-2 bg-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Usuarios</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?php echo $totalU; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Earnings (Monthly) Card Example -->
        <a class="col-xl-3 col-md-6 mb-4" href="clientes.php">
            <div class="card border-left-success shadow h-100 py-2 bg-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Profesores</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?php echo $totalC; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Earnings (Monthly) Card Example -->
        <a class="col-xl-3 col-md-6 mb-4" href="productos.php">
            <div class="card border-left-info shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Alumnos</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-white"><?php echo $totalP; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Pending Requests Card Example -->
        <a class="col-xl-3 col-md-6 mb-4" href="ventas.php">
            <div class="card border-left-warning bg-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Carrera</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?php echo $totalV; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-white-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <div class="container" >
        <div class="card shadow h-100 py-2 " style="width: 60rem,justify-content: center;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div style="width: 1000px;" class="col-auto">
                        <canvas id="myChart"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                        
                        (async () => {
                        // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
                        const respuestaRaw = await fetch("datos.php");
                        // Decodificar como JSON
                        const respuesta = await respuestaRaw.json();
                        // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
                        // Obtener una referencia al elemento canvas del DOM
                        const ctx = document.getElementById('myChart');
                        const etiquetas = respuesta.etiquetas; // <- Aquí estamos pasando el valor traído usando AJAX
                        // Podemos tener varios conjuntos de datos. Comencemos con uno
                        const datosBD = {
                            // label: "Ventas por mes",
                            // Pasar los datos igualmente desde PHP
                            data: respuesta.datos, // <- Aquí estamos pasando el valor traído usando AJAX
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                            borderWidth: 1, // Ancho del borde
                        };
                        
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                            labels: etiquetas,
                            datasets: [datosBD]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                yAxes: [{
                                    display: true,
                                    ticks: {
                                        beginAtZero: true,
                                        max: 10,
                                        min: 0
                                    }
                                }]
                            }
                            }
                        });
                    })();
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once "includes/footer.php"; ?>
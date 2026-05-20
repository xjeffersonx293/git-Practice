<?php
session_start();
include("php/conexion.php");

//Consulta sucursales
$sql="SELECT * FROM sucursales";
$resultado=$conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales - Ferretería Don Toño</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <link rel="stylesheet" href="styles/style.css">
</head>

<body>



<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <a class="navbar-brand" href="index.php">Ferretería Don Toño</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="#">Sucursales</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Precios</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="productos.php">Herramientas</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">Construcción</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">Techos</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="ms-auto">

                <?php if(isset($_SESSION['usuario_id'])): ?>

                    <div class="dropdown">

                        <a class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <i class="fa-solid fa-circle-user me-2"></i>

                            <?php echo $_SESSION['nombre']; ?>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fa-solid fa-id-card me-2"></i>
                                    Perfil
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item text-danger" href="php/logout.php">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                                    Cerrar sesión
                                </a>
                            </li>

                        </ul>
                    </div>

                <?php else: ?>

                    <a class="btn btn-outline-primary me-2" href="login.html">Login</a>

                    <a class="btn btn-primary" href="registro.html">Registrarse</a>

                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <h2 class="mb-4">Nuestras Sucursales</h2>

    <div class="row">

        <?php while($sucursales=$resultado->fetch_assoc()): ?>

            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow-sm">

                    <img src="img/sucursales/<?php echo $sucursales['imagen']; ?>" class="card-img-top" alt="<?php echo $sucursales['nombre']; ?>">

                    <div class="card-body">

                        <h5 class="card-title">
                            <?php echo $sucursales['nombre']; ?>
                        </h5>

                        <p class="card-text">
                            <?php echo $sucursales['descripcion']; ?>
                        </p>

                        <p class="fw-bold text-primary">
                            <?php echo $sucursales['ubicacion']; ?>
                        </p>

                        <a href="#" class="btn btn-primary">Ver más</a>

                    </div>
                </div>
            </div>

        <?php endwhile; ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>

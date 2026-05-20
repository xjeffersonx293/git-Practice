<?php
session_start();

include("../php/conexion.php");

// 🔐 SOLO ADMIN
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// CONSULTA PRODUCTOS
$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ver Productos</title>

    <!-- BOOTSTRAP -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- FONT AWESOME -->
    <link 
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    >
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">

            <span class="navbar-brand">
                Admin - Productos
            </span>

            <a href="dashboard.php" class="btn btn-secondary">
                Volver
            </a>

        </div>
    </nav>

    <!-- CONTENIDO -->
    <div class="container mt-5">

        <h2 class="mb-4">Lista de Productos</h2>

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php while($producto = $resultado->fetch_assoc()): ?>

                    <tr>

                        <!-- ID -->
                        <th scope="row">
                            <?php echo $producto['id']; ?>
                        </th>

                        <!-- IMAGEN -->
                        <td>
                            <img 
                                src="../img/productos/<?php echo $producto['imagen']; ?>"
                                width="60"
                                alt="Producto"
                            >
                        </td>

                        <!-- NOMBRE -->
                        <td>
                            <?php echo $producto['nombre']; ?>
                        </td>

                        <!-- PRECIO -->
                        <td>
                            $<?php echo $producto['precio']; ?>
                        </td>

                        <!-- STOCK -->
                        <td>
                            <?php echo $producto['stock']; ?>
                        </td>

                        <!-- ACCIONES -->
                        <td>

                            <!-- EDITAR -->
                            <a 
                                href="editar-productos.php?id=<?php echo $producto['id']; ?>"
                                class="btn btn-warning btn-sm"
                            >
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- ELIMINAR -->
                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#eliminarModal"
                                data-id="<?php echo $producto['id']; ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <!-- MODAL ELIMINAR --> 
                            <div class="modal fade" id="eliminarModal" tabindex="-1"> 
                            
                                <div class="modal-dialog"> 
                                    <div class="modal-content"> 
                            
                                        <div class="modal-header"> 
                                            <h5 class="modal-title"> 
                                                Confirmar eliminación 
                                            </h5> 
                            
                                            <button type="button" 
                                                    class="btn-close" 
                                                    data-bs-dismiss="modal"> 
                                            </button> 
                                        </div> 
                            
                                        <div class="modal-body"> 
                                            ¿Seguro que deseas eliminar este producto? 
                                        </div> 
                            
                                        <div class="modal-footer"> 
                            
                                            <button type="button" 
                                                    class="btn btn-secondary" 
                                                    data-bs-dismiss="modal"> 
                                                Cancelar 
                                            </button> 
                            
                                            <a href="" 
                                            id="btnEliminar" 
                                            class="btn btn-danger"> 
                                                Eliminar 
                                            </a> 
                            
                                        </div> 
                            
                                    </div> 
                                </div> 
                            
                            </div> 


                        </td>

                    </tr>

                <?php endwhile; ?>

            </tbody>

        </table>

    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
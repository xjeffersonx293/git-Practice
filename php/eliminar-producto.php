<?php
session_start();

include("../php/conexion.php");

// ==============================
// SOLO ADMIN
// ==============================
if (
    !isset($_SESSION['usuario_id']) ||
    $_SESSION['rol'] != 'admin'
) {
    header("Location: ../index.php");
    exit();
}

// ==============================
// VALIDAR ID
// ==============================
if (!isset($_GET['id'])) {
    header("Location: ver_productos.php");
    exit();
}

$id = $_GET['id'];

// ==============================
// OBTENER IMAGEN DEL PRODUCTO
// ==============================
$sqlImagen = "SELECT imagen FROM productos WHERE id = ?";

$stmtImagen = $conn->prepare($sqlImagen);
$stmtImagen->bind_param("i", $id);
$stmtImagen->execute();

$resultado = $stmtImagen->get_result();
$producto = $resultado->fetch_assoc();

// ==============================
// ELIMINAR IMAGEN DE LA CARPETA
// ==============================
if ($producto && !empty($producto['imagen'])) {

    $rutaImagen = "../img/productos/" . $producto['imagen'];

    if (file_exists($rutaImagen)) {
        unlink($rutaImagen);
    }
}

// ==============================
// ELIMINAR PRODUCTO DE LA BD
// ==============================
$sql = "DELETE FROM productos WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    header("Location: ver-productos.php");
    exit();

} else {

    echo "Error al eliminar el producto.";
}
?> 
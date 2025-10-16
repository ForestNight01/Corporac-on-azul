<?php
$host = 'localhost';
$user = 'pablo';
$pass = '12345678';
$db   = 'materiales';

// Conexión
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(" Conexión fallida: " . $conn->connect_error);
}

// Recibir datos

$producto = trim($_POST['producto']);


// Validar que el nombre no esté vacío
if ($producto === '') {
    echo " Nombre del producto no puede estar vacío.";
    exit;
}

// Preparar la consulta para actualizar por nombre
$sql = "delete from materiales where nombre =? and stock = 0";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo " Error al preparar la consulta: " . $conn->error;
    exit;
}


$stmt->bind_param("s", $producto);

// Ejecutar y dar respuesta
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "✅ Producto <strong>$producto</strong> Eliminado correctamente.";
    } else {
        echo "⚠️ No se encontró el producto con nombre: <strong>$nombre</strong>.";
    }
} else {
    echo "❌ Error al actualizar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<?php
$host = 'localhost';
$user = 'pablo';
$pass = '12345678';
$db   = 'materiales';

// Conexión
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("❌ Conexión fallida: " . $conn->connect_error);
}

// Recibir datos
$producto=trim($_POST['producto']);
$nombre = trim($_POST['nombre']);
$unidad = trim($_POST['medida']);
$precio = floatval($_POST['precio']);
$stock = intval($_POST['stock']);
$total = floatval($_POST['total']);

// Validar que el nombre no esté vacío
if ($producto === '') {
    echo " Nombre del producto no puede estar vacío.";
    exit;
}

// Preparar la consulta para actualizar por nombre
$sql = "UPDATE materiales
        SET nombre=?, unidad_medida = ?, precio = ?, stock = ?, total = ?
        WHERE nombre = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo " Error al preparar la consulta: " . $conn->error;
    exit;
}

// Asignar parámetros: unidad (s), precio (d), stock (i), total (d), nombre (s)
$stmt->bind_param("ssdids", $nombre, $unidad, $precio, $stock, $total, $producto);

// Ejecutar y dar respuesta
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "✅ Producto <strong>$nombre</strong> actualizado correctamente.";
    } else {
        echo "⚠️ No se encontró el producto con nombre: <strong>$nombre</strong>.";
    }
} else {
    echo "❌ Error al actualizar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

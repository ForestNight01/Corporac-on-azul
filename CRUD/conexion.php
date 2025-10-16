<?php
//Conexioin a base de datos 

$host = 'localhost';
$db   = 'materiales';
$user = 'pablo';
$pass = '12345678';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("❌ Conexión fallida: " . mysqli_connect_error());
}

echo "✅ Conexión exitosa con mysqli";

// Verifica si se recibieron los datos precio stock total
if (isset($_POST['nombre'])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $medida = htmlspecialchars($_POST['medida']);
    $precio = htmlspecialchars($_POST['precio']);
    $stock = htmlspecialchars($_POST['stock']);
    $total = htmlspecialchars($_POST['total']);
   
    

  $stmt = $conn->prepare("INSERT INTO materiales (nombre, unidad_medida, precio, stock,total) VALUES (?, ?, ?, ? , ?)");
  $stmt->bind_param("ssdid",$nombre, $medida, $precio, $stock, $total);

if (!$stmt) {
    die("Error en preparación: " . $conn->error);
}

$stmt->bind_param("ssdid",$nombre, $medida, $precio, $stock, $total);

if ($stmt->execute()) {
    echo "Material insertado correctamente";
} else {
    echo "Error en ejecución: " . $stmt->error;
}


   
} 
?>
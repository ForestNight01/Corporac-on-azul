<?php

$host = 'localhost';
$db   = 'materiales';
$user = 'pablo';
$pass = '12345678';
header('Content-Type: application/json');

$conn = mysqli_connect($host, $user, $pass, $db);





//mostrar


// Obtener el texto del buscador
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

$sql = "SELECT id, nombre, unidad_medida, precio, stock, total
        FROM materiales
        WHERE nombre LIKE ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(["error" => "Error al preparar la consulta: " . $conn->error]);
    exit;
}

$like = "%$nombre%";
$stmt->bind_param("s", $like);
$stmt->execute();

$result = $stmt->get_result();
$materiales = [];

while ($row = $result->fetch_assoc()) {
    $materiales[] = $row;
}

// Devolver los resultados como JSON
echo json_encode($materiales);

$stmt->close();
$conn->close();

?>
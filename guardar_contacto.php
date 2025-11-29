<?php
// guardar_contacto.php
require 'config/db.php';

// Verificar que la petición sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contacto.php');
    exit;
}

// Obtener y limpiar datos
$nombre     = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$correo     = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$asunto     = isset($_POST['asunto']) ? trim($_POST['asunto']) : '';
$comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';

// Validaciones básicas
if ($nombre === '' || $correo === '' || $asunto === '' || $comentario === '') {
    header('Location: contacto.php?error=1');
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    header('Location: contacto.php?error=1');
    exit;
}

try {
    $sql = "INSERT INTO contacto (fecha, correo, nombre, asunto, comentario)
            VALUES (NOW(), :correo, :nombre, :asunto, :comentario)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':correo'     => $correo,
        ':nombre'     => $nombre,
        ':asunto'     => $asunto,
        ':comentario' => $comentario,
    ]);

    // Redirigir con mensaje de éxito
    header('Location: contacto.php?exito=1');
    exit;

} catch (PDOException $e) {
    header('Location: contacto.php?error=1');
    exit;
}

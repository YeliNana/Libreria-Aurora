<?php
// admin_contacto_eliminar.php
require 'config/db.php';

if (!isset($_GET['id']) || $_GET['id'] === '') {
    die('Mensaje no especificado.');
}

$id = $_GET['id'];

// Eliminar el registro
$sql = "DELETE FROM contacto WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

header('Location: admin_contactos.php?msg=eliminado');
exit;

<?php
// admin_contacto_editar.php
$titulo_pagina = 'Editar mensaje de contacto';
$pagina = 'contacto';

require 'config/db.php';

// Validar ID
if (!isset($_GET['id']) || $_GET['id'] === '') {
    die('Mensaje no especificado.');
}

$id = $_GET['id'];

// Si envían el formulario (POST), actualizamos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre    = trim($_POST['nombre'] ?? '');
    $correo    = trim($_POST['correo'] ?? '');
    $asunto    = trim($_POST['asunto'] ?? '');
    $comentario = trim($_POST['comentario'] ?? '');

    if ($nombre === '' || $correo === '' || $asunto === '') {
        $error = 'Nombre, correo y asunto son obligatorios.';
    } else {
        $sql = "
            UPDATE contacto
            SET nombre = :nombre,
                correo = :correo,
                asunto = :asunto,
                comentario = :comentario
            WHERE id = :id
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':asunto' => $asunto,
            ':comentario' => $comentario,
            ':id' => $id,
        ]);

        header('Location: admin_contactos.php?msg=actualizado');
        exit;
    }
}

// Si es GET, obtenemos los datos actuales
$sql = "SELECT * FROM contacto WHERE id = :id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$mensaje = $stmt->fetch();

if (!$mensaje) {
    die('Mensaje no encontrado.');
}

require 'includes/header.php';
?>

<main class="py-5">
  <div class="container">
    <h1 class="h3 mb-4">Editar mensaje de contacto</h1>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="row">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <form method="POST">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input
                  type="text"
                  id="nombre"
                  name="nombre"
                  class="form-control"
                  value="<?= htmlspecialchars($mensaje['nombre']) ?>"
                  required
                >
              </div>

              <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input
                  type="email"
                  id="correo"
                  name="correo"
                  class="form-control"
                  value="<?= htmlspecialchars($mensaje['correo']) ?>"
                  required
                >
              </div>

              <div class="mb-3">
                <label for="asunto" class="form-label">Asunto</label>
                <input
                  type="text"
                  id="asunto"
                  name="asunto"
                  class="form-control"
                  value="<?= htmlspecialchars($mensaje['asunto']) ?>"
                  required
                >
              </div>

              <div class="mb-3">
                <label for="comentario" class="form-label">Comentario</label>
                <textarea
                  id="comentario"
                  name="comentario"
                  rows="4"
                  class="form-control"
                  required
                ><?= htmlspecialchars($mensaje['comentario']) ?></textarea>
              </div>

              <button type="submit" class="btn btn-primary">Guardar cambios</button>
              <a href="admin_contactos.php" class="btn btn-secondary">Cancelar</a>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<?php require 'includes/footer.php'; ?>

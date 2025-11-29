<?php
$titulo_pagina = 'Detalle del autor';
$pagina = 'autores';

require 'config/db.php';

if (!isset($_GET['id'])) {
    die("Autor no especificado.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM autores WHERE id_autor = :id LIMIT 1");
$stmt->execute([':id' => $id]);
$autor = $stmt->fetch();

require 'includes/header.php';
?>

<main class="py-5">
  <div class="container">

    <?php if (!$autor): ?>
      <div class="alert alert-danger">Autor no encontrado.</div>
      <a href="autores.php" class="btn btn-secondary">← Volver</a>
      <?php require 'includes/footer.php'; exit; ?>
    <?php endif; ?>

    <?php
      $nombre = $autor['nombre'] . ' ' . $autor['apellido'];
      $ciudad = $autor['ciudad'];
      $estado = $autor['estado'];
      $pais   = $autor['pais'];
      $telefono = $autor['telefono'];
      $direccion = $autor['direccion'];
      $contrato = $autor['contrato'] == 1 ? "Activo" : "No activo";
    ?>

    <div class="mb-3">
      <a href="autores.php" class="text-decoration-none small text-muted">← Volver a Autores</a>
    </div>

    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-3">
          <div class="card-body">
            <h1 class="h4 mb-2"><?= htmlspecialchars($nombre) ?></h1>

            <p class="text-muted mb-2">
              <?= htmlspecialchars($ciudad) ?>
              <?php if (!empty($estado)) echo ', ' . htmlspecialchars($estado); ?>
              · <?= htmlspecialchars($pais) ?>
            </p>

            <?php if (!empty($direccion)): ?>
              <p class="small mb-0">📍 <?= htmlspecialchars($direccion) ?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-3">
          <div class="card-body">
            <h5 class="h6 mb-3">Información del autor</h5>

            <p class="mb-2">
              <span class="small text-muted d-block">Teléfono</span>
              <?= htmlspecialchars($telefono) ?>
            </p>

            <p class="mb-2">
              <span class="small text-muted d-block">País</span>
              <?= htmlspecialchars($pais) ?>
            </p>

            <p class="mb-2">
              <span class="small text-muted d-block">Estado del contrato</span>
              <span class="badge <?= $contrato === 'Activo' ? 'bg-success' : 'bg-secondary' ?>">
                <?= $contrato ?>
              </span>
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<?php require 'includes/footer.php'; ?>

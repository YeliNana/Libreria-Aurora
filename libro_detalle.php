<?php
// libro_detalle.php

$titulo_pagina = 'Detalle del libro';
$pagina = 'libros';

require 'config/db.php';

// Validar que venga el parámetro GET "id"
if (!isset($_GET['id']) || $_GET['id'] === '') {
    die('Libro no especificado.');
}

$id_titulo = $_GET['id'];

// Buscar solo en la tabla titulos
$sql = "SELECT * FROM titulos
        WHERE id_titulo = :id_titulo
        LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_titulo' => $id_titulo]);
$libro = $stmt->fetch();

require 'includes/header.php';

// Función para traducir el tipo a algo más amigable
function traducirTipoDetalle($tipo) {
    switch ($tipo) {
        case 'business':      return 'Negocios';
        case 'popular_comp':  return 'Computación popular';
        case 'psychology':    return 'Psicología';
        case 'trad_cook':     return 'Cocina tradicional';
        case 'mod_cook':      return 'Cocina moderna';
        default:              return ucfirst($tipo);
    }
}

?>

<main class="py-5">
  <div class="container">

    <!-- Si no se encuentra el libro -->
    <?php if (!$libro): ?>
      <div class="alert alert-danger mb-4">
        No se encontró información para este libro.
      </div>
      <a href="libros.php" class="btn btn-secondary">← Volver al catálogo de libros</a>

    <?php else: ?>

      <!-- Breadcrumb / navegación -->
      <div class="mb-3">
        <a href="index.php" class="text-decoration-none small text-muted">Inicio</a>
        <span class="text-muted small"> / </span>
        <a href="libros.php" class="text-decoration-none small text-muted">Libros</a>
        <span class="text-muted small"> / </span>
        <span class="small">Detalle</span>
      </div>

      <div class="row g-4">
        <!-- Columna principal: título y descripción -->
        <div class="col-lg-8">
          <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
              <h1 class="h4 mb-2">
                <?= htmlspecialchars($libro['titulo']) ?>
              </h1>

              <?php if (!empty($libro['tipo'])): ?>
                <div class="mb-3">
                  <span class="badge bg-primary">
                    <?= htmlspecialchars(traducirTipoDetalle($libro['tipo'])) ?>
                  </span>
                </div>
              <?php endif; ?>

              <?php if (!empty($libro['notas'])): ?>
                <p class="mb-0">
                  <?= nl2br(htmlspecialchars($libro['notas'])) ?>
                </p>
              <?php else: ?>
                <p class="text-muted mb-0">
                  Este título no tiene una descripción detallada disponible.
                </p>
              <?php endif; ?>
            </div>
          </div>

          <a href="libros.php" class="btn btn-outline-primary">
            ← Volver al catálogo de libros
          </a>
        </div>

        <!-- Columna lateral: ficha técnica -->
        <div class="col-lg-4">
          <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
              <h2 class="h6 mb-3">Información del libro</h2>

              <p class="mb-2">
                <span class="text-muted small d-block">Precio</span>
                <strong>
                  <?php
                  echo $libro['precio'] !== null
                    ? '$' . number_format($libro['precio'], 2)
                    : 'No disponible';
                  ?>
                </strong>
              </p>

              <p class="mb-2">
                <span class="text-muted small d-block">Fecha de publicación</span>
                <span>
                  <?= htmlspecialchars(substr($libro['fecha_pub'], 0, 10)) ?>
                </span>
              </p>

              <p class="mb-2">
                <span class="text-muted small d-block">Categoría</span>
                <span>
                  <?= htmlspecialchars(traducirTipoDetalle($libro['tipo'])) ?>
                </span>
              </p>

              <p class="mb-0">
                <span class="text-muted small d-block">Estado del contrato</span>
                <span>
                  <?= $libro['contrato'] === '1' ? 'Activo' : 'No activo' ?>
                </span>
              </p>
            </div>
          </div>

          <div class="small text-muted">
            La información de este libro se carga directamente desde la base de datos de la librería Aurora.
          </div>
        </div>
      </div>

    <?php endif; ?>

  </div>
</main>

<?php require 'includes/footer.php'; ?>

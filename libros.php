<?php
// libros.php
$titulo_pagina = 'Libros';
$pagina = 'libros';

require 'includes/header.php';
require 'config/db.php';

// Obtener todos los libros
$stmt = $pdo->query("SELECT * FROM titulos");
$libros = $stmt->fetchAll();

// Totales usando count() y sizeof() (para requisitos del proyecto)
$total_libros_count  = count($libros);
$total_libros_sizeof = sizeof($libros);

// Función para traducir el tipo
function traducirTipo($tipo) {
    switch ($tipo) {
        case 'business':      return 'Negocios';
        case 'popular_comp':  return 'Computación popular';
        case 'psychology':    return 'Psicología';
        case 'trad_cook':     return 'Cocina tradicional';
        case 'mod_cook':      return 'Cocina moderna';
        default:              return ucfirst($tipo);
    }
}

// Función para clase de badge según tipo
function claseBadgeTipo($tipo) {
    switch ($tipo) {
        case 'business':      return 'bg-primary';
        case 'popular_comp':  return 'bg-success';
        case 'psychology':    return 'bg-warning text-dark';
        case 'trad_cook':     return 'bg-danger';
        case 'mod_cook':      return 'bg-info text-dark';
        default:              return 'bg-secondary';
    }
}

// Libros destacados para el carrusel (primeros 3)
$destacados = array_slice($libros, 0, 3);
?>

<main class="py-5">
  <div class="container">

    <!-- Encabezado -->
    <div class="row align-items-center mb-4">
      <div class="col-md-7">
        <h1 class="h3 mb-2">Catálogo de libros</h1>
        <p class="text-muted mb-0">
          Explora los libros disponibles en la librería Aurora y encuentra tu próxima lectura.
        </p>
      </div>
      <div class="col-md-5 mt-3 mt-md-0">
        <div class="card shadow-sm border-0">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div class="text-muted small">Libros disponibles</div>
              <div class="fs-4 fw-semibold"><?= $total_libros_count ?></div>
            </div>
            <div class="text-end small text-muted">
              Catálogo actualizado automáticamente desde la base de datos.
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Carrusel de libros destacados -->
    <?php if (!empty($destacados)): ?>
    <div id="carouselLibros" class="carousel slide mb-4" data-bs-ride="carousel">
      <div class="carousel-inner">

        <?php foreach ($destacados as $index => $libro): ?>
          <?php
            $tipo = $libro['tipo'];
            $claseBadge = claseBadgeTipo($tipo);
            $tipoES = traducirTipo($tipo);
          ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="card shadow-sm border-0">
              <div class="card-body d-md-flex align-items-center">
                <div class="flex-grow-1">
                  <h5 class="card-title mb-1">
                    <?= htmlspecialchars($libro['titulo']) ?>
                  </h5>
                  <?php if (!empty($libro['notas'])): ?>
                    <p class="card-text small mb-2 text-muted">
                      <?= htmlspecialchars(substr($libro['notas'], 0, 140)) ?><?= strlen($libro['notas']) > 140 ? '…' : '' ?>
                    </p>
                  <?php endif; ?>
                  <span class="badge <?= $claseBadge ?>">
                    <?= htmlspecialchars($tipoES) ?>
                  </span>
                </div>
                <div class="mt-3 mt-md-0 text-md-end">
                  <p class="mb-1 fw-semibold">
                    <?php
                    echo $libro['precio'] !== null
                      ? '$' . number_format($libro['precio'], 2)
                      : 'No disponible';
                    ?>
                  </p>
                  <p class="small text-muted mb-2">
                    Publicado: <?= htmlspecialchars(substr($libro['fecha_pub'], 0, 10)) ?>
                  </p>
                  <a
                    href="libro_detalle.php?id=<?= urlencode($libro['id_titulo']) ?>"
                    class="btn btn-sm btn-primary"
                  >
                    Ver detalles
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselLibros" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselLibros" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>
    <?php endif; ?>

    <!-- Buscador -->
    <div class="row mb-3">
      <div class="col-md-6">
        <div class="input-group">
          <span class="input-group-text">🔍</span>
          <input
            type="text"
            id="buscador-libros"
            class="form-control"
            placeholder="Buscar por título del libro..."
          >
        </div>
        <small class="text-muted">Escribe el nombre o parte del nombre del libro.</small>
      </div>
    </div>

    <!-- Grid de cards de libros -->
    <div class="row g-4" id="listado-libros">
      <?php foreach ($libros as $libro): ?>
        <?php
          $tipo = $libro['tipo'];
          $claseBadge = claseBadgeTipo($tipo);
          $tipoES = traducirTipo($tipo);
        ?>
        <div class="col-md-6 col-lg-4 libro-card">
          <div class="card h-100 shadow-sm" data-id="<?= htmlspecialchars($libro['id_titulo']) ?>">
            <div class="card-body d-flex flex-column">
              <div class="mb-2">
                <h5 class="card-title mb-1"><?= htmlspecialchars($libro['titulo']) ?></h5>
                <span class="badge <?= $claseBadge ?> mb-2">
                  <?= htmlspecialchars($tipoES) ?>
                </span>
                <?php if (!empty($libro['notas'])): ?>
                  <p class="card-text small text-muted mb-2">
                    <?= htmlspecialchars(substr($libro['notas'], 0, 100)) ?><?= strlen($libro['notas']) > 100 ? '…' : '' ?>
                  </p>
                <?php endif; ?>
              </div>

              <div class="mt-auto d-flex justify-content-between align-items-end">
                <div>
                  <div class="fw-semibold">
                    <?php
                    echo $libro['precio'] !== null
                      ? '$' . number_format($libro['precio'], 2)
                      : 'No disponible';
                    ?>
                  </div>
                  <div class="small text-muted">
                    <?= htmlspecialchars(substr($libro['fecha_pub'], 0, 10)) ?>
                  </div>
                </div>
                <a
                  href="libro_detalle.php?id=<?= urlencode($libro['id_titulo']) ?>"
                  class="btn btn-sm btn-primary"
                >
                  Ver detalles
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</main>

<?php require 'includes/footer.php'; ?>

<?php
// autores.php
$titulo_pagina = 'Autores';
$pagina = 'autores';

require 'includes/header.php';
require 'config/db.php';

// Obtener autores
$stmt = $pdo->query("SELECT * FROM autores");
$autores = $stmt->fetchAll();

$total = count($autores);
?>

<main class="py-5">
  <div class="container">

    <!-- Encabezado -->
    <div class="row align-items-center mb-4">
      <div class="col-md-7">
        <h1 class="h3 mb-2">Autores</h1>
        <p class="text-muted">
          Descubre a los escritores que dan vida a los libros de Aurora.
        </p>
      </div>
      <div class="col-md-5">
        <div class="card shadow-sm border-0">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div class="small text-muted">Total autores</div>
              <div class="fs-4 fw-semibold"><?= $total ?></div>
            </div>
            <div class="small text-muted text-end">
              Información cargada desde la base de datos.
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Buscador -->
    <div class="row mb-3">
      <div class="col-md-6">
        <div class="input-group">
          <span class="input-group-text">🔍</span>
          <input type="text" id="buscador-autores" class="form-control"
                 placeholder="Buscar autores por nombre, país o ciudad...">
        </div>
        <small class="text-muted">La búsqueda se hace en tu navegador con JavaScript.</small>
      </div>
    </div>

    <!-- GRID DE CARDS -->
    <div class="row g-4" id="grid-autores">

      <?php foreach ($autores as $autor): ?>
        <?php
          $nombre = $autor['nombre'] . ' ' . $autor['apellido'];
          $ciudad = $autor['ciudad'];
          $estado = $autor['estado'];
          $pais   = $autor['pais'];
          $telefono = $autor['telefono'];
          $contrato = $autor['contrato'] == 1 ? "Activo" : "No activo";
        ?>

        <div class="col-md-6 col-lg-4 autor-card">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column">

              <h5 class="fw-semibold mb-1"><?= htmlspecialchars($nombre) ?></h5>

              <p class="small text-muted mb-2">
                <?= htmlspecialchars($ciudad) ?>
                <?php if (!empty($estado)) echo ', ' . htmlspecialchars($estado); ?>
                <br>
                <?= htmlspecialchars($pais) ?>
              </p>

              <p class="small mb-2">📞 <?= htmlspecialchars($telefono) ?></p>

              <span class="badge <?= $contrato === "Activo" ? 'bg-success' : 'bg-secondary' ?>">
                <?= $contrato ?>
              </span>

              <div class="mt-auto pt-3 d-flex justify-content-end">
                <a
                  href="autor_detalle.php?id=<?= urlencode($autor['id_autor']) ?>"
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

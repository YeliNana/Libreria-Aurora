<?php
// admin_contactos.php
$titulo_pagina = 'Mensajes de contacto';
$pagina = 'contacto';

require 'includes/header.php';
require 'config/db.php';

// Obtener todos los mensajes de contacto
$sql = "SELECT * FROM contacto ORDER BY fecha DESC";
$stmt = $pdo->query($sql);
$mensajes = $stmt->fetchAll();
$total_mensajes = count($mensajes);
?>

<main class="py-5">
  <div class="container">
    <h1 class="h3 mb-3">Mensajes de contacto</h1>
    <a href="contacto.php" class="btn btn-primary">
    Enviar nuevo mensaje
  </a>
    <p class="text-muted mb-4">
      Aquí se muestran los mensajes enviados a través del formulario de contacto.
      Desde esta sección puedes editarlos o eliminarlos.
    </p>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'actualizado'): ?>
      <div class="alert alert-success">Mensaje actualizado correctamente.</div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'eliminado'): ?>
      <div class="alert alert-warning">Mensaje eliminado correctamente.</div>
    <?php endif; ?>

    <div class="card shadow-sm border-0 mb-3">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <span class="small text-muted d-block">Total de mensajes recibidos</span>
          <span class="fs-4 fw-semibold"><?= $total_mensajes ?></span>
        </div>
        <div class="small text-muted text-end">
          Datos cargados desde la tabla <code>contacto</code>.
        </div>
      </div>
    </div>

    <?php if ($total_mensajes === 0): ?>

      <div class="alert alert-info">
        Todavía no se ha recibido ningún mensaje de contacto.
      </div>

    <?php else: ?>

      <div class="table-responsive shadow-sm rounded-3 bg-white p-3">
        <table class="table table-striped align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Fecha</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Asunto</th>
              <th>Comentario</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($mensajes as $mensaje): ?>
            <tr>
              <td class="small text-muted">
                <?= htmlspecialchars($mensaje['fecha']) ?>
              </td>
              <td><?= htmlspecialchars($mensaje['nombre']) ?></td>
              <td class="small">
                <a href="mailto:<?= htmlspecialchars($mensaje['correo']) ?>">
                  <?= htmlspecialchars($mensaje['correo']) ?>
                </a>
              </td>
              <td><?= htmlspecialchars($mensaje['asunto']) ?></td>
              <td class="small">
                <?php
                  $texto = $mensaje['comentario'];
                  $resumen = mb_strlen($texto) > 60
                    ? mb_substr($texto, 0, 60) . '…'
                    : $texto;
                  echo nl2br(htmlspecialchars($resumen));
                ?>
              </td>
              <td>
                <a
                  href="admin_contacto_editar.php?id=<?= urlencode($mensaje['id']) ?>"
                  class="btn btn-sm btn-outline-primary mb-1"
                >
                  Editar
                </a>
                <a
                  href="admin_contacto_eliminar.php?id=<?= urlencode($mensaje['id']) ?>"
                  class="btn btn-sm btn-outline-danger mb-1"
                  onclick="return confirm('¿Seguro que deseas eliminar este mensaje?');"
                >
                  Eliminar
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    <?php endif; ?>

    <p class="small text-muted mt-3">
      Esta sección es para gestión interna de mensajes (CRUD). Los usuarios envían desde <code>contacto.php</code>
      y aquí se administran los registros almacenados en la base de datos.
    </p>
  </div>
</main>

<?php require 'includes/footer.php'; ?>

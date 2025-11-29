<?php
// contacto.php
$titulo_pagina = 'Contacto';
$pagina = 'contacto';

require 'includes/header.php';
?>

<main class="py-5">
  <div class="container">

    <div class="row justify-content-center mb-4">
      <div class="col-lg-8 text-center">
        <h1 class="h3 mb-2">Ponte en contacto con Aurora</h1>
        <p class="text-muted">
          ¿Tienes dudas sobre algún libro, autor o sobre la librería?
          Envíanos un mensaje y te responderemos lo antes posible.
        </p>
      </div>
    </div>

    <?php if (isset($_GET['exito']) && $_GET['exito'] == '1'): ?>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="alert alert-success">
            ✅ Tu mensaje se ha enviado correctamente. ¡Gracias por contactarnos!
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] == '1'): ?>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="alert alert-danger">
            ❌ Ocurrió un error al enviar el mensaje. Revisa los datos e inténtalo de nuevo.
          </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="row g-4 justify-content-center align-items-start">
      <!-- Formulario -->
      <div class="col-md-7">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h2 class="h5 mb-3">Formulario de contacto</h2>

            <form action="guardar_contacto.php" method="POST">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input
                  type="text"
                  id="nombre"
                  name="nombre"
                  class="form-control"
                  required
                >
              </div>

              <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input
                  type="email"
                  id="correo"
                  name="correo"
                  class="form-control"
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
                ></textarea>
              </div>

              <button type="submit" class="btn btn-primary w-100">
                Enviar mensaje
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Info lateral -->
      <!-- Info lateral -->
<div class="col-md-4">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h2 class="h6 mb-3">Información de contacto</h2>

      <p class="small text-muted mb-1">📍 Dirección:</p>
      <p class="small mb-3">
        Calle Aurora #123<br>
        Ciudad del Conocimiento
      </p>

      <p class="small text-muted mb-1">📞 Teléfono:</p>
      <p class="small mb-3">+1 (809) 555-1234</p>

      <p class="small text-muted mb-1">⏰ Horario:</p>
      <p class="small mb-3">Lunes a Sábado · 9:00 AM – 6:00 PM</p>

      <p class="small text-muted mb-1">🌐 Redes sociales:</p>
      <ul class="list-unstyled small mb-0">
        <li>📘 Facebook: <span class="text-muted">/auroralibreria</span></li>
        <li>📸 Instagram: <span class="text-muted">@auroralibreria</span></li>
        <li>🐦 Twitter: <span class="text-muted">@auroralibros</span></li><br>
        <li> <a href="admin_contactos.php" class="btn btn-sm btn-primary">💬 Ver Mensajes</a></li>
      </ul>
    </div>
  </div>
</div>


  </div>
</main>

<?php require 'includes/footer.php'; ?>

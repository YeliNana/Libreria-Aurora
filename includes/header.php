<?php
if (!isset($titulo_pagina)) {
    $titulo_pagina = 'Inicio';
}
if (!isset($pagina)) {
    $pagina = '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Librería Aurora - <?= htmlspecialchars($titulo_pagina) ?></title>

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&family=Roboto:wght@300;400;500&display=swap"
    rel="stylesheet"
  />
 <link rel="icon" type="image/png" href="assets/img/icono.png">
  <!-- Estilos propios -->
  <link rel="stylesheet" href="assets/css/style.css?v=4" />
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="index.php">
  <img src="assets/img/logo.png" alt="Librería Aurora" height="40" style="border-radius:8px;">
  <span>Librería Aurora</span>
</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?= $pagina === 'inicio' ? 'active' : '' ?>" href="index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $pagina === 'libros' ? 'active' : '' ?>" href="libros.php">Libros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $pagina === 'autores' ? 'active' : '' ?>" href="autores.php">Autores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $pagina === 'contacto' ? 'active' : '' ?>" href="contacto.php">Contacto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

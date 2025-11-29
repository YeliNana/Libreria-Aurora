<?php
// index.php
$titulo_pagina = 'Inicio';
$pagina = 'inicio';
require 'includes/header.php';
?>

<header class="py-5 hero-aurora">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-md-6">
        <h1 class="display-5 fw-bold mb-3">Bienvenido a Librería Aurora</h1>
        <p class="lead mb-4">
          “Descubre tu próximo libro favorito”. Explora nuestro catálogo de títulos y
          conoce a los autores que dan vida a cada historia.
        </p>
        <a href="libros.php" class="btn btn-primary btn-lg me-2">
          Ver libros
        </a>
        <a href="autores.php" class="btn btn-outline-primary btn-lg">
          Ver autores
        </a>
      </div>
      <div class="col-md-6 text-center">
        <!-- Aquí puedes reemplazar por tu logo -->
        <div class="text-center">
  <img src="assets/img/logo.png" alt="Logo Aurora" class="img-fluid" style="max-height:220px;">
</div>

      </div>
    </div>
  </div>
</header>

<main class="py-5">
  <div class="container">
    <h2 class="h3 mb-4">Libros destacados</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">The Busy Executive's Database Guide</h5>
            <p class="card-text text-muted mb-1">Autor: Johnson White</p>
            <p class="card-text small">
              Una visión general de sistemas de base de datos para aplicaciones de negocio.
            </p>
            <a href="libros.php" class="btn btn-sm btn-primary">Ver más</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Cooking with Computers</h5>
            <p class="card-text text-muted mb-1">Autor: Michael Leary</p>
            <p class="card-text small">
              Recetas y trucos para combinar cocina tradicional con tecnología.
            </p>
            <a href="libros.php" class="btn btn-sm btn-primary">Ver más</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Emotional Security: A New Algorithm</h5>
            <p class="card-text text-muted mb-1">Autor: Sheryl Hunter</p>
            <p class="card-text small">
              Técnicas modernas para manejar el estrés emocional en el mundo actual.
            </p>
            <a href="libros.php" class="btn btn-sm btn-primary">Ver más</a>
          </div>
        </div>
      </div>
    </div>

    <hr class="my-5" />

    <section>
      <h2 class="h4 mb-3">¿Qué encontrarás en Aurora?</h2>
      <ul>
        <li>Un catálogo de libros organizado y fácil de consultar.</li>
        <li>Un listado de autores con sus datos básicos.</li>
        <li>Un formulario de contacto para enviar consultas.</li>
      </ul>
    </section>
  </div>
</main>

<?php
require 'includes/footer.php';
?>

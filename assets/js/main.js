// Año actual en el footer
const spanAnio = document.getElementById("anio-actual");
if (spanAnio) {
  spanAnio.textContent = new Date().getFullYear();
}

const elementosAnimados = [];

// Al cargar el DOM
document.addEventListener("DOMContentLoaded", () => {
  // Animación ligera
  const candidatos = document.querySelectorAll(
    "main h1, main h2, main .card, main .table-responsive, header .row"
  );

  candidatos.forEach((el) => {
    el.classList.add("js-fade-in");
    elementosAnimados.push(el);
  });

  if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.1 }
    );

    elementosAnimados.forEach((el) => observer.observe(el));
  } else {
    elementosAnimados.forEach((el) => el.classList.add("visible"));
  }

  // Botón scroll-to-top
  crearBotonScrollTop();

  // Buscador en CARDS de libros
  inicializarBuscadorCards("buscador-libros", "listado-libros", ".libro-card");

  // Buscador en TABLA de autores (si existe)
  inicializarBuscadorCards("buscador-autores", "grid-autores", ".autor-card");

});
// Botón "Ir arriba"
function crearBotonScrollTop() {
  const btn = document.createElement("button");
  btn.id = "btn-scroll-top";
  btn.innerHTML = "↑";

  btn.addEventListener("click", () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  document.body.appendChild(btn);

  window.addEventListener("scroll", () => {
    if (window.scrollY > 200) {
      btn.classList.add("show");
    } else {
      btn.classList.remove("show");
    }
  });
}

// Scroll suave para anchors internos

document.addEventListener("click", (e) => {
  const target = e.target.closest('a[href^="#"]');
  if (!target) return;

  const id = target.getAttribute("href").slice(1);
  const section = document.getElementById(id);
  if (section) {
    e.preventDefault();
    section.scrollIntoView({ behavior: "smooth" });
  }
});


// Buscador en CARDS (Libros)
// Busca por TÍTULO e ID

function inicializarBuscadorCards(idInput, idContenedor, selectorItems) {
  const input = document.getElementById(idInput);
  const contenedor = document.getElementById(idContenedor);
  if (!input || !contenedor) return;

  const items = contenedor.querySelectorAll(selectorItems);

  input.addEventListener("input", () => {
    const termino = input.value.toLowerCase().trim();

    items.forEach((item) => {
      const tituloEl = item.querySelector(".card-title");
      const idEl = item.querySelector(".libro-id");

      const titulo = tituloEl ? tituloEl.textContent.toLowerCase() : "";
      const idTexto = idEl ? idEl.textContent.toLowerCase() : "";

      const textoBusqueda = (titulo + " " + idTexto).trim();

      item.style.display = textoBusqueda.includes(termino) ? "" : "none";
    });
  });
}

// Buscador en TABLA (Autores)
function inicializarBuscadorTabla(idInput, idTabla) {
  const input = document.getElementById(idInput);
  const tabla = document.getElementById(idTabla);
  if (!input || !tabla) return;

  const filas = tabla.querySelectorAll("tbody tr");

  input.addEventListener("input", () => {
    const termino = input.value.toLowerCase().trim();

    filas.forEach((fila) => {
      const texto = fila.textContent.toLowerCase();
      fila.style.display = texto.includes(termino) ? "" : "none";
    });
  });
}

function inicializarBuscadorCards(idInput, idContenedor, selectorItems) {
  const input = document.getElementById(idInput);
  const contenedor = document.getElementById(idContenedor);
  if (!input || !contenedor) return;

  const items = contenedor.querySelectorAll(selectorItems);

  input.addEventListener("input", () => {
    const termino = input.value.toLowerCase().trim();

    items.forEach((item) => {
      const texto = item.textContent.toLowerCase();
      item.style.display = texto.includes(termino) ? "" : "none";
    });
  });
}

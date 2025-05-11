// Función que se activa al hacer clic en el botón para cambiar el modo
function cambiarModo() {
  const body = document.body;
  const modoOscuro = body.classList.toggle("dark-mode");
  localStorage.setItem("modoOscuro", modoOscuro ? "activado" : "desactivado");
}

// Verificar el estado del modo oscuro al cargar la página
if (localStorage.getItem("modoOscuro") === "activado") {
  document.body.classList.add("dark-mode");
}

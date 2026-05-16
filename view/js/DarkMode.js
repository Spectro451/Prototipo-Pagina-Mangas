function cambiarModo() {
  var estaOscuro = document.body.classList.contains("dark-mode") ||
    (!document.body.classList.contains("light-mode") &&
      window.matchMedia("(prefers-color-scheme: dark)").matches);

  if (estaOscuro) {
    localStorage.setItem("modoOscuro", "desactivado");
  } else {
    localStorage.setItem("modoOscuro", "activado");
  }
  aplicarModo();
}

function aplicarModo() {
  var preferencia = localStorage.getItem("modoOscuro");
  if (preferencia === "activado") {
    document.body.classList.add("dark-mode");
    document.body.classList.remove("light-mode");
  } else if (preferencia === "desactivado") {
    document.body.classList.remove("dark-mode");
    document.body.classList.add("light-mode");
  } else {
    document.body.classList.remove("dark-mode");
    document.body.classList.remove("light-mode");
  }
}

aplicarModo();

  <section class="contenedor-ayuda">
    <h1 class="titulo">¿Necesitas ayuda? 💌</h1>

    <div class="cuadro-info-contacto">
      <h2>📞 Información de contacto</h2>
      <p><strong>Dirección:</strong> 742 Avenida Siempreviva</p>
      <p><strong>Teléfono:</strong> +56 9 8765 4321</p>
      <p><strong>Correo:</strong> contacto@kiwimangas.cl</p>
    </div>

    <div class="formulario-ayuda">
      <h2>¿Necesitas ayuda? Envíanos un mensaje 💭</h2>
      <form id="formAyuda" method="POST" onsubmit="event.preventDefault(); alert('Función no disponible por el momento.');">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" required>

        <label for="mensaje">Mensaje</label>
        <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

        <button type="submit">Enviar mensaje</button>
      </form>
    </div>
  </section>
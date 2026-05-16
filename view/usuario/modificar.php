<h2>Modificar Usuario</h2>
    <?php if (isset($usuarios)): ?>
    <form action="../public/index.php?controller=Admin&action=guardarModificacionUsuario" method="POST" class="RegistroAdmin">
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuarios['id']) ?>">
        <input type="text" name="nombre" value="<?= htmlspecialchars($usuarios['nombre']) ?>" required>
        <input type="email" name="email" value="<?= htmlspecialchars($usuarios['email']) ?>" required>
        <select name="admin">
            <option value="SI" <?= $usuarios['admin'] === 'SI' ? 'selected' : '' ?>>Sí</option>
            <option value="NO" <?= $usuarios['admin'] === 'NO' ? 'selected' : '' ?>>No</option>
        </select>
        <button type="submit">Guardar cambios</button>
    </form>
    <?php endif; ?>
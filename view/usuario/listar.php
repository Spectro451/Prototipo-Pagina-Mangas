

    <h3>Usuarios Registrados</h3>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Acciones</th>
        </tr>
        <?php 
        foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><?= $usuario['admin'] === 'SI' ? '✔' : '❌' ?></td>
                <td>
                    <!-- Formulario para Modificar Usuario -->
                    <form action="../public/index.php?controller=Usuario&action=modificarUsuario" method="POST" style="display:inline;">
                        <input type="hidden" name="id_usuario" value="<?= $usuario['id'] ?>">
                        <button type="submit" id="modificar">Modificar</button>
                    </form>

                    <!-- Formulario para Eliminar Usuario -->
                    <form action="../public/index.php?controller=Usuario&action=eliminarUsuario" method="POST" style="display:inline;">
                        <input type="hidden" name="id_usuario" value="<?= $usuario['id'] ?>">
                        <button type="submit" id="eliminar" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
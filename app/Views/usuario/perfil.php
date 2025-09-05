<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /contacto-app/public/");
    exit;
}
?>

<h2>Perfil de <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></h2>
<p>Email: <?php echo htmlspecialchars($_SESSION['usuario_email']); ?></p>


<h3>Mis Contactos</h3>

<?php if (empty($contactos)): ?>
    <p>No tienes contactos registrados.</p>
<?php else: ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Fecha Creación</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($contactos as $contacto): ?>
        <tr>
            <td><?php echo htmlspecialchars($contacto['id']); ?></td>
            <td><?php echo htmlspecialchars($contacto['nombre']); ?></td>
            <td><?php echo htmlspecialchars($contacto['telefono']); ?></td>
            <td><?php echo htmlspecialchars($contacto['email']); ?></td>
            <td><?php echo htmlspecialchars($contacto['fecha_creacion']); ?></td>
            <td>
                <a href="/contacto-app/public/contacto/editar/<?php echo $contacto['id']; ?>">Editar</a>
                <a href="/contacto-app/public/contacto/eliminar/<?php echo $contacto['id']; ?>" 
                onclick="return confirm('¿Eliminar contacto?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<a href="/contacto-app/public/contacto/crear">Agregar nuevo contacto</a>


<p>
    <a href="/contacto-app/public/perfil/editar">
        <button>Actualizar Perfil</button>
    </a>
</p>

<form action="/contacto-app/public/eliminar-cuenta" method="POST">
    <input type="hidden" name="id" value="<?php echo $_SESSION['usuario_id']; ?>">
    <button type="submit" onclick="return confirm('¿Estás seguro?')">Eliminar cuenta</button>
</form>

<form method="POST" action="/contacto-app/public/logout">
    <button type="submit">Cerrar Sesión</button>
</form>

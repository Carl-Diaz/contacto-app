
<h2>Editar Perfil</h2>
<?php
$error = $_GET['error'] ?? null;
if ($error): ?>
    <div style="color: red; margin-bottom: 10px;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php  endif; ?>

<form method="POST" action="/contacto-app/public/perfil/actualizar">
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>" required>
    <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['usuario_email']); ?>" required>
    <input type="password" name="password" placeholder="Nueva contraseña (opcional)">
    <button type="submit">Guardar Cambios</button>
</form>

<p><a href="/contacto-app/public/perfil">⬅ Volver al perfil</a></p>

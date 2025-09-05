<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /contacto-app/public/login");
    exit;
}


if (!isset($contacto)) {
    header("Location: /contacto-app/public/perfil");
    exit;
}
?>

<h2>Editar Contacto</h2>
<?php if (isset($_GET['error'])): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;">
        ❌ Error: <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>
<form method="POST" action="/contacto-app/public/contacto/actualizar/<?php echo $contacto['id']; ?>">
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($contacto['nombre']); ?>" required>
    <input type="tel" name="telefono" value="<?php echo htmlspecialchars($contacto['telefono']); ?>" required>
    <input type="email" name="email" value="<?php echo htmlspecialchars($contacto['email']); ?>" required>
    <button type="submit">Actualizar Contacto</button>
</form>

<a href="/contacto-app/public/perfil">← Volver al perfil</a>
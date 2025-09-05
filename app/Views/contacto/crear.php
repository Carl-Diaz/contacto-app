<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /contacto-app/public/login");
    exit;
}
?>


<h2>Agregar Nuevo Contacto</h2>
<?php if (isset($_GET['error'])): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;">
        ❌ Error: <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>

<form method="POST" action="/contacto-app/public/contacto/guardar">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="tel" name="telefono" placeholder="Teléfono" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <button type="submit">Guardar Contacto</button>
</form>

<a href="/contacto-app/public/perfil">← Volver al perfil</a>
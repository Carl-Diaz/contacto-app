<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de usuario</h2>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p style="color: green;">✅ Usuario registrado con éxito. Ahora puedes iniciar sesión.</p>
    <?php elseif (isset($_GET['error'])): ?>
        <p style="color: red;">❌ Error: <?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form method="POST" action="/contacto-app/public/registro">
        <input type="text" name="nombre" placeholder="Nombre completo" 
               value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>" required>
        <input type="email" name="email" placeholder="Correo electrónico" 
               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrar</button>
    </form>

    <p><a href="/contacto-app/public/">Volver al login</a></p>
</body>
</html>
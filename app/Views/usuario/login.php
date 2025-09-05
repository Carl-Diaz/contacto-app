<h2>Iniciar Sesión</h2>

<?php if (isset($_GET['error'])): ?>
    <p style="color: red;">❌ <?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>
<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<form method="POST" action="/contacto-app/public/login">
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Ingresar</button>
</form>

<p>¿No tienes cuenta? <a href="/contacto-app/public/registro">Regístrate aquí</a></p>

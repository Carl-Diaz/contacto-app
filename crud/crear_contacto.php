<?php
require_once '../include/conexion.php';
require_once '../include/funciones_contactos.php';
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}
// Guarda el id del usuario actual desde la sesión
$usuario_id = $_SESSION["usuario_id"];

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    // Llama a la función y pasa el usuario_id
    $mensaje = createContacto($conexion, $nombre, $email, $telefono, $usuario_id);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Contacto</title>
</head>
<body>
    <h2>Crear nuevo contacto</h2>
    <?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="telefono" placeholder="Teléfono" required><br>
        <button type="submit">Guardar contacto</button>
    </form>
    <br>
    <a href="../mis_contactos.php">Volver a mis contactos</a>
</body>
</html>

<?php
require_once '../include/conexion.php';
require_once '../include/funciones_contactos.php';
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}
$usuario_id = $_SESSION["usuario_id"];

if (!isset($_GET['id'])) {
    echo "ID de contacto no especificado.";
    exit;
}
$id = $_GET['id'];

// Obtener datos actuales del contacto
$stmt = $conexion->prepare("SELECT * FROM contactos WHERE id = :id AND usuario_id = :usuario_id");
$stmt->bindParam(':id', $id);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$contacto = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$contacto) {
    echo "Contacto no encontrado o no tienes permisos.";
    exit;
}

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = updateContacto($conexion, $id, $nombre, $email, $telefono);
    // Actualizar datos para mostrar en el formulario
    $contacto['nombre'] = $nombre;
    $contacto['email'] = $email;
    $contacto['telefono'] = $telefono;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Contacto</title>
</head>
<body>
    <h2>Editar contacto</h2>
    <?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
    <form method="POST">
        <input type="text" name="nombre" value="<?= htmlspecialchars($contacto['nombre']) ?>" required><br>
        <input type="email" name="email" value="<?= htmlspecialchars($contacto['email']) ?>" required><br>
        <input type="text" name="telefono" value="<?= htmlspecialchars($contacto['telefono']) ?>" required><br>
        <button type="submit">Actualizar contacto</button>
    </form>
    <br>
    <a href="../mis_contactos.php">Volver a mis contactos</a>
</body>
</html>

<?php
session_start();
require_once '../include/conexion.php';
require_once '../include/funciones_usuarios.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$id = $_SESSION['usuario_id']; //

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar actualización
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $resultado = updateUsuario($conexion, $id, $nombre, $email, $password);
    $mensaje = $resultado;
}

// Obtener datos actuales del usuario
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit;
}
?>

<h2>Editar Usuario</h2>
<?php if (isset($mensaje)): ?>
    <p><?= htmlspecialchars($mensaje) ?></p> // Mensaje de éxito o error cual es el mensje 
<?php endif; ?>

<form method="POST">
    <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required></label><br>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required></label><br>
    <label>Nueva contraseña (opcional): <input type="password" name="password"></label><br>
    <button type="submit">Actualizar</button>
</form>

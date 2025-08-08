<?php
require_once 'include/conexion.php';
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit;
}
$usuario_id = $_SESSION["usuario_id"];

$stmt = $conexion->prepare("SELECT * FROM contactos WHERE usuario_id = :usuario_id");
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Contactos</title>
</head>
<body>
    <h2>Mis Contactos</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
        </tr>
        <?php foreach ($contactos as $contacto): ?>
        <tr>
            <td><?= htmlspecialchars($contacto['nombre']) ?></td>
            <td><?= htmlspecialchars($contacto['email']) ?></td>
            <td><?= htmlspecialchars($contacto['telefono']) ?></td>
            <td>
                <a href="crud/editar_contacto.php?id=<?= $contacto['id'] ?>">Editar</a> |
                <a href="crud/eliminar_contacto.php?id=<?= $contacto['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este contacto?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($contactos)): ?>
        <h2>No tienes contactos registrados.</h2>
        <?php endif; ?>
    </table>
    <br>
    <a href="./crud/crear_contacto.php">Agregar nuevo contacto</a>
    <a href="cerrar_sesion.php">Cerrar sesión</a>
    <a href="./crud/editar_usuario.php">Editar mi perfil</a>
    <a href="./crud/eliminar_usuario.php" onclick="return confirm('¿Seguro que deseas eliminar tu cuenta?');">Eliminar mi cuenta</a>
</body>
</html>

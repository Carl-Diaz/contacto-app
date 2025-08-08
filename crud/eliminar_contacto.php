<?php
require_once '../include/conexion.php';
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}
$usuario_id = $_SESSION["usuario_id"];

if (!isset($_GET['id'])) {
    header("Location: ../mis_contactos.php?error=id");
    exit;
}
$id = $_GET['id'];

// Verificar que el contacto pertenece al usuario
$stmt = $conexion->prepare("SELECT * FROM contactos WHERE id = :id AND usuario_id = :usuario_id");
$stmt->bindParam(':id', $id);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$contacto = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$contacto) {
    header("Location: ../mis_contactos.php?error=permiso");
    exit;
}

// Eliminar el contacto
$stmt = $conexion->prepare("DELETE FROM contactos WHERE id = :id AND usuario_id = :usuario_id");
$stmt->bindParam(':id', $id);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();

header("Location: ../mis_contactos.php?success=eliminado");
exit;

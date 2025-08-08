<?php
session_start();
require_once '../include/conexion.php';
require_once '../include/funciones_usuarios.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_SESSION['usuario_id'];

if (deleteUsuario($conexion, $id)) {
    session_destroy();
    header("Location: ../index.php");
    exit;
} else {
    // Por si hay error, puedes redirigir con un mensaje de error si quieres
    header("Location: ../index.php?error=1");
    exit;
}

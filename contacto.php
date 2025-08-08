<?php 
require_once 'include/conexion.php';
session_start();    
if(!isset($_SESSION["usuario_id"])){
    header("Location: index.php");
    exit;
}
$usuario_id = $_SESSION["usuario_id"];
$sql = "SELECT * FROM usuarios WHERE id = :usuario_id";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$usuario) {
    echo "Usuario no encontrado.";
    exit;
}
?>
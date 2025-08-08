<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "1234";
$db = "contacto_app_db";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$db", $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa a la base de datos."; // Solo para desarrollo
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
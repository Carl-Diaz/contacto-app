<?php
require_once 'include/conexion.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
        <button type="button" onclick="location.href='index.php'">Iniciar Sesion</button>
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($nombre) || empty($email) || empty($password)) {
            echo "Todos los campos son obligatorios.";
            exit;
        }
        // Validar email duplicado
        $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->fetch()) {
            echo "El email ya está registrado.";
        } else {
            try{
                $password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)");
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                echo "Registro exitoso";
            } catch (PDOException $e) {
                echo "Error al registrar: " . $e->getMessage();
            }
        }
    }
    ?>
</body>
</html>

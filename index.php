<?php
include 'include/conexion.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contacto-app</title>
</head>
<body>
    <form action="procesar.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">ingresar</button>
        <button type="button" onclick="location.href='registrar.php'">Registrarse</button>
    </form>
</body>
</html>
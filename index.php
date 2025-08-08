<?php
require_once 'include/conexion.php';
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
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">ingresar</button>
        <button type="button" onclick="location.href='registrar.php'">Registrarse</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (empty($email) || empty($password)) {
            echo "Todos los campos son obligatorios.";
            exit;
        }else{
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($usuario && password_verify($password, $usuario["password"])) {
                $_SESSION["usuario_id"] = $usuario["id"];
                header("Location: mis_contactos.php");
                exit;
            } else {
                echo "No se encontró un usuario con ese email o la contraseña es incorrecta.";
            }   
        }
    }
    ?>
</body>
</html>
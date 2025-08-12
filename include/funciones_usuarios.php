<?php
function createUsuario($conexion, $nombre, $email, $password)
{
    if (empty($nombre) || empty($email) || empty($password)) {
        return "Todos los campos son obligatorios.";
    }
    // Validar email duplicado
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->fetch()) {
        return "El email ya está registrado.";
    }
    try {
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->execute();
        return "Usuario registrado exitosamente.";
    } catch (PDOException $e) {
        return "Error al registrar usuario: " . $e->getMessage();
    }
}

function updateUsuario($conexion, $id, $nombre, $email, $password)
{
    if (empty($id) || empty($nombre) || empty($email)) {
        return "Todos los campos son obligatorios.";
    }
    try {
        if (empty($password)) {
            $stmt = $conexion->prepare("UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
        } else {
            $stmt = $conexion->prepare("UPDATE usuarios SET nombre = :nombre, email = :email, password = :password WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hash);
        }
        $stmt->execute();
        return "Usuario actualizado exitosamente.";
    } catch (PDOException $e) {
        return "Error al actualizar usuario: " . $e->getMessage();
    }
}

function deleteUsuario($conexion, $id)
{
    if (empty($id)) {
        return false;
    }
    try {
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute(); // true si fue exitoso, false si falló
    } catch (PDOException $e) {
        return false;
    }
}


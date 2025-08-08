<?php
function createContacto($conexion, $nombre, $email, $telefono, $usuario_id){
    if (empty($nombre) || empty($email) || empty($telefono)) {
        return "Todos los campos son obligatorios.";
    }
    try {
        $stmt = $conexion->prepare("INSERT INTO contactos (nombre, email, telefono, usuario_id) VALUES (:nombre, :email, :telefono, :usuario_id)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return "Contacto registrado exitosamente.";
    } catch (PDOException $e) {
        return "Error al registrar contacto: " . $e->getMessage();
    }
}

function ReadContactos($conexion, $usuario_id){
    try {
        $stmt = $conexion->prepare("SELECT * FROM contactos WHERE usuario_id = :usuario_id");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Error al obtener contactos: " . $e->getMessage();
    }
}

function updateContacto($conexion, $id, $nombre, $email, $telefono){
    if (empty($id) || empty($nombre) || empty($email) || empty($telefono)) {
        return "Todos los campos son obligatorios.";
    }
    try {
        $stmt = $conexion->prepare("UPDATE contactos SET nombre = :nombre, email = :email, telefono = :telefono WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->execute();
        return "Contacto actualizado exitosamente.";
    } catch (PDOException $e) {
        return "Error al actualizar contacto: " . $e->getMessage();
    }
}

function deleteContacto($conexion, $id){
    if (empty($id)) {
        return "El ID del contacto es obligatorio.";
    }
    try {
        $stmt = $conexion->prepare("DELETE FROM contactos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return "Contacto eliminado exitosamente.";
    } catch (PDOException $e) {
        return "Error al eliminar contacto: " . $e->getMessage();
    }
}
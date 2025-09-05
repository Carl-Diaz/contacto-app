<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use Exception;

class Usuario {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function crearUsuario(string $nombre, string $email, string $password): int {
        $query = "INSERT INTO usuarios (nombre, email, password, fecha_creacion) 
            VALUES (:nombre, :email, :password, NOW())";
        $stmt = $this->conn->prepare($query);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);

        if ($stmt->execute()) {
            return (int)$this->conn->lastInsertId();
        } else {
            throw new Exception("Error al crear el usuario. Puede que el correo ya esté en uso.");
        }
    }

    public function validarLogin(string $email, string $password) {
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        throw new Exception("El correo electrónico ya está en uso por otra cuenta.");
        }

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        } else {
            return false;
        }
    }

    public function existeEmail(string $email): bool {
    $stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch() !== false;
}

    public function actualizarPerfil(int $id, string $nombre, string $email, ?string $password = null): bool {
    // Verificar que no exista otro usuario con el mismo correo
    $checkQuery = "SELECT id FROM usuarios WHERE email = :email AND id != :id";
    $checkStmt = $this->db->getConnection()->prepare($checkQuery);
    $checkStmt->bindParam(':email', $email);
    $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $checkStmt->execute();

    if ($checkStmt->fetch(PDO::FETCH_ASSOC)) {
        throw new Exception("El correo electrónico ya está en uso por otra cuenta.");
    }

    // Si viene password nuevo, lo encriptamos
    $passwordHash = null;
    if (!empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    }

    // Construir query dinámica
    $query = "UPDATE usuarios SET nombre = :nombre, email = :email";
    if ($passwordHash) {
        $query .= ", password = :password";
    }
    $query .= " WHERE id = :id";

    $stmt = $this->db->getConnection()->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($passwordHash) {
        $stmt->bindParam(':password', $passwordHash);
    }

    return $stmt->execute();
}


    public function eliminarUsuario(int $id): bool {
        $query = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}

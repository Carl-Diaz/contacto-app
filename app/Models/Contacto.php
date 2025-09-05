<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Contacto {
    private $conn;

    private $database;

    public function __construct() {
        $this->database = new Database();
        $this->conn = $this->database->getConnection();
    }

    public function getContactosByUserId(int $userId): array {
        $stmt = $this->conn->prepare("SELECT * FROM contactos WHERE usuario_id = ? ORDER BY nombre");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContactoById(int $userId, int $contactoId): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM contactos WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$contactoId, $userId]);
        $contacto = $stmt->fetch(PDO::FETCH_ASSOC);
        return $contacto ?: null;
    }

    public function crearContacto(int $userId, array $datos): bool {
        $stmt = $this->conn->prepare("INSERT INTO contactos (usuario_id, nombre, telefono, email) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$userId, $datos['nombre'], $datos['telefono'], $datos['email']]);
    }

    public function actualizarContacto(int $userId, int $contactoId, array $datos): bool {
        $stmt = $this->conn->prepare("UPDATE contactos SET nombre = ?, telefono = ?, email = ? WHERE id = ? AND usuario_id = ?");
        return $stmt->execute([$datos['nombre'], $datos['telefono'], $datos['email'], $contactoId, $userId]);
    }

    public function eliminarContacto(int $userId, int $contactoId): bool {
        $stmt = $this->conn->prepare("DELETE FROM contactos WHERE id = ? AND usuario_id = ?");
        return $stmt->execute([$contactoId, $userId]);
    }
}
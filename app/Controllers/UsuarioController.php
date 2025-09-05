<?php
namespace App\Controllers;

use App\Models\Usuario;
use Exception;

class UsuarioController {
    private Usuario $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function mostrarLogin(): void {
        require __DIR__ . '/../Views/usuario/login.php';
    }

    public function mostrarRegistro(): void {
        require __DIR__ . '/../Views/usuario/registro.php';
        
    }

    public function mostrarPerfil(): void {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: /contacto-app/public/login");
        exit;
    }
    $contactoModel = new \App\Models\Contacto();
    $userId = $_SESSION['usuario_id'];
    $contactos = $contactoModel->getContactosByUserId($userId);
    
    require __DIR__ . '/../Views/usuario/perfil.php';
    }

    public function mostrarEditarPerfil(): void {
    require_once __DIR__ . '/../Views/usuario/editarPerfil.php';
}


    public function registrar(): void {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        try {
            if (empty($nombre) || empty($email) || empty($password)) {
                throw new Exception("Todos los campos son obligatorios.");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("El correo electrónico no es válido.");
            }

            // Verificar si el email ya existe
            if ($this->usuarioModel->existeEmail($email)) {
                throw new Exception("El correo electrónico ya está registrado.");
            }

            $this->usuarioModel->crearUsuario($nombre, $email, $password);

            header("Location: /contacto-app/public/registro?success=1");
            exit;
        } catch (Exception $e) {
            header("Location: /contacto-app/public/registro?error=" . urlencode($e->getMessage()));
            exit;
        }
    }

    require_once '../app/Views/usuario/registro.php';
}

    public function login() {
    $error = null;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        try {
            if (empty($email) || empty($password)) {
                throw new Exception("Todos los campos son obligatorios.");
            }

            $usuario = $this->usuarioModel->validarLogin($email, $password);

            if (!$usuario) {
                throw new Exception("Credenciales de sesión inválidas.");
            }

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_email'] = $usuario['email'];

            header("Location: /contacto-app/public/perfil");
            exit;
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
    
    
    require_once '../app/Views/usuario/login.php';
}

    public function actualizarPerfil(int $id, string $nombre, string $email, ?string $password = null): bool {
        if (empty($nombre) || empty($email)) {
            throw new Exception("Nombre y correo electrónico son obligatorios.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El correo electrónico no es válido.");
        }
        return $this->usuarioModel->actualizarPerfil($id, $nombre, $email, $password);
    }

    public function eliminarCuenta(): bool {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método no permitido");
    }
    
    $id = $_POST['id'] ?? null;
    
    if (empty($id)) {
        throw new Exception("ID de usuario es obligatorio.");
    }
    
    $resultado = $this->usuarioModel->eliminarUsuario((int)$id);
    
    if ($resultado) {
        // Destruir sesión y redirigir
        session_destroy();
        header("Location: /contacto-app/public/");
        exit;
    }
    
        return $resultado;
    }

    public function procesarActualizarPerfil(): void {
    try {
        if (!isset($_SESSION['usuario_id'])) {
            throw new Exception("Debes iniciar sesión para actualizar el perfil.");
        }

        $id = $_SESSION['usuario_id'];
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? null;

        // Llamar al modelo para actualizar
        $this->usuarioModel->actualizarPerfil($id, $nombre, $email, $password);

        // Actualizar los datos de la sesión
        $_SESSION['usuario_nombre'] = $nombre;
        $_SESSION['usuario_email'] = $email;

        // Redirigir de nuevo al perfil
        header("Location: /contacto-app/public/perfil");
        exit;
    } catch (Exception $e) {
        // Si hay error, redirige al formulario de edición con mensaje
        header("Location: /contacto-app/public/perfil/editar?error=" . urlencode($e->getMessage()));
        exit;
    }
}

public function logout(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();   // Limpia variables de sesión
    session_destroy(); // Destruye la sesión

    // Redirigir al login
    header("Location: /contacto-app/public/");
    exit;
}



}

<?php
namespace App\Controllers;

use App\Models\Contacto;
use Exception;

class ContactoController {
    private $contactoModel;

    public function __construct() {
        $this->contactoModel = new Contacto();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /contacto-app/public/login");
            exit;
        }

        $userId = $_SESSION['usuario_id'];
        $contactos = $this->contactoModel->getContactosByUserId($userId);
        
        require_once '../app/Views/usuario/perfil.php';
    }

    public function crear() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /contacto-app/public/login");
            exit;
        }
        
        require_once '../app/Views/contacto/crear.php';
    }

    public function guardar() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['usuario_id'])) {
        header("Location: /contacto-app/public/login");
        exit;
    }

    try {
        $userId = $_SESSION['usuario_id'];
        $datos = [
            'nombre' => trim($_POST['nombre']),
            'telefono' => trim($_POST['telefono']),
            'email' => trim($_POST['email'])
        ];
        
        $this->contactoModel->crearContacto($userId, $datos);
        header("Location: /contacto-app/public/perfil?success=contacto_creado");
        exit;
        
    } catch (\PDOException $e) {
        if ($e->getCode() == 23000) {
            $error = "El correo electrónico ya existe en tus contactos.";
        } else {
            $error = "Error de base de datos: " . $e->getMessage();
        }
        header("Location: /contacto-app/public/contacto/crear?error=" . urlencode($error));
        exit;
    } catch (Exception $e) {
        header("Location: /contacto-app/public/contacto/crear?error=" . urlencode($e->getMessage()));
        exit;
    }
}

    public function editar($id) {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: /contacto-app/public/login");
        exit;
    }

    $userId = $_SESSION['usuario_id'];
    $contacto = $this->contactoModel->getContactoById($userId, $id);

    if (!$contacto) {
        header("Location: /contacto-app/public/perfil?error=contacto_no_encontrado");
        exit;
    }

    require_once '../app/Views/contacto/editar.php';
}
    public function actualizar($id) {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['usuario_id'])) {
        header("Location: /contacto-app/public/login");
        exit;
    }

    try {
        $userId = $_SESSION['usuario_id'];
        $datos = [
            'nombre' => trim($_POST['nombre']),
            'telefono' => trim($_POST['telefono']),
            'email' => trim($_POST['email'])
        ];

        
        $this->contactoModel->actualizarContacto($userId, $id, $datos);
        header("Location: /contacto-app/public/perfil?success=Contacto actualizado");
        
    } catch (\PDOException $e) {
        if ($e->getCode() == 23000) {
            $error = "El correo electrónico ya existe en tus contactos.";
        } else {
            $error = "Error de base de datos: " . $e->getMessage();
        }
        header("Location: /contacto-app/public/contacto/editar/{$id}?error=" . urlencode($error));
    } catch (Exception $e) {
        header("Location: /contacto-app/public/contacto/editar/{$id}?error=" . urlencode($e->getMessage()));
    }
    exit;
}

    public function eliminar($id) {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /contacto-app/public/login");
            exit;
        }

        try {
            $userId = $_SESSION['usuario_id'];
            $this->contactoModel->eliminarContacto($userId, $id);
            header("Location: /contacto-app/public/perfil?success=contacto_eliminado");
            
        } catch (Exception $e) {
            header("Location: /contacto-app/public/perfil?error=" . urlencode($e->getMessage()));
        }
        exit;
    }
}
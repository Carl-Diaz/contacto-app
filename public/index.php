<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Controllers\UsuarioController;
use App\Controllers\ContactoController;

$router = new Router();



$router->get('/', UsuarioController::class, 'mostrarLogin');
$router->get('/registro', UsuarioController::class, 'mostrarRegistro');
$router->get('/perfil', UsuarioController::class, 'mostrarPerfil');
$router->get('/perfil/editar', UsuarioController::class, 'mostrarEditarPerfil');
$router->get('/contactos', ContactoController::class, 'index');
$router->get('/contacto/crear', ContactoController::class, 'crear');
$router->get('/contacto/editar/{id}', ContactoController::class, 'editar');
$router->get('/contacto/eliminar/{id}', ContactoController::class, 'eliminar');



$router->post('/login', UsuarioController::class, 'login');
$router->post('/registro', UsuarioController::class, 'registrar');
$router->post('/perfil/actualizar', UsuarioController::class, 'actualizarPerfil');
$router->post('/logout', UsuarioController::class, 'logout');
$router->post('/eliminar-cuenta', UsuarioController::class, 'eliminarCuenta');

$router->post('/contacto/guardar', ContactoController::class, 'guardar');
$router->post('/contacto/actualizar/{id}', ContactoController::class, 'actualizar');

try {
    $router->run();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

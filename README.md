# CONTACTO-APP

Aplicación web de gestión de usuarios y contactos desarrollada en **PHP** con conexión a **MySQL** mediante **PDO**. Permite a los usuarios:

- Registrarse e iniciar sesión
- Crear, editar y eliminar contactos personales
- Editar su perfil
- Eliminar su cuenta

---

## Estructura del Proyecto

CONTACTO-APP/
│
├── index.php # Página de inicio con formulario de login
├── registrar.php # Página para registrar nuevos usuarios
├── mis_contactos.php # Lista de contactos del usuario actual
├── cerrar_sesion.php # Cierra la sesión activa
│
├── crud/
│ ├── crear_contacto.php # Lógica para crear nuevos contactos
│ ├── editar_contacto.php # Formulario para editar un contacto
│ ├── eliminar_contacto.php # Elimina un contacto
│ ├── editar_usuario.php # Formulario para editar perfil de usuario
│ └── eliminar_usuario.php # Elimina la cuenta del usuario logueado
│
├── include/
│ ├── conexion.php # Conexión PDO a la base de datos
│ ├── funciones_contactos.php # Funciones CRUD para contactos
│ └── funciones_usuarios.php # Funciones CRUD para usuarios
│
└── README.md # Este archivo

---

## Requisitos

- PHP 7.4 o superior
- MySQL / MariaDB
- Servidor local como XAMPP, Laragon o similar

---

## Instalación

1. Clona el repositorio o descarga los archivos.
2. Crea una base de datos en MySQL llamada por ejemplo `contactos_app_db`.
3. Ejecuta el siguiente script SQL para crear las tablas necesarias:

---sql

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contactos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  telefono VARCHAR(20),
  email VARCHAR(100),
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
Configura tu archivo include/conexion.php con tus credenciales de base de datos:

$dsn = 'mysql:host=localhost;dbname=contactos_app_db;charset=utf8';
$usuario = 'root';
$clave = '';
Inicia tu servidor y accede a index.php desde tu navegador para comenzar.

Funcionalidades
- Registro de usuarios

- Login con validación de contraseña encriptada (password_hash)

- CRUD de contactos por cada usuario (solo ve y edita sus propios)

- Edición del perfil de usuario

- Eliminación de cuenta (con cierre automático de sesión)

- Validación de sesión para proteger rutas privadas

## Autor
Desarrollado por CARLOS DIAZ
# CONTACTO-APP

Aplicación web de gestión de usuarios y contactos desarrollada en **PHP** con conexión a **MySQL** mediante **PDO**. Permite a los usuarios:

- Registrarse e iniciar sesión
- Crear, editar y eliminar contactos personales
- Editar su perfil
- Eliminar su cuenta

---

## Estructura del Proyecto

CONTACTO-APP/<br>
│
<br>├── index.php # Página de inicio con formulario de login
<br>├── registrar.php # Página para registrar nuevos usuarios
<br>|mis_contactos.php # Lista de contactos del usuario actual
<br>├── cerrar_sesion.php # Cierra la sesión activa
<br>│
<br>├── crud/
<br>│ ├── crear_contacto.php # Lógica para crear nuevos contactos
<br>│ ├── editar_contacto.php # Formulario para editar un contacto
<br>│ ├── eliminar_contacto.php # Elimina un contacto
<br>│ ├── editar_usuario.php # Formulario para editar perfil de usuario
<br>│ └── eliminar_usuario.php # Elimina la cuenta del usuario logueado
<br>│
<br>├── include/
<br>│ <br>├── conexion.php # Conexión PDO a la base de datos
<br>│ <br>├── funciones_contactos.php # Funciones CRUD para contactos
<br>│ <br>└── funciones_usuarios.php # Funciones CRUD para usuarios
<br>│
<br>└── README.md # Este archivo

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


Funcionalidades
- Registro de usuarios

- CRUD de contactos por cada usuario 

- Edición del perfil de usuario

- Eliminación de cuenta 


## Autor
Desarrollado por CARLOS DIAZ

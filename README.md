# Contacto App

Una aplicación web completa para gestión de contactos personales, desarrollada con PHP orientado a objetos, MVC y MySQL.

##  Características

### Gestión de Usuarios
- Registro de nuevos usuarios
- Login y autenticación segura
- Edición de perfil de usuario
- Eliminación de cuenta
- Logout seguro

### 📋 Gestión de Contactos
- Crear nuevos contactos
- Listar todos los contactos del usuario
- Editar contactos existentes
- Eliminar contactos
- Validaciones de datos únicos (email)


## 🛠️ Tecnologías Utilizadas

- **Backend:** PHP 7.4+ (Orientado a Objetos)
- **Frontend:** HTML5
- **Base de datos:** MySQL
- **Arquitectura:** MVC (Modelo-Vista-Controlador)
- **Autoloading:** Composer PSR-4
- **Servidor:** Apache (compatible con Laragon/XAMPP)

## Estructura del Proyecto
contacto-app/
├── app/
│ ├── Config/
│ │ └── Database.php
│ ├── Controllers/
│ │ ├── UsuarioController.php
│ │ └── ContactoController.php
│ ├── Models/
│ │ ├── Usuario.php
│ │ └── Contacto.php
│ ├── Views/
│ │ ├── usuario/
│ │ │ ├── login.php
│ │ │ ├── registro.php
│ │ │ ├── perfil.php
│ │ │ └── editarPerfil.php
│ │ └── contacto/
│ │ ├── crear.php
│ │ └── editar.php
│ └── Router.php
├── public/
│ ├── index.php
│ └── .htaccess
├── vendor/
└── composer.json


## Instalación

**Clonar el repositorio:**
   git clone [(https://github.com/Carl-Diaz/contacto-app.git)]
   cd contacto-app

**Instalar dependencias**
composer install

# Configurar base de datos

Crear base de datos contacto_app_db
Configurar credenciales en app/Config/Database.php

**Configurar servidor**
Apuntar el documento root a la carpeta public/
Asegurar que mod_rewrite esté habilitado

# Estructura de la Base de Datos

**Tabla: usuarios**
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

**Tabla: contactos**
CREATE TABLE contactos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(150) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    UNIQUE KEY email_unique (usuario_id, email),
    UNIQUE KEY telefono_unique (usuario_id, telefono)
);

# Uso de la Aplicación

**Registro:** Crear una nueva cuenta
**Login:** Iniciar sesión con email y contraseña
**Perfil**: Ver y gestionar contactos personales
**Agregar contacto:** Formulario con validaciones
**Editar contacto:** Modificar información existente
**Eliminar contacto:** Confirmación antes de eliminar

# Endpoints Disponibles
**GET**
/ - Login
/registro - Formulario de registro
/perfil - Perfil del usuario con contactos
/contacto/crear - Formulario nuevo contacto
/contacto/editar/{id} - Formulario editar contacto

**POST**
/login - Procesar login
/registro - Procesar registro
/contacto/guardar - Guardar nuevo contacto
/contacto/actualizar/{id} - Actualizar contacto
/contacto/eliminar/{id} - Eliminar contacto
/logout - Cerrar sesión

# Desarrollo
Desarrollado con PHP moderno y patrones de diseño MVC. Ideal para aprender:
Programación orientada a objetos en PHP
Patrón MVC
Manejo de sesiones
Validaciones de seguridad
Interacción con MySQL


# AUTOR
Carlos Alberto Diaz Sanchez 


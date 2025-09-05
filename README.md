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
contacto-app/<br>
<br>├── app/
<br>│ ├── Config/
<br>│ │ └── Database.php
<br>│ ├── Controllers/
<br>│ ├── UsuarioController.php
<br>│ │ └── ContactoController.php
<br>│ ├── Models/
<br>│ │ ├── Usuario.php
<br>│ │ └── Contacto.php
<br>│ ├── Views/
<br>│ │ ├── usuario/
<br>│ │ │ ├── login.php
<br>│ │ │ ├── registro.php
<br>│ │ │ ├── perfil.php
<br>│ │ │ └── editarPerfil.php
<br>│ │ └── contacto/
<br>│ │ ├── crear.php
<br>│ │ └── editar.php
<br>│ └── Router.php
<br>├── public/
<br>│ ├── index.php
<br>│ └── .htaccess
<br>├── vendor/
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
    id INT PRIMARY KEY AUTO_INCREMENT,<br>
    nombre VARCHAR(100) NOT NULL,<br>
    email VARCHAR(150) UNIQUE NOT NULL,<br>
    password VARCHAR(255) NOT NULL,<br>
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

**Tabla: contactos**
CREATE TABLE contactos (
    id INT PRIMARY KEY AUTO_INCREMENT,<br>
    usuario_id INT NOT NULL,<br>
    nombre VARCHAR(100) NOT NULL,<br>
    telefono VARCHAR(20) NOT NULL,<br>
    email VARCHAR(150) NOT NULL,<br>
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,<br>
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,<br>
    UNIQUE KEY email_unique (usuario_id, email),<br>
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


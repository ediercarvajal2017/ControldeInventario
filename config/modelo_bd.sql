-- Modelo de Base de Datos para Control de Inventario
-- Creación de tablas principales y relaciones

CREATE DATABASE IF NOT EXISTS controldeinventario;
USE controldeinventario;

-- Tabla de instituciones
CREATE TABLE instituciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_dane VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    tipo_sede ENUM('Principal','Sección') NOT NULL
);

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    documento VARCHAR(20) NOT NULL UNIQUE,
    nombres VARCHAR(80) NOT NULL,
    apellidos VARCHAR(80) NOT NULL,
    cargo ENUM('Docente','Rector','Secretario') NOT NULL,
    institucion_id INT NOT NULL,
    username VARCHAR(40) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','rector','secretario','docente') NOT NULL,
    activo TINYINT(1) DEFAULT 1,
    FOREIGN KEY (institucion_id) REFERENCES instituciones(id)
);

-- Tabla de espacios
CREATE TABLE espacios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(80) NOT NULL,
    numeracion VARCHAR(20) NOT NULL,
    institucion_id INT NOT NULL,
    FOREIGN KEY (institucion_id) REFERENCES instituciones(id)
);

-- Tabla de elementos
CREATE TABLE elementos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(30) NOT NULL UNIQUE,
    descripcion TEXT NOT NULL,
    foto VARCHAR(255),
    valor DECIMAL(12,2) NOT NULL,
    factura VARCHAR(255),
    fecha_ingreso DATE NOT NULL,
    usuario_registro_id INT NOT NULL,
    FOREIGN KEY (usuario_registro_id) REFERENCES usuarios(id)
);

-- Tabla de asignaciones
CREATE TABLE asignaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    elemento_id INT NOT NULL,
    espacio_id INT NOT NULL,
    responsable_id INT NOT NULL,
    fecha_asignacion DATE NOT NULL,
    estado ENUM('En uso','Reintegro','Reparación','Traslado') NOT NULL,
    ubicacion VARCHAR(100) NOT NULL,
    usuario_asigna_id INT NOT NULL,
    FOREIGN KEY (elemento_id) REFERENCES elementos(id),
    FOREIGN KEY (espacio_id) REFERENCES espacios(id),
    FOREIGN KEY (responsable_id) REFERENCES usuarios(id),
    FOREIGN KEY (usuario_asigna_id) REFERENCES usuarios(id)
);

-- Tabla de movimientos
CREATE TABLE movimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    elemento_id INT NOT NULL,
    tipo_movimiento ENUM('Ingreso','Retiro','Traslado','Reintegro','Reparación') NOT NULL,
    fecha DATE NOT NULL,
    estado ENUM('En uso','Traslado','Reintegro','Reparación') NOT NULL,
    usuario_movimiento_id INT NOT NULL,
    destino VARCHAR(100),
    FOREIGN KEY (elemento_id) REFERENCES elementos(id),
    FOREIGN KEY (usuario_movimiento_id) REFERENCES usuarios(id)
);

-- Tabla de actividad de usuarios
CREATE TABLE actividad (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    accion VARCHAR(100) NOT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    descripcion TEXT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

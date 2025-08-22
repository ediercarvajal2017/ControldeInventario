-- Datos de ejemplo para Control de Inventario
USE controldeinventario;

-- Instituciones
INSERT INTO instituciones (codigo_dane, nombre, direccion, tipo_sede) VALUES
('110001', 'Institución Educativa Central', 'Calle 123 #45-67', 'Principal'),
('110002', 'Institución Educativa Sección Norte', 'Avenida 89 #12-34', 'Sección');

-- Usuarios
INSERT INTO usuarios (documento, nombres, apellidos, cargo, username, password, rol, activo) VALUES
('10000001', 'Ana', 'Rectora', 'Rector', 1, 'ana.rector', '$2y$10$EjemploHashRector', 'rector', 1),
('10000002', 'Luis', 'Secretario', 'Secretario', 1, 'luis.secretario', '$2y$10$EjemploHashSecretario', 'secretario', 1),
('10000003', 'Maria', 'Docente', 'Docente', 2, 'maria.docente', '$2y$10$EjemploHashDocente', 'docente', 1);

-- Espacios
INSERT INTO espacios (nombre, numeracion) VALUES
('Aula 101', '101', 1),
('Laboratorio de Ciencias', 'LAB01', 1),
('Sala de Profesores', 'SP01', 2);

-- Elementos
INSERT INTO elementos (codigo, descripcion, foto, valor, factura, fecha_ingreso, usuario_registro_id) VALUES
('E001', 'Proyector Epson XGA', 'proyector.jpg', 1200000, 'factura001.pdf', '2025-08-01', 2),
('E002', 'Mesa de madera grande', 'mesa.jpg', 350000, 'factura002.pdf', '2025-08-02', 2),
('E003', 'Silla ergonómica azul', 'silla.jpg', 180000, 'factura003.pdf', '2025-08-03', 3);

-- Asignaciones
INSERT INTO asignaciones (elemento_id, espacio_id, responsable_id, fecha_asignacion, estado, ubicacion, usuario_asigna_id) VALUES
(1, 2, 3, '2025-08-05', 'En uso', 'Laboratorio de Ciencias', 2),
(2, 1, 2, '2025-08-06', 'En uso', 'Aula 101', 1),
(3, 3, 3, '2025-08-07', 'En uso', 'Sala de Profesores', 1);

-- Movimientos
INSERT INTO movimientos (elemento_id, tipo_movimiento, fecha, estado, usuario_movimiento_id, destino) VALUES
(1, 'Ingreso', '2025-08-01', 'En uso', 2, 'Laboratorio de Ciencias'),
(2, 'Ingreso', '2025-08-02', 'En uso', 2, 'Aula 101'),
(3, 'Ingreso', '2025-08-03', 'En uso', 3, 'Sala de Profesores');

-- Actividad
INSERT INTO actividad (usuario_id, accion, fecha, descripcion) VALUES
(2, 'Registro de elemento', '2025-08-01 09:00:00', 'Se registró el proyector'),
(2, 'Registro de elemento', '2025-08-02 10:00:00', 'Se registró la mesa'),
(3, 'Registro de elemento', '2025-08-03 11:00:00', 'Se registró la silla');

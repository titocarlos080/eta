
CREATE TABLE menus (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL UNIQUE,
    ruta VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE roles ( 
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE roles_menus ( 
    id SERIAL PRIMARY KEY,
    rol_id INT NOT NULL,
    menu_id INT NOT NULL,
    FOREIGN KEY(rol_id) REFERENCES roles(id),
    FOREIGN KEY(menu_id) REFERENCES menus(id)
);


CREATE TABLE tematicas ( 
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE usuarios ( 
    id SERIAL PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    password_reset VARCHAR(255) NULL,
    rol_id INT NOT NULL,
    tematica_id INT NOT NULL,
    FOREIGN KEY(rol_id) REFERENCES roles(id),
    FOREIGN KEY(tematica_id) REFERENCES tematicas(id)
 );


CREATE TABLE estudiantes ( 
    ci VARCHAR(20) NOT NULL PRIMARY KEY,
    nombre VARCHAR(255)   NULL,
    apellido_pat VARCHAR(255)   NULL,
    apellido_mat VARCHAR(255)   NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telefono VARCHAR(255) NULL,
    sexo CHAR(1) CHECK (sexo IN ('M', 'F')),
    fecha_nacimiento VARCHAR NOT NULL,
    usuario_id INT NOT NULL,
    FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
    
 );




CREATE TABLE administrativos ( 
    ci VARCHAR(20) NOT NULL PRIMARY KEY,
    nombre VARCHAR(255)   NULL,
    apellido_pat VARCHAR(255)   NULL,
    apellido_mat VARCHAR(255)   NULL,
    telefono VARCHAR(255) NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    sexo CHAR(1) CHECK (sexo IN ('M', 'F')),
    fecha_nacimiento VARCHAR NOT NULL,
    usuario_id INT NOT NULL,
    FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
  
);

CREATE TABLE docentes ( 
    ci VARCHAR(20) NOT NULL PRIMARY KEY,
    nombre VARCHAR(255)   NULL,
    apellido_pat VARCHAR(255)   NULL,
    apellido_mat VARCHAR(255)   NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    kardex VARCHAR(255) NULL,
    curriculum VARCHAR(255) NULL,
     usuario_id INT NOT NULL, -- Agregado usuario_id
     FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
);
 

-- ///////////////////////////////////////////////////////////
-- ///////////////////////////////////////////////////////////
CREATE OR REPLACE FUNCTION insertar_usuario(
    p_email VARCHAR,
    p_password VARCHAR,
    p_rol_id INT,
    p_tematica_id INT
)
RETURNS INT AS $$
DECLARE
    v_usuario_id INT;
BEGIN
    -- Insertar un nuevo usuario en la tabla usuarios
    INSERT INTO usuarios (email, password, rol_id, tematica_id)
    VALUES (p_email, p_password, p_rol_id, p_tematica_id)
    RETURNING id INTO v_usuario_id;

    RETURN v_usuario_id;
END;
$$ LANGUAGE plpgsql;


-- ///////////////////////////////////////////////////////////

CREATE OR REPLACE FUNCTION insertar_estudiante(
    p_ci VARCHAR,
    p_nombre VARCHAR,
    p_apellido_pat VARCHAR,
    p_apellido_mat VARCHAR,
    p_email VARCHAR,
    p_telefono VARCHAR,
    p_sexo CHAR,
    p_fecha_nacimiento VARCHAR
)

RETURNS INT AS $$
DECLARE
    v_usuario_id INT;
 BEGIN
    -- Insertar un nuevo usuario y obtener su ID
    v_usuario_id := insertar_usuario(p_email, p_ci, 3, 1);  -- Ajustar rol_id y tematica_id según sea necesario

    -- Insertar un nuevo estudiante en la tabla estudiantes
    INSERT INTO estudiantes (ci, nombre, apellido_pat, apellido_mat, email, telefono, sexo, fecha_nacimiento, usuario_id)
    VALUES (p_ci, p_nombre, p_apellido_pat, p_apellido_mat, p_email, p_telefono, p_sexo, p_fecha_nacimiento, v_usuario_id);

    RETURN v_usuario_id;
END;
$$ LANGUAGE plpgsql;
-- //////////////////////////////////////////////////////////
CREATE OR REPLACE FUNCTION insertar_docente(
    p_ci VARCHAR,
    p_nombre VARCHAR,
    p_apellido_pat VARCHAR,
    p_apellido_mat VARCHAR,
    p_email VARCHAR,
    p_kardex VARCHAR,
    p_curriculum VARCHAR
)
RETURNS INT AS $$
DECLARE
    v_usuario_id INT;
 BEGIN
    -- Insertar un nuevo usuario y obtener su ID
    v_usuario_id := insertar_usuario(p_email, p_ci, 2, 1);  -- Ajustar rol_id y tematica_id según sea necesario

    -- Insertar un nuevo docente en la tabla docentes
    INSERT INTO docentes (ci, nombre, apellido_pat, apellido_mat, email, kardex, curriculum, usuario_id)
    VALUES (p_ci, p_nombre, p_apellido_pat, p_apellido_mat, p_email, p_kardex, p_curriculum, v_usuario_id);

    RETURN v_usuario_id;
END;
$$ LANGUAGE plpgsql;
-- //////////////////////////////////////////////////////////

CREATE OR REPLACE FUNCTION insertar_administrativo(
    p_ci VARCHAR,
    p_nombre VARCHAR,
    p_apellido_pat VARCHAR,
    p_apellido_mat VARCHAR,
    p_email VARCHAR,
    p_telefono VARCHAR,
    p_sexo CHAR,
    p_fecha_nacimiento VARCHAR
)
RETURNS INT AS $$
DECLARE
    v_usuario_id INT;
 BEGIN
    -- Insertar un nuevo usuario y obtener su ID
    v_usuario_id := insertar_usuario(p_email, p_ci, 1, 1);  -- Ajustar rol_id y tematica_id según sea necesario

    -- Insertar un nuevo administrativo en la tabla administrativos
    INSERT INTO administrativos (ci, nombre, apellido_pat, apellido_mat, telefono, email, sexo, fecha_nacimiento, usuario_id)
    VALUES (p_ci, p_nombre, p_apellido_pat, p_apellido_mat, p_telefono, p_email, p_sexo, p_fecha_nacimiento, v_usuario_id);

    RETURN v_usuario_id;
END;
$$ LANGUAGE plpgsql;

-- ////////////////////////////////////////////////////////////////////


-- ///////////### TRIGGER  ###/////////////////////

CREATE TABLE gestiones ( 
    codigo SERIAL PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    fecha_inicio DATE ,
    fecha_fin DATE
 );

CREATE TABLE carreras ( 
    sigla VARCHAR(255) PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    gestion_codigo INT NOT NULL,
    FOREIGN KEY(gestion_codigo) REFERENCES gestiones(codigo)
);
 

CREATE TABLE niveles ( 
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE materias ( 
    sigla VARCHAR(255) PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    observacion VARCHAR(255) NOT NULL,
    creditos INT NOT NULL

);

CREATE TABLE carreras_materias ( 
    nivel_id INT NOT NULL,
    materia_sigla VARCHAR(255)  NOT NULL,
    carrera_sigla VARCHAR(255)  NOT NULL,
    PRIMARY KEY(materia_sigla,carrera_sigla),
    FOREIGN KEY(nivel_id) REFERENCES niveles(id),
    FOREIGN KEY(materia_sigla) REFERENCES materias(sigla),
    FOREIGN KEY(carrera_sigla) REFERENCES carreras(sigla)
);
 
CREATE TABLE carrera_estudiantes ( 
    id SERIAL PRIMARY KEY,
    fecha_inscripcion DATE NOT NULL,
    estudiante_ci VARCHAR(20)  NOT NULL,
    carrera_sigla VARCHAR(255)  NOT NULL,
     FOREIGN KEY(estudiante_ci) REFERENCES estudiantes(ci),
     FOREIGN KEY(carrera_sigla) REFERENCES carreras(sigla)
);


-- ////////////////////////////////////////////////////////////////////////////
CREATE TABLE grupo_materias (
    sigla VARCHAR(10) NOT NULL PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    materia_sigla VARCHAR(255)  NOT NULL,
    carrera_sigla VARCHAR(255)  NOT NULL,
    docente_ci  VARCHAR(20) NOT NULL,
     FOREIGN KEY(docente_ci) REFERENCES docentes(ci),
     FOREIGN KEY(materia_sigla) REFERENCES materias(sigla),
    FOREIGN KEY(carrera_sigla) REFERENCES carreras(sigla)
 
 );

CREATE TABLE horarios ( 
    id SERIAL PRIMARY KEY,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL
);

CREATE TABLE dias ( 
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE grupo_materia_horarios ( 
    grupo_sigla VARCHAR(10) NOT NULL,
    horario_id INT NOT NULL,
    dia_id INT NOT NULL,
    PRIMARY KEY(grupo_sigla,horario_id),
    FOREIGN KEY(dia_id)  REFERENCES dias(id),
     FOREIGN KEY(grupo_sigla) REFERENCES grupos_materias(sigla),
     FOREIGN KEY(horario_id) REFERENCES horarios(id)
 );

CREATE TABLE estudiante_materia ( 
    id SERIAL PRIMARY KEY  NOT NULL,
    fecha DATE NOT NULL,
    grupos_materias_sigla VARCHAR(10) NOT NULL,
    estudiante_ci VARCHAR(20) NOT NULL,
     FOREIGN KEY(grupos_materias_sigla)  REFERENCES grupos_materias(sigla),
     FOREIGN KEY(estudiante_ci) REFERENCES estudiantes(ci)
  );


CREATE TABLE notas ( 
    id SERIAL PRIMARY KEY,
    nota_final NUMERIC(5, 2) NOT NULL CHECK (nota_final >= 1 AND nota_final <= 100),
    estudiante_materia_id INT NOT NULL, 
     FOREIGN KEY(estudiante_materia_id) REFERENCES estudiante_materia(id)
 );

 

CREATE TABLE pagos (
    id SERIAL PRIMARY KEY,
    monto DECIMAL(10,2) NOT NULL,
    fecha DATE NOT NULL,
    concepto VARCHAR(255) NOT NULL,
    estudiante_materia_id INT NOT NULL, 
     FOREIGN KEY(estudiante_materia_id) REFERENCES estudiante_materia(id)
 
 );
 
 CREATE TABLE egresos (
    id SERIAL PRIMARY KEY,
    monto DECIMAL(10,2) NOT NULL,
    fecha DATE NOT NULL,
    concepto VARCHAR(255) NOT NULL,
    gestion_codigo INT NOT NULL,
    FOREIGN KEY(gestion_codigo) REFERENCES gestiones(codigo)
 
 );

-- // GESTION DE OFERTAS, GENERACION DE OFERTAS

-- select g.descripcion, ca.descripcion,cm.materia_sigla,gm.descripcion,doc.nombre, dias.nombre ,h.hora_inicio, h.hora_fin
-- from  gestiones g,carreras ca,carreras_materias cm,grupos_materias gm,docentes doc,grupo_materia_horarios gmh,horarios h, dias
-- where g.codigo=ca.gestion_codigo and ca.sigla = cm.carrera_sigla and
-- gm.materia_sigla= cm.materia_sigla  and gm.docente_ci = doc.ci and gm.sigla = gmh.grupo_sigla and
-- gmh.horario_id=h.id and gmh.dia_id= dias.id

CREATE VIEW ofertas AS
SELECT 
    g.descripcion AS gestion_descripcion, 
    ca.descripcion AS carrera_descripcion,
    cm.materia_sigla,
    gm.descripcion AS grupo_materia_descripcion,
    doc.nombre AS docente_nombre,
    dias.nombre AS dia_nombre,
    h.hora_inicio,
    h.hora_fin
FROM  
    gestiones g
    JOIN carreras ca ON g.codigo = ca.gestion_codigo
    JOIN carreras_materias cm ON ca.sigla = cm.carrera_sigla
    JOIN grupos_materias gm ON gm.materia_sigla = cm.materia_sigla
    JOIN docentes doc ON gm.docente_ci = doc.ci
    JOIN grupo_materia_horarios gmh ON gm.sigla = gmh.grupo_sigla
    JOIN horarios h ON gmh.horario_id = h.id
    JOIN dias ON gmh.dia_id = dias.id;


/*
REPORTES

Egresos por Gestión


SELECT g.descripcion AS gestion, SUM(e.monto) AS total_egresos
FROM egresos e
JOIN gestiones g ON e.gestion_codigo = g.codigo
GROUP BY g.descripcion;

Ingresos por Gestión

SELECT g.descripcion AS gestion, SUM(p.monto) AS total_ingresos
FROM pagos p
JOIN estudiante_materia em ON p.estudiante_materia_id = em.id
JOIN estudiantes e ON em.estudiante_ci = e.ci
JOIN estudiantes_carrera ec ON e.ci = ec.estudiante_ci
JOIN gestiones g ON ec.carrera_sigla = g.codigo
GROUP BY g.descripcion;

Estudiantes por Carrera

SELECT c.descripcion AS carrera, COUNT(ec.estudiante_ci) AS num_estudiantes
FROM estudiantes_carrera ec
JOIN carreras c ON ec.carrera_sigla = c.sigla
GROUP BY c.descripcion;





*/



--  DATOS
-- Datos de roles
INSERT INTO roles (nombre) VALUES
('Admin'),
('Docente'),
('Estudiante');



INSERT INTO tematicas (nombre) VALUES
('Dia'),
('Noche'),
('Niño'),
('Joven'),
('Adulto');

SELECT insertar_administrativo(
    '123',     -- p_ci
    'Tito',           -- p_nombre
    'Carlos',          -- p_apellido_pat
    'Gutierrez',         -- p_apellido_mat
    'titocarlos080@gmail.com', -- p_email
    '123456789',      -- p_telefono
    'M',              -- p_sexo (F o M)
    '2000-01-15'      -- p_fecha_nacimiento
);
  

-- Datos de gestiones
INSERT INTO gestiones (descripcion, fecha_inicio, fecha_fin) VALUES
('Gestion 2024', '2024-01-01', '2024-12-31');

-- Datos de carreras
INSERT INTO carreras (sigla, descripcion, gestion_codigo) VALUES
('INF', 'Ingenieria Informatica', 1),
('ADM', 'Administracion de Empresas', 1);

-- Datos de niveles
INSERT INTO niveles (nombre) VALUES
('Basico'),
('Intermedio'),
('Avanzado');

-- Datos de materias
INSERT INTO materias (sigla, descripcion, observacion, creditos) VALUES
('MAT101', 'Matematicas Basicas', 'Sin observaciones', 3),
('INF101', 'Introduccion a la Informatica', 'Sin observaciones', 4),
('ADM101', 'Introduccion a la Administracion', 'Sin observaciones', 3);

-- Datos de carreras_materias
INSERT INTO carreras_materias (nivel_id, materia_sigla, carrera_sigla) VALUES
(1, 'MAT101', 'INF'),
(1, 'INF101', 'INF'),
(1, 'ADM101', 'ADM');

-- Datos de grupos
INSERT INTO grupos_materias (sigla, descripcion, materia_sigla, carrera_sigla, docente_id) VALUES
('G1', 'Grupo 1 de Matematicas', 'MAT101', 'INF', 1),
('G2', 'Grupo 2 de Informatica', 'INF101', 'INF', 2),
('G3', 'Grupo 3 de Administracion', 'ADM101', 'ADM', 2);

-- Datos de horarios
INSERT INTO horarios (hora_inicio, hora_fin) VALUES
('08:00:00', '10:00:00'),
('10:00:00', '12:00:00'),
('14:00:00', '16:00:00');

-- Datos de dias
INSERT INTO dias (nombre) VALUES
('Lunes'),
('Martes'),
('Miercoles'),
('Jueves'),
('Viernes');

 

 INSERT INTO egresos (monto, fecha, concepto, gestion_codigo) VALUES
(1500.50, '2023-01-15', 'Compra de materiales de oficina', 1),
(2500.75, '2023-02-20', 'Pago de servicios públicos', 1),
(3200.00, '2023-03-10', 'Reparación de equipos de computación', 1),
(4100.90, '2023-04-05', 'Mantenimiento del edificio', 1)
 






// eliminacion de tablas
DO $$ 
DECLARE
    r RECORD;
BEGIN
    FOR r IN (SELECT tablename FROM pg_tables WHERE schemaname = 'public') LOOP
        EXECUTE 'DROP TABLE IF EXISTS ' || quote_ident(r.tablename) || ' CASCADE';
    END LOOP;
END $$;

--Insertando datos
   -- Insertar roles
INSERT INTO roles (nombre) VALUES
('Admin'),
('Docente'),
('Estudiante');


-- Insertar tematicas
INSERT INTO tematicas (nombre) VALUES
('Dia'),
('Noche'),
('Niño'),
('Joven'),
('Adulto');

-- Datos de dias
INSERT INTO dias (nombre) VALUES
('Lunes'),
('Martes'),
('Miercoles'),
('Jueves'),
('Viernes');

-- Insertar datos en la tabla menus
INSERT INTO menus (id, name, url, icon, parent_id, orden, created_at, updated_at) VALUES
(1, 'Gestión de Usuarios', NULL, 'fas fa-users', 0, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(2, 'Gestión de Gestiones', NULL, 'fas fa-calendar-alt', 0, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(3, 'Gestión de Materias', NULL, 'fas fa-book', 0, 3, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(4, 'Gestión de Carreras', NULL, 'fas fa-graduation-cap', 0, 4, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(5, 'Gestión de Ofertas', NULL, 'fas fa-clipboard-list', 0, 5, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(6, 'Gestión de Inscripciones', NULL, 'fas fa-user-check', 0, 6, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(7, 'Gestión de Pagos', NULL, 'fas fa-money-bill-wave', 0, 7, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(8, 'Reportes y Estadísticas', NULL, 'fas fa-chart-bar', 0, 8, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(9, 'Configuración', NULL, 'fas fa-cog', 0, 9, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(10, 'Crear Usuario', 'usuarios/create', 'fas fa-user-plus', 1, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(11, 'Listar Usuarios', 'usuarios', 'fas fa-users', 1, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(12, 'Estudiantes', 'estudiantes', 'fas fa-user-graduate', 1, 3, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(13, 'Docentes', 'docentes', 'fas fa-chalkboard-teacher', 1, 4, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(14, 'Administrativos', 'administrativos', 'fas fa-user-tie', 1, 5, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(15, 'Crear Gestión', 'gestiones/create', 'fas fa-calendar-plus', 2, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(16, 'Listar Gestiones', 'gestiones', 'fas fa-calendar-alt', 2, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(17, 'Crear Materia', 'materias/create', 'fas fa-book-medical', 3, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(18, 'Listar Materias', 'materias', 'fas fa-book', 3, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(19, 'Crear Carrera', 'carreras/create', 'fas fa-graduation-cap', 4, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(20, 'Listar Carreras', 'carreras', 'fas fa-list-alt', 4, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(21, 'Niveles', 'niveles', 'fas fa-layer-group', 4, 3, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(22, 'Grupos', 'grupo_materias', 'fas fa-users-cog', 4, 4, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(23, 'Horarios', 'horarios', 'fas fa-clock', 4, 5, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(24, 'Crear Oferta', 'ofertas/create', 'fas fa-plus-square', 5, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
 (25, 'Listar Ofertas', 'ofertas', 'fas fa-th-list', 5, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(26, 'Crear Inscripción', 'inscripciones/create', 'fas fa-plus-square', 6, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(27, 'Listar Inscripciones', 'inscripciones', 'fas fa-list', 6, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(28, 'Inscribir Carrera', 'carrera_estudiantes', 'fas fa-graduation-cap', 6, 3, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(29, 'Inscribir Materia', 'materia_estudiantes', 'fas fa-book', 6, 4, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(30, 'Crear Pago', 'pagos/create', 'fas fa-money-check-alt', 7, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(31, 'Listar Pagos', 'pagos', 'fas fa-money-bill-wave', 7, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(32, 'Pagar QR', 'pagos/qr', 'fas fa-qrcode', 7, 3, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(33, 'Pagos por QR', 'pagos/lista-qr', 'fas fa-receipt', 7, 4, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(34, 'Egresos', 'egresos', 'fas fa-file-invoice', 7, 5, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(35, 'Crear Reporte', 'reportes/create', 'fas fa-file-alt', 8, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(36, 'Listar Reportes', 'reportes', 'fas fa-chart-line', 8, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(37, 'Ver Estadísticas', 'estadisticas/estudiantes', 'fas fa-chart-pie', 8, 3, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(38, 'Permisos', 'permisos', 'fas fa-user-shield', 9, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(39, 'Roles', 'roles', 'fas fa-user-tag', 9, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12');

 


-- Insertar datos en la tabla role_menus
INSERT INTO role_menus (id, role_id, menu_id, created_at, updated_at) VALUES
(1, 1, 1, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(2, 1, 2, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(3, 1, 3, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(4, 1, 4, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(5, 1, 5, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(6, 1, 6, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(7, 1, 7, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(8, 1, 8, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(9, 1, 9, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(10, 1, 10, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(11, 1, 11, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(12, 1, 12, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(13, 1, 13, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(14, 1, 14, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(15, 1, 15, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(16, 1, 16, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(17, 1, 17, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(18, 1, 18, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(19, 1, 19, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(20, 1, 20, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(21, 1, 21, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(22, 1, 22, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(23, 1, 23, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(24, 1, 24, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(25, 1, 25, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(26, 1, 26, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(27, 1, 27, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(28, 1, 28, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(29, 1, 29, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(30, 1, 30, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(31, 1, 31, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(32, 1, 32, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(33, 1, 33, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(34, 1, 34, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(35, 1, 35, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(36, 1, 36, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(37, 1, 37, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(38, 1, 38, '2024-07-16 18:41:12', '2024-07-16 18:41:12'),
(39, 1, 39, '2024-07-16 18:41:12', '2024-07-16 18:41:12');
 

 -- Insertar 10 usuarios con rol de Admin
INSERT INTO usuarios (name, email, password, rol_id, created_at, updated_at) VALUES
('Ana Martínez', 'ana.martinez@example.com', 'password1', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Carlos Fernández', 'carlos.fernandez@example.com', 'password2', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Elena Gómez', 'elena.gomez@example.com', 'password3', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Jorge Ruiz', 'jorge.ruiz@example.com', 'password4', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Laura Pérez', 'laura.perez@example.com', 'password5', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Manuel López', 'manuel.lopez@example.com', 'password6', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Marta Fernández', 'marta.fernandez@example.com', 'password7', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Nicolás García', 'nicolas.garcia@example.com', 'password8', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Paula Rodríguez', 'paula.rodriguez@example.com', 'password9', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Rafael Martínez', 'rafael.martinez@example.com', 'password10', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Tito Carlos', 'titocarlos080@gmail.com', '$2y$10$qS5eKHRlnCJLf9jkokpaGOjDEJBFCvTJ8RN4wsGhGLNyquaaBF2ba', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- Insertar 10 usuarios con rol de Docente
INSERT INTO usuarios (name, email, password, rol_id, created_at, updated_at) VALUES
('Adriana Torres', 'adriana.torres@example.com', 'password1', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('David Moreno', 'david.moreno@example.com', 'password2', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Isabel Castillo', 'isabel.castillo@example.com', 'password3', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Luis Méndez', 'luis.mendez@example.com', 'password4', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Patricia Romero', 'patricia.romero@example.com', 'password5', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Ricardo Silva', 'ricardo.silva@example.com', 'password6', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Sandra Ortega', 'sandra.ortega@example.com', 'password7', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Tomás Delgado', 'tomas.delgado@example.com', 'password8', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Valeria Peña', 'valeria.pena@example.com', 'password9', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Víctor Bravo', 'victor.bravo@example.com', 'password10', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- Insertar 10 usuarios con rol de Estudiante
INSERT INTO usuarios (name, email, password, rol_id, created_at, updated_at) VALUES
('Alejandro Soto', 'alejandro.soto@example.com', 'password1', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Beatriz Vargas', 'beatriz.vargas@example.com', 'password2', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Camilo Cordero', 'camilo.cordero@example.com', 'password3', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Daniela Jiménez', 'daniela.jimenez@example.com', 'password4', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Esteban Ramírez', 'esteban.ramirez@example.com', 'password5', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Gabriela Álvarez', 'gabriela.alvarez@example.com', 'password6', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Hugo Morales', 'hugo.morales@example.com', 'password7', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Ivanna Morales', 'ivanna.morales@example.com', 'password8', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Javier Soto', 'javier.soto@example.com', 'password9', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('Katherine Salazar', 'katherine.salazar@example.com', 'password10', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- Insertar 10 docentes
INSERT INTO docentes (ci, nombre, apellido_pat, apellido_mat, email, kardex, curriculum, usuario_id, created_at, updated_at) VALUES
('12345678A', 'Alejandro', 'Martínez', 'Gómez', 'alejandro.martinez@example.com', 'Kardex01', 'Curriculum01', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('12345678B', 'Beatriz', 'Vargas', 'Castro', 'beatriz.vargas@example.com', 'Kardex02', 'Curriculum02', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('12345678C', 'Carlos', 'Moreno', 'Mora', 'carlos.moreno@example.com', 'Kardex03', 'Curriculum03', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('12345678D', 'Daniela', 'Jiménez', 'Hernández', 'daniela.jimenez@example.com', 'Kardex04', 'Curriculum04', 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('12345678E', 'Esteban', 'Ramírez', 'Fernández', 'esteban.ramirez@example.com', 'Kardex05', 'Curriculum05', 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('12345678F', 'Gabriela', 'Álvarez', 'Cordero', 'gabriela.alvarez@example.com', 'Kardex06', 'Curriculum06', 6, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('12345678G', 'Hugo', 'Morales', 'Alvarado', 'hugo.morales@example.com', 'Kardex07', 'Curriculum07', 7, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('12345678H', 'Ivanna', 'Morales', 'Castro', 'ivanna.morales@example.com', 'Kardex08', 'Curriculum08',8, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('12345678I', 'Javier', 'Soto', 'Bravo', 'javier.soto@example.com', 'Kardex09', 'Curriculum09', 9, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('12345678J', 'Katherine', 'Salazar', 'Vásquez', 'katherine.salazar@example.com', 'Kardex10', 'Curriculum10',10, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- Insertar 10 estudiantes
INSERT INTO estudiantes (ci, nombre, apellido_pat, apellido_mat, email, telefono, sexo, fecha_nacimiento, usuario_id, created_at, updated_at) VALUES
('98765432A', 'Lucía', 'Pérez', 'Jiménez', 'lucia.perez@example.com', '123456789', 'F', '2002-01-15', 11, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('98765432B', 'Mateo', 'López', 'Ramírez', 'mateo.lopez@example.com', '234567890', 'M', '2002-02-20', 12, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('98765432C', 'Natalia', 'Torres', 'Bermúdez', 'natalia.torres@example.com', '345678901', 'F', '2002-03-12', 13, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('98765432D', 'Oscar', 'García', 'Paredes', 'oscar.garcia@example.com', '456789012', 'M', '2002-04-25', 14, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('98765432E', 'Paola', 'Gómez', 'Arroyo', 'paola.gomez@example.com', '567890123', 'F', '2002-05-05', 15, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('98765432F', 'Quintín', 'Jaramillo', 'Silva', 'quintin.jaramillo@example.com', '678901234', 'M', '2002-06-10', 16, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('98765432G', 'Renata', 'Rivas', 'Castro', 'renata.rivas@example.com', '789012345', 'F', '2002-07-14', 17, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('98765432H', 'Santiago', 'Hernández', 'Gómez', 'santiago.hernandez@example.com', '890123456', 'M', '2002-08-19', 18, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('98765432I', 'Tania', 'Arias', 'Valencia', 'tania.arias@example.com', '901234567', 'F', '2002-09-22', 19, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('98765432J', 'Ulises', 'Montoya', 'Ramírez', 'ulises.montoya@example.com', '012345678', 'M', '2002-10-30', 20, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- Insertar 10 administrativos
INSERT INTO administrativos (ci, nombre, apellido_pat, apellido_mat, email, telefono,   usuario_id, created_at, updated_at) VALUES
('56473829A', 'Gabriel', 'Sánchez', 'Téllez', 'gabriel.sanchez@example.com', '321654987',   21, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('56473829B', 'Helena', 'García', 'Arias', 'helena.garcia@example.com', '432165789',   22, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('56473829C', 'Ignacio', 'Romero', 'Cano', 'ignacio.romero@example.com', '543216897',  23, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('56473829D', 'Jazmín', 'Martínez', 'Rivas', 'jazmin.martinez@example.com', '654327098',  24, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('56473829E', 'Kevin', 'Paredes', 'Gutiérrez', 'kevin.paredes@example.com', '765438109',   25, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('56473829F', 'Laura', 'Vásquez', 'Medina', 'laura.vasquez@example.com', '876549210',   26, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('56473829G', 'Marcelo', 'Mora', 'Tobar', 'marcelo.mora@example.com', '987654321',  27, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('56473829H', 'Nerea', 'Hernández', 'Bravo', 'nerea.hernandez@example.com', '098765432',   28, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('56473829I', 'Oscar', 'Suárez', 'Figueroa', 'oscar.suarez@example.com', '109876543',   29, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('56473829J', 'Paula', 'Salazar', 'Cruz', 'paula.salazar@example.com', '210987654',  30, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
('9441550', 'Tito', 'Carlos', 'Gutierrez', 'titocarlos080@gmail.com', '210987654',  11, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO gestiones (descripcion, fecha_inicio, fecha_fin) VALUES
('Gestión 2022', '2022-01-01', '2022-12-31'),
('Gestión 2023', '2023-01-01', '2023-12-31'),
('Gestión 2024', '2024-01-01', '2024-12-31');

INSERT INTO niveles (nombre) VALUES
('Básico'),
('Intermedio'),
('Avanzado');

INSERT INTO carreras (sigla, descripcion, gestion_codigo, created_at, updated_at) VALUES
('CS101', 'Ciencias de la Computación - Básico', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('CS102', 'Ciencias de la Computación - Intermedio', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('CS201', 'Ingeniería de Software - Básico', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('CS202', 'Ingeniería de Software - Intermedio', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('CS301', 'Redes de Computadoras - Básico', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('CS302', 'Redes de Computadoras - Intermedio', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('CS401', 'Inteligencia Artificial - Básico', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('CS402', 'Inteligencia Artificial - Intermedio', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('CS501', 'Desarrollo Web - Avanzado', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('CS502', 'Desarrollo Móvil - Avanzado', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO materias (sigla, descripcion, observacion, creditos, estado, created_at, updated_at) VALUES
-- Materias 1-10 (Anteriores)
('MAT101', 'Matemáticas I', 'Materia fundamental para el cálculo', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('MAT102', 'Matemáticas II', 'Avanzado en matemáticas aplicadas', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('FIS101', 'Física I', 'Conceptos básicos de física', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('FIS102', 'Física II', 'Física avanzada y experimentos', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('QUI101', 'Química I', 'Fundamentos de química general', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('QUI102', 'Química II', 'Química orgánica e inorgánica', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('BIO101', 'Biología I', 'Introducción a la biología', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('BIO102', 'Biología II', 'Biología celular y molecular', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('INF101', 'Programación I', 'Fundamentos de la programación', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('INF102', 'Programación II', 'Estructuras avanzadas y algoritmos', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

-- Materias 11-20 (Nuevas)
('MAT201', 'Matemáticas III', 'Cálculo integral y diferencial', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('MAT202', 'Matemáticas IV', 'Álgebra lineal y matrices', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('FIS201', 'Física III', 'Electromagnetismo', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('FIS202', 'Física IV', 'Óptica y física moderna', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('QUI201', 'Química III', 'Química analítica', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('QUI202', 'Química IV', 'Química de materiales', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('BIO201', 'Biología III', 'Genética y evolución', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('BIO202', 'Biología IV', 'Ecología y medio ambiente', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('INF201', 'Programación III', 'Desarrollo de aplicaciones web', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('INF202', 'Programación IV', 'Bases de datos y SQL', 4, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO horarios (hora_inicio, hora_fin, created_at, updated_at) VALUES
-- Horarios 1-5 (Anteriores)
('08:00:00', '10:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('10:00:00', '12:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('13:00:00', '15:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('15:00:00', '17:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('17:00:00', '19:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

-- Horarios 6-10 (Nuevos)
('07:00:00', '09:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('09:00:00', '11:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('11:00:00', '13:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('14:00:00', '16:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('16:00:00', '18:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

-- Horarios 11-15
('08:00:00', '09:30:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('09:30:00', '11:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('11:00:00', '12:30:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('12:30:00', '14:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('14:00:00', '15:30:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

-- Horarios 16-20
('15:30:00', '17:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('17:00:00', '18:30:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('18:30:00', '20:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('20:00:00', '21:30:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
('21:30:00', '23:00:00', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


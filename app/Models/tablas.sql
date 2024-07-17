 -- Tabla gestiones
CREATE TABLE gestiones (
    codigo SERIAL PRIMARY KEY,
    descripcion VARCHAR(255),
    fecha_inicio DATE,
    fecha_fin DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla menus
CREATE TABLE menus (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255),
    url VARCHAR(255),
    icon VARCHAR(255),
    parent_id BIGINT,
    "order" INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES menus(id) ON DELETE CASCADE
);

-- Tabla tematicas
CREATE TABLE tematicas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla paginas
CREATE TABLE paginas (
    id SERIAL PRIMARY KEY,
    path VARCHAR(255) UNIQUE,
    visitas INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla roles
CREATE TABLE roles (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla role_menus
CREATE TABLE role_menus (
    id SERIAL PRIMARY KEY,
    role_id BIGINT,
    menu_id BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE
);

-- Tabla usuarios
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    password_reset VARCHAR(255),
    rol_id BIGINT,
    tematica_id BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (rol_id) REFERENCES roles(id),
    FOREIGN KEY (tematica_id) REFERENCES tematicas(id)
);

-- Tabla docentes
CREATE TABLE docentes (
    ci VARCHAR(255) PRIMARY KEY,
    nombre VARCHAR(255),
    apellido_pat VARCHAR(255),
    apellido_mat VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    kardex VARCHAR(255),
    curriculum VARCHAR(255),
    usuario_id BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla niveles
CREATE TABLE niveles (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255)
);

-- Tabla carreras
CREATE TABLE carreras (
    sigla VARCHAR(255) PRIMARY KEY,
    descripcion VARCHAR(255),
    gestion_codigo INTEGER,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (gestion_codigo) REFERENCES gestiones(codigo) ON DELETE CASCADE
);

-- Tabla estudiantes
CREATE TABLE estudiantes (
    ci VARCHAR(255) PRIMARY KEY,
    nombre VARCHAR(255),
    apellido_pat VARCHAR(255),
    apellido_mat VARCHAR(255),
    email VARCHAR(255),
    telefono VARCHAR(255),
    sexo CHAR(1) CHECK (sexo IN ('M', 'F')),
    fecha_nacimiento DATE,
    usuario_id BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
);
-- Tabla pagos
CREATE TABLE pagos (
    id SERIAL PRIMARY KEY,
    estudiante_ci VARCHAR(255),
    concepto VARCHAR(255),
    fecha TIMESTAMP,
    monto INTEGER,
    mes_pago VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (estudiante_ci) REFERENCES estudiantes(ci) ON DELETE CASCADE
);

-- Tabla materias
CREATE TABLE materias (
    sigla VARCHAR(255) UNIQUE,
    descripcion VARCHAR(255),
    observacion VARCHAR(255),
    creditos INTEGER,
    estado BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (sigla)
);

-- Tabla horarios
CREATE TABLE horarios (
    id SERIAL PRIMARY KEY,
    hora_inicio TIME,
    hora_fin TIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla carrera_materias
CREATE TABLE carrera_materias (
    id SERIAL PRIMARY KEY,
    nivel_id BIGINT,
    materia_sigla VARCHAR(255),
    carrera_sigla VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nivel_id) REFERENCES niveles(id),
    FOREIGN KEY (materia_sigla) REFERENCES materias(sigla),
    FOREIGN KEY (carrera_sigla) REFERENCES carreras(sigla)
);

-- Tabla grupo_materias
CREATE TABLE grupo_materias (
    sigla VARCHAR(255) PRIMARY KEY,
    descripcion VARCHAR(255),
    materia_sigla VARCHAR(255),
    carrera_sigla VARCHAR(255),
    docente_ci VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (materia_sigla) REFERENCES materias(sigla),
    FOREIGN KEY (carrera_sigla) REFERENCES carreras(sigla),
    FOREIGN KEY (docente_ci) REFERENCES docentes(ci)
);

-- Tabla carrera_estudiantes
CREATE TABLE carrera_estudiantes (
    id SERIAL PRIMARY KEY,
    fecha_inscripcion DATE,
    estudiante_ci VARCHAR(255),
    carrera_sigla VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (estudiante_ci) REFERENCES estudiantes(ci),
    FOREIGN KEY (carrera_sigla) REFERENCES carreras(sigla)
);

-- Tabla estudiante_materia
CREATE TABLE estudiante_materia (
    id SERIAL PRIMARY KEY,
    fecha DATE,
    grupos_materias_sigla VARCHAR(255),
    estudiante_ci VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (grupos_materias_sigla) REFERENCES grupo_materias(sigla) ON DELETE CASCADE,
    FOREIGN KEY (estudiante_ci) REFERENCES estudiantes(ci) ON DELETE CASCADE
);

-- Tabla dias
CREATE TABLE dias (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla grupo_materia_horarios
CREATE TABLE grupo_materia_horarios (
    id SERIAL PRIMARY KEY,
    grupo_sigla VARCHAR(255),
    horario_id BIGINT,
    dia_id BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (grupo_sigla) REFERENCES grupo_materias(sigla) ON DELETE CASCADE,
    FOREIGN KEY (horario_id) REFERENCES horarios(id) ON DELETE CASCADE,
    FOREIGN KEY (dia_id) REFERENCES dias(id) ON DELETE CASCADE
);


-- Tabla: especialidad
CREATE TABLE especialidad (
    id_especialidad SERIAL PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    descripcion TEXT
);

-- Tabla: destino
CREATE TABLE destino (
    id_destino SERIAL PRIMARY KEY,
    ciudad VARCHAR(50) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    requiere_pasaporte BOOLEAN NOT NULL DEFAULT FALSE
);

-- Tabla: usuario
CREATE TABLE usuario (
    id_usuario SERIAL PRIMARY KEY,
    dni VARCHAR(20) UNIQUE NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    edad INTEGER NOT NULL
);

-- Tabla: guia
CREATE TABLE guia (
    id_guia SERIAL PRIMARY KEY,
    dni VARCHAR(20) UNIQUE NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    id_especialidad INTEGER REFERENCES especialidad(id_especialidad),
    id_destino INTEGER REFERENCES destino(id_destino)
);

-- Tabla: pasaporte
CREATE TABLE pasaporte (
    numero VARCHAR(50) PRIMARY KEY,
    pais_exp VARCHAR(50) NOT NULL,
    fecha_validez DATE NOT NULL,
    id_usuario INTEGER REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

-- Tabla: viajar
CREATE TABLE viajar (
    dni_usuario VARCHAR(20),
    id_destino INTEGER,
    fecha_viaje DATE NOT NULL,
    PRIMARY KEY (dni_usuario, id_destino),
    FOREIGN KEY (dni_usuario) REFERENCES usuario(dni),
    FOREIGN KEY (id_destino) REFERENCES destino(id_destino)
);

CREATE TABLE usuario_destino (
    id SERIAL PRIMARY KEY,
    id_usuario INTEGER REFERENCES usuario(id_usuario),
    id_destino INTEGER REFERENCES destino(id_destino),
    fecha_inscripcion DATE
);


-- Tabla: posse (relación entre usuario y pasaporte)
CREATE TABLE posse (
    dni_usuario VARCHAR(20),
    numero_pasaporte VARCHAR(50),
    PRIMARY KEY (dni_usuario, numero_pasaporte),
    FOREIGN KEY (dni_usuario) REFERENCES usuario(dni),
    FOREIGN KEY (numero_pasaporte) REFERENCES pasaporte(numero)
);

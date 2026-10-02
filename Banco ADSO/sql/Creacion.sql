CREATE DATABASE db_banco_adso;

USE db_banco_adso;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE cuentas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_cuenta VARCHAR(20) NOT NULL UNIQUE,
    saldo DECIMAL(12,2) NOT NULL DEFAULT 0,
    cliente_id INT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cuenta_id INT NOT NULL UNIQUE,
    clave_hash VARCHAR(255) NOT NULL,
    FOREIGN KEY (cuenta_id) REFERENCES cuentas(id)
);

CREATE TABLE retiros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cuenta_id INT NOT NULL,
    valor DECIMAL(12,2) NOT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cuenta_id) REFERENCES cuentas(id)
);

CREATE TABLE transferencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cuenta_origen_id INT NOT NULL,
    cuenta_destino_id INT NOT NULL,
    valor DECIMAL(12,2) NOT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cuenta_origen_id) REFERENCES cuentas(id),
    FOREIGN KEY (cuenta_destino_id) REFERENCES cuentas(id)
);
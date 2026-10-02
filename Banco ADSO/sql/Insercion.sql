USE db_banco_adso;

INSERT INTO clientes (nombre) VALUES ('Ana Torres');
INSERT INTO clientes (nombre) VALUES ('Luis Perez');
INSERT INTO clientes (nombre) VALUES ('Maria Gomez');
INSERT INTO clientes (nombre) VALUES ('Carlos Ruiz');
INSERT INTO clientes (nombre) VALUES ('Sofia Diaz');
INSERT INTO clientes (nombre) VALUES ('Jhosep Suarez');

INSERT INTO cuentas (numero_cuenta, saldo, cliente_id) VALUES ('1001', 500000, 1);
INSERT INTO cuentas (numero_cuenta, saldo, cliente_id) VALUES ('1002', 250000, 2);
INSERT INTO cuentas (numero_cuenta, saldo, cliente_id) VALUES ('1003', 1200000, 3);
INSERT INTO cuentas (numero_cuenta, saldo, cliente_id) VALUES ('1004', 80000, 4);
INSERT INTO cuentas (numero_cuenta, saldo, cliente_id) VALUES ('1005', 30000, 5);
INSERT INTO cuentas (numero_cuenta, saldo, cliente_id) VALUES ('1000', 150000, 6);

INSERT INTO usuarios (cuenta_id, clave_hash) VALUES (1, '$2y$12$T53PHyniyqo3B6gbvMRgb.6mnAK95Sb1tD6gXH6uzCGtX.6wYfdE6');
INSERT INTO usuarios (cuenta_id, clave_hash) VALUES (2, '$2y$12$gZkXHPjZVJo4Fy49crtb/OlfIvrdoQPnrKFIm2g..f7.P2QFxYvfS');
INSERT INTO usuarios (cuenta_id, clave_hash) VALUES (3, '$2y$12$Rz87us3Z6LPXYGDSDHsjvuyide/kbg5rM.ZlCFQCAhZDXKonXvfYm');
INSERT INTO usuarios (cuenta_id, clave_hash) VALUES (4, '$2y$12$iM9kOw1K.5w1DWltuodMcO79ihZZgPCQ8Kory3EpRM9309M0qNSB6');
INSERT INTO usuarios (cuenta_id, clave_hash) VALUES (5, '$2y$12$lt25egNGQK9nsJNzbiA5TOYbH6dtnA0cebRPrYFmagzTB0vwkKZU6');
INSERT INTO usuarios (cuenta_id, clave_hash) VALUES (6, '$2y$12$IuszcmYYEvOWwSb5hsE5TO2N1KkUKZQghzCXfauw3bjyo82YbM3Oi');
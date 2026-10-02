<?php
declare(strict_types=1);

namespace App\Nucleo;

use PDO;

class Conexion
{
    private static ?PDO $instancia = null;

    private function __construct()
    {
    }

    public static function obtener(): PDO
    {
        if (self::$instancia === null) {
            $configuracion = require __DIR__ . '/../../config/basedatos.php';

            $cadenaConexion = 'mysql:host=' . $configuracion['servidor'] . ';port=' . $configuracion['puerto'] . ';dbname=' . $configuracion['basedatos'] . ';charset=' . $configuracion['codificacion'];

            self::$instancia = new PDO($cadenaConexion, $configuracion['usuario'], $configuracion['clave'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }

        return self::$instancia;
    }
}
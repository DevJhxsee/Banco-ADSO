<?php
declare(strict_types=1);

namespace App\Repositorios;

use App\Modelos\Usuario;
use App\Nucleo\Conexion;
use PDO;

class RepositorioUsuarios
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::obtener();
    }

    public function buscarPorCuentaId(int $cuentaId): ?Usuario
    {
        $consulta = $this->conexion->prepare('SELECT * FROM usuarios WHERE cuenta_id = :cuenta_id');
        $consulta->execute(['cuenta_id' => $cuentaId]);
        $fila = $consulta->fetch();

        if ($fila === false) {
            return null;
        }

        return new Usuario($fila['id'], $fila['cuenta_id'], $fila['clave_hash']);
    }
}
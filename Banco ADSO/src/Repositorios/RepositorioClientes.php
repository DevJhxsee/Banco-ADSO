<?php
declare(strict_types=1);

namespace App\Repositorios;

use App\Modelos\Cliente;
use App\Nucleo\Conexion;
use PDO;

class RepositorioClientes
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::obtener();
    }

    public function buscarPorId(int $id): ?Cliente
    {
        $consulta = $this->conexion->prepare('SELECT * FROM clientes WHERE id = :id');
        $consulta->execute(['id' => $id]);
        $fila = $consulta->fetch();

        if ($fila === false) {
            return null;
        }

        return new Cliente($fila['id'], $fila['nombre']);
    }
}
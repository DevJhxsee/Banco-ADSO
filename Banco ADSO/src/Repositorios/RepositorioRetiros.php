<?php
declare(strict_types=1);

namespace App\Repositorios;

use App\Modelos\Retiro;
use App\Nucleo\Conexion;
use PDO;

class RepositorioRetiros
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::obtener();
    }

    public function registrar(int $cuentaId, string $valor): void
    {
        $consulta = $this->conexion->prepare('INSERT INTO retiros (cuenta_id, valor) VALUES (:cuenta_id, :valor)');
        $consulta->execute(['cuenta_id' => $cuentaId, 'valor' => $valor]);
    }

    public function listarPorCuenta(int $cuentaId): array
    {
        $consulta = $this->conexion->prepare('SELECT * FROM retiros WHERE cuenta_id = :cuenta_id ORDER BY fecha DESC');
        $consulta->execute(['cuenta_id' => $cuentaId]);
        $filas = $consulta->fetchAll();

        $retiros = [];

        foreach ($filas as $fila) {
            $retiros[] = new Retiro($fila['id'], $fila['cuenta_id'], $fila['valor'], $fila['fecha']);
        }

        return $retiros;
    }

    public function calcularTotal(int $cuentaId): string
    {
        $consulta = $this->conexion->prepare('SELECT SUM(valor) AS total FROM retiros WHERE cuenta_id = :cuenta_id');
        $consulta->execute(['cuenta_id' => $cuentaId]);
        $fila = $consulta->fetch();

        return $fila['total'] ?? '0';
    }
}
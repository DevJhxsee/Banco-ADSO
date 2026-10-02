<?php
declare(strict_types=1);

namespace App\Repositorios;

use App\Modelos\Cuenta;
use App\Nucleo\Conexion;
use PDO;

class RepositorioCuentas
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::obtener();
    }

    public function buscarPorNumero(string $numeroCuenta): ?Cuenta
    {
        $consulta = $this->conexion->prepare('SELECT * FROM cuentas WHERE numero_cuenta = :numero');
        $consulta->execute(['numero' => $numeroCuenta]);
        $fila = $consulta->fetch();

        if ($fila === false) {
            return null;
        }

        return new Cuenta($fila['id'], $fila['numero_cuenta'], $fila['saldo'], $fila['cliente_id']);
    }

    public function buscarPorId(int $id): ?Cuenta
    {
        $consulta = $this->conexion->prepare('SELECT * FROM cuentas WHERE id = :id');
        $consulta->execute(['id' => $id]);
        $fila = $consulta->fetch();

        if ($fila === false) {
            return null;
        }

        return new Cuenta($fila['id'], $fila['numero_cuenta'], $fila['saldo'], $fila['cliente_id']);
    }

    public function descontarSaldo(int $id, string $valor): void
    {
        $consulta = $this->conexion->prepare('UPDATE cuentas SET saldo = saldo - :valor WHERE id = :id');
        $consulta->execute(['valor' => $valor, 'id' => $id]);
    }

    public function sumarSaldo(int $id, string $valor): void
    {
        $consulta = $this->conexion->prepare('UPDATE cuentas SET saldo = saldo + :valor WHERE id = :id');
        $consulta->execute(['valor' => $valor, 'id' => $id]);
    }
}
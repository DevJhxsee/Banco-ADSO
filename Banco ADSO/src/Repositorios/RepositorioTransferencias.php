<?php
declare(strict_types=1);

namespace App\Repositorios;

use App\Modelos\Transferencia;
use App\Nucleo\Conexion;
use PDO;

class RepositorioTransferencias
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::obtener();
    }

    public function registrar(int $cuentaOrigenId, int $cuentaDestinoId, string $valor): void
    {
        $consulta = $this->conexion->prepare('INSERT INTO transferencias (cuenta_origen_id, cuenta_destino_id, valor) VALUES (:origen, :destino, :valor)');
        $consulta->execute(['origen' => $cuentaOrigenId, 'destino' => $cuentaDestinoId, 'valor' => $valor]);
    }

    public function listarEnviadas(int $cuentaId): array
    {
        $consulta = $this->conexion->prepare('SELECT * FROM transferencias WHERE cuenta_origen_id = :cuenta_id ORDER BY fecha DESC');
        $consulta->execute(['cuenta_id' => $cuentaId]);
        $filas = $consulta->fetchAll();

        $transferencias = [];

        foreach ($filas as $fila) {
            $transferencias[] = new Transferencia($fila['id'], $fila['cuenta_origen_id'], $fila['cuenta_destino_id'], $fila['valor'], $fila['fecha']);
        }

        return $transferencias;
    }

    public function calcularTotalEnviado(int $cuentaId): string
    {
        $consulta = $this->conexion->prepare('SELECT SUM(valor) AS total FROM transferencias WHERE cuenta_origen_id = :cuenta_id');
        $consulta->execute(['cuenta_id' => $cuentaId]);
        $fila = $consulta->fetch();

        return $fila['total'] ?? '0';
    }
}
<?php
declare(strict_types=1);

namespace App\Servicios;

use App\Nucleo\Conexion;
use App\Repositorios\RepositorioCuentas;
use App\Repositorios\RepositorioUsuarios;
use App\Repositorios\RepositorioRetiros;
use App\Repositorios\RepositorioTransferencias;
use PDOException;

class ServicioCuenta
{
    private RepositorioCuentas $repositorioCuentas;
    private RepositorioUsuarios $repositorioUsuarios;
    private RepositorioRetiros $repositorioRetiros;
    private RepositorioTransferencias $repositorioTransferencias;

    public function __construct()
    {
        $this->repositorioCuentas = new RepositorioCuentas();
        $this->repositorioUsuarios = new RepositorioUsuarios();
        $this->repositorioRetiros = new RepositorioRetiros();
        $this->repositorioTransferencias = new RepositorioTransferencias();
    }

    public function verificarClave(int $cuentaId, string $clave): void
    {
        $usuario = $this->repositorioUsuarios->buscarPorCuentaId($cuentaId);

        if ($usuario === null || !password_verify($clave, $usuario->claveHash)) {
            throw new CredencialesInvalidasException();
        }
    }

    public function iniciarSesion(string $numeroCuenta, string $clave): int
    {
        $cuenta = $this->repositorioCuentas->buscarPorNumero($numeroCuenta);

        if ($cuenta === null) {
            throw new CredencialesInvalidasException();
        }

        $this->verificarClave($cuenta->id, $clave);

        return $cuenta->id;
    }

    public function retirar(int $cuentaId, string $valor, string $clave): void
    {
        $this->verificarClave($cuentaId, $clave);

        if (!is_numeric($valor) || $valor <= 0) {
            throw new ValorInvalidoException();
        }

        $cuenta = $this->repositorioCuentas->buscarPorId($cuentaId);
        if ($cuenta->saldo < $valor) {
            throw new SaldoInsuficienteException();
        }

        $conexion = Conexion::obtener();
        $conexion->beginTransaction();
        try {
            $this->repositorioCuentas->descontarSaldo($cuentaId, $valor);
            $this->repositorioRetiros->registrar($cuentaId, $valor);
            $conexion->commit();
        } catch (PDOException $e) {
            $conexion->rollBack();
            throw $e;
        }
    }

    public function transferir(int $cuentaId, string $numeroDestino, string $valor, string $clave): void
    {
        $this->verificarClave($cuentaId, $clave);

        $destino = $this->repositorioCuentas->buscarPorNumero($numeroDestino);
        if ($destino === null) {
            throw new CuentaNoEncontradaException();
        }

        if (!is_numeric($valor) || $valor <= 0) {
            throw new ValorInvalidoException();
        }

        $origen = $this->repositorioCuentas->buscarPorId($cuentaId);
        if ($origen->saldo < $valor) {
            throw new SaldoInsuficienteException();
        }

        if ($destino->id === $cuentaId) {
            throw new MismaCuentaException();
        }

        $conexion = Conexion::obtener();
        $conexion->beginTransaction();
        try {
            $this->repositorioCuentas->descontarSaldo($cuentaId, $valor);
            $this->repositorioCuentas->sumarSaldo($destino->id, $valor);
            $this->repositorioTransferencias->registrar($cuentaId, $destino->id, $valor);
            $conexion->commit();
        } catch (PDOException $e) {
            $conexion->rollBack();
            throw $e;
        }
    }
}
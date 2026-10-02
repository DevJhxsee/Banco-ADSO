<?php
declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Repositorios\RepositorioCuentas;
use App\Repositorios\RepositorioClientes;

class CuentaControlador extends ControladorBase
{
    public function panelAccion(): void
    {
        $cuentaId = $this->obtenerIdCuenta();

        $repositorioCuentas = new RepositorioCuentas();
        $repositorioClientes = new RepositorioClientes();

        $cuenta = $repositorioCuentas->buscarPorId($cuentaId);
        $cliente = $repositorioClientes->buscarPorId($cuenta->clienteId);

        $this->mostrarVista('cuenta/panel', [
            'titulo' => 'Panel',
            'nombre' => $cliente->nombre,
            'numeroCuenta' => $cuenta->numeroCuenta,
            'saldo' => $cuenta->saldo,
        ]);
    }
}
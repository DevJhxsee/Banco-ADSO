<?php
declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Repositorios\RepositorioRetiros;
use App\Servicios\ServicioCuenta;
use App\Servicios\CredencialesInvalidasException;
use App\Servicios\ValorInvalidoException;
use App\Servicios\SaldoInsuficienteException;

class RetirosControlador extends ControladorBase
{
    public function formularioAccion(): void
    {
        $this->obtenerIdCuenta();

        $mensaje = $_SESSION['mensaje'] ?? '';
        $error = $_SESSION['error'] ?? '';

        unset($_SESSION['mensaje'], $_SESSION['error']);

        $this->mostrarVista('retiros/formulario', [
            'titulo' => 'Retirar',
            'mensaje' => $mensaje,
            'error' => $error,
        ]);
    }

    public function realizarAccion(): void
    {
        $cuentaId = $this->obtenerIdCuenta();

        $valor = trim($_POST['valor'] ?? '');
        $clave = $_POST['clave'] ?? '';

        $servicio = new ServicioCuenta();

        try {
            $servicio->retirar($cuentaId, $valor, $clave);
            $_SESSION['mensaje'] = 'Retiro realizado con éxito';
        } catch (CredencialesInvalidasException $e) {
            $_SESSION['error'] = 'La contraseña es incorrecta';
        } catch (ValorInvalidoException $e) {
            $_SESSION['error'] = 'El valor debe ser un número mayor que 0';
        } catch (SaldoInsuficienteException $e) {
            $_SESSION['error'] = 'Saldo insuficiente';
        }

        $this->redirigir('retiros/formulario');
    }

    public function historialAccion(): void
    {
        $cuentaId = $this->obtenerIdCuenta();

        $repositorio = new RepositorioRetiros();
        $retiros = $repositorio->listarPorCuenta($cuentaId);
        $total = $repositorio->calcularTotal($cuentaId);

        $this->mostrarVista('retiros/historial', [
            'titulo' => 'Mis retiros',
            'retiros' => $retiros,
            'cantidad' => count($retiros),
            'total' => $total,
        ]);
    }
}
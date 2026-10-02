<?php
declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Repositorios\RepositorioTransferencias;
use App\Servicios\ServicioCuenta;
use App\Servicios\CredencialesInvalidasException;
use App\Servicios\CuentaNoEncontradaException;
use App\Servicios\ValorInvalidoException;
use App\Servicios\SaldoInsuficienteException;
use App\Servicios\MismaCuentaException;

class TransferenciasControlador extends ControladorBase
{
    public function formularioAccion(): void
    {
        $this->obtenerIdCuenta();

        $mensaje = $_SESSION['mensaje'] ?? '';
        $error = $_SESSION['error'] ?? '';

        unset($_SESSION['mensaje'], $_SESSION['error']);

        $this->mostrarVista('transferencias/formulario', [
            'titulo' => 'Transferir',
            'mensaje' => $mensaje,
            'error' => $error,
        ]);
    }

    public function realizarAccion(): void
    {
        $cuentaId = $this->obtenerIdCuenta();

        $numeroDestino = trim($_POST['numero_destino'] ?? '');
        $valor = trim($_POST['valor'] ?? '');
        $clave = $_POST['clave'] ?? '';

        $servicio = new ServicioCuenta();

        try {
            $servicio->transferir($cuentaId, $numeroDestino, $valor, $clave);
            $_SESSION['mensaje'] = 'Transferencia realizada con éxito';
        } catch (CredencialesInvalidasException $e) {
            $_SESSION['error'] = 'La contraseña es incorrecta';
        } catch (CuentaNoEncontradaException $e) {
            $_SESSION['error'] = 'La cuenta destino no existe';
        } catch (ValorInvalidoException $e) {
            $_SESSION['error'] = 'El valor debe ser un número mayor que 0';
        } catch (SaldoInsuficienteException $e) {
            $_SESSION['error'] = 'Saldo insuficiente';
        } catch (MismaCuentaException $e) {
            $_SESSION['error'] = 'No puede transferir a su propia cuenta';
        }

        $this->redirigir('transferencias/formulario');
    }

    public function historialAccion(): void
    {
        $cuentaId = $this->obtenerIdCuenta();

        $repositorio = new RepositorioTransferencias();
        $transferencias = $repositorio->listarEnviadas($cuentaId);
        $total = $repositorio->calcularTotalEnviado($cuentaId);

        $this->mostrarVista('transferencias/historial', [
            'titulo' => 'Mis transferencias',
            'transferencias' => $transferencias,
            'cantidad' => count($transferencias),
            'total' => $total,
        ]);
    }
}
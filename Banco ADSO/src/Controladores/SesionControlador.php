<?php
declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Servicios\ServicioCuenta;
use App\Servicios\CredencialesInvalidasException;

class SesionControlador extends ControladorBase
{
    public function formularioAccion(): void
    {
        if (isset($_SESSION['cuenta_id'])) {
            $this->redirigir('cuenta/panel');
        }

        $this->mostrarVista('sesion/formulario', [
            'titulo' => 'Iniciar sesión',
            'error' => '',
        ]);
    }

    public function entrarAccion(): void
    {
        $numeroCuenta = trim($_POST['numero_cuenta'] ?? '');
        $clave = $_POST['clave'] ?? '';

        $servicio = new ServicioCuenta();

        try {
            $cuentaId = $servicio->iniciarSesion($numeroCuenta, $clave);
        } catch (CredencialesInvalidasException $e) {
            $this->mostrarVista('sesion/formulario', [
                'titulo' => 'Iniciar sesión',
                'error' => 'Número de cuenta o contraseña incorrectos',
            ]);
            return;
        }

        session_regenerate_id(true);
        $_SESSION['cuenta_id'] = $cuentaId;

        $this->redirigir('cuenta/panel');
    }

    public function salirAccion(): void
    {
        $_SESSION = [];
        session_destroy();
        $this->redirigir('sesion/formulario');
    }
}
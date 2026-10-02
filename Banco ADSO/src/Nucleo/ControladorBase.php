<?php
declare(strict_types=1);

namespace App\Nucleo;

abstract class ControladorBase
{
    protected function mostrarVista(string $nombre, array $datos = []): void
    {
        $vista = new Vista();
        $vista->render($nombre, $datos);
    }

    protected function redirigir(string $ruta): void
    {
        header('Location: index.php?ruta=' . $ruta);
        exit;
    }

    protected function obtenerIdCuenta(): int
    {
        if (!isset($_SESSION['cuenta_id'])) {
            $this->redirigir('sesion/formulario');
        }

        return (int) $_SESSION['cuenta_id'];
    }
}
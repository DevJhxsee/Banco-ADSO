<?php
declare(strict_types=1);

namespace App\Nucleo;

class Vista
{
    private const CARPETA = __DIR__ . '/../../vistas';

    public function render(string $nombre, array $datos = []): void
    {
        $rutaContenido = self::CARPETA . '/' . $nombre . '.php';

        if (!is_file($rutaContenido)) {
            throw new \RuntimeException("No existe la vista: {$nombre}");
        }

        extract($datos);

        ob_start();
        require $rutaContenido;
        $contenido = ob_get_clean();

        require self::CARPETA . '/layout.php';
    }
}
<?php
declare(strict_types=1);

session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Nucleo\Router;
use App\Nucleo\Vista;

$ruta = $_GET['ruta'] ?? 'cuenta/panel';

try {
    $enrutador = new Router();
    $enrutador->despachar($ruta);
} catch (Throwable $e) {
    http_response_code(500);
    $vista = new Vista();
    $vista->render('errores/500', ['titulo' => 'Error']);
}
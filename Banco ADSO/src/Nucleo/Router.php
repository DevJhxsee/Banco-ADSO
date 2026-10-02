<?php
declare(strict_types=1);

namespace App\Nucleo;

class Router
{
    public function despachar(string $ruta): void
    {
        $partes = explode('/', trim($ruta, '/'));

        $controlador = $partes[0];
        $accion = $partes[1] ?? 'inicio';
        $parametros = array_slice($partes, 2);

        $clase = 'App\\Controladores\\' . ucfirst($controlador) . 'Controlador';
        $metodo = $accion . 'Accion';

        if (!class_exists($clase) || !method_exists($clase, $metodo)) {
            http_response_code(404);
            $vista = new Vista();
            $vista->render('errores/404', ['titulo' => 'Página no encontrada']);
            return;
        }

        $objeto = new $clase();
        $objeto->$metodo(...$parametros);
    }
}

<?php

namespace MVC; // agrupacion

use Controllers\ErrorController; // error

class Router
{
    public $getRoutes = []; // rutas GET
    public $postRoutes = []; // rutas POST

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn; // capturar ruta GET
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn; // capturar ruta POST
    }

    private function runController($fn)
    {
        if ($fn) {
            call_user_func($fn, $this); // ejecuta el controlador con la vista (exito)
        } else {
            call_user_func([ErrorController::class, "index"], $this); // ejecuta el controlador con la vista (error)
        }
    }

    public function router()
    {
        $currentRouter = $_SERVER['PATH_INFO'] ?? "/"; // obtener la ruta actual
        $requestMethod = $_SERVER['REQUEST_METHOD']; // obtener el tipo de metodo (GET o POST) 
        $fn = null; // capturar la ruta de la funcion
        if ($requestMethod == "GET") $fn = $this->getRoutes[$currentRouter] ?? null; // obtenemos la ruta de la fn
        if ($requestMethod == "POST") $fn = $this->postRoutes[$currentRouter] ?? null; // obtenemos la ruta de la fn
        $this->runController($fn); // ejecutar controlador

    }

    public function render($view, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value; // captura y asigna a la variable
        }
        ob_start(); // iniciar almacenamiento en memoria de la vista
        include __DIR__ . "/views/$view.php"; // mostrar vista
        $content = ob_get_clean(); // borrar almacenamiento en memoria de la vista
        include __DIR__ . "/views/layout/layout.php"; // agregar el layout a la vista
    }
}

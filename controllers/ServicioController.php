<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController
{
    public static function index(Router $router)
    {
        isAdmin();

        $servicios = Servicio::all();

        $router->render("servicios/index", [
            "nombre" => $_SESSION["nombre"],
            "servicios" => $servicios
        ]);
    }
    public static function crear(Router $router)
    {
        isAdmin();
        $servicio = new Servicio();
        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if (empty($alertas)) {
                $servicio->guardar();
                header("Location: /servicio");
            }
        }

        $router->render("servicios/crear", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "errores" => $alertas
        ]);
    }
    public static function actualizar(Router $router)
    {
        isAdmin();
        if (!is_numeric($_GET["id"])) {
               header("Location: /servicio");
        }
        $servicio = [];
        $servicio = Servicio::find($_GET["id"]); 
        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $servicio->sincronizar($_POST);
            if (empty($alertas)) {
                $servicio->guardar();
                header("Location: /servicio");
            }
        }

        $router->render("servicios/actualizar", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "errores" => $alertas
        ]);
    }
    public static function eliminar() {
        isAdmin();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!is_numeric($_POST["id"])) {
                header("Location: /servicio");
            }
            $servicio = Servicio::find($_POST["id"]);
            $servicio->eliminar();
            header("Location: /servicio");
        }
    }
}

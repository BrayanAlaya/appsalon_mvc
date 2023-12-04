<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\ApiController;
use Controllers\CitaController;
use Controllers\LoginController;
use Controllers\ServicioController;
use MVC\Router;

$router = new Router();

//iniciar sesion
$router->get("/",[LoginController::class,"login"]);
$router->post("/",[LoginController::class,"login"]);
$router->get("/logout",[LoginController::class,"logout"]);

//crear cuenta
$router->get("/crear-cuenta",[LoginController::class,"crear"]);
$router->post("/crear-cuenta",[LoginController::class,"crear"]);

//recuperar cuenta
$router->get("/forget",[LoginController::class,"forget"]);
$router->post("/forget",[LoginController::class,"forget"]);
$router->get("/recover",[LoginController::class,"recover"]);
$router->post("/recover",[LoginController::class,"recover"]);

//confirmacion de cuenta
$router->get("/confirmar-cuenta",[LoginController::class,"confirmar"]);
$router->get("/mensaje",[LoginController::class,"mensaje"]);

//area privada
$router->get("/cita",[CitaController::class, "index"]);
$router->get("/admin",[AdminController::class, "index"]);

//api
$router->get("/api/servicio", [ApiController::class, "index"]);
$router->post("/api/citas",[ApiController::class, "guardar"]);

//funciones
$router->post("/delete",[ApiController::class,"delete"]);

//funciones servicios
$router->get("/servicio",[ServicioController::class, "index"]);
$router->get("/servicio/crear",[ServicioController::class, "crear"]);
$router->post("/servicio/crear",[ServicioController::class, "crear"]);
$router->get("/servicio/actualizar",[ServicioController::class, "actualizar"]);
$router->post("/servicio/actualizar",[ServicioController::class, "actualizar"]);
$router->post("/servicio/eliminar",[ServicioController::class, "eliminar"]);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
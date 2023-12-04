<?php 

namespace Controllers;

use DateTime;
use Model\AdminCita;
use MVC\Router;

class AdminController{
    public static function index(Router $router) {

        isAdmin();

        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        $fechaVerificar = explode("-",$fecha);

        if (!checkdate($fechaVerificar[1],$fechaVerificar[2],$fechaVerificar[0])) {
            header("Location: /404");
        }

        $consulta = "SELECT citas.id, citas.hora, CONCAT(usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioid=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citasservicios.citasId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasservicios.serviciosId ";
        $consulta .= " WHERE fecha =  '${fecha}' ";
        $citas = AdminCita::SQL($consulta);
        $nombre = $_SESSION["nombre"];
        $router->render("admin/index",[
            "nombre" => $nombre,
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }
}

?>
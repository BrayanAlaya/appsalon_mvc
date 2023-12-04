<?php

namespace Controllers;

use Model\Cita;
use Model\CitasServicios;
use Model\Servicio;

class ApiController
{
    public static function index()
    {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }
    public static function guardar()
    {

        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $idServicios = explode(",", $_POST["serviciosid"]);

        foreach ($idServicios as $idServicio) {
            $citaServicio = [
                "citasId" => $resultado["id"],
                "serviciosId" => $idServicio
            ];
            $guardarCitSer = new CitasServicios($citaServicio);
            $guardarCitSer->guardar();
        }

        echo json_encode($resultado);
    }

    public static function delete()
    {
        isAdmin();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $cita = Cita::find($_POST["id"]);
            $cita->eliminar();
            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }
    }
}

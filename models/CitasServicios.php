<?php 

namespace Model;

class CitasServicios extends ActiveRecord{
    protected static $tabla = "citasservicios";
    protected static $columnasDB = ["id","citasId","serviciosId"];

    public $id;
    public $citasId;
    public $serviciosId;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->citasId = $args["citasId"] ?? null;
        $this->serviciosId = $args["serviciosId"] ?? null;
    }

}

?>
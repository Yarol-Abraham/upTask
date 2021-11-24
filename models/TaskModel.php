<?php 

namespace Model; // agrupacion

use Model\ActiveRecord;

class TaskModel extends ActiveRecord {

    protected static $table = "tareas"; // nombre de la tabla (base de datos)

    protected static $columns = [
        "id",
        "nombre",
        "estado",
        "id_proyecto"
    ]; // nombre de cada columna de la tabla (base de datos)

    public $id;
    public $nombre;
    public $estado;
    public $id_proyecto;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? '';
        $this->estado = $args["estado"] ?? 0;
        $this->id_proyecto = $args["id_proyecto"] ?? '';
    }

}
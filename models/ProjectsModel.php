<?php

namespace Model; // agrupacion

use Model\ActiveRecord; 

class ProjectsModel extends ActiveRecord {
    protected static $table = "proyectos"; // nombre de la tabla (base de datos)
    protected static $columns = [
        "id",
        "proyecto",
        "url",
        "id_usuario"
    ]; // nombre de cada columna de la tabla (base de datos)

    public $id;
    public $proyecto;
    public $url;
    public $id_usuario;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->proyecto = $args["proyecto"] ?? null;
        $this->url = $args["url"] ?? null;
        $this->id_usuario = $args["id_usuario"] ?? null;
    }

    public function validate(){

        if(!$this->proyecto) self::setErrors("error", "porfavor ingrese un nombre para el proyecto 😥");
        return self::getErrors();
    }

}


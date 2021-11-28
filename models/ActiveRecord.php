<?php

namespace Model;

class ActiveRecord
{
    // Base DE DATOS
    protected static $db;
    protected static $table = '';
    protected static $columns = [];
    protected static $route = ""; // ruta de la vista
    protected static $name = ""; // nombre de la pagina
    protected static $id_create = ""; // obtener el id cada que se crea uno nuevo
    // static = secondaria, self= primaria;
    
    public static function setRoute($route)
    {
        self::$route = $route;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function setName($name)
    {
        self::$name = $name;
    }

    public static function getName()
    {
        return self::$name;
    }

    public static function setId($id)
    {
        self::$id_create = $id;
    }

    public static function getId()
    {
        return self::$id_create;
    }

    // Alertas y Mensajes - errores
    protected static $errors = [];

    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function setErrors($type, $msg) // type => key, $msg => value - errores
    {
        static::$errors[$type][] = $msg;
    }

    public static function getErrors() // obtener los errores
    {
        return self::$errors;
    }

    public function validate() // validar errores
    {
        static::$errors = [];
        return static::$errors;
    }

    public function save() // guardar
    {
        if (!is_null($this->id)) return $this->update(); // actualizar registro
        return $this->create(); // crear registro
    }

    // ----- CRUD -----
    
    public function create() // crear
    {
        $attributes = $this->sanitizeAttributes(); // sanitizar los atributos
        $sql = "INSERT INTO " . static::$table . " (";
        $sql .= join(",", array_keys($attributes));
        $sql .= ") VALUES (' ";
        $sql .= join("', '", array_values($attributes));
        $sql .= " ') ";
        $result = self::$db->query($sql);
        self::setId(self::$db->insert_id);
        return $result;
    }

    public function update() // actualizar
    {
        $attributes = $this->sanitizeAttributes();
        $values = [];
        foreach($attributes as $key => $value){
            $values[] = "{$key}='{$value}'"; // formateamos los atributos
        }
        $sql = "UPDATE " . static::$table . " SET ";
        $sql .= join(", ", $values);
        $sql .= " WHERE id='" . self::$db->escape_string($this->id) . "'" ;
        $sql .= " LIMIT 1";
        return self::$db->query($sql);
    }

    public function remove() // eliminar un registro
    {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function getFindId($id) // buscar un registro por id
    { 

    }

    public static function where($name, $value) // buscar un registro por su nombre y valor
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE ";
        $sql .= $name . "=" . "'{$value}'";
        $result = self::querySQL($sql);
        return array_shift( $result );
    }

    public static function getOne() // obtener un registro
    {
        
    }

    public static function getAll_Id($name, $value) // obtener todos los registros por un campo
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE ";
        $sql .= $name . "=" . "'{$value}'";
        $result = self::querySQL($sql);
        return $result;
    }

    // ----- SQL -----
    public static function querySQL($query) // realizar la consulta a la base de datos
    {
        $res = self::$db->query($query);
        $array = [];
        while ($result = $res->fetch_assoc()) {
            $array[] = static::createObject($result);
        }
        $res->free();
        return $array;
    }

    public static function createObject($register) // array => objecto
    {
        $object = new static;
        foreach ($register as $key => $value) {
            if (property_exists($object, $key)) $object->$key = $value;
        }
        return $object;
    }

    public function Attributes() // obtener los atributos
    {
        $attributes = [];
        foreach (static::$columns as $column) {
            if ($column === "id") continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeAttributes() // debupar las entradas
    {
        $attributes = $this->Attributes();
        
        $sanitize = [];
        foreach ($attributes as $key => $value) {
            $sanitize[$key] = self::$db->escape_string($value);
        }
        return $sanitize;
    }

    public function synchronize($args = []) // sincronizamos los datos con la clase
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) $this->$key = $value;
        }
    }

    //END
}

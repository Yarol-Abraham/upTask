<?php 

namespace Controllers; // agrupacion

use Model\ProjectsModel;
use Model\UserModel;
use Model\TaskModel;

class TaskController {

    public static function index()
    {

    }

    private static function sendError($msg = "Hubo un error al agregar la tarea! 😢")
    {
        $res = [
            "status" => false,
            "type" => "error",
            "msg" => $msg
        ];
        echo json_encode($res);
    }

    private static function send($newTask, $getId, $msg = "Tarea agregada Correctamente 😊")
    {
        $res = [
            "status" => $newTask,
            "type" => "success",
            "id" => $getId,
            "msg" => $msg
        ];
        echo json_encode($res);
    }

    public static function create()
    {
        if($_SERVER["REQUEST_METHOD"] != "POST") return;
        session_start();
        if(!$_SESSION) return static::sendError(); // debe exister una sesion 

        $project = ProjectsModel::where("url", sanitizar($_POST["url"]));
        if(!$project) return static::sendError(); // verificar si existe el proyecto
        
        if($project->id_usuario != $_SESSION["id"]) return static::sendError(); // verificar que el proyecto pertenezca al usuario actual
        
        $task = new TaskModel;
        $task->synchronize($_POST);
        
        $errors = $task->validate();
        foreach($errors as $key => $error) $errors = $error[0];
        if (!empty($errors)) return static::sendError($errors); // enviar los errores si existen
        
        $task->id_proyecto = $project->id;
        $newTask = $task->save(); // guardar la nueva tarea
        $getId = $task::getId(); // obtener el id del registro
        static::send($newTask, $getId);
    }

    public static function update()
    {
        if($_SERVER["REQUEST_METHOD"] != "POST") return;

    }

    public static function delete()
    {
        if($_SERVER["REQUEST_METHOD"] != "POST") return;

    }

}
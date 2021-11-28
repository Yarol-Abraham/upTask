<?php 

namespace Controllers; // agrupacion

use Model\ProjectsModel;
use Model\TaskModel;

class TaskController {


    private static function sendError($msg = "Hubo un error al agregar la tarea! 😢")
    {
        $res = [
            "status" => false,
            "type" => "error",
            "msg" => $msg
        ];
        echo json_encode($res);
    }

    private static function send($task = null, $msg = "Tarea agregada Correctamente 😊")
    {
        $res = [
            "status" => true,
            "type" => "success",
            "task" => $task,
            "msg" => $msg
        ];
        echo json_encode($res);
    }

    private static function sendAll($tasks)
    {
        $res = [
            "status" => true,
            "type" => "success",
            "tasks" => $tasks
        ];
        echo json_encode($res);
    }

    public static function index()
    {
        session_start();
        if(!$_SESSION) return static::sendError(); // debe exister una sesion 
        
        if(!isset($_GET['url'])) return static::sendError(); // si no existe la url
        
        $project = ProjectsModel::where('url', $_GET['url']);
        $msg = "Las tareas de este proyecto no existen 😕, empieza creando nuevas!";
        if(empty($project)) return static::sendError($msg); // debe exister el proyecto

        $tasks = TaskModel::getAll_Id('id_proyecto', $project->id);

        static::sendAll($tasks);
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
        $task->save(); // guardar la nueva tarea
        $task->id = $task::getId(); // obtener el id del registro

        static::send($task);
    }

    public static function update()
    {
        if($_SERVER["REQUEST_METHOD"] != "POST") return;

        session_start();
        if(!$_SESSION) return static::sendError(); // debe exister una sesion

        $task = TaskModel::where('id', sanitizar($_POST['id']));

        $task->estado = $task->estado == 0 ? 1 : 0;

        $task->save();

        static::send($task);
    }

    public static function delete()
    {
        if($_SERVER["REQUEST_METHOD"] != "POST") return;

        session_start();
        if(!$_SESSION) return static::sendError(); // debe exister una sesion

        $task = TaskModel::where('id', sanitizar($_POST['id']));

        $task->remove();
        
        static::send();
    }

}
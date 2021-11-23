<?php

namespace Controllers; // agrupacion

use MVC\Router;
use Model\ProjectsModel;

class ProjectsController {

    private static function render($router, $project = null, $errors = []){
        isAuth(); // verifica autenticacion
        $router->render(ProjectsModel::getRoute(), [
            "name" => ProjectsModel::getName(),
            "errors" => $errors,
            "project" => $project
        ]);
    }

    public static function index(Router $router) // mostrar todos los proyectos
    {
        session_start();

        $projects = ProjectsModel::getAll_Id("id_usuario", $_SESSION["id"]);
        ProjectsModel::setRoute("/pages/index");
        ProjectsModel::setName("Inicio");
        static::render($router, $projects);  
    }
 
    public static function create(Router $router) // crear un proyecto
    {
        session_start();
        $project = new ProjectsModel; 
        $project::setRoute("/pages/create");
        $project::setName("Crear"); 

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $project->synchronize($_POST);
            $errors = $project->validate();
            if(!empty($errors)) return static::render($router, $project, $errors);
            $project->url = md5(uniqid());
            $project->id_usuario = $_SESSION["id"];
            $project->save();
            return header("Location: /upTask/dashboard/project?url=" . $project->url);    
        }

        static::render($router, $project);  
    }

    public static function project(Router $router){
       
        session_start();
        $url = isset($_GET["url"]) ? $_GET["url"] : null;
        if(!$url) return header("Location: /upTask/dashboard/index"); // si no hay token
        $project = new ProjectsModel; 
        $getProject = $project->where("url", $url);
        if(empty($getProject)) return header("Location: /upTask/dashboard/index"); // si el token no existe
        if($getProject->id_usuario != $_SESSION["id"])  return header("Location: /upTask/dashboard/index"); // si el token existe, pero no es el usuario logueado
        $project::setRoute("/pages/project");
        $project::setName("Proyecto"); 
    
        static::render($router, $getProject);  
    }
 
}
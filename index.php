<?php

require "./includes/app.php"; // app

use MVC\Router; // Router
use Controllers\AuthController; // login
use Controllers\UserController; // usuario
use Controllers\ProjectsController; // proyectos
use Controllers\TaskController; // tareas
use Controllers\ErrorController; // error

$router = new Router(); // instanciar clase
// ----- Login -----
$router->get("/auth/login", [AuthController::class, "login"]); 
$router->post("/auth/login", [AuthController::class, "login"]); 
$router->get("/auth/logout", [AuthController::class, "logout"]); 
$router->get("/auth/forgett", [AuthController::class, "forgett"]); 
$router->post("/auth/forgett", [AuthController::class, "forgett"]); 
$router->get("/auth/restore", [AuthController::class, "restore"]); 
$router->post("/auth/restore", [AuthController::class, "restore"]); 
$router->get("/auth/message", [AuthController::class, "message"]); 
$router->get("/auth/confirm", [AuthController::class, "confirm"]); 
$router->get("/auth/confirmRestore", [AuthController::class, "confirmRestore" ]); 
// ----- Pages -----
$router->get("/dashboard/index", [ProjectsController::class, "index"]); 
$router->get("/dashboard/project", [ProjectsController::class, "project"]); 
$router->post("/dashboard/project", [ProjectsController::class, "project"]); 
$router->get("/dashboard/create", [ProjectsController::class, "create"]); 
$router->post("/dashboard/create", [ProjectsController::class, "create"]); 
$router->get("/dashboard/account", [UserController::class, "account"]); 
// ----- Api Task -----
$router->get("/api/tasks", [TaskController::class, "index"]);
$router->post("/api/task", [TaskController::class, "create"]);
$router->post("/api/task/update", [TaskController::class, "update"]);
$router->post("/api/task/delete", [TaskController::class, "delete"]);
// ----- User -----
$router->get("/user/create", [UserController::class, "create"]);
$router->post("/user/create", [UserController::class, "create"]);
// ----- Error -----
$router->get("/error/index", [ErrorController::class, "index"]);
$router->router(); // capturar ruta creada

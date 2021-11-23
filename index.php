<?php

require "./includes/app.php"; // app

use MVC\Router; // Router
use Controllers\AuthController; // login
use Controllers\UserController; // usuario
use Controllers\ProjectsController; // proyectos
use Controllers\ErrorController; // error

$router = new Router(); // instanciar clase
// ----- Login -----
$router->get("/auth/login", [AuthController::class, "login"]); // crear ruta login de auth
$router->post("/auth/login", [AuthController::class, "login"]); // crear ruta login de auth
$router->get("/auth/logout", [AuthController::class, "logout"]); // crear ruta logout de auth
$router->get("/auth/forgett", [AuthController::class, "forgett"]); // crear ruta forgett de auth
$router->post("/auth/forgett", [AuthController::class, "forgett"]); // crear ruta forgett de auth
$router->get("/auth/restore", [AuthController::class, "restore"]); // crear ruta restore de auth
$router->post("/auth/restore", [AuthController::class, "restore"]); // crear ruta restore de auth
$router->get("/auth/message", [AuthController::class, "message"]); // crear ruta message de auth
$router->get("/auth/confirm", [AuthController::class, "confirm"]); // crear ruta confirm de auth
$router->get("/auth/confirmRestore", [AuthController::class, "confirmRestore" ]); // crear ruta confirmRestore de auth
// ----- Pages -----
$router->get("/dashboard/index", [ProjectsController::class, "index"]); // crear ruta de index de sesion
$router->get("/dashboard/project", [ProjectsController::class, "project"]); // crear ruta de project de sesion
$router->post("/dashboard/project", [ProjectsController::class, "project"]); // crear ruta de project de sesion
$router->get("/dashboard/create", [ProjectsController::class, "create"]); // crear ruta de create de sesion
$router->post("/dashboard/create", [ProjectsController::class, "create"]); // crear ruta de create de sesion
$router->get("/dashboard/account", [UserController::class, "account"]); // crear ruta de create de sesion
// ----- User -----
$router->get("/user/create", [UserController::class, "create"]); // crear ruta create de usuario
$router->post("/user/create", [UserController::class, "create"]); // crear ruta create de usuario
// ----- Error -----
$router->get("/error/index", [ErrorController::class, "index"]); // crear ruta index de error
$router->router(); // capturar ruta creada

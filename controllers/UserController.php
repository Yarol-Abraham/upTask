<?php

namespace Controllers; // agrupacion

use MVC\Router; // router
use Model\UserModel; // modelo de usuario
use Mailer\Mailer; // mailer


class UserController
{

    private static function render($router, $user = null, $errors = [])
    {
        $router->render(UserModel::getRoute(), [
            "name" => UserModel::getName(), // nombre de la pagina
            "user" => $user, // modelo
            "errors" => $errors // errores
        ]); // renderizar la vista
    }

    public static function create(Router $router) // crear usuario
    {
        $user = new UserModel;
        $user::setRoute("/users/create");
        $user::setName("Crear Cuenta");
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $user->synchronize($_POST); // sincronizar los datos con la vista
            $errors = $user->validate();
            if (!empty($errors)) return static::render($router, $user, $errors); // mostrar la vista con los errores
            $userExists = $user::where("email", $user->email);
            if(!empty($userExists)) // si existe el usuario con el email
            {
                $user->setErrors("error", "Lo sentimos, el usuario ya existe 😢");
                $errors = $user::getErrors();
                return static::render($router, $user, $errors); // mostrar la vista con el error
            }
            $user->encrypPassword(); // encryptar la contraseña
            unset($user->confirmPassword); // eliminar campo confirmacion
            $user->generateToken(); // generar token
            $result = $user->save(); // crear el usuario
            if(!$result) // si existe un error al intentar guardar 
            {
                $user->setErrors("error", "Ha ocurrido un error al guardar la informacion, vuelve a intentarlo 😢");
                $errors = $user::getErrors();
                return static::render($router, $user, $errors); // mostrar la vista con el error
            }
            $mailer = new Mailer(
                $user->email,
                $user->nombre,
                $user->token,
                "create"
            );// crendenciales
            if($mailer->send()) return header('Location: /upTask/auth/message');
            $user->setErrors("error", "Ha ocurrido un error al enviar el email 😢");
            $errors = $user::getErrors();
            return static::render($router, $user, $errors); // mostrar la vista con el error
        }
        static::render($router, $user, $errors); // vista predeterminada
    }

    public static function account(Router $router) // cuenta de usuario
    {
        UserModel::setRoute("/pages/account");
        UserModel::setName("Cuenta");
        session_start();
        isAuth();
        static::render($router);
    }

}

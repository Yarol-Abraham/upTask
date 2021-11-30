<?php

namespace Controllers; // agrupacion

use MVC\Router; // router
use Model\UserModel; // modelo de usuario
use Mailer\Mailer; // mailer


class UserController
{

    private static function render($router, $user = null, $alerts = [])
    {
        $router->render(UserModel::getRoute(), [
            "name" => UserModel::getName(), // nombre de la pagina
            "user" => $user, // modelo
            "alerts" => $alerts // alertas
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
        session_start();
        isAuth();

        $user = UserModel::where('id', $_SESSION['id']);
        $alerts = [];

        $user::setRoute("/pages/account");
        $user::setName("Cuenta");
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") // actualizar datos de usuario
        {
            $user->synchronize($_POST);
        
            $errors = $user->validaAccount();
            if (!empty($errors)) return static::render($router, $user, $errors); // mostrar la vista con los errores
            
            $verifyEmail = UserModel::where('email', $user->email);
            if($verifyEmail && $verifyEmail->id != $user->id) // validar que el email no sea igual al de otro usuario
            {
                $verifyEmail::setErrors("error", "ya existe un usuario con el correo, por favor agrega otro 😥");
                $errors = $verifyEmail::getErrors();
                return static::render($router, $user, $errors);
            }

            $user->save();
            
            $_SESSION['nombre'] = $user->nombre; // actualizar nombre
            $_SESSION['email'] = $user->email; // actualizar email
            
            $user::setErrors("correct", "Se actualizado tu perfil correctamente 😉");
            $alerts = $user::getErrors();
        }

        static::render($router, $user, $alerts);
    }

    public static function update(Router $router) // actualizar la contraseña del usuario
    {
        session_start();
        isAuth();

        $user = UserModel::where('id', $_SESSION['id']);
        $alerts = [];
        $errors = [];

        $user::setRoute("/pages/password");
        $user::setName("Password");

        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user->synchronize($_POST);
            
            
            if(!password_verify($user->passwordActual, $user->password))
            {
                $user::setErrors("fail", "La contraseña actual es incorrecta 😓");
                $errors = $user::getErrors();
                return static::render($router, $user, $errors);
            } 

            $errors = $user->validatePasswordNew();
            if(!empty($errors)) return static::render($router, $user, $errors);

            $user->password = $user->passwordNueva;
            $user->encrypPassword(); // encryptar la contraseña
            unset($user->confirmPassword); // eliminar campo confirmacion
            $result = $user->save(); // crear el usuario
            if(!$result) // si existe un error al intentar guardar 
            {
                $user->setErrors("error", "Ha ocurrido un error al guardar la informacion, vuelve a intentarlo 😢");
                $errors = $user::getErrors();
                return static::render($router, $user, $errors); // mostrar la vista con el error
            }
            $user::setErrors("correct", "Se actualizado tu perfil correctamente 😉");
            $alerts = $user::getErrors();
        }
        
        static::render($router, $user, $alerts);
    }

}

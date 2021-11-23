<?php

namespace Controllers; // agrupacion

use MVC\Router; // router
use Model\UserModel; // usuarios
use Mailer\Mailer; // mailer

class AuthController
{
   
    private static function render($router, $errors = [])
    {
        $router->render(UserModel::getRoute(), [
            "name" => UserModel::getName(), // nombre de la pagina
            "errors" => $errors // errores
        ]); // renderizar la vista
    }

    private static function validateUser($user, $msg, $router) // validamos que el usuario existan en upTask
    {
        $user->setErrors("error", $msg);
        $errors = $user::getErrors();
        return static::render($router, $errors); // mostrar la vista con el error   
    }

    public static function login(Router $router)
    {
        UserModel::setRoute("/authentication/login");
        UserModel::setName("Iniciar Sesion");

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $user = new UserModel();
            $user->synchronize($_POST);
            
            $errors = $user->validateLogin();
            if(!empty($errors)) return static::render($router, $errors); // renderizar la vista
            
            $userExists = $user->where("email", $user->email);
            $msg = "Lo sentimos, el usuario no existe con este email, o no ha válidado su email en upTask 😢";
            if(empty($userExists)) return static::validateUser($user, $msg, $router); // si existe el usuario
            if($userExists->confirmar != 1) return static::validateUser($user, $msg, $router); // si su correo no esta confirmado
            
            $msg = "El email o la contraseña son incorrectas 😓";
            if(!password_verify($_POST["password"], $userExists->password)) return static::validateUser($user, $msg, $router);
            
            session_start(); // iniciar la autenticación
            $_SESSION['id'] = $userExists->id;
            $_SESSION['nombre'] = $userExists->nombre;
            $_SESSION['login'] = true;
            return header('Location: /upTask/dashboard/index');
        }

        static::render($router); // renderizar la vista
    }

    public static function logout(Router $router)
    {
        session_start();
        $_SESSION = [];
        header("Location: /upTask/auth/login");
    }

    static public function forgett(Router $router)
    {
        UserModel::setRoute("/authentication/forgett");
        UserModel::setName("Olvide mi contraseña");
        
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
            $user = new UserModel;
            $user->synchronize($_POST);
            
            $errors = $user->validateEmail();
            if(!empty($errors)) return static::render($router, $errors);
            
            $userExists = $user::where("email", $user->email);
            $msg = "Lo sentimos, el usuario no existe con este email, o no ha válidado su email en upTask 😢";
            if(empty($userExists)) return static::validateUser($user, $msg, $router);
            if($userExists->confirmar != 1)  return static::validateUser($user, $msg, $router);
            
            $userExists->generateToken();
            unset($userExists->password);
            $userExists->save();
            
            $mailer = new Mailer(
                $userExists->email,
                $userExists->nombre,
                $userExists->token,
                "forgett"
            );// crendenciales
            if($mailer->send()) return header('Location: /upTask/auth/message');
            
            $user->setErrors("error", "Ha ocurrido un error al enviar el email 😢");
            $errors = $user::getErrors();
            return static::render($router, $user, $errors); // mostrar la vista con el error
        }
        static::render($router); // renderizar la vista predeterminada
    }

    public static function restore(Router $router)
    {
        UserModel::setRoute("/authentication/restore");
        UserModel::setName("Restablecer contraseña");
    
        $token = isset($_GET['token']) ? sanitizar($_GET['token']) : null; 
        if(!$token) return header("Location: /upTask/auth/login"); // si no hay token
        $user = UserModel::where('token', $token);
        
        if(empty($user)) // si no existe el usuario con el token
        {
            UserModel::setRoute("/authentication/login");
            UserModel::setName("Iniciar Sesion");
            UserModel::setErrors("error", "Token no válido 😢");
            return static::render($router, UserModel::getErrors()); // renderizar la vista
        }; 
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $userCredentials = new UserModel;
            $userCredentials->synchronize($_POST);
            
            $errors = $userCredentials->validatePassword();
            if(!empty($errors)) return static::render($router, $errors); // renderizar la vista
            
            $user->password = $userCredentials->password;
            $user->token = "";
            $user->encrypPassword();
            unset($user->confirmPassword);
            $result = $user->save();
            
            $msg = "Ha ocurrido un error al guardar la informacion, vuelve a intentarlo 😢";
            if(!$result) return static::validateUser($user, $msg, $router);
            return header('Location: /upTask/auth/confirmRestore'); // si todo salio bien
        }
        static::render($router); // renderizar la vista
    }

    public static function message(Router $router)
    {
        UserModel::setRoute("/authentication/message");
        UserModel::setName("Mensaje");
        static::render($router); // renderizar la vista
    }

    public static function confirmRestore(Router $router) // confirma si se restauro la contraseña
    {
        UserModel::setRoute("/authentication/confirmRestore");
        UserModel::setName("Confirmacion");
        static::render($router); // renderizar la vista
    }

    public static function confirm(Router $router) // confirmar que el usuario se ha creado
    {
        UserModel::setRoute("/authentication/confirm");
        UserModel::setName("Confirmar");

        $token = isset($_GET['token']) ? sanitizar($_GET['token']) : null;  
        if(!$token) return header("Location: /upTask/auth/login"); // si no hay token
        $user = UserModel::where('token', $token);
        if(empty($user)) // si no existe el usuario con el token
        {
            UserModel::setErrors("error", "Token no válido 😢");
            return static::render($router, UserModel::getErrors()); // renderizar la vista
        }; 
        $user->confirmar = 1;
        $user->token = "";
        unset($user->confirmPassword);
        $user->save();
        static::render($router); // renderizar la vista
    }

    //end
}

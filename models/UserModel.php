<?php

namespace Model; // agrupacion

use Model\ActiveRecord; // ActiveRecord -> extends 

class UserModel extends ActiveRecord
{
    protected static $table = "usuarios"; // nombre de la tabla (base de datos)
    protected static $columns = [
        "id",
        "nombre",
        "email",
        "password",
        "token",
        "confirmar"
    ]; // nombre de cada columna de la tabla (base de datos)
    
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $token;
    public $confirmPassword;
    public $confirmar;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['password'] ?? null;
        $this->token = $args['token'] ?? null;
        $this->confirmPassword = $args['confirmPassword'] ?? null;
        $this->confirmar = $args['confirmar'] ?? 0;
    }

    public function validate() // validar los campos
    {
        if (!$this->nombre) self::setErrors("error", "Por favor ingrese su nombre 😅");
        if (!$this->email) self::setErrors("error", "El email no es válido 😥");
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) self::setErrors("error", "El email no es válido 😢");
        if (!$this->password) self::setErrors("error", "La contraseña no puede ir vacia 😥");
        if (!$this->confirmPassword) self::setErrors("error", "Debes de confirmar tu contraseña 😥");
        if ($this->password !== $this->confirmPassword) self::setErrors("error", "Las contraseñas no son iguales 😥");
        if (strlen($this->password) < 6) self::setErrors("error", "La contraseña debe tener un minimo de 6 caracteres 🤔");
        return self::getErrors(); // retornar los errores
    }

    
    public function validateEmail() // validar email unicamente
    {
        if (!$this->email) self::setErrors("error", "Por favor proporciona tu email 🤔");
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) self::setErrors("error", "El email no es válido 😢");
        return self::getErrors(); // retornar los errores
    }

    public function validatePassword() // validar contraseñas unicamente
    {
        if (!$this->password) self::setErrors("error", "La contraseña no puede ir vacia 😥");
        if (!$this->confirmPassword) self::setErrors("error", "Debes de confirmar tu contraseña 😥");
        if ($this->password !== $this->confirmPassword) self::setErrors("error", "Las contraseñas no son iguales 😥");
        if (strlen($this->password) < 6) self::setErrors("error", "La contraseña debe tener un minimo de 6 caracteres 🤔");
        return self::getErrors(); // retornar los errores
    }

    public function validateLogin() // validar email y contraseña unicamente
    {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) self::setErrors("error", "El email no es válido 😢");
        if (!$this->password) self::setErrors("error", "La contraseña no puede ir vacia 😥");
        return self::getErrors(); // retornar los errores
    }
    
    public function encrypPassword() // encryptar la contraseña
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT); // encryptar
    }

    public function generateToken() // generar token para validar email
    {
        $long = 20; // longitud de la cadena
        $this->token = bin2hex(random_bytes(($long - ($long % 2)) / 2)); // generar el token
    }

    // END
}

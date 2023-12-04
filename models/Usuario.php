<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "nombre", "apellido", "email", "password", "telefono", "admin", "confirmado", "token"];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->admin = $args["admin"] ?? 0;
        $this->confirmado = $args["confirmado"] ?? 0;
        $this->token = $args["token"] ?? "";
    }

    public function validarLogin() {
        if (!$this->email) {
            self::$alertas["error"][] = "Email Obligatorio";
        }
        if (!$this->password) {
            self::$alertas["error"][] = "Contraseña obligatoria";
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if (!$this->password) {
            self::$alertas["error"][] = "Contraseña obligatoria";
        }
        if (strlen($this->password) < 6) {
            self::$alertas["error"][] = "Contraseña muy corta";
        }
        return self::$alertas;
    }

    public function validarEmail() {
        if (!$this->email) {
            self::$alertas["error"][] = "Email Obligatorio";
        }
        return self::$alertas;
    }

    public function comprobarPasswordAndVerificado($password) {
        $resultado = password_verify($password,$this->password);
        if (!$resultado || !$this->confirmado) {
            self::$alertas["error"][] = "Contrasña incorrecta o cuenta no confirmada";
            return FALSE;
        } else{
            return TRUE;
        }
    }

    public function errores(){
        if (!$this->nombre) {
            self::$alertas["error"][] = "Nombre obligatorio";
        }
        if (!$this->apellido) {
            self::$alertas["error"][] = "Apellidos obligatorios";
        }
        if (!$this->email) {
            self::$alertas["error"][] = "Email obligatorios";
        }
        if (!$this->password) {
            self::$alertas["error"][] = "Contraseña obligatoria";
        }
        if (strlen($this->password) < 6) {
            self::$alertas["error"][] = "La contraseña debe ser mas larga";
        }
        return self::$alertas;
    }

    public function existeUsuario() {
        $query = "SELECT * FROM ". self::$tabla ." WHERE email = '" . $this->email . "' LIMIT 1;" ;
        $resultado = self::$db->query($query);
        
        if ($resultado->num_rows) {
            self::$alertas["errores"][] = "El email ingresado ya existe";
        } 

        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password,PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }
}

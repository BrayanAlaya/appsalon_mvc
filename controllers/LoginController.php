<?php 

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router) {
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if (empty($alertas)) {
                $usuario = Usuario::where("email", $auth->email);
                if ($usuario) {
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        
                        $_SESSION["nombre"] = $usuario->nombre ." ".$usuario->apellido;
                        $_SESSION["id"] = $usuario->id;
                        $_SESSION["email"] = $usuario->email;
                        $_SESSION["login"] = TRUE;
                        if ($usuario->admin === "1") {
                            $_SESSION["admin"] = $usuario->admin ?? null;
                            header("Location: /admin");
                        } else{
                            header("Location: /cita");
                        }
                    }
                    
                }else{
                    Usuario::setAlerta("error", "Email incorrecto");
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/login",[
            "errores" => $alertas
        ]);
    }
    public static function logout() {
        $_SESSION = [];
        header("Location: /");
    }
    public static function forget(Router $router) {

        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if (empty($alertas)) {
                $usuario = Usuario::where("email", $auth->email);
                if ($usuario && $usuario->confirmado === "1") {
                    $usuario->crearToken();
                    $usuario->guardar();

                    $email = new Email($usuario->nombre,$usuario->email,$usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta("exito","Revisa tu email");

                }else{
                    Usuario::setAlerta("error","El usuario no existe o no esta confirmado");
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/forget-password",[
            "errores" => $alertas
        ]);
    }
    public static function recover(Router $router) {
        $alertas = [];
        $error = false;
        $token = s($_GET["token"]);
        $usuario = Usuario::where("token", $token);
        if (empty($usuario)) {
            Usuario::setAlerta("error", "Token no valido");
            $error = TRUE;
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $recover = new Usuario($_POST);
            $alertas = $recover->validarPassword();
            
            if (empty($alertas)) {
                if ($recover->password === $_POST["passwordRepeat"]) {
                    $usuario->password = $recover->password;
                    $usuario->hashPassword();
                    $usuario->token = null;
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header("Location: /");
                    }
                }else{
                    Usuario::setAlerta("error", "Contraseñas no similares");
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/recover",[
            "errores" => $alertas,
            "error" => $error
        ]);
    }
    public static function crear(Router $router) {
        $usuario = new Usuario;
        $errores = [];
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario->sincronizar($_POST);
            $errores = $usuario->errores();

            if (empty($errores)) {
                $existe = $usuario->existeUsuario();

                if ($existe->num_rows) {
                    $errores = $usuario->getAlertas();
                } else{
                    $usuario->hashPassword();
                    $usuario->crearToken();
                    $email = new Email($usuario->nombre,$usuario->email,$usuario->token);
                    $email->enviarConfirmacion();
                    
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header("Location: /mensaje");
                    }

                }

            }


        }

        $router->render("auth/crear-cuenta",[
            "usuario" => $usuario,
            "errores" => $errores
        ]);
    }
    public static function mensaje(Router $router) {
        
        $router->render("auth/mensaje",[

        ]);
    }
    public static function confirmar(Router $router) {
        $alertas = [];

        $token = s($_GET["token"]);

        $usuario = Usuario::where("token", $token);
        
        if (empty($usuario)) {
            Usuario::setAlerta("error", "Token no valido");
        }else{
            $usuario->token = null;
            $usuario->confirmado = "1";
            $usuario->guardar();
            Usuario::setAlerta("exito", "Cuenta confirmada");
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/confirmar-cuenta",[
            "errores" => $alertas
        ]);
    }
}
?>

<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($nombre, $email, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = $_ENV["EMAIL_HOST"];
        $email->SMTPAuth = true;
        $email->Port = $_ENV["EMAIL_PORT"];
        $email->Username = $_ENV["EMAIL_USER"];
        $email->Password = $_ENV["EMAIL_PASS"];

        $email->setFrom("cuentas@appsalon.com");
        $email->addAddress("brayan.alaya@hotmail.com", "Appsalon");
        $email->Subject = "Confirma tu cuenta";

        $email->isHTML(TRUE);
        $email->CharSet = "UTF-8";


        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong>Has creado tu cuenta en appsalon</p>";
        $contenido .= "<p> presiona aqui: <a href='". $_ENV["PROYECT_URL"] ."/confirmar-cuenta?token=". $this->token ."'>Confirmar cuenta</a></p>";
        $contenido .= "<p>si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $email->Body = $contenido;

        $email->send();
    }

    public function enviarInstrucciones() {
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = $_ENV["EMAIL_HOST"];
        $email->SMTPAuth = true;
        $email->Port = $_ENV["EMAIL_PORT"];
        $email->Username = $_ENV["EMAIL_USER"];
        $email->Password = $_ENV["EMAIL_PASS"];

        $email->setFrom("cuentas@appsalon.com");
        $email->addAddress("brayan.alaya@hotmail.com", "Appsalon");
        $email->Subject = "Restablece tu contraseña";

        $email->isHTML(TRUE);
        $email->CharSet = "UTF-8";


        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong>Has solisitado restablecer tu contraseña, ingresa en el siguiente enlace.</p>";
        $contenido .= "<p> presiona aqui: <a href='". $_ENV["PROYECT_URL"] ."/recover?token=". $this->token ."'>Restablecer Contraseña</a></p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $email->Body = $contenido;

        $email->send();
    }

}

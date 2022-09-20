<?php
require_once("clase_conexion.php");
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';

class Correo extends Conectar
{

  public function __construct()
  {
    $this->conexion = parent::conexion();
  }

  public function prueba()
  {
    $mail = new PHPMailer(true);
    try {
      //Server settings
      $mail->SMTPDebug = 0;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'quijess6@gmail.com';                     //SMTP username
      $mail->Password   = 'dgjdhloqzaxxfqyf';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('quijess6@gmail.com', 'Jesus aguirre');
      $mail->addAddress('can3lon3000@gmail.com', 'Jesus Canelon');     //Add a recipient
      //$mail->addAddress('ellen@example.com');               //Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
     // $mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');



      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Este es el asunto t';
      $mail->Body    = 'Este es un mensaje con etiquetas html <b>En negrita!</b>';
      $mail->AltBody = 'Y bueno cosas aqui extras que x pues';

      $mail->send();

    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}

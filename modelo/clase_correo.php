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
  private $correo;



  public function __construct()
  {
    $this->conexion = parent::conexion();
  }

  public function prueba($destinatario,$asunto,$mensaje)
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
      $mail->setFrom('quijess6@gmail.com', '');
      $mail->addAddress($destinatario, '');     //Add a recipient
      //$mail->addAddress('ellen@example.com');               //Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
     // $mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');



      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $asunto;
      $mail->Body    = $mensaje;
     

      $mail->send();

    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }

  function listar_correos(){

        $sql = ("SELECT usuario,codigo FROM usuarios");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->correo[] = $filas;
        }
        return $this->correo;
  }


}

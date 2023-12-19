<?php
namespace Csr\Modelo;
use Csr\Modelo\Conexion;
use PDO;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';

class Correo extends Conexion
{

  private $id_modulo;

  private $conexion;

  public function __construct()
  {
    $this->conexion = parent::conexion();
    $this->id_modulo = 11;
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
      $mail->Username   = 'proyectocasasobrelaroca@gmail.com';                     //SMTP username
      $mail->Password   = 'henxaswwjnitgjqf';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('proyectocasasobrelaroca@gmail.com', '');
      $mail->addAddress($destinatario, '');     //Add a recipient
      //$mail->addAddress('ellen@example.com');               //Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
     // $mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

      $mail->AddEmbeddedImage('./resources/img/casawhite.jpg', 'csr');

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $asunto;
      $mail->Body  = "<img src=\"cid:csr\" /> " . $mensaje;
     

      $mail->send();

    } catch (Exception $e) {
      http_response_code(404);

      echo json_encode( array("msj"=>"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
      die();
    }
       $accion = "Envio de correo";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion,$this->id_modulo);
  }

  public function listar_correos(){
        $resultado = [];
        $sql = ("SELECT usuario,codigo FROM usuarios");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }
        return $resultado;
  }

  public function enviar_token($destinatario,$token){
    $mail = new PHPMailer(true);
    try {
      //Server settings
      $mail->SMTPDebug = 0;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'proyectocasasobrelaroca@gmail.com';                     //SMTP username
      $mail->Password   = 'henxaswwjnitgjqf';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('proyectocasasobrelaroca@gmail.com', '');
      $mail->addAddress($destinatario, '');     //Add a recipient
    
      $mail->AddEmbeddedImage('./resources/img/casawhite.jpg', 'csr');

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject =  "Este es el token de verificacion para recueperar tu contraseña";
      $mail->Body  = "<img src=\"cid:csr\" /> <p> El token es:  <b>" .$token ."</b></p>";
     

      $mail->send();

    } catch (Exception $e) {
      http_response_code(404);

      echo json_encode( array("msj"=>"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
      die();
    }
  }
  public function enviar_nueva_password($destinatario,$password){
    $mail = new PHPMailer(true);
    try {
      //Server settings
      $mail->SMTPDebug = 0;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'proyectocasasobrelaroca@gmail.com';                     //SMTP username
      $mail->Password   = 'henxaswwjnitgjqf';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('proyectocasasobrelaroca@gmail.com', '');
      $mail->addAddress($destinatario, '');     //Add a recipient
    
      $mail->AddEmbeddedImage('./resources/img/casawhite.jpg', 'csr');

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject =  "Password reset";
      $mail->Body  = "<img src=\"cid:csr\" /> <p> tu nueva password es:  <b>" . $password ."</b></p>";
     

      $mail->send();

    } catch (Exception $e) {
      http_response_code(404);

      echo json_encode( array("msj"=>"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
      die();
    }
  }

}

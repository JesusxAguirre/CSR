<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;


final class LoginTest extends TestCase
{
  private $objeto_usuarios;

  public function setUp(): void
  {
    $this->objeto_usuario = new Usuarios();
  }

  /** @test **/
  public function test_login_admin()
  {
    //Init
    $correo = "examplejeje@gmail.com";
    $clave = "Hola!000";
    $expected = 200;

    //Act  
    $this->objeto_usuario->security_validation_correo($correo);

    $this->objeto_usuario->security_validation_clave($clave);

    $_SESSION['usuario'] = $correo;

    $_SESSION['clave'] = $clave;

    $response = $this->objeto_usuario->validar();

    //Asert
    $this->assertEquals($expected, $response);
  }


}

<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;


final class LoginTest extends TestCase
{
  private $objeto_usuarios;

  public function setUp(): void
  {
    $this->objeto_usuarios   = new Usuarios();
  }
  /** @test **/
  public function test_login_admin()
  {
    //Init
    $_SESSION['usuario'] = "example@gmail.com";
    $_SESSION['clave'] = "12345678";
    $expected = 1;
    //Act  
    $response = $this->objeto_usuarios->validar();

    //Asert
    $this->assertEquals($expected, $response);
  }

  /** @test **/
  public function test_recuperar_password()
  {
    //Init
    $correo = "example@gmail.com";
    $clave = "12345678";
    $expected = 1;
    //Act  
    $this->objeto_usuarios->setRecuperar($correo,$clave);

    $response = $this->objeto_usuarios->recuperar_password();

    //Asert
    $this->assertEquals($expected, $response);
  }
}

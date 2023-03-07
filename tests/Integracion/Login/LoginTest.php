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
    $usuario_aleatorio = $this->objeto_usuarios->listar_usuarios();
    
    $_SESSION['usuario'] = $usuario_aleatorio[0]['usuario'];
    $_SESSION['clave'] =  "12345678";
    $expected = 1;
    //Act  
    $response = $this->objeto_usuarios->validar();

    //Asert
    $this->assertEquals($expected, $response);
  }

  /** 
   * @depends test_login_admin
   *  **/
  public function test_recuperar_password()
  {
    //Init
    $clave = "12345678";
    $expected = 1;
    //Act  
    $this->objeto_usuarios->setRecuperar($_SESSION['usuario'],$clave);

    $response = $this->objeto_usuarios->recuperar_password();

    //Asert
    $this->assertEquals($expected, $response);
  }
}

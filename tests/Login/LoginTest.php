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
    $_SESSION['usuario'] = "";
    $_SESSION['clave'] = "";
    $expected = 200;
    
    //Act  
    $response =  $this->objeto_usuarios->validar();

    //Asert

    $this->assertEquals($expected, $response['status_code']);
  }


}

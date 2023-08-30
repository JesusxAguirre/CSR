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
    $correo = "";
    $clave = "";
    $expected = 200;
    
    //Act  

    $this->assertEquals('',$this->objeto_usuarios->security_validation_correo($correo));

    $this->assertEquals('',$this->objeto_usuarios->security_validation_clave($clave));

    $response =  $this->objeto_usuarios->validar();

    //Asert

    $this->assertEquals($expected, $response['status_code']);
  }


}

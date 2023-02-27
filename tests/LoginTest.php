<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;


final class LoginTest extends TestCase
{
   
    /** @test **/
    public function test_login_admin ()
    {
     //Init
      $objeto_usuarios = New Usuarios();
      $_SESSION['usuario'] = "casasobrelaroca@gmail.com";
      $_SESSION['clave'] = "987654321";
      $expected = 1;
     //Act  
      $response = $objeto_usuarios->validar();
      
     //Asert
     $this->assertEquals($expected,$response);
    }
}
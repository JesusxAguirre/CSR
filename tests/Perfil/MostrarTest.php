<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;

final class MostrarTest extends TestCase
{
  private $objeto;

  public function setUp(): void
  {
    $this->objeto = new Usuarios();
  }
  
  /** @test **/
  public function test_mostrar(): void
  {
    //Init
    $_SESSION['usuario'] = 'correonoexiste@gmail.com';
    $cedula = 'error';
    //Act  

    $datos = $this->objeto->mi_perfil();

    //Asert

    $this->assertNotEmpty($datos);
    $this->assertEquals($cedula, $datos[0]['cedula']);
  }
}
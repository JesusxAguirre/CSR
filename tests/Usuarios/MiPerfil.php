<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;


final class MiPerfilTest extends TestCase
{
  private $objeto_usuarios;

  public function setUp(): void
  {
    $this->objeto_usuarios   = new Usuarios();
  }
  
  /** @test **/
  public function test_miPerfil()
  {
    //Init
    $_SESSION['usuario'] = 'can3lon3000@gmail.com';
    //Act  
    $datos_usuario = $this->objeto_usuarios->mi_perfil();

    //Asert
    $this->assertIsArray($datos_usuario ); // verifica que $matriz_usuario es un array
    $this->assertNotEmpty($datos_usuario ); // verifica que $matriz_usuario no está vacío
    $this->assertContains($_SESSION['usuario'], $datos_usuario[0]);
  }
}

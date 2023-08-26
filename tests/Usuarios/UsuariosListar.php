<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;


final class UsuariosTest extends TestCase
{
  private $objeto_usuarios;

  public function setUp(): void
  {
    $this->objeto_usuarios   = new Usuarios();
  }
  
  /** @test **/
  public function test_listar_usuarios()
  {
    //Init
    
    //Act  
    $matriz_usuario = $this->objeto_usuarios->listar();

    //Asert
    $this->assertIsArray($matriz_usuario); // verifica que $matriz_usuario es un array
    $this->assertNotEmpty($matriz_usuario); // verifica que $matriz_usuario no está vacío
    $this->assertArrayHasKey('cedula', $matriz_usuario[0]); // verifica que el primer usuario tiene una clave 'id'
  }
}

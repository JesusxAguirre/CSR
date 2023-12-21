<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;

final class ListarTest extends TestCase
{
  private $objeto_usuarios;

  public function setUp(): void
  {
    $this->objeto_usuarios = new Usuarios();
  }
  
  /** @test **/
  public function test_listar(): void
  {
    //Init

    $expected = 0;

    //Act  

    $listar_usuarios = $this->objeto_usuarios->listar();

    //Asert

    $this->assertNotEmpty($listar_usuarios);
    $this->assertGreaterThan($expected, $listar_usuarios);

  }
}
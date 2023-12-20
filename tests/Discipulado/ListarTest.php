<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Discipulado;


final class ListarTest extends TestCase
{
  private $objeto;

  public function setUp(): void
  {
    $this->objeto = new Discipulado();
  }

  /** @test **/
  public function test_listar(): void
  {
    //Init
    $expected = 0;
    $_SESSION['cedula'] = 123;

    //Act
    $matriz_celula = $this->objeto->listar_celula_discipulado();


    //Assert

    $this->assertNotEmpty($matriz_celula);
    $this->assertGreaterThan($expected, $matriz_celula);
  }
}
?>
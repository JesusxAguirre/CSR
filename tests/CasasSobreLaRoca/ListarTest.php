<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\LaRoca;


final class ListarTest extends TestCase
{
  private $objeto;

  public function setUp(): void
  {
    $this->objeto   = new LaRoca();
    $_SESSION['cedula'] = '';
  }
  /** @test **/
  public function test_listar(): void
  {
    //Init
    $key_expected = "id";

    //Act
    $casas = $this->objeto->listar_casas_la_roca_por_usuario();

    //Assert

    $this->assertArrayHasKey($key_expected, $casas[0]);

  }
}
?>
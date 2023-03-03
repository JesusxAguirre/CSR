<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Consolidacion;


final class UsuariosTest extends TestCase
{
  private $objeto_consolidacion;

  public function setUp(): void
  {
    $this->objeto_consolidacion   = new Consolidacion();
  }
  /** @test **/
  public function test_listar_usuarios_N2(): array
  {
    //Init
    $key_expected = "cedula";
    //Act
    $array_usuarios_n2_3 =$this->objeto_consolidacion->listar_usuarios_N2();

    //Assert

    $this->assertArrayHasKey($key_expected,$array_usuarios_n2_3);

    return $array_usuarios_n2_3;
  }
  /** @test **/
  public function test_listar_no_participantes(): array
  {
    //Init
    $key_expected = "cedula";
    //Act
    $array_usuarios_a_consolidar =$this->objeto_consolidacion->listar_usuarios_N2();

    //Assert

    $this->assertArrayHasKey($key_expected,$array_usuarios_a_consolidar);

    return $array_usuarios_a_consolidar;
  }

    
  /**
   * @depends test_listar_no_participantes
   * @depends test_listar_usuarios_N2
   * **/
  public function test_registrar_consolidacion(){
    
  }

}

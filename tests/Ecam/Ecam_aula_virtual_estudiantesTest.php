<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;


final class Ecam_aula_virtual_estudiantesTest extends TestCase
{
  private $objeto_ecam;

  public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['id_seccion'] = 14;
  }
  /** @test **/
  public function test_listar_mis_compañeros()
  {
    //Init


    $expected = true;
    //Act  
  
    //Asert
  
  }

 
}

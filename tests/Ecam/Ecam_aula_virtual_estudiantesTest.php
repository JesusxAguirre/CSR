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
    
  }
  /** @test **/
  public function test_listar_mis_compañeros()
    {
      //Init
      $_SESSION['id_seccion'] = 14;
      $key = "cedula";
      //Act  
      $array_estudiantes =$this->objeto_ecam->listar_misCompaneros();
      
      //Asert
      
      $this->assertArrayHasKey($key,$array_estudiantes[0]);
      
      
    }

 
}

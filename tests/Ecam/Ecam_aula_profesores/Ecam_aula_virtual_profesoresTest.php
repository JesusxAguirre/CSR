<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;


final class Ecam_aula_virtual_profesoresTest extends TestCase
{
  private $objeto_ecam;
  private $id_materia;
  public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['id_seccion'] = 14;
    $_SESSION['cedula'] =27666555;
    $this->id_materia = 1;
   
  }
  /** @test **/
  public function test_listar_misMateriasProf()
  {
    //Init

    $key = "id_materia";
    //Act  
    $array_materias = $this->objeto_ecam->listar_misMateriasProf();
  
    //Asert

    $this->assertArrayHasKey($key, $array_materias[0]);
  }
  public function test_agregarContenidos()
  {
    //Init
    $contenido = "Esta materia trata sobre logica de programacion comenzaremos en breve viendo pseudo codigo";
    
 
    //Act  
    $response = $this->objeto_ecam->agregarContenidos($_SESSION['id_seccion'],$this->id_materia,$contenido);
    
    //Asert

    $this->assertTrue($response);
  }

 
}

<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;


final class ProfesoresTest extends TestCase
{
  private $objeto_ecam;
  
  public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['cedula'] = 27666555;
  }

  /** @test **/
  public function test_listar_noProfesores(): array
  {
    //Init
    $key_expected = "cedula";
    //Act

    $array_futuros_profesores = $this->objeto_ecam->listar_noProfesores();

    //Asert

    $this->assertArrayHasKey($key_expected,$array_futuros_profesores[0]);

    return $array_futuros_profesores[0];
    
  }

  public function test_listarProfesores(): array
  {
    //Init
    $key_expected = "cedula";

    //Act

    $array_profesores = $this->objeto_ecam->listarProfesores();

    //Assert

   

    $this->assertArrayHasKey($key_expected,$array_profesores[0]);

    return $array_profesores;
  }
  /**
     * @depends test_listar_noProfesores
     * @depends test_listarProfesores
  */
  public function test_agregar_profesores(array $futuro_profesor,array $array_profesores) //: array
  {
    //Init
   
    $array_cedula[] =$futuro_profesor['cedula'];
    //Act  

    $this->objeto_ecam->agregar_profesores($array_cedula);

    $array_profesores = $this->objeto_ecam->listarProfesores();
    
    //guardando en un array las cedulas de todos los profesores para verificar que si exista la que se agrego
    foreach($array_profesores as $profesor){
      $cedulas_profesores[] = $profesor['cedula'];
    }

    //Assert
    $this->assertContains($array_cedula[0],$cedulas_profesores);
  }

  
}

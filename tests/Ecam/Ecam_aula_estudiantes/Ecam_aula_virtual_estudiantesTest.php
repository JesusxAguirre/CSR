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
    $_SESSION['id_seccion'] = 19;
    $_SESSION['cedula'] =2345698;
  }
  /** @test **/
  public function test_listar_mis_compañeros()
  {
    //Init

    $key = "cedula";
    //Act  
    $array_estudiantes = $this->objeto_ecam->listar_misCompaneros();

    //Asert

    $this->assertArrayHasKey($key, $array_estudiantes[0]);
  }

  /** @test **/
  public function test_listar_mis_profesores()
  {

    //Init
    $key = "codigo";
    //Act
    $array_profesores = $this->objeto_ecam->listar_misProfesores();
    //Asert
    

    $this->assertArrayHasKey($key, $array_profesores[0]);
  }

  /** @test **/
  public function test_listar_mis_materias()
  {
    //Init
    $key = "id_materia";
    //Act
    $array_materias = $this->objeto_ecam->listar_misMateriasEst();
    //Asert
   

    $this->assertArrayHasKey($key, $array_materias[0]);
  }
  /** @test **/
  public function test_datos_miSeccioEst()
  {
    //Init
    $key = "nombreSeccion";
    //Act
    $array_datos_seccion = $this->objeto_ecam->datos_miSeccionEst();
    //Asert
    

    $this->assertArrayHasKey($key, $array_datos_seccion[0]);
  }
  public function test_listar_mis_notas()
  {
    //Init
    $key = "id_seccion";
    //Act
    $array_mis_notas = $this->objeto_ecam->listar_misNotas();
    //Asert
   

    $this->assertArrayHasKey($key, $array_mis_notas[0]);
  }
}

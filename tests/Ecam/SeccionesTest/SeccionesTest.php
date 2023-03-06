<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;


final class SeccionesTest extends TestCase
{
  private $objeto_ecam;
  private $nombreSeccion;
  private $nivelSeccion;
  private $fechaCierre;
  
  public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['cedula'] = 27666555;
    $this->nombreSeccion = 'Los Desarrolladores';
    $this->nivelSeccion = 1;
    $this->fechaCierre = '2023-03-04';
  }


  /** @test **/
  public function test_crear_seccion_paso1()//: array
  {
    //Init

    //Act
    $respuesta= $this->objeto_ecam->validar_seccion($this->nombreSeccion, $this->nivelSeccion);
    $this->assertEquals(0, $respuesta, $mensaje = "La seccion ya existe");

  }

  /**
   * @depends test_crear_seccion_paso1 
   * **/
  public function test_crear_seccion_paso1_listarMaterias() :array
  {
    //Init

    //Act
    $cantidad = $this->objeto_ecam->cantidadFilasNiveles($this->nivelSeccion);
    $materias_nivel = $this->objeto_ecam->listarMateriasNivel($this->nivelSeccion);

    //Assert
    $this->assertArrayHasKey('id_materia', $materias_nivel[0]);
    $this->assertIsInt($cantidad);

    $arreglo['cantidad'] = $cantidad;
    $arreglo['materias'] = $materias_nivel;

    return $arreglo;
  }

  /**
   * @depends test_crear_seccion_paso1_listarMaterias 
   * **/
  public function test_crear_seccion_paso1_listarProfesores($arreglo) :array
  {
    //Int
    $profesores_materias = [];
    for ($i=0; $i < $arreglo['cantidad']; $i++) { 
       foreach ($this->objeto_ecam->listarProfesoresMateria($arreglo['materias'][$i]['id_materia']) as $arreglo2) {
          $profesores_materias[] = $arreglo2['cedula_profesor'];
        }
    }
    $expected = $this->objeto_ecam->listarProfesoresMateria($arreglo['materias'][0]['id_materia']);
    //Act
    $this->assertContains($expected[0]['cedula_profesor'], $profesores_materias);

    $arreglo['cedula_profesores'] = $profesores_materias;

    return $arreglo;
  }

   /**
   * @depends test_crear_seccion_paso1
   * **/
  public function test_crear_seccion_paso1_listarEstudiantes($arreglo) :array
  {
      $cedula_estudiantes = [];
      foreach ($this->objeto_ecam->sinNivel($this->nivelSeccion) as $valor) {
        $cedula_estudiantes[] = $valor['cedula'];
      }

      $expected = $this->objeto_ecam->sinNivel($this->nivelSeccion);

      //Art
      $this->assertContains($expected[0]['cedula'], $cedula_estudiantes);
      $arreglo['cedula_estudiantes'] = $cedula_estudiantes;

      return $arreglo;
  }

  /**
   * @depends test_crear_seccion_paso1_listarEstudiantes
   * @depends test_crear_seccion_paso1_listarProfesores
   * **/
  public function test_crear_seccion_final($array1,$array2)
  {
    $id_materia = [];
    foreach ($array2['materias'] as $valor) {
      $id_materia[] = $valor['id_materia'];
    }

    $this->objeto_ecam->setSeccion($this->nombreSeccion, $this->nivelSeccion, $array2['cedula_profesores'], $array1['cedula_estudiantes'], $id_materia, $this->fechaCierre);
    $valor = $this->objeto_ecam->crearSeccion();

    $expected = $this->objeto_ecam->listarSeccionesON();
    foreach ($expected as $valor2) {
      $expected[] = $valor2['id_seccion'];
    }
    
    $this->assertContains($valor, $expected);
  }
}

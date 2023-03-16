<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;


final class CrudSecciones extends TestCase
{
    private $objeto_ecam;
    private $nombreSeccion;
    private $nivelSeccion;
    private $fechaCierre;
    private $id_seccion;
    public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['cedula'] = 27666555;
    $this->nombreSeccion = 'Prueba';
    $this->nivelSeccion = 1;
    $this->fechaCierre = '2023-03-23';
    //$this->id_seccion = 20;
  }

  /** @test **/
  public function test_editar_datos_basicos()
  {
    //Init
    $consulta = $this->objeto_ecam->listarSeccionesON();
    $indice = count($consulta)-1;
    $id_seccion = $consulta[$indice]['id_seccion'];
    //Act
    $respuesta= $this->objeto_ecam->validar_seccion($this->nombreSeccion, $this->nivelSeccion);
    $this->assertEquals(0, $respuesta, $mensaje = "La seccion ya existe");

    $this->objeto_ecam->setActualizarDatosSeccion($this->nombreSeccion, $this->nivelSeccion, $this->fechaCierre);
    $this->objeto_ecam->actualizarDatosSeccion($id_seccion);

    $expected = [];
    foreach ($this->objeto_ecam->listarSeccionesON() as $value) {
      $expected[]= $value['nombre'];
    }

    $this->assertContains($this->nombreSeccion, $expected);

    return $id_seccion;
  }

  /**
   * @depends test_editar_datos_basicos
   * **/
  public function test_agregar_estudiantes($id_seccion) :array
  {
    $est = $this->objeto_ecam->sinNivel($this->nivelSeccion);
    $estudiantes = [];
    array_push($estudiantes, $est[0]['cedula'], $est[1]['cedula']);

    $this->objeto_ecam->agregandoMasEstudiantes($estudiantes, $id_seccion);
    $expected = [];
    foreach ($this->objeto_ecam->listarEstudiantesON($id_seccion) as $value) {
      $expected[] = $value['cedula'];
    }

    $this->assertContains($estudiantes[0], $expected);

    return $estudiantes;
  }

  /**
   * @depends test_agregar_estudiantes
   * @depends test_editar_datos_basicos
   * **/
  public function test_eliminar_estudiantes($array, $id_seccion)
  {
    $this->objeto_ecam->eliminarEstSeccion($array[0]);
    $expected = $this->objeto_ecam->listarEstudiantesON($id_seccion);

    //debo crear un foreach
    $this->assertNotContains($array[0], $expected);
  }

  /**
   * @depends test_editar_datos_basicos
   * **/
  public function test_agregar_materiasProfesores($id_seccion) :array
  {
    $materia = $this->objeto_ecam->selectMateriasOFF($id_seccion, $this->nivelSeccion);
    $profesor = $this->objeto_ecam->profesores_materiaSeleccionada($materia[0]['id_materia']);

    $this->objeto_ecam->setActualizarMP($materia[0]['id_materia'], $profesor[0]['cedula_profesor']);
    $this->objeto_ecam->actualizarMateriasProfesores($id_seccion);

    $expected = [];
    foreach ($this->objeto_ecam->listarProfesores_seccionMateria($id_seccion) as $value) {
      $expected[] = $value['cedula'];
      $expected[] = $value['id_materia'];
    }

    $this->assertContains($materia[0]['id_materia'], $expected);
    $this->assertContains($profesor[0]['cedula_profesor'], $expected);
    
    $arreglo['cedula_profesor'] = $profesor[0]['cedula_profesor'];
    $arreglo['id_materia'] = $materia[0]['id_materia'];

    return $arreglo;
  }

  /**
   * @depends test_agregar_materiasProfesores
   * @depends test_editar_datos_basicos
   * **/
  public function test_eliminar_materiasProfesores($array, $id_seccion)
  {
    $this->objeto_ecam->eliminarMateriaProf_seccion($id_seccion, $array['id_materia'], $array['cedula_profesor']);
    $expected = $this->objeto_ecam->listarProfesores_seccionMateria($id_seccion);

    $this->assertEmpty($expected);
  }

  /**
   * @depends test_editar_datos_basicos
   * **/
  public function test_cerrar_seccion($id_seccion)
  {
    $this->objeto_ecam->cerrarSeccion($id_seccion);
    $expected = $this->objeto_ecam->listarSeccionesON();
    foreach ($this->objeto_ecam->listarSeccionesON() as $value) {
      $expected2[] = $value['id_seccion'];
    }

    $this->assertNotContains($id_seccion, $expected2);
  }
/* 
  public function test_listar_secciones_cerradas()
  {
    $expected = [];
    foreach ($this->objeto_ecam->listarSeccionesOFF() as $value) {
      $expected[] = $value['id_seccion'];
    }

    $this->assertContains($this->id_seccion, $expected);
  }

  public function test_eliminar_seccion_definitivamente()
  {
    $this->objeto_ecam->eliminarSeccion($this->id_seccion);
    $expected = [];
    foreach ($this->objeto_ecam->listarSeccionesON() as $value) {
      $expected[] = $value['id_seccion'];
    }
    foreach ($this->objeto_ecam->listarSeccionesOFF() as $value) {
      $expected[] = $value['id_seccion'];
    }

    $this->assertNotContains($this->id_seccion, $expected);
  } */
}
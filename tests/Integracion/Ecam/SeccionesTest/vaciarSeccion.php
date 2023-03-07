<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;
use Csr\Modelo\Usuarios;


final class CrudSecciones extends TestCase
{
    private $objeto_ecam;
    private $objeto_usuario;
    private $nombreSeccion;
    private $nivelSeccion;
    private $fechaCierre;

    public function setUp(): void
  {
    $this->objeto_ecam = new Ecam();
    $this->objeto_usuario = new Usuarios();
    $return = $this->objeto_usuario->listar_usuarios_N2();
    $_SESSION['cedula'] = $return[0]['cedula'];

    $this->nombreSeccion = 'PruebaFinal';
    $this->nivelSeccion = 1;
    $this->fechaCierre = '2023-03-23';
  }

  /** @test **/
  public function test_editar_datos_basicos()
  {
    //Init
    $consulta = $this->objeto_ecam->listarSeccionesON();
    $id_seccion = $consulta[0]['id_seccion'];

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
  public function test_eliminar_estudiantes($id_seccion)
  {
    $estudiante = [];
    foreach ($this->objeto_ecam->listarEstudiantesON($id_seccion) as $value) {
        $estudiante[] = $value['cedula'];
    }
    $this->objeto_ecam->eliminarEstSeccion($estudiante[0]);
    $expected = $this->objeto_ecam->listarEstudiantesON($id_seccion);

    //debo crear un foreach
    $this->assertNotContains($estudiante[0], $expected);

    return $id_seccion;
  }

  /**
   * @depends test_eliminar_estudiantes
   * **/
  public function test_eliminar_materiasProfesores($id_seccion)
  {
    $datos = [];
    foreach ($this->objeto_ecam->listarProfesores_seccionMateria($id_seccion) as $value) {
        $datos['cedula'] = $value['cedula'];
        $datos['id_materia'] = $value['id_materia'];
    }
    $this->objeto_ecam->eliminarMateriaProf_seccion($id_seccion, $datos['id_materia'], $datos['cedula']);

    $expected2 = $this->objeto_ecam->listarProfesores_seccionMateria($id_seccion);

    $this->assertEmpty($expected2);

    return $id_seccion;
  }

  /**
   * @depends test_eliminar_materiasProfesores
   * **/
  public function test_cerrar_seccion($id_seccion)
  {
    $validacion = $this->objeto_ecam->cerrarSeccion($id_seccion);
    

    $this->assertTrue($validacion);
  }
}

?>
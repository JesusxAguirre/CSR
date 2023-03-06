<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;


final class ControlTest extends TestCase
{
    private $objeto_ecam;

    public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['cedula'] = 27666555;
  }

  /** @test **/
  public function test_agregar_notaFinal() :array
  {
    //Init
    $consulta = $this->objeto_ecam->listarSeccionesON();
    $indice = count($consulta)-1;
    $id_seccion = $consulta[$indice]['id_seccion'];
    $consulta2 = $this->objeto_ecam->listarEstudiantesON($id_seccion);
    $nota_final = 14;

    $estudiante['cedula'] = $consulta2[0]['cedula'];
    $estudiante['id_seccion'] = $id_seccion;
    $estudiante['nivel_academico'] = $consulta[$indice]['nivel_academico'];
    $estudiante['nota_final'] = $nota_final;

    $this->objeto_ecam->agregar_notaFinal($id_seccion, $estudiante['cedula'], $nota_final, $estudiante['nivel_academico']);

    $expected = [];
    foreach ($this->objeto_ecam->listarEstudiantes_notaFinal() as $value) {
        if ($value['cedula'] == $estudiante['cedula'] && $value['nivel_academico'] == $estudiante['nivel_academico']) {
            $expected['cedula'] = $value['cedula'];
            $expected['id_seccion'] = $value['id_seccion'];
            $expected['nivel_academico'] = $value['nivel_academico'];
            $expected['nota_final'] = $value['notaFinal'];
        }
    }

    $this->assertEquals($estudiante, $expected);

    return $estudiante;
  }

  /**
   * @depends test_agregar_notaFinal
   * **/
  public function test_eliminar_notaFinal($array)
  {
    $this->objeto_ecam->eliminar_notaFinal($array['id_seccion'], $array['cedula'], $array['nivel_academico']);

    $expected = [];
    foreach ($this->objeto_ecam->listarEstudiantes_notaFinal() as $value) {
        if ($value['cedula'] == $array['cedula'] && $value['nivel_academico'] == $array['nivel_academico'] && $value['notaFinal'] > 0) {
            $expected['cedula'] = $value['cedula'];
            $expected['id_seccion'] = $value['id_seccion'];
            $expected['nivel_academico'] = $value['nivel_academico'];
            $expected['nota_final'] = $value['notaFinal'];
        }
    }

    $this->assertNotContains($array, $expected);
  }
}
?>
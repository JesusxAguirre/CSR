<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;
use Csr\Modelo\Usuarios;


final class ControlTest extends TestCase
{
  private $objeto_ecam;
  private $objeto_usuario;

    public function setUp(): void
  {
    $this->objeto_ecam = new Ecam();
    $this->objeto_usuario = new Usuarios();
    $return = $this->objeto_usuario->listar_usuarios_N2();
    $_SESSION['cedula'] = $return[0]['cedula'];
  }

  /** @test **/
  public function test_agregar_notaFinal()
  {
    //Init
    $consulta = $this->objeto_ecam->listarSeccionesON();
    $id_seccion = $consulta[0]['id_seccion'];
    $consulta2 = $this->objeto_ecam->listarEstudiantesON($id_seccion);
    $nota_final = 16;

    $estudiante['cedula'] = $consulta2[0]['cedula'];
    $estudiante['id_seccion'] = $id_seccion;
    $estudiante['nivel_academico'] = $consulta[0]['nivel_academico'];
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
  }
}
?>
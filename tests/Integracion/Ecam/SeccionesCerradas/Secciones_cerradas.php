<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;
use Csr\Modelo\Usuarios;


final class Secciones_cerradas extends TestCase
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
  public function test_listar_secciones_cerradas()
  {
    $id_seccion = [];

    foreach ($this->objeto_ecam->listarSeccionesOFF() as $value) {
      $id_seccion[] = $value['id_seccion'];
    }

    $this->assertNotEmpty($id_seccion);

    return $id_seccion[0];
  }

  /**
   * @depends test_listar_secciones_cerradas
   * **/
  public function test_eliminar_seccion_definitivamente($id_seccion)
  {
    $validacion = $this->objeto_ecam->eliminarSeccion($id_seccion);

    $this->assertTrue($validacion);
  }

}
?>
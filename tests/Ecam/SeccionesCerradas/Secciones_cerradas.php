<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;


final class Secciones_cerradas extends TestCase
{
    private $objeto_ecam;
    private $id_seccion;

    public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['cedula'] = 27666555;
    $this->id_seccion = 22;
  }

  /** @test **/
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
  }

}
?>
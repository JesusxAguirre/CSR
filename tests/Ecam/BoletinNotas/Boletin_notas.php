<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;


final class Boletin_notas extends TestCase
{
    private $objeto_ecam;
    private $id_seccion;

    public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['cedula'] = 2345698;
    $this->id_seccion = 21;
  }

  /** @test **/
  public function listar_boletin_notas()
  {
    $aprobados = [];
    foreach ($this->objeto_ecam->seccionAprobados($this->id_seccion) as $value) {
        $aprobados[] = $value['cedulaEstudiante'];
    }

    $reprobados = [];
    foreach ($this->objeto_ecam->seccionAplazados($this->id_seccion) as $value) {
        $reprobados[] = $value['cedulaEstudiante'];
    }
    
    $this->assertContains($_SESSION['cedula'], $aprobados);
    $this->assertNotContains($_SESSION['cedula'], $reprobados);
  }
}
?>
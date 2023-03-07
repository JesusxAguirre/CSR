<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;
use Csr\Modelo\Usuarios;


final class Boletin_notas extends TestCase
{
    private $objeto_ecam;
    private $objeto_usuario;
    private $id_seccion;

    public function setUp(): void
  {
    $this->objeto_ecam = new Ecam();
    $this->objeto_usuario = new Usuarios();
    $return = $this->objeto_ecam->listarSeccionesON();
    $return2 = $this->objeto_ecam->listarEstudiantesON($return[0]['id_seccion']);
    
    $_SESSION['id_seccion'] = $return[0]['id_seccion'];
    $_SESSION['cedula'] = $return2[0]['cedula'];
  }

  /** @test **/
  public function listar_boletin_notas()
  {
    $aprobados = [];
    foreach ($this->objeto_ecam->seccionAprobados($_SESSION['id_seccion']) as $value) {
        $aprobados[] = $value['cedulaEstudiante'];
    }

    $reprobados = [];
    foreach ($this->objeto_ecam->seccionAplazados($_SESSION['id_seccion']) as $value) {
        $reprobados[] = $value['cedulaEstudiante'];
    }
    
    $this->assertContains($_SESSION['cedula'], $aprobados);
    $this->assertNotContains($_SESSION['cedula'], $reprobados);
  }
}
?>
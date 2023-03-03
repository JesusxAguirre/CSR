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
    private $consulta_seccion;
    public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['cedula'] = 27666555;
    $this->nombreSeccion = 'LosProgramadores';
    $this->nivelSeccion = 1;
    $this->fechaCierre = '2023-03-23';
    $this->consulta_seccion = $this->objeto_ecam->listarSeccionesON();
    $this->id_seccion = $this->consulta_seccion[1]['id_seccion'];
  }

  public function test_editar_datos_basicos()
  {
    //Init

    //Act
    $respuesta= $this->objeto_ecam->validar_seccion($this->nombreSeccion, $this->nivelSeccion);
    $this->assertEquals(0, $respuesta, $mensaje = "La seccion ya existe");
  }
}
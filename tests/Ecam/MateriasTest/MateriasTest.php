<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;


final class MateriasTest extends TestCase
{
  private $objeto_ecam;
  private $id_materia;
  public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['cedula'] = 27666555;
  }

  public function test_listar_misMateriasProf(): array
  {
    //Init

    $key = "id_materia";
    //Act  
    $array_materias = $this->objeto_ecam->listar_misMateriasProf();

    $datos_profesor['id_materia'] = $array_materias[0]["id_materia"];
    $datos_profesor['id_seccion'] = $array_materias[0]["id_seccion"];
    //Asert
  
    
    
    $this->assertArrayHasKey($key, $array_materias[0]);

    return $datos_profesor;
  }

  
}

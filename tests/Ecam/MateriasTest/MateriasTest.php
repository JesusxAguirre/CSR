<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;


final class MateriasTest extends TestCase
{
  private $objeto_ecam;
  
  public function setUp(): void
  {
    $this->objeto_ecam   = new Ecam();
    $_SESSION['cedula'] = 27666555;
  }

  public function test_agregarMaterias(): array
  {
    //Init
    $array_profesores = $this->objeto_ecam->listarProfesores();
    foreach($array_profesores as $profsor){
      $profesores_cedula[] = $profsor['cedula'];
    }
    $nombre_materia = "Programacion 1";
    $nivel = 1;
    
    print_r($profesores_cedula);
    //Act  
    $this->objeto_ecam->setMaterias($nombre_materia,$nivel,$profesores_cedula);

    $this->objeto_ecam->agregarMaterias();
    
    $array_materias = $this->objeto_ecam->listarMaterias();
    print_r($array_materias);
    //Asert  
    $this->assertContains($nombre_materia,$array_materias);

    return $array_materias;
  }

  
}

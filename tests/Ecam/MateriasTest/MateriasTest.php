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
    
    $response = $this->objeto_ecam->validar_materia($nombre_materia,$nivel);
    $this->assertEquals(0,$response,$message = "Esta materia ya existe en la base de datos por favor cambie el dato a ingresar");
    //Act  
    $this->objeto_ecam->setMaterias($nombre_materia,$nivel,$profesores_cedula);

    $this->objeto_ecam->agregarMaterias();
    
    $array_materias = $this->objeto_ecam->listarMaterias();


    //guardando en un array los nombres de las materias y el nivel
    foreach($array_materias as $materia){
      $array_materias_comprobar[]= $materia['nombre'];

    }
    //Asert  
    
    $this->assertcontains($nombre_materia,$array_materias_comprobar);
 

    return $array_materias;
  }

  
}

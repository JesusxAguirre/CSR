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
    foreach ($array_profesores as $profsor) {
      $profesores_cedula[] = $profsor['cedula'];
    }
    $nombre_materia = "Programacion 1";
    $nivel = 1;

    $response = $this->objeto_ecam->validar_materia($nombre_materia, $nivel);
    $this->assertEquals(0, $response, $message = "Esta materia ya existe en la base de datos por favor cambie el dato a ingresar");
    //Act  
    $this->objeto_ecam->setMaterias($nombre_materia, $nivel, $profesores_cedula);

    $this->objeto_ecam->agregarMaterias();

    $array_materias = $this->objeto_ecam->listarMaterias();


    //guardando en un array los nombres de las materias y el nivel
    foreach ($array_materias as $materia) {
      $array_materias_comprobar[] = $materia['nombre'];
    }
    //Asert  

    $this->assertcontains($nombre_materia, $array_materias_comprobar);

    return $array_materias;
  }

  /**
   * @depends test_agregarMaterias 
   * **/
  public function test_desvincularProfesor(array $array_materias)
  {
    //Init
    //obteniendo cedulas de profesores
    $array_profesores = $this->objeto_ecam->listarProfesores();
    foreach ($array_profesores as $profsor) {
      $profesores_cedula[] = $profsor['cedula'];
    }
    $nombre_materia = "Programacion 1";
    //obteniendo id de materia ingresada anteriormente
    foreach ($array_materias as $materia) {
      if ($nombre_materia == $materia['nombre']) {
        $id_materia = $materia['id_materia'];
      }
    }


    //Act

    $this->objeto_ecam->desvincularProfesor($profesores_cedula[0],$id_materia);

    $array_profesores_materia = $this->objeto_ecam->listarProfesoresMateria($id_materia);


    foreach($array_profesores_materia as $profesor){
      $cedulas_profesores_materias = $profesor['cedula'];
    }

    $this->assertNotContains($profesores_cedula[0],$cedulas_profesores_materias);

    $profesor_a_vincular['cedula'] = $profesores_cedula[0];
    $profesor_a_vincular['id_materia'] = $id_materia;

    return $profesor_a_vincular;
  }

  /**
   * @depends test_desvincularProfesor 
   * **/
  public function test_vincularProfesor(array $profesor_a_vincular)
  {
    //Init
    

    //Asert

    $this->objeto_ecam->vincularProfesor($profesor_a_vincular['cedula'],$profesor_a_vincular['id_materia']);

    $array_profesores_materia = $this->objeto_ecam->listarProfesoresMateria($profesor_a_vincular['id_materia']);

    foreach($array_profesores_materia as $profesor){
      $cedulas_profesores_materias = $profesor['cedula'];
    }
    
    $this->assertContains($profesor_a_vincular['cedula'],$cedulas_profesores_materias);
  }


}

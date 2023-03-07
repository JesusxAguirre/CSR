<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;
use Csr\Modelo\Usuarios;


final class MateriasTest extends TestCase
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



  public function test_agregarMaterias(): array
  {
    //Init
    /*$array_profesores = $this->objeto_ecam->listarProfesores();
    foreach ($array_profesores as $profesor) {
      $profesores_cedula[] = $profesor['cedula'];
    }*/
    $profesores_cedula = [];
    $nombre_materia = "Programacion 1";
    $nivel = 1;

    $response = $this->objeto_ecam->validar_materia($nombre_materia, $nivel);
    $this->assertEquals(0, $response, $message = "Esta materia ya existe en la base de datos por favor cambie el dato a ingresar");
    //Act  
    $this->objeto_ecam->setMaterias($nombre_materia, $nivel, $profesores_cedula);

    $this->objeto_ecam->agregarMaterias();

    $array_materias = $this->objeto_ecam->listarMaterias();


    //guardando en un array los nombres de las materias 
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
  public function test_vincularProfesor($materia)
  {
    //Init
    $cedulas_a_vincular = [];
    $array_profesores = $this->objeto_ecam->listarProfesores();
    foreach ($array_profesores as $profesor) {
      $cedulas_a_vincular[] = $profesor['cedula'];
    }

   
    //Act
    $this->objeto_ecam->vincularProfesor($cedulas_a_vincular, $materia[0]['id_materia']);

    //obteniendo profesores que dan la materia
    $array_profesores_materia = $this->objeto_ecam->listarProfesoresMateria($materia[0]['id_materia']);

    //guardando solamente las cedulas en otro array para comprobar que exista la cedula del profesor
    foreach ($array_profesores_materia as $profesor) {
      $cedulas_profesores_materias[] = $profesor['cedula_profesor'];
    }
     //Asert
    $this->assertContains($cedulas_a_vincular[0], $cedulas_profesores_materias);

    return $materia[0]['id_materia'];
  }

  /**
   * @depends test_vincularProfesor
   * **/
  public function test_actualizarMateria(int $materia){
    //Init
    $nombre_materia_antiguo ="Programacion 1";
    $nombre_materia = "Programacion Nueva";
    $nivel = 1;

    
    //Act
    $response = $this->objeto_ecam->validar_materia($nombre_materia, $nivel);
    $this->assertEquals(0, $response, $message = "Esta materia ya existe en la base de datos por favor cambie el dato a ingresar");

    $this->objeto_ecam->setActualizar($materia,$nombre_materia,$nivel);

    $this->objeto_ecam->actualizarMateria();

    
    $array_materias = $this->objeto_ecam->listarMaterias();


    //guardando en un array los nombres de las materias
    foreach ($array_materias as $materia) {
      $array_materias_comprobar[] = $materia['nombre'];
    }
    //Asert  

    $this->assertcontains($nombre_materia, $array_materias_comprobar);
  }
}

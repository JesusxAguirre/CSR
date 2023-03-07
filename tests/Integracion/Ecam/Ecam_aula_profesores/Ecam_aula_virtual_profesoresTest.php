<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Ecam;
use Csr\Modelo\Usuarios;


final class Ecam_aula_virtual_profesoresTest extends TestCase
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

  /**
   * @depends test_listar_misMateriasProf
   */
  public function test_agregarContenidos(array $datos_profesor): array
  {
    //Init
    $contenido = "Esta materia trata sobre logica de programacion comenzaremos en breve viendo pseudo codigo";


    //Act  
    $response = $this->objeto_ecam->agregarContenidos($datos_profesor['id_seccion'], $datos_profesor['id_materia'], $contenido);

    //Asert

    $this->assertEquals(true, $response);

    return $datos_profesor;
  }

  /**
   * @depends test_agregarContenidos
   */
  public function test_listarContenido(array $datos_profesor): array
  {
    //Init
    $key_expected = "contenido";

    //Act  
    $array_contenido = $this->objeto_ecam->listarContenido($datos_profesor['id_seccion'], $datos_profesor['id_materia']);

    //Asert

    $this->assertArrayHasKey($key_expected, $array_contenido[0]);

    return $datos_profesor;
  }


  public function test_listar_misEstudiantes()
  {
    //Init
    $key_expected = "cedula";
    //Act
    $array_estudiantes = $this->objeto_ecam->listar_misEstudiantes();
    //Asert

    $this->assertArrayHasKey($key_expected, $array_estudiantes[0]);

    return $array_estudiantes[0];
  }

  /**
   * @depends test_listar_misEstudiantes
   */
  public function test_agregarNotaMateria(array $array_estudiante) //: array
  {
    //Init
    $nota = 16;

    //Act  
    $this->objeto_ecam->setNotaMateriaEstudiante($array_estudiante['id_seccion'], $array_estudiante['id_materia'], $array_estudiante['cedula']);
    $response = $this->objeto_ecam->agregarNotaMateria($nota);
    //Asert
    $this->assertTrue($response);

    return $array_estudiante;
  }
  /**
   * @depends test_agregarNotaMateria
   */
  public function test_listarNota_miEstudiante(array $array_estudiante): array
  {
    //Init

    $key_expected = "nota";
    //Act  

    $array_estudiante = $this->objeto_ecam->listarNota_miEstudiante($array_estudiante['id_materia'], $array_estudiante['id_seccion'], $array_estudiante['cedula']);
    //Asert
    

    $this->assertArrayHasKey($key_expected, $array_estudiante[0]);

    return $array_estudiante;
  }

  /**
   * @depends test_agregarNotaMateria
   */
  public function test_actualizarNotaMateria(array $array_estudiante)
  {
    //Init
    $nota = 14;

    //Act  

    $this->objeto_ecam->setActualizarMateriaEstudiante($array_estudiante['id_seccion'], $array_estudiante['id_materia'], $array_estudiante['cedula']);


    $this->objeto_ecam->actualizarNotaMateria($nota);

    $response = $this->objeto_ecam->listarNota_miEstudiante($array_estudiante['id_materia'], $array_estudiante['id_seccion'], $array_estudiante['cedula']);
    //Asert

    $this->assertEquals($nota, $response[0]['nota']);

  }
}

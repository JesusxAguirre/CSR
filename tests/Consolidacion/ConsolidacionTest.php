<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Consolidacion;


final class ConsolidacionTest extends TestCase
{
  private $objeto_consolidacion;

  public function setUp(): void
  {
    $this->objeto_consolidacion   = new Consolidacion();
    $_SESSION['cedula'] = 27666555;
  }
  /** @test **/
  public function test_listar_usuarios_N2(): array
  {
    //Init
    $key_expected = "cedula";
    //Act
    $array_usuarios_n2_3 = $this->objeto_consolidacion->listar_usuarios_N2();

    //Assert

    $this->assertArrayHasKey($key_expected, $array_usuarios_n2_3[0]);



    return $array_usuarios_n2_3;
  }
  /** @test **/
  public function test_listar_no_participantes(): array
  {
    //Init
    $key_expected = "cedula";
    //Act
    $array_usuarios_a_consolidar = $this->objeto_consolidacion->listar_no_participantes();

    //Assert



    $this->assertArrayHasKey($key_expected, $array_usuarios_a_consolidar[0]);

    return $array_usuarios_a_consolidar;
  }


  /**
   * @depends test_listar_no_participantes
   * @depends test_listar_usuarios_N2
   * **/
  public function test_registrar_consolidacion($array_usuarios_a_consolidar, $array_usuarios_n2_3): array
  {

    $dia_reunion = "Jueves";
    $hora = date("h:i:s");
    $direccion_celula = "Villa crepuscular";

    foreach ($array_usuarios_n2_3 as $usuarios) {
      $cedulas_n2[] = $usuarios['cedula'];
    }
    foreach ($array_usuarios_a_consolidar as $usuarios) {
      $cedulas_usuarios_a_consolidar[] = $usuarios['cedula'];
    }
    //Act

    $this->objeto_consolidacion->setConsolidacion(
      $cedulas_n2[0],
      $cedulas_n2[1],
      $cedulas_n2[2],
      $dia_reunion,
      $hora,
      $direccion_celula,
      [$cedulas_usuarios_a_consolidar[0]]
    );

    $this->objeto_consolidacion->registrar_consolidacion();

    $array_celulas_consolidacion = $this->objeto_consolidacion->listar_celula_consolidacion();
    //Assert

    foreach ($array_celulas_consolidacion as $celulas_consolidacion) {
      if ($cedulas_n2[0] == $celulas_consolidacion['cedula_lider']) {
        $celula_consolidacion_nueva = $celulas_consolidacion;
      }
    }


    //aqui tambien se testea la funcion listar celulas de consolidacion
    $this->assertArrayHasKey("id", $array_celulas_consolidacion[0]);
    $this->assertContains($cedulas_n2[0], $celula_consolidacion_nueva);


    return $celula_consolidacion_nueva;
  }


  /**
   * @depends test_registrar_consolidacion
   * **/
  public function test_update_consolidacion($celula_consolidacion_nueva)
  {
    //Init
    $dia_reunion = "Domingos";
    $hora = date("h:i:s");
    $direccion_celula = "Villa roca";
    $array_usuarios_n2_n3 = $this->objeto_consolidacion->listar_usuarios_N2();
    $array_usuarios_a_consolidar = $this->objeto_consolidacion->listar_no_participantes();

    foreach ($array_usuarios_n2_n3 as $usuarios) {
      $cedulas_n2[] = $usuarios['cedula'];
    }
    foreach ($array_usuarios_a_consolidar as $usuarios) {
      $cedulas_a_consolidar[] = $usuarios['cedula'];
    }

    //Act

    $this->objeto_consolidacion->setActualizar(
      $celula_consolidacion_nueva['cedula_lider'],
      $celula_consolidacion_nueva['cedula_anfitrion'],
      $celula_consolidacion_nueva['cedula_asistente'],
      $dia_reunion,
      $hora,
      $direccion_celula,
      $celula_consolidacion_nueva['id']
    );

    $this->objeto_consolidacion->update_consolidacion();

    $celulas_cosolidacion = $this->objeto_consolidacion->listar_celula_consolidacion();


    foreach ($celulas_cosolidacion as $celulas) {
      if ($celula_consolidacion_nueva['id'] == $celulas['id']) {
        $celula_consolidacion_nueva = $celulas;
      }
    }
    //Assert


    $this->assertEquals(
      [$dia_reunion, $hora, $direccion_celula],
      [$celula_consolidacion_nueva['dia_reunion'], $celula_consolidacion_nueva['hora'], $celula_consolidacion_nueva['direccion']]
    );
  }

  /**
   * @depends test_registrar_consolidacion
   * **/
  public function test_agregar_participantes($celula_consolidacion_nueva)
  {
    //Init
    $no_participantes = $this->objeto_consolidacion->listar_no_participantes();
    foreach ($no_participantes as $no_participante) {
      $cedulas_no_participantes = $no_participante['cedula'];
    }
    

    //Act
    $this->objeto_consolidacion->setParticipantes($cedulas_no_participantes[0], $celula_consolidacion_nueva['id']);
    $this->objeto_consolidacion->agregar_participantes();

    $participantes = $this->objeto_consolidacion->listar_participantes($celula_consolidacion_nueva['id']);


    foreach ($participantes as $participante) {
      $cedulas_participantes = $participante['participantes_celula'];
    }

    //Assert

    //aqui tambien se testea la funcion listar participantes
    $this->assertArrayHasKey("participantes_celula", $participantes[0]);

    $this->assertContains($cedulas_no_participantes[0], $cedulas_participantes);


    $celula_consolidacion_nueva['cedulas_participantes'] = $cedulas_no_participantes;

    return $celula_consolidacion_nueva;
  }

    /**
   * @depends test_agregar_participantes
   * **/
  public function test_agregar_asistencias(array $celula_consolidacion_nueva) 
  {
    //Init
    $fecha_actual = date("d-m-Y");
    //Act
    $this->objeto_consolidacion->setAsistencias($celula_consolidacion_nueva['cedulas_participantes'],
    $celula_consolidacion_nueva['id'],$fecha_actual);
    
    $this->objeto_consolidacion->registrar_asistencias();
    //Assert


  }
}

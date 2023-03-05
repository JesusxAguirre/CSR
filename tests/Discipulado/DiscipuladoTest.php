<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Discipulado;


final class DiscipuladoTest extends TestCase
{
  private $objeto_discipulado;

  public function setUp(): void
  {
    $this->objeto_discipulado   = new Discipulado();
    $_SESSION['cedula'] = 27666555;
  }
  /** @test **/
  public function test_listar_usuarios_N2(): array
  {
    //Init
    $key_expected = "cedula";
    //Act
    $array_usuarios_n2_3 = $this->objeto_discipulado->listar_usuarios_N2();

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
    $array_usuarios_a_discipular = $this->objeto_discipulado->listar_no_participantes();

    //Assert



    $this->assertArrayHasKey($key_expected, $array_usuarios_a_discipular[0]);

    return $array_usuarios_a_discipular;
  }


  /**
   * @depends test_listar_no_participantes
   * @depends test_listar_usuarios_N2
   * **/
  public function test_registrar_discipulado($array_usuarios_a_discipular, $array_usuarios_n2_3): array
  {

    $dia_reunion = "Jueves";
    $hora = date("h:i:s");
    $direccion_celula = "Villa crepuscular";

    foreach ($array_usuarios_n2_3 as $usuarios) {
      $cedulas_n2[] = $usuarios['cedula'];
    }
    foreach ($array_usuarios_a_discipular as $usuarios) {
      $cedulas_usuarios_a_discipular[] = $usuarios['cedula'];
    }
    //Act

    $this->objeto_discipulado->setDiscipulado(
      $cedulas_n2[0],
      $cedulas_n2[1],
      $cedulas_n2[2],
      $dia_reunion,
      $hora,
      $direccion_celula,
      [$cedulas_usuarios_a_discipular[0]]
    );

    $this->objeto_discipulado->registrar_discipulado();
    
    $array_celulas_discipulacion = $this->objeto_discipulado->listar_celula_discipulado();
    //Assert

    foreach ($array_celulas_discipulacion as $celulas_discipulacion) {
      if ($cedulas_n2[0] == $celulas_discipulacion['cedula_lider']) {
        $celula_discipulacion_nueva = $celulas_discipulacion;
      }
    }


    //aqui tambien se testea la funcion listar celulas de discipulacion
    $this->assertArrayHasKey("id", $array_celulas_discipulacion[0]);
    $this->assertContains($cedulas_n2[0], $celula_discipulacion_nueva);


    return $celula_discipulacion_nueva;
  }


  /**
   * @depends test_registrar_discipulacion
   * **/
  public function test_update_discipulacion($celula_discipulacion_nueva)
  {
    //Init
    $dia_reunion = "Domingos";
    $hora = date("h:i:s");
    $direccion_celula = "Villa roca";
    $array_usuarios_n2_n3 = $this->objeto_discipulado->listar_usuarios_N2();
    $array_usuarios_a_discipular = $this->objeto_discipulado->listar_no_participantes();
    
    foreach ($array_usuarios_n2_n3 as $usuarios) {
      $cedulas_n2[] = $usuarios['cedula'];
    }
    foreach ($array_usuarios_a_discipular as $usuarios) {
      $cedulas_a_discipular[] = $usuarios['cedula'];
    }

    //Act

    $this->objeto_discipulado->setActualizar(
      $celula_discipulacion_nueva['cedula_lider'],
      $celula_discipulacion_nueva['cedula_anfitrion'],
      $celula_discipulacion_nueva['cedula_asistente'],
      $dia_reunion,
      $hora,
      $direccion_celula,
      $celula_discipulacion_nueva['id']
    );

    $this->objeto_discipulado->actualizar_discipulado();

    $celulas_discipulado = $this->objeto_discipulado->listar_celula_discipulado();


    foreach ($celulas_discipulado as $celulas) {
      if ($celula_discipulacion_nueva['id'] == $celulas['id']) {
        $celula_discipulacion_nueva = $celulas;
      }
    }
    //Assert


    $this->assertEquals(
      [$dia_reunion, $hora, $direccion_celula],
      [$celula_discipulacion_nueva['dia_reunion'], $celula_discipulacion_nueva['hora'], $celula_discipulacion_nueva['direccion']]
    );
  }

  /**
   * @depends test_registrar_discipulacion
   * **/
  public function test_agregar_participantes($celula_discipulacion_nueva)
  {
    //Init
    $no_participantes = $this->objeto_discipulado->listar_no_participantes();
    foreach ($no_participantes as $no_participante) {
      $cedulas_no_participantes[] = $no_participante['cedula'];
    }


    //Act
    $this->objeto_discipulado->setParticipantes([$cedulas_no_participantes[0]], $celula_discipulacion_nueva['id']);
    $this->objeto_discipulado->agregar_participantes();

    $participantes = $this->objeto_discipulado->listar_participantes($celula_discipulacion_nueva['id']);



    foreach ($participantes as $participante) {
      $cedulas_participantes[] = $participante['participantes_cedula'];
    }

    //Assert

    //aqui tambien se testea la funcion listar participantes
    $this->assertArrayHasKey("participantes_cedula", $participantes[0]);

    $this->assertContains($cedulas_no_participantes[0], $cedulas_participantes);


    $celula_discipulacion_nueva['cedulas_participantes'] = $cedulas_no_participantes;

    return $celula_discipulacion_nueva;
  }

  /**
   * @depends test_agregar_participantes
   * **/
  public function test_agregar_asistencias(array $celula_discipulacion_nueva)
  {
    //Init
    $fecha_actual = date("Y-m-d");
    //Act
    $this->objeto_discipulado->setAsistencias(
      $celula_discipulacion_nueva['cedulas_participantes'],
      $celula_discipulacion_nueva['id'],
      $fecha_actual
    );

    $this->objeto_discipulado->registrar_asistencias();

    $asistencias_participantes = $this->objeto_discipulado->listar_asistencias(
      $celula_discipulacion_nueva['id'],
      $fecha_actual,
      $fecha_actual
    );


    //Assert

    $this->assertArrayHasKey("id_discipulacion", $asistencias_participantes[0]);


    return $celula_discipulacion_nueva;
  }

  /**
   * @depends test_agregar_asistencias
   * **/
  public function test_eliminar_participantes(array $celula_discipulacion_nueva)
  {
    //Init

    $cedula_participante = $celula_discipulacion_nueva['cedulas_participantes'][0];

    //Act
    $this->objeto_discipulado->eliminar_participantes($cedula_participante);
    $participantes = $this->objeto_discipulado->listar_participantes($celula_discipulacion_nueva['id']);

    foreach ($participantes as $participante) {
      $cedulas_participantes[] = $participante['participantes_cedula'];
    }
    //Assert

    $this->assertContains($cedula_participante, $cedulas_participantes);
  }
}

<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Consolidacion;


final class UsuariosTest extends TestCase
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
    $array_usuarios_n2_3 =$this->objeto_consolidacion->listar_usuarios_N2();

    //Assert
 
    $this->assertArrayHasKey($key_expected,$array_usuarios_n2_3[0]);

  

    return $array_usuarios_n2_3;
  }
  /** @test **/
  public function test_listar_no_participantes(): array
  {
    //Init
    $key_expected = "cedula";
    //Act
    $array_usuarios_a_consolidar =$this->objeto_consolidacion->listar_no_participantes();

    //Assert

    
    $this->assertArrayHasKey($key_expected,$array_usuarios_a_consolidar[0]);

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

    foreach($array_usuarios_n2_3 as $usuarios){
      $cedulas_n2[] = $usuarios['cedula'];
    }
    foreach($array_usuarios_a_consolidar as $usuarios){
      $cedulas_usuarios_a_consolidar[] = $usuarios['cedula'];
    }
    //Act
   
    $this->objeto_consolidacion->setConsolidacion($cedulas_n2[0],$cedulas_n2[1],
    $cedulas_n2[2],$dia_reunion,$hora,$direccion_celula,[$cedulas_usuarios_a_consolidar[0]]);

    $this->objeto_consolidacion->registrar_consolidacion();

    $array_celulas_consolidacion = $this->objeto_consolidacion->listar_celula_consolidacion();
    //Assert
    print_r($array_celulas_consolidacion);
    foreach($array_celulas_consolidacion as $celulas_consolidacion){
      if($cedulas_n2[0] == $celulas_consolidacion['cedula_lider']){
        $celula_consolidacion_nueva = $celulas_consolidacion;
      }
    }


    $this->assertArrayHasKey("id",$array_celulas_consolidacion[0]);
    $this->assertContains($cedulas_n2[0],$celula_consolidacion_nueva);


    return $celula_consolidacion_nueva;
  }


    /**
   * @depends test_registrar_consolidacion
   * **/
  public function test_update_consolidacion($celula_consolidacion_nueva){
    //Init
    $dia_reunion = "Domingos";
    $hora = date("h:i:s");
    $direccion_celula = "Villa roca";
    $array_usuarios_n2_n3 = $this->objeto_consolidacion->listar_usuarios_N2();
    $array_usuarios_a_consolidar = $this->objeto_consolidacion->listar_no_participantes();

    foreach($array_usuarios_n2_n3 as $usuarios){
      $cedulas_n2[] = $usuarios['cedula'];
    }
    foreach($array_usuarios_a_consolidar as $usuarios){
      $cedulas_a_consolidar[] = $usuarios['cedula'];
    }
  }
 

}

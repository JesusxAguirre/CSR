<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;


final class UsuariosTest extends TestCase
{
  private $objeto_usuarios;

  public function setUp(): void
  {
    $this->objeto_usuarios   = new Usuarios();
  }
  
  /** @test **/
  public function test_editar_usuarios()
  {
    //Init
    $nombre = "Maria";
    $apellido = "Marcano";
    $cedula = "22357445";
    $edad = '2000-01-01';
    $sexo = "Mujer";
    $civil = "Soltera";
    $nacionalidad = "Venezolana";
    $estado = "Css";
    $telefono = "04122654321";
    $rol = 1;

    $array_usuario = $this->objeto_usuarios->listar();

    $expected = ["nombre"=>$nombre,"apellido"=>$apellido,"cedula"=>$cedula,"fecha_nacimiento"=>$edad,"sexo"=>$sexo,"estado_civil"=>$civil,"nacionalidad"=>$nacionalidad,
    "estado"=>$estado,"telefono"=>$telefono,"id_rol"=>$rol];
    //Act  
    $this->objeto_usuarios->setUpdate($nombre, $apellido, $cedula, $array_usuario[0]['cedula'], $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $rol);

    $this->objeto_usuarios->update_usuarios();
    $array_usuario =$this->objeto_usuarios->get_usuario_sin_rol($cedula);
    
    //Asert 
    
    $this->assertEquals($expected,$array_usuario);
  }
}

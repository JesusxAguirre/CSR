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
  public function test_registrar_usuario()
  {
    //Init
    $nombre = "Mario";
    $apellido = "Cercano";
    $cedula = "27543321";
    $edad =40;
    $sexo = "hombre";
    $civil = "soltero";
    $nacionalidad = "Venezolana";
    $estado = "Bolivar";
    $telefono = "04122654321";
    $correo = "mariocercano@gmail.com";
    $clave = "88381918";

    $expected = true;
    //Act  
    $this->objeto_usuarios->setUsuarios($nombre, $apellido, $cedula, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo, $clave);
    $response = $this->objeto_usuarios->registrar_usuarios();

    //Asert
    $this->assertEquals($expected, $response);
  }
  
  /** @test **/
  public function test_editar_usuario()
  {
    //Init
    $nombre = "Mario";
    $apellido = "Cercano";
    $cedula = "22333443";
    $edad =40;
    $sexo = "hombre";
    $civil = "soltero";
    $nacionalidad = "Venezolana";
    $estado = "Yaracuy";
    $telefono = "04122654321";
    $cedula_antigua ="27543321";
    $rol = 1;

    $expected = true;
    //Act  
    $this->objeto_usuarios->setUpdate($nombre,$apellido,$cedula,$cedula_antigua,$edad,$sexo,$civil,$nacionalidad,$estado,$telefono,$rol);    

    $response = $this->objeto_usuarios->update_usuarios();

    //Asert
    $this->assertEquals($expected, $response);
  }
}

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
  public function test_registrar_usuario(): array
  {
    //Init
    $_SESSION['cedula'] = "27666555";
    $usuario = $_SESSION['cedula'];
    $nombre = "Mario";
    $apellido = "Cercano";
    $cedula = "27543321";
    $edad = 40;
    $sexo = "hombre";
    $civil = "soltero";
    $nacionalidad = "Venezolana";
    $estado = "Bolivar";
    $telefono = "04122654321";
    $correo = "casasobrelaroca@gmail.com";
    $clave = "12345678";

    $expected = true;
    //Act  
    $this->objeto_usuarios->setUsuarios($nombre, $apellido, $cedula, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo, $clave);
    $this->objeto_usuarios->registrar_usuarios();

    $array_usuario = $this->objeto_usuarios->get_usuario_sin_rol($cedula);
    //Asert

    $this->assertEquals($cedula, $array_usuario['cedula']);

    return $array_usuario;
  }

  /**
   * @depends test_registrar_usuario
   */
  public function test_editar_usuario(array $array_usuario): array
  {
    //Init
    $nombre = "Maria";
    $apellido = "Marcano";
    $cedula = "22357445";
    $edad = 24;
    $sexo = "Mujer";
    $civil = "soltera";
    $nacionalidad = "Venezolana";
    $estado = "Distrito capital";
    $telefono = "04122654321";
    
    $rol = 1;

    $expected = ["nombre"=>$nombre,"apellido"=>$apellido,"cedula"=>$cedula,"edad"=>"24","sexo"=>$sexo,"estado_civil"=>$civil,"nacionalidad"=>$nacionalidad,
    "estado"=>$estado,"telefono"=>$telefono,"id_rol"=>"1"];
    //Act  
    $this->objeto_usuarios->setUpdate($nombre, $apellido, $cedula, $array_usuario['cedula'], $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $rol);

    $this->objeto_usuarios->update_usuarios();
    $array_usuario =$this->objeto_usuarios->get_usuario_sin_rol($cedula);

    
      //Asert 
    
    $this->assertEquals($expected,$array_usuario);

    return $array_usuario;
  }

 
}

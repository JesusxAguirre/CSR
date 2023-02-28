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
    $correo = "mariocercano@gmail.com";
    $clave = "88381918";

    $expected = true;
    //Act  
    $this->objeto_usuarios->setUsuarios($nombre, $apellido, $cedula, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo, $clave);
    $this->objeto_usuarios->registrar_usuarios();

    $array_usuario = $this->objeto_usuarios->get_usuario($cedula);
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
    $estado = "Distrito Capital";
    $telefono = "04122654321";
 
    $rol = 1;

    $expected = true;
    //Act  
    $this->objeto_usuarios->setUpdate($nombre, $apellido, $cedula, $array_usuario['cedula'], $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $rol);

    $this->objeto_usuarios->update_usuarios();
    $array_usuario =$this->objeto_usuarios->get_usuario($cedula);
      //Asert 
    $this->assertEqualsCanonicalizing(
      [$nombre,$apellido,$cedula,$edad,$sexo,$civil,$nacionalidad,$estado,$telefono,$rol],
      [$array_usuario['nombre'],$array_usuario['apellido'],$array_usuario['cedula'],$array_usuario['edad'],$array_usuario['estado_civl'],$array_usuario['nacionalidad'],$array_usuario['estado'],$array_usuario['telefono'],$array_usuario['id_rol']]
    );

    return $array_usuario;
  }

   /**
   * @depends test_editar_usuario
   */
  public function test_eliminar_usuario(array $array_usuario )
  {
    //Init
    $expected = true;
    //Act
    $this->objeto_usuarios->setEliminar($array_usuario['cedula']);
    $response = $this->objeto_usuarios->delete_usuarios();
    //Asert

    $this->assertEquals($expected, $response);
  }
}

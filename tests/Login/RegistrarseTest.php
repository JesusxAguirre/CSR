<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;


final class RegistrarseTest extends TestCase
{
  private $objeto_usuario;

  public function setUp(): void
  {
    $this->objeto_usuario   = new Usuarios();
  }
  /** @test **/
  public function test_registrar_usuario(): void
  {
    //Init
    $nombre = "Mario";
    $apellido = "Castaneda";
    $cedula = "17098431";
    $edad = "1981-12-12";
    $sexo = "hombre";
    $civil = "soltero";
    $nacionalidad = "venezolana";
    $estado = "bolivar";
    $telefono = "0414789321";
    $correo = "mariocastaneda@gmail.com";
    $clave = "Hola!000";

    $expected = true;

    //Act  
    $this->objeto_usuario->security_validation_inyeccion_sql([$nombre, $apellido, $cedula, $sexo, $civil, $nacionalidad, $telefono, $clave]);

	$this->objeto_usuario->security_validation_caracteres([$nombre, $apellido]);

	$this->objeto_usuario->security_validation_cedula($cedula);

	$this->objeto_usuario->security_validation_fecha_nacimiento($edad);

	$this->objeto_usuario->security_validation_sexo($sexo);

	$this->objeto_usuario->security_validation_estado_civil($civil);

	$this->objeto_usuario->security_validation_nacionalidad($nacionalidad);

	$this->objeto_usuario->security_validation_estado($estado);

	$this->objeto_usuario->security_validation_correo($correo);

	$this->objeto_usuario->security_validation_clave($clave);

	$nombre = $this->objeto_usuario->sanitizar_cadenas($nombre);
	$apellido = $this->objeto_usuario->sanitizar_cadenas($apellido);
	$nacionalidad = $this->objeto_usuario->sanitizar_cadenas($nacionalidad);
	$estado = $this->objeto_usuario->sanitizar_cadenas($estado);

	$this->objeto_usuario->setUsuarios($nombre, $apellido, $cedula, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo, $clave);

	$this->objeto_usuario->registrar_usuarios();

    $array_usuario = $this->objeto_usuario->get_usuario_sin_rol($cedula);
    //Asert

    $this->assertEquals($cedula, $array_usuario['cedula']);

  }
}

?>
<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;

final class EditarTest extends TestCase
{
  private $objeto;

  public function setUp(): void
  {
    $this->objeto = new Usuarios();
  }
  
  /** @test **/
  public function test_editar(): void
  {
    //Init
    $nombre = "Picoro";
    $apellido = "Daimacu";
    $cedula = "17098431";
    $cedula_antigua = "17098!_)*%431";
    $fecha_nacimiento = '1996-10-07';
    $sexo = "H(&^o  mbre";
    $estado_civil = "solHmm12tero";
    $nacionalidad = "venezolana";
    $estado = "laraB%$!nasss";
    $telefono = "numero918726&";
    $correo = 'mariocastaneda@gmail.com';

    //Act  

    $this->objeto->security_validation_inyeccion_sql([$nombre, $apellido, $cedula, $sexo, $estado_civil, $nacionalidad, $telefono]);
    $this->objeto->security_validation_caracteres([$nombre, $apellido]);
    $this->objeto->security_validation_cedula($cedula);
    $this->objeto->security_validation_fecha_nacimiento($fecha_nacimiento);
    $this->objeto->security_validation_sexo($sexo);
    $this->objeto->security_validation_estado_civil($estado_civil);
    $this->objeto->security_validation_nacionalidad($nacionalidad);
    $this->objeto->security_validation_estado($estado);
    $this->objeto->security_validation_correo($correo);

    $nombre = $this->objeto->sanitizar_cadenas($nombre);
    $apellido = $this->objeto->sanitizar_cadenas($apellido);

    $this->objeto->setUpdate_sin_rol($nombre, $apellido, $cedula, $cedula_antigua, $fecha_nacimiento, $sexo, $estado_civil, $nacionalidad, $estado, $telefono, $correo);
    $response = $this->objeto->update_usuarios_sin_rol();

    //Asert

    $this->assertTrue($response);

  }
}
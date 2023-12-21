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
    $nombre = "Jose";
    $apellido = "Picolo";
    $cedula = "170!-98431";
    $cedula_antigua = "";
    $fecha_nacimiento = '1996-11-07';
    $sexo = "homb)(&^re";
    $estado_civil = "solter  2o";
    $nacionalidad = "vene@#*olana";
    $estado = "barinas";
    $telefono = "04122654321";
    $rol = 1;

    //Act  

    $this->objeto->security_validation_inyeccion_sql([$nombre, $apellido, $cedula, $sexo, $estado_civil, $nacionalidad, $telefono]);
    $this->objeto->security_validation_caracteres([$nombre, $apellido]);
    $this->objeto->security_validation_cedula($cedula);
    $this->objeto->security_validation_cedula($cedula_antigua);
    $this->objeto->security_validation_fecha_nacimiento($fecha_nacimiento);
    $this->objeto->security_validation_sexo($sexo);
    $this->objeto->security_validation_estado_civil($estado_civil);
    $this->objeto->security_validation_nacionalidad($nacionalidad);
    $this->objeto->security_validation_estado($estado);

    $nombre = $this->objeto->sanitizar_cadenas($nombre);
    $apellido = $this->objeto->sanitizar_cadenas($apellido);

    $this->objeto->setUpdate($nombre, $apellido, $cedula, $cedula_antigua, $fecha_nacimiento, $sexo, $estado_civil, $nacionalidad, $estado, $telefono, $rol);
    $response = $this->objeto->update_usuarios();

    //Asert

    $this->assertTrue($response);

  }
}
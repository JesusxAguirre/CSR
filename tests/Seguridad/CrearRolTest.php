<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Roles;

final class CrearRolTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new Roles();
    }

    /** @test **/
    public function test_crear(): void
    {
        //Init
        $nombreRol = 'Example';
        $descripcionRol = 'Esto es un rol de test';
        $response = false;
        $expected = 0;
        //Act

        $this->objeto->security_validation_caracteres([str_replace(' ', '', $nombreRol), str_replace(' ', '', $descripcionRol)]);
        $this->objeto->security_validation_inyeccion_sql([str_replace(' ', '', $nombreRol), str_replace(' ', '', $descripcionRol)]);
        $validacion = $this->objeto->validar_crear_rol($nombreRol);

        if ($validacion > 0) {
            echo json_encode(array('status' => 'false', 'msj' => 'El rol ingresado ya existe'));
        } else {
            $this->objeto->setDatos($nombreRol, $descripcionRol);
            $response = $this->objeto->create_rol();
        }
        
        //Assert

        $this->assertEquals($expected, $validacion);
        $this->assertTrue($response);

        
    }
}
?>
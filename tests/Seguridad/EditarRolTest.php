<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Roles;


final class EditarRolTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new Roles();
    }

    /** @test **/
    public function test_editar(): void
    {
        //Init
        $expected = 0;
        $idRol = 40;
        $nombreRol = 'Example23+_ *&^';
        $descripcionRol = 'Esto es un rol de test';

        //Act

        $this->objeto->security_validation_caracteres([$nombreRol, $descripcionRol]);
        $this->objeto->security_validation_inyeccion_sql([$nombreRol]);
        $validacion = $this->objeto->validar_crear_rol($nombreRol);
        $this->objeto->setUpdatedRol($nombreRol, $descripcionRol);
        $response = $this->objeto->update_rol($idRol);


        //Assert

        $this->assertEquals($expected, $validacion);
        $this->assertTrue($response);

        
    }
}
?>
<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Roles;


final class EditarRoles extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto   = new Roles();
    }

    /** @test **/
    public function test_editarRoles()
    {
        //Init
        $idRol = '22';
        $nombreRol = 'NewExample';
        $descripcionRol = 'Other new example';

        //Act  
        $validacion = $this->objeto->validar_crear_rol($nombreRol);
        if ($validacion > 0) {
            return;
        } else {
            $this->objeto->setDatos($nombreRol, $descripcionRol);
            $this->objeto->update_rol($idRol);
        }

        $expected = [
            "id" => $idRol, "nombre" => $nombreRol, "descripcion" => $descripcionRol
        ];
        $matriz = $this->objeto->get_roles();

        //Asert 
        $this->assertArrayHasKey('id', $matriz[5]); // verifica que el primer usuario tiene una clave 'id'
        $this->assertEquals($expected,$matriz[5]);
    }
}

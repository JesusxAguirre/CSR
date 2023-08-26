<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Roles;


final class ElimnarRoles extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto   = new Roles();
    }

    /** @test **/
    public function test_eliminarRoles()
    {
        //Init
        $id = '22';

        //Act  
        $validacion = $this->objeto->validar_eliminar_rol($id);
        if ($validacion > 0) {
            return false;
        }else{
            $mensaje = $this->objeto->delete_rol($id);
        }

        $matriz = $this->objeto->get_roles();

        //Asert 
        $this->assertIsArray($matriz); // verifica que $matriz_usuario es un array
        $this->assertNotEmpty($matriz); // verifica que $matriz_usuario no está vacío
        $this->assertArrayHasKey('id', $matriz[0]); // verifica que el primer usuario tiene una clave 'id'
        $this->assertNotContains($id, $matriz);
    }
}

<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Roles;


final class ListarRoles extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto   = new Roles();
    }

    /** @test **/
    public function test_listarRoles()
    {
        //Init
        $matriz = $this->objeto->get_roles();

        //Act  

        //Asert 
        $this->assertIsArray($matriz); // verifica que $matriz_usuario es un array
        $this->assertNotEmpty($matriz); // verifica que $matriz_usuario no está vacío
        $this->assertArrayHasKey('id', $matriz[0]); // verifica que el primer usuario tiene una clave 'id'
    }
}

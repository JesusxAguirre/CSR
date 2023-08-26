<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;


final class BitacoraTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto   = new Usuarios();
    }

    /** @test **/
    public function test_bitacora()
    {
        //Init
        $matriz_bitacora = $this->objeto->listar_bitacora();

        //Act  

        //Asert 
        $this->assertIsArray($matriz_bitacora); // verifica que $matriz_usuario es un array
        $this->assertNotEmpty($matriz_bitacora); // verifica que $matriz_usuario no está vacío
        $this->assertArrayHasKey('accion_realizada', $matriz_bitacora[0]); // verifica que el primer usuario tiene una clave 'accion_realizada'
    }
}

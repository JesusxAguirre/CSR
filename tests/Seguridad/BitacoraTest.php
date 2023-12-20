<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;


final class BitacoraTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new Usuarios();
    }

    /** @test **/
    public function test_bitacora(): void
    {
        //Init
        $expected = 0;


        //Act

        $listar_bitacora = $this->objeto->listar_bitacora();


        //Assert

        $this->assertNotEmpty($listar_bitacora);
        $this->assertGreaterThan($expected, $listar_bitacora);
    }
}
?>
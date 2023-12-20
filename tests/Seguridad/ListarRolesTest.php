<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Roles;


final class ListarRolesTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new Roles();
    }

    /** @test **/
    public function test_listar(): void
    {
        //Init
        $expected = 0;


        //Act

        $listar_roles = $this->objeto->get_roles();


        //Assert

        $this->assertNotEmpty($listar_roles);
        $this->assertGreaterThan($expected, $listar_roles);
    }
}
?>
<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Discipulado;


final class EliminarDiscipuloTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new Discipulado();
    }

    /** @test **/
    public function test_eliminar(): void
    {
        //Init

        $cedula_participante = '19482134';


        //Act
        $this->objeto->security_validation_codigo([$cedula_participante]);
        $response = $this->objeto->eliminar_participantes($cedula_participante);


        //Assert

        $this->assertTrue($response);
    }
}
?>
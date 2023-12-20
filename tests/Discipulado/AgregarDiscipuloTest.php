<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Discipulado;


final class AgregarDiscipuloTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new Discipulado();
    }

    /** @test **/
    public function test_agregar(): void
    {
        //Init

        $participantes = ['hey!', 'tron.0+1'];
        $id = 7;


        //Act

        $this->objeto->security_validation_inyeccion_sql([$id]);
        $this->objeto->security_validation_codigo($participantes);
        $this->objeto->setParticipantes($participantes, $id);

        $response = $this->objeto->agregar_participantes();


        //Assert

        $this->assertTrue($response);
    }
}
?>
<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Discipulado;


final class ReporteTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new Discipulado();
    }

    /** @test **/
    public function test_reporte(): void
    {
        //Init
        $id = 7;
        $fecha_inicio = '2023-12-01';
        $fecha_final = '2023-12-20';
        $expected = 0;


        //Act

        $this->objeto->security_validation_fecha($fecha_inicio);
        $this->objeto->security_validation_fecha($fecha_final);
        $matriz_asistencias = $this->objeto->listar_asistencias($id, $fecha_inicio, $fecha_final);


        //Assert

        $this->assertNotEmpty($matriz_asistencias);
        $this->assertGreaterThan($expected, $matriz_asistencias);
    }
}
?>
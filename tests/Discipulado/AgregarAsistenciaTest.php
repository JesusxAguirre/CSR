<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Discipulado;


final class AgregarAsistenciaTest extends TestCase
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

        $fecha = '2023-12-20';
        $asistentes = ['errorprueba', 2345698];
        $id = '7!.';


        //Act

        $this->objeto->security_validation_inyeccion_sql([$id]);
        $this->objeto->security_validation_fecha($fecha);
        $this->objeto->security_validation_codigo($asistentes);

        $this->objeto->setAsistencias($asistentes, $id, $fecha);

        $response = $this->objeto->registrar_asistencias();


        //Assert

        $this->assertTrue($response);
    }
}
?>
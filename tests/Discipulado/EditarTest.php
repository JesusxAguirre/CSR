<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Discipulado;


final class EditarTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new Discipulado();
    }

    /** @test **/
    public function test_editar(): void
    {
        //Init
        $cedula_lider = '27199177-N2-VE-LA-H-S-CD1-CSR17';
        $cedula_anfitrion = '1938492-N1-VE-LA-H-S-CD1';
        $cedula_asistente = '2345698-N1-VE-LA-H-S-CD1';
        $dia = 'Sabado';
        $hora = '05:10';
        $direccion = 'Cabudare';
        $id = 7;


        //Act
        $this->objeto->security_validation_inyeccion_sql([$id, $dia, str_replace(" ", "", $direccion)]);

        $this->objeto->security_validation_codigo([$cedula_lider, $cedula_anfitrion, $cedula_asistente]);

        $this->objeto->setActualizar($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion, $id);

        $response = $this->objeto->actualizar_discipulado();


        //Assert

        $this->assertTrue($response);
    }
}
?>
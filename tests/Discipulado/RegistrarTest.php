<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Discipulado;


final class RegistrarTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new Discipulado();
    }

    /** @test **/
    public function test_registrar(): void
    {
        //Init
        $cedula_lider = '27!+-199177-N2-VE-LA-H-S-CD1-CSR17';
        $cedula_anfitrion = '1938492-N1-VE-LA-H-S-CD1';
        $cedula_asistente = '*&^%2345698-N1-VE-LA-H-S-CD1!!';
        $dia = 'Domingo';
        $hora = '07:07ERrrorrr';
        $direccion = 'Quibor';
        $participantes = ['16634134-N2-VE-LA-M-M'];


        //Act

        //borrando del array participantes las coicidencias en los valores con las cedulas de lider, anfitrion y asistente
        if (($clave = array_search($cedula_lider, $participantes)) !== false) {
            unset($participantes[$clave]);
        }
        if (($clave = array_search($cedula_anfitrion, $participantes)) !== false) {
            unset($participantes[$clave]);
        }
        if (($clave = array_search($cedula_asistente, $participantes)) !== false) {
            unset($participantes[$clave]);
        }

        $this->objeto->security_validation_inyeccion_sql([$dia, str_replace(" ", "", $direccion)]);
        $this->objeto->security_validation_codigo($participantes);
        $this->objeto->security_validation_codigo([$cedula_lider, $cedula_anfitrion, $cedula_asistente]);

        $cedula_lider = explode('-', $cedula_lider)[0];
        $cedula_anfitrion = explode('-', $cedula_anfitrion)[0];
        $cedula_asistente = explode('-', $cedula_asistente)[0];

        $this->objeto->security_validation_cedula([$cedula_lider, $cedula_anfitrion, $cedula_asistente]);
        $this->objeto->security_validation_caracteres([$dia, $direccion]);
        $this->objeto->security_validation_hora($hora);

        $this->objeto->setDiscipulado($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion, $participantes);

        $response = $this->objeto->registrar_discipulado();


        //Assert

        $this->assertTrue($response);
    }
}
?>
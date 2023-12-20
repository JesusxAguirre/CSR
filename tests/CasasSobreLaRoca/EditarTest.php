<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\LaRoca;


final class EditarTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new LaRoca();
        $_SESSION['cedula'] = '27199177';
    }
    /** @test **/
    public function test_editar(): void
    {
        //Init
        $id = '15';
        $cedula_lider = '27199177';
        $dia = 'l';
        $hora = '09:10';
        $nombre_anfitrion = 'Cheo';
        $telefono_anfitrion = '';
        $cantidad = 'a';
        $direccion = 'avenida!+&ssss';
        $expected = true;

        
        //Act
        $this->objeto->security_validation_inyeccion_sql([$id, $dia, str_replace(" ", "", $nombre_anfitrion), $telefono_anfitrion, $cantidad, str_replace(" ", "", $direccion)]);
        //validando estructura de codigo ademas sepaprando sola la cedula del codigo, para luego validar la cedula
        $this->objeto->security_validation_codigo([$cedula_lider]);

        $this->objeto->security_validation_cantidad([$cantidad]);

        $this->objeto->setActualizar($cedula_lider, $nombre_anfitrion, $telefono_anfitrion, $cantidad, $direccion, $dia, $hora, $id);
        $response = $this->objeto->actualizar_CSR();


        //Assert
        $this->assertTrue($response);
    }
}
?>
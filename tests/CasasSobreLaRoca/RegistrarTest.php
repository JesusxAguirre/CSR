<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\LaRoca;


final class RegistrarTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new LaRoca();
        $_SESSION['cedula'] = '27199177';
    }
    /** @test **/
    public function test_registrar(): void
    {
        //Init

        $cedula_lider = '27199177';
        $dia = 'Jueves';
        $hora = '09:10';
        $nombre_anfitrion = 'Juan';
        $telefono_anfitrion = 'errorPRUEBA';
        $direccion = 'avenida hola';
        $cantidad_integrantes = 'errorPRUEBA2';


        //Act
        
        $this->objeto->security_validation_inyeccion_sql([$cedula_lider, $dia, str_replace(" ", "", $nombre_anfitrion),
        $telefono_anfitrion, $cantidad_integrantes, str_replace(" ", "", $direccion)]);
        $this->objeto->security_validation_cedula($cedula_lider);
        $this->objeto->security_validation_caracteres([$dia, $nombre_anfitrion]);
        $this->objeto->security_validation_hora($hora);
        $this->objeto->security_validation_telefono($telefono_anfitrion);

        $this->objeto->security_validation_cantidad([$cantidad_integrantes]);
        $this->objeto->setCSR($cedula_lider, $direccion, $nombre_anfitrion, $telefono_anfitrion, $dia, $hora, $cantidad_integrantes);
        
        $response = $this->objeto->registrar_CSR();


        //Assert
        $this->assertTrue($response);
    }
}
?>
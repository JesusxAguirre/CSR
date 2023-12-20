<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\LaRoca;


final class ReporteTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto = new LaRoca();
        $_SESSION['cedula'] = '27199177';
    }
    /** @test **/
    public function test_reporte(): void
    {
        //Init
        $CSR = 15;
        $hombres = 'tres';
        $mujeres = 'tres';
        $niños = 'cero';
        $confesiones = 4;

        
        //Act

        $this->objeto->security_validation_inyeccion_sql([$CSR, $hombres, $mujeres, $niños, $confesiones]);

        $this->objeto->security_validation_numero($CSR);

        $this->objeto->security_validation_cantidad([$hombres, $mujeres, $niños, $confesiones]);

        $this->objeto->setReporte($CSR, $hombres, $mujeres, $niños, $confesiones);

        $response = $this->objeto->registrar_reporte_CSR();

        //Assert
        $this->assertTrue($response);
    }
}
?>
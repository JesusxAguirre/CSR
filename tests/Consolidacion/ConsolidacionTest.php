<?php

declare(strict_types=1);

use Csr\Modelo\Consolidacion;
use PHPUnit\Framework\TestCase;
use Csr\Modelo\Consolidacion;


final class ConsolidacionTest extends TestCase
{
  private $objeto_consolidacion;

  public function setUp(): void
  {
    $this->objeto_consolidacion  = new Consolidacion();
  }
  /** @test **/
  public function test_listar_consolidacion()
  {
    //Init
   

    $expected = true;
    //Act  
    

    //Asert
    $this->assertEquals($expected, $response);
  }

 
}

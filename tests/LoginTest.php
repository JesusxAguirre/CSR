<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class LoginTest extends TestCase
{
   
    public function testSumar()
    {
      $suma = 2 + 3 ;
      $expected = 4;
        $this->assertEquals(
            $expected ,
            $suma
        );
    }
}
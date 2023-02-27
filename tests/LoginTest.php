<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class LoginTest extends TestCase
{
   
    /** @test **/
    public function test_login_admin ()
    {
      $suma = 2 + 3 ;
      $expected = 4;
        $this->assertEquals(
            $expected ,
            $suma
        );
    }
}
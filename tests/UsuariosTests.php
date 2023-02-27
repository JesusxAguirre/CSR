<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class UsuariosTest extends TestCase
{
  public function testSuma(): void
  {
      $suma = 2+2;
      $this->assertEquals(
          4,
          $suma
      );
  }
}
<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Csr\Modelo\Usuarios;


final class MiPerfilEditarTest extends TestCase
{
    private $objeto;

    public function setUp(): void
    {
        $this->objeto   = new Usuarios();
    }

    /** @test **/
    public function test_miPerfilEditar()
    {
        //Init
        $cedula = '12021047';
        $cedula_antigua = '27199177';
        $nombre = 'Marcos';
        $apellido = 'Aguilar';
        $edad = '1999-12-30';
        $sexo = 'hombre';
        $civil = 'Soltero';
        $nacionalidad = 'Venezolana';
        $estado = 'lara';
        $telefono = '04143543210';
        $correo = 'examplejeje@gmail.com';
        
        //Act  
        $this->objeto->setUpdate_sin_rol($nombre, $apellido, $cedula, $cedula_antigua, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo);
        $this->objeto->update_usuarios_sin_rol();

        $listaUsuarios = $this->objeto->listar();

        //Asert
        $this->assertIsArray($listaUsuarios); // verifica que $matriz_usuario es un array
        $this->assertNotEmpty($listaUsuarios); // verifica que $matriz_usuario no está vacío
    }
}

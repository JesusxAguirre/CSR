<?php

namespace Csr\Modelo;

use PDO;
use Exception;

class Conexion
{
    private $inyeccion = "SET FOREIGN_KEY_CHECKS = 0;";
    private $expresion_especial = "/^[^a-zA-Z0-9!@#$%^&*]$/";

    private $expresion_cedula = "/^[0-9]{7,8}$/";

    private $expresion_numero = "/^[0-9]$/";

    private $expresion_nombre = "/^[A-ZÑa-zñáéíóúÁÉÍÓÚ'°]{3,12}$/";
    protected static function conexion()
    {

        try {

            $dsn = "mysql: host=localhost; dbname=casa_sobre_la_roca";

            $user = "root";

            $password = "";

            $conexion = new PDO($dsn, $user, $password);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conexion->exec("SET CHARACTER SET UTF8");

            $conexion->query("SET lc_time_names = 'es_ES'");
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();
        }

        return $conexion;
    }

    protected function registrar_bitacora($cedula, $accion, $id_modulo)
    {
        $sql = "INSERT INTO bitacora_usuario (cedula_usuario, id_modulo, fecha_registro, hora_registro, accion_realizada) 
        VALUES(:ced, :id, CURDATE(), CURTIME(), :accion)";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":ced" => $cedula,
            ":id" => $id_modulo,
            ":accion" => $accion
        ));
    }

    protected function validar_inyeccion($array)
    {
    
        for ($i = 0; $i < count($array); $i++) {
            $response = preg_match_all($this->expresion_especial, $array[$i]);

            if ($response > 0) {
                //guardar en base de datos hacker


                die("sapo perro");
            }

            if($array[$i] == ""){
                //guardar en base de datos de hacker


                die("datos vacio sapo hacker");
            }
        }
    }


    protected function validar_cedula($string)
    {
        return preg_match_all($this->expresion_cedula, $string);
    }

    protected function validar_caracteres($string)
    {
        return preg_match_all($this->expresion_nombre, $string);
    }

    //protected function validar_caracteres()
}

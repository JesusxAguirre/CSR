<?php
namespace Csr\Modelo;

use PDO;
use Exception;
class Conexion
{
    private $inyeccion = "SET FOREIGN_KEY_CHECKS = 0;";
    private $expresion_especial = "/[[:punct:]]/";

    private $expresion_cedula = "/^[0-9]{7,8}$/";

    private $expresion_numero = "/^[0-9]$/";

    private $expresion_nombre = "/^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$/";
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
        return preg_match_all($this->expresion_especial, $array);
    }


    protected function validar_letras($string)
    {
        return preg_match($this->expresion_cedula, $string);
    }
}

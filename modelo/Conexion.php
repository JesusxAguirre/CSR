<?php

namespace Csr\Modelo;


use PDO;
use Exception;
use DateTime;

class Conexion
{
    private $inyeccion = "SET FOREIGN_KEY_CHECKS = 0;";

    // Definir el umbral de solicitud
    private $umbralSolicitudes = 5; // 5 solicitudes en 1 segundo
    private $umbralTiempo = 1; // 1 segundo

    private $expresion_especial = "/^[^a-zA-Z0-9!@#$%^&*]$/";

    private $expresion_cedula = "/^[0-9]{7,8}$/";

    private $expresion_numero = "/^[0-9]$/";

    private $expresion_caracteres = "/^[A-ZÑa-zñáéíóúÁÉÍÓÚ'°]{3,12}$/";

    //CONEXION CON BASE DE DATOS
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

    //REGISTRAR ACCIONES DE USUARIOS EN LA BITACORA 
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


    //VALIDACION INYECCION SQL
    protected function validar_inyeccion($array)
    {

        for ($i = 0; $i < count($array); $i++) {
            $response = preg_match_all($this->expresion_especial, $array[$i]);

            if ($response > 0) {
                //guardar en base de datos hacker


                die("inyeccion sql");
            }

            if ($array[$i] == "") {
                //guardar en base de datos de hacker


                die("datos vacio");
            }
        }
    }


    //VALIDACION CEDULA
    protected function validar_cedula($cedula)
    {
        $response = preg_match_all($this->expresion_cedula, $cedula);

        if ($response == 0) {
            //guardar ataque de hacker

            die("datos invalido de cedula");
        }
    }

    protected function validar_caracteres($array)
    {

        for ($i = 0; $i < count($array); $i++) {
            $response = preg_match_all($this->expresion_caracteres, $array[$i]);

            if ($response == 0) {
                //guardar datos de hacker

                die("datos invalidos en caracteres");
            }
        }
    }


    protected function check_requests_danger()
    {
        // Obtener la IP del cliente
       
        

        $ip = $_SERVER['REMOTE_ADDR'];
        // Obtener la marca de tiempo actual
        $timestamp = time();
        // Eliminar registros antiguos en la tabla 'requests'
        $limiteTiempo = $timestamp - $this->umbralTiempo;
        $eliminarRegistrosAntiguos = $this->conexion()->prepare("DELETE FROM requests WHERE timestamp < :limiteTiempo");
        $eliminarRegistrosAntiguos->bindParam(':limiteTiempo', $limiteTiempo);
        $eliminarRegistrosAntiguos->execute();
        // Contar las solicitudes realizadas por la IP en el último segundo

        //Creo que esta llamando mal la columna. Las tablas que me pasaste tiene id en vez de ip
        $consulta = $this->conexion()->prepare("SELECT COUNT(*) AS conteo FROM requests WHERE ip = :ip");
        $consulta->bindParam(':ip', $ip);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        // Verificar el contador y bloquear el acceso si se supera el umbral
        if ($resultado['conteo'] >= $this->umbralSolicitudes) {
            // Registrar la IP en la tabla de blacklist
            $insertarBlacklist = $this->conexion()->prepare("INSERT INTO blacklist (ip) VALUES (:ip)");
            $insertarBlacklist->bindParam(':ip', $ip);
            $insertarBlacklist->execute();
            // Bloquear el acceso al servidor
            http_response_code(403);
            echo "Acceso denegado. Has superado el límite de solicitudes por segundo.";
            die();
        }
        // Registrar la solicitud en la base de datos
        $registrarSolicitud = $this->conexion()->prepare("INSERT INTO requests (ip, timestamp) VALUES (:ip, )");
        $registrarSolicitud->bindParam(':ip', $ip);
        $registrarSolicitud->bindParam(':timestamp', $timestamp);
        $registrarSolicitud->execute();
    }

    protected function check_blacklist()
    {
        // Obtener la IP del cliente
        
        $ip = $_SERVER['REMOTE_ADDR'];
    
        // Consultar la tabla de blacklist para verificar si la IP está en la lista negra
        $consulta = $this->conexion()->prepare("SELECT COUNT(*) AS conteo FROM blacklist WHERE ip = :ip");
        $consulta->bindParam(':ip', $ip);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    
        // Verificar el resultado y bloquear el acceso si la IP está en la lista negra
        if ($resultado['conteo'] > 0) {
            // Bloquear el acceso al servidor
            http_response_code(403);
            echo "Acceso denegado. Tu IP está en la lista negra.";
            die();
        }
    }
}

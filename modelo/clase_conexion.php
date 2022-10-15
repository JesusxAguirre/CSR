<?php

class Conectar
{

    public static function conexion()
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
    public function registrar_bitacora($usuario,$accion)
    {
       
        $sql = ("SELECT cedula FROM usuarios WHERE usuario = '$usuario'"); //consultar cedula de usuario actual

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        $usuario = $resultado['cedula'];

        $sql = "INSERT INTO bitacora_usuario (cedula_usuario,fecha_registro,hora_registro,
                              accion_realizada) 
                              VALUES(:ced,CURDATE(),CURTIME(),:accion)";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":ced" => $usuario,
            ":accion" => $accion
        ));
    }
}

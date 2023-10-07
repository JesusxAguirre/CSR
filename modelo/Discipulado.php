<?php

namespace Csr\Modelo;

use Csr\Modelo\Conexion;

use PDO;
use Exception;
use DateTime;

use Throwable;

class Discipulado extends Conexion
{
    private $conexion;
    private $id_modulo;

    private $direccion;
    private $participantes;
    private $asistentes;
    private $dia;
    private $hora;
    private $id;
    private $fecha;
    private $cedula_lider;
    private $cedula_anfitrion;
    private $cedula_asistente;


    //PROPIEDADES PARA EXPRESIONES REGULARES DE REGISTRAR USUARIO


    private $expresion_telefono = "/^[0-9]{11}$/";

    private $expresion_especial =  "/[^a-zA-Z0-9!@#$%^&*]/";

    private $expresion_codigo =  "/^([^a-zA-Z0-9!@#$%^&-*])$/";

    private $expresion_cedula = "/^[0-9]{7,8}$/";


    private $expresion_caracteres = "/^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]{3,19}$/";

    private $expresion_hora = "/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/";


    public function __construct()
    {
        $this->conexion = parent::conexion();
        $this->id_modulo = 6;
    }
    public function buscar_discipulado($busqueda)
    {
        $resultado = [];
        $busqueda = '%' . $busqueda . '%';
        $sql = ("SELECT *, lider.codigo 'cod_lider', anfitrion.codigo 'cod_anfitrion', asistente.codigo 'cod_asistente', lider.cedula 'ced_lider', anfitrion.cedula 'ced_anfitrion', asistente.cedula 'ced_asistente' 
        FROM celula_discipulado 
        JOIN usuarios AS lider ON celula_discipulado.cedula_lider = lider.cedula 
        JOIN usuarios AS anfitrion ON celula_discipulado.cedula_anfitrion = anfitrion.cedula 
        JOIN usuarios AS asistente ON celula_discipulado.cedula_asistente = asistente.cedula  
        WHERE codigo_celula_discipulado  LIKE :busqueda1 
        OR fecha LIKE :busqueda2 
        OR dia_reunion LIKE :busqueda3
        OR hora LIKE :busqueda4
        OR lider.codigo LIKE :busqueda5
        OR anfitrion.codigo LIKE :busqueda6
        OR asistente.codigo LIKE :busqueda7");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":busqueda1" => $busqueda,
            ":busqueda2" => $busqueda,
            ":busqueda3" => $busqueda,
            ":busqueda4" => $busqueda,
            ":busqueda5" => $busqueda,
            ":busqueda6" => $busqueda,
            ":busqueda7" => $busqueda,
        ));


        if ($stmt->rowCount() > 0) {
            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                $resultado[] = $filas;
            }
        }

        return $resultado;
    }

    public function listar_usuarios_N2()
    {
        $resultado = [];
        $consulta = ("SELECT cedula,codigo,nombre,apellido 
        FROM usuarios 
        WHERE codigo LIKE '%N2%' OR codigo LIKE '%N3%'");

        $sql = $this->conexion()->prepare($consulta);

        $sql->execute(array());

        while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }
        return $resultado;
    }

    public function listar_usuarios_N2_sin_discipulado()
    {

        $sql = ("SELECT cedula,codigo FROM usuarios WHERE codigo LIKE  '%N2%' OR codigo LIKE '%N3%'
        AND cedula NOT IN (SELECT cedula_lider FROM celula_discipulado) ");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }

        return $resultado;
    }




    public function listar_celula_discipulado()
    {
        $resultado = [];
        $sql = ("SELECT celula_discipulado.id, celula_discipulado.codigo_celula_discipulado, celula_discipulado.dia_reunion, celula_discipulado.hora, celula_discipulado.direccion,
        lider.codigo AS codigo_lider,    lider.cedula AS cedula_lider,  
        anfitrion.codigo AS codigo_anfitrion, anfitrion.cedula AS cedula_anfitrion, 
        asistente.codigo AS codigo_asistente, asistente.cedula AS cedula_asistente
        FROM celula_discipulado 
        INNER JOIN usuarios AS lider  ON   celula_discipulado.cedula_lider = lider.cedula
        INNER JOIN usuarios AS anfitrion  ON   celula_discipulado.cedula_anfitrion = anfitrion.cedula
        INNER JOIN usuarios AS asistente  ON   celula_discipulado.cedula_asistente = asistente.cedula");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }

        $accion = "Listar Celula de discipulado";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
        return $resultado;
    }
    public function listar_participantes($id_discipulado)
    {
        try {
            $participantes = [];
            $sql = ("SELECT celula_discipulado.id, celula_discipulado.codigo_celula_discipulado AS codigo_celula,discipulos.cedula AS participantes_cedula, discipulos.nombre AS participantes_nombre,discipulos.apellido 
                    AS participantes_apellido, discipulos.codigo AS participantes_codigo, discipulos.telefono AS participantes_telefono
                    FROM celula_discipulado 
                    INNER JOIN discipulos AS participantes ON celula_discipulado.id = participantes.id_discipulado
                    INNER JOIN usuarios AS discipulos ON participantes.cedula = discipulos.cedula
                    WHERE celula_discipulado.id = :id_discipulado");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":id_discipulado" => $id_discipulado));

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                $participantes[] = $filas;
            }

            $accion = "Listar Discipulos";
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            return $participantes;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    public function listar_celula_discipulado_por_usuario()
    {
        try {
            $resultado = [];
            $usuario = $_SESSION['usuario'];
            $sql = ("SELECT celula_discipulado.id, celula_discipulado.codigo_celula_discipulado
        FROM celula_discipulado 
        WHERE celula_discipulado.cedula_lider = (SELECT cedula FROM usuarios WHERE usuario = '$usuario') ");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                $resultado[] = $filas;
            }
            return $resultado;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();
            return false;
        }
    }

    public function listar_asistencias($id, $fecha_inicio, $fecha_final)
    {
        $resultado = [];

        //SENTENCIA ANTIGUA HECHA POR JESUS AGUIRRE

        /*$sql = ("SELECT COUNT(reporte_celula_discipulado.fecha) AS numero_asistencias, reporte_celula_discipulado.cedula_participante, usuarios.nombre,
        usuarios.codigo, usuarios.telefono, MONTHNAME(fecha) AS mes
        FROM reporte_celula_discipulado 
        INNER JOIN usuarios ON reporte_celula_discipulado.cedula_participante = usuarios.cedula
        WHERE reporte_celula_discipulado.fecha BETWEEN '$fecha_inicio' AND  '$fecha_final' 
        AND  reporte_celula_discipulado.id_discipulado = '$id'
        GROUP BY MONTHNAME(fecha)");*/

        $sql = "SELECT `rp`.`id_discipulado`, `usuarios`.`nombre`, `usuarios`.`apellido`, `usuarios`.`telefono`, `usuarios`.`codigo`, COUNT(DISTINCT `rp`.`fecha`) as `asistencias`, COUNT(DISTINCT `rpd`.`fecha`) as `total` FROM `usuarios` 
        INNER JOIN `reporte_celula_discipulado` AS `rp` ON `rp`.`cedula_participante` = `usuarios`.`cedula` 
        RIGHT JOIN `reporte_celula_discipulado` as `rpd` ON `rpd`.`id_discipulado` = :id1
        WHERE `rp`.`fecha` BETWEEN :fecha_inicio1 AND :fecha_final2 AND `rp`.`id_discipulado` = :id2 AND `rpd`.`fecha` BETWEEN :fecha_inicio2 AND :fecha_final2 GROUP BY `usuarios`.`cedula`";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":id1" => $id,
            ":fecha_inicio1" => $fecha_inicio,
            ":fecha_final1" => $fecha_final,
            ":id2" => $id,
            ":fecha_inicio2" => $fecha_inicio,
            ":fecha_final2" => $fecha_final
        ));
        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultado[] = $filas;
        }

        $accion = "Reporte de Asistencias de celula de discipulado";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
        return $resultado;
    }

    public function listar_no_participantes()
    {
        $resultado = [];
        $sql = ("SELECT cedula, codigo,nombre,apellido FROM usuarios WHERE usuarios.cedula NOT IN (SELECT cedula FROM discipulos) 
         AND usuarios.cedula NOT IN (SELECT cedula_lider FROM celula_discipulado)
         AND usuarios.cedula NOT IN (SELECT cedula_anfitrion FROM celula_discipulado)
         AND usuarios.cedula NOT IN (SELECT cedula_asistente FROM celula_discipulado)
         AND usuarios.cedula NOT IN  (SELECT cedula FROM participantes_consolidacion) 
         AND usuarios.cedula NOT IN (SELECT cedula_lider FROM celula_consolidacion)
         AND usuarios.cedula NOT IN (SELECT cedula_anfitrion FROM celula_consolidacion)
         AND usuarios.cedula NOT IN (SELECT cedula_asistente FROM celula_consolidacion)");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }

        return $resultado;
    }

    //------------------------------------------------------Registrar Asitencias de discipulado ----------------------//
    public function registrar_asistencias()
    {
        try {

            $sql = "INSERT INTO reporte_celula_discipulado (id_discipulado,cedula_participante,fecha) 
            VALUES(:id_discipulado,:cedula_participante,:fecha)";

            $stmt = $this->conexion->prepare($sql);
            //recorriendo arreglo de asistentes
            foreach ($this->asistentes as $asistente) {
                $stmt->execute(array(
                    ":id_discipulado" => $this->id,
                    ":cedula_participante" => $asistente,
                    ":fecha" => $this->fecha
                ));
            } //fin del foeach

            if (isset($_SESSION['cedula'])) {
                $accion = "Registrar Asistencias de celula de discipulado";
                $usuario = $_SESSION['cedula'];
                parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            }



            http_response_code(200);
            echo json_encode(array("msj" => "Se han registrado correctamente las asistencias", 'status_code' => 200));
            die();
        } catch (Throwable $ex) {

            if ($this->conexion()->inTransaction()) {
                $this->conexion()->rollBack();
            }


            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));

            die();
        }
    }
    //------------------------------------------------------Registrar discipulado ----------------------//
    public function registrar_discipulado()
    {
        try {

            if ($this->cedula_lider == $this->cedula_anfitrion or $this->cedula_lider == $this->cedula_asistente) {
                throw new Exception("La cedula del lider no puede ser igual a la del anfitrion o el asistente ", 422);
            }


            //VALIDANDO QUE LAS FECHAS SEAN CON MEDIA HORA DE DIFERENCIA
            $sql = ("SELECT hora,dia_reunion AS dia FROM celula_discipulado WHERE cedula_lider = :cedula_lider");

            $stmt = $this->conexion()->prepare($sql);

            $hora = DateTime::createFromFormat('H:i', $this->hora);


            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($filas['dia'] == $this->dia) {

                    $hora_filas_formateada = substr($filas['hora'], 0, 5);

                    $horas_base_de_datos = DateTime::createFromFormat('H:i', $hora_filas_formateada);

                    //calculando la diferencia entre horarios
                    $diferenciaMinutos = $hora->diff($horas_base_de_datos)->format('%i');

                    if ($diferenciaMinutos < 15) {
                        throw new Exception("Estás intentando registrar un horario de celula de discipulado que choca con otro horario. La diferencia debe ser de al menos 15 minutos.", 422);
                    }
                }
            }

            //buscando ultimo id agregando
            $sql = ("SELECT MAX(id) AS id FROM celula_discipulado");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());

            $contador = $stmt->fetch(PDO::FETCH_ASSOC);

            $id = $contador['id'];


            //sumandole un numero para que sea dinamico 
            $id++;




            $sql = "INSERT INTO celula_discipulado (codigo_celula_discipulado,cedula_lider,
            cedula_anfitrion,cedula_asistente,dia_reunion,fecha,hora,direccion) 
            VALUES(:codigo,:cedula_lider,:cedula_anfitrion,:cedula_asistente,:dia,:fecha,:hora,:direc)";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute(array(
                ":codigo" => 'CD' . $id,
                ":cedula_lider" => $this->cedula_lider, ":cedula_anfitrion" => $this->cedula_anfitrion,
                ":cedula_asistente" => $this->cedula_asistente, ":dia" => $this->dia,
                ":fecha" => $this->fecha, ":hora" => $this->hora, ":direc" => $this->direccion
            ));


            //---------Comienzo de funcion de pasar id foraneo con respecto a los discipulos de la celula------------------------//
            //primero vamos a buscar el id que queremos pasar como clave foranea

            $sql = ("SELECT id FROM celula_discipulado 
            WHERE cedula_lider= :cedula_lider
            AND cedula_anfitrion = :cedula_anfitrion
            AND cedula_asistente = :cedula_asistente");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula_lider" => $this->cedula_lider, ":cedula_anfitrion" => $this->cedula_anfitrion,
                ":cedula_asistente" => $this->cedula_asistente
            ));

            $id_discipulado  = $stmt->fetch(PDO::FETCH_ASSOC);


            foreach ($this->participantes as $participantes) {
                $sql = ("INSERT INTO discipulos (cedula,id_discipulado) VALUES (:cedula,:id) ");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $participantes,
                    ":id" => $id_discipulado['id']
                ));
            } //fin del foreach
            //id foraneo agregado por cada participante



            //---------Comienzo de funcion de pasar id foraneo con respecto a el lider de la celula------------------------//
            //agregando codigo de celula a codigo de usuario
            //agregando a lider
            $sql = ("SELECT codigo FROM usuarios WHERE cedula = :cedula_lider");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(":cedula_lider" => $this->cedula_lider));
            $codigo_lider  = $stmt->fetch(PDO::FETCH_ASSOC);


            $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_lider['codigo'] . '-' . 'CD' . $id,
                ":cedula" => $this->cedula_lider
            ));

            //comprobando que el anfitrion y el asistente sean la misma cedula
            if ($this->cedula_anfitrion == $this->cedula_asistente) {
                $sql = ("SELECT codigo FROM usuarios WHERE cedula = :cedula_anfitrion");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(":cedula_anfitrion" => $this->cedula_anfitrion));

                $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_anfitrion['codigo']  . '-' . 'CD' . $id,
                    ":cedula" => $this->cedula_anfitrion
                ));

                //registrando en tabla intermediaria los anfitriones y asistentes
                $sql = ("INSERT INTO discipulos(cedula,id_discipulado) VALUES (:cedula,:id) ");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $this->cedula_anfitrion,
                    ":id" => $id_discipulado['id']
                ));
            } else { //comienzo del ELSE y fin del IF
                //agregando codigo de celula por separado de anfitrion y asistente
                $sql = ("SELECT codigo FROM usuarios WHERE cedula = :cedula_anfitrion");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(":cedula_anfitrion" => $this->cedula_anfitrion));

                $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_anfitrion['codigo']  . '-' . 'CD' . $id,
                    ":cedula" => $this->cedula_anfitrion
                ));

                //registrando en tabla intermediaria los anfitriones y asistentes
                $sql = ("INSERT INTO discipulos(cedula,id_discipulado) VALUES (:cedula,:id) ");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $this->cedula_anfitrion,
                    ":id" => $id_discipulado['id']
                ));

                $sql = ("SELECT codigo FROM usuarios WHERE cedula = :cedula_asistente");

                $stmt = $this->conexion()->prepare($sql);
                $stmt->execute(array(":cedula_asistente" => $this->cedula_asistente));

                $codigo_asistente  = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_asistente['codigo']  . '-' . 'CD' . $id,
                    ":cedula" => $this->cedula_asistente
                ));

                //registrando en tabla intermediaria los anfitriones y asistentes
                $sql = ("INSERT INTO discipulos(cedula,id_discipulado) VALUES (:cedula,:id) ");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $this->cedula_asistente,
                    ":id" => $id_discipulado['id']
                ));
            } //fin del else si el asitente de la celula y el anfitrion son distintos


            if (isset($_SESSION['cedula'])) {
                $accion = "Registrar  celula de discipulado";
                $usuario = $_SESSION['cedula'];
                parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            }



            http_response_code(200);
            echo json_encode(array("msj" => "Se ha registrado correctamente la cedula de discipulado", 'status_code' => 200));
            die();
        } catch (Throwable $ex) {

            

            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));

            die();
        }
    }


    public function actualizar_discipulado()
    {
        try {


            if ($this->cedula_lider == $this->cedula_anfitrion or $this->cedula_lider == $this->cedula_asistente) {
                throw new Exception("La cedula del lider no puede ser igual a la del anfitrion o el asistente ", 422);
            }

            //VALIDANDO QUE LAS FECHAS SEAN CON 15 MINUTOS DE DIFERENCIA
            $sql = ("SELECT hora,dia_reunion as dia, id FROM celula_discipulado WHERE cedula_lider = :cedula_lider");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":cedula_lider" => $this->cedula_lider));

            $hora = DateTime::createFromFormat('H:i', $this->hora);


            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($filas['dia'] == $this->dia and $filas['id'] != $this->id) {

                    $hora_filas_formateada = substr($filas['hora'], 0, 5);

                    $horas_base_de_datos = DateTime::createFromFormat('H:i', $hora_filas_formateada);

                    //calculando la diferencia entre horarios
                    $diferenciaMinutos = $hora->diff($horas_base_de_datos)->format('%i');

                    if ($diferenciaMinutos < 15) {
                        throw new Exception("Estás intentando registrar un horario de celula de discipulado que choca con otro horario. La diferencia debe ser de al menos 15 minutos.", 422);
                    }
                }
            }


            //buscando las cedulas de los usuarios por id de celula
            $sql = ("SELECT  celula_discipulado.codigo_celula_discipulado AS codigo_celula,  
            lider.codigo AS codigo_lider, lider.cedula AS cedula_lider,  
            anfitrion.codigo AS codigo_anfitrion, anfitrion.cedula AS cedula_anfitrion, 
            asistente.codigo AS codigo_asistente, asistente.cedula AS cedula_asistente
            FROM celula_discipulado 
            INNER JOIN usuarios AS lider  ON   celula_discipulado.cedula_lider = lider.cedula
            INNER JOIN usuarios AS anfitrion  ON   celula_discipulado.cedula_anfitrion = anfitrion.cedula
            INNER JOIN usuarios AS asistente  ON   celula_discipulado.cedula_asistente = asistente.cedula
            WHERE celula_discipulado.id = :id");
            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":id" => $this->id));

            if ($stmt->rowCount() < 1) {
                throw new Exception("Esta celula de discipulado no existe en la base de datos", 404);
            }

            //guardando en un array asociativo las cedulas
            $cedulas  = $stmt->fetch(PDO::FETCH_ASSOC);
            
              //COMPROBANDO QUE SE ENVIAN DATOS DIFERENTES
              if (
                $cedulas['cedula_lider'] == $this->cedula_lider and $cedulas['cedula_anfitrion'] == $this->cedula_anfitrion and
                $cedulas['dia_reunion'] == $this->dia and $cedulas['cedula_asistente'] == $this->cedula_asistente and
                $cedulas['dia_visita'] == $this->dia and $cedulas['hora'] == $this->hora and $cedulas['direccion'] == $this->direccion
            ) {
                throw new Exception("Estas enviando la solicitud sin modificar los datos", 422);
            }


            $codigo = $cedulas['codigo_celula'];
            $codigo1 = $cedulas['codigo_celula'];
            $codigo2 = $cedulas['codigo_celula']; //esto es porque aveces se sobreescribian la variable dependiendo de que if entrara entonces fue mas facil hacer 3 variables que arreglar eso
            $codigo3 = $cedulas['codigo_celula'];
            $codigo_lider_antiguo = $cedulas['codigo_lider'];
            $codigo_anfitrion_antiguo = $cedulas['codigo_anfitrion'];
            $codigo_asistente_antiguo = $cedulas['codigo_asistente'];
            $cedula_lider_antiguo = $cedulas['cedula_lider'];
            $cedula_anfitrion_antiguo = $cedulas['cedula_anfitrion'];
            $cedula_asistente_antiguo = $cedulas['cedula_asistente'];


            if ($codigo_lider_antiguo != $this->cedula_lider) {

                $codigo1 = '-' . $codigo;
                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,':codigo1','') WHERE cedula = :cedula_lider_antiguo");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo1,
                    ":cedula_lider_antiguo" => $cedula_lider_antiguo
                ));
                //agregando el codigo a el usuario nuevo
                $sql = ("SELECT codigo FROM usuarios WHERE cedula = :cedula_lider");

                $stmt = $this->conexion()->prepare($sql);
                $stmt->execute(array(":cedula_lider" => $this->cedula_lider));
                $codigo_lider  = $stmt->fetch(PDO::FETCH_ASSOC);


                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_lider['codigo'] . '-' . $codigo,
                    ":cedula" => $this->cedula_lider
                ));
            }
            //comprobando si las cedulas de anfitrion y asistente son iguales
            if ($this->cedula_anfitrion == $this->cedula_asistente) {
                if ($codigo_anfitrion_antiguo != $this->cedula_anfitrion) {

                    $codigo2 = '-' . $codigo;
                    $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,':codigo2','') WHERE cedula = :cedula_anfitrion_antiguo");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(
                        ":codigo2" => $codigo2,
                        ":cedula_anfitrion_antiguo" => $cedula_anfitrion_antiguo
                    ));
                    //agregando el codigo a el usuario nuevo
                    $sql = ("SELECT codigo FROM usuarios WHERE cedula = :cedula_anfitrion");

                    $stmt = $this->conexion()->prepare($sql);
                    $stmt->execute(array(":cedula_anfitrion" => $this->cedula_anfitrion));
                    $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);


                    $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(
                        ":codigo" => $codigo_anfitrion['codigo'] . '-' . $codigo,
                        ":cedula" => $this->cedula_anfitrion
                    ));

                    $sql = ("DELETE FROM discipulos WHERE cedula = :cedula_anfitrion_antiguo");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(":cedula_anfitrion_antiguo" => $cedula_anfitrion_antiguo));

                    $sql = ("INSERT INTO discipulos (cedula,id_discipulado) VALUES (:cedula,:id)");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(
                        ":cedula" => $this->cedula_anfitrion,
                        ":id" => $this->id
                    ));
                }
            } else {
                if ($codigo_anfitrion_antiguo != $this->cedula_anfitrion) {
                    if ($codigo_anfitrion_antiguo != $this->cedula_asistente) {
                        $codigo2 = '-' . $codigo;
                        $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,':codigo2','') WHERE cedula = :cedula_anfitrion_antiguo");

                        $stmt = $this->conexion()->prepare($sql);

                        $stmt->execute(array(
                            ":codigo2" => $codigo2,
                            ":cedula_anfitrion_antiguo" => $cedula_anfitrion_antiguo
                        ));
                    }
                    //agregando el codigo a el usuario nuevo
                    $sql = ("SELECT codigo FROM usuarios WHERE cedula = :cedula_anfitrion");

                    $stmt = $this->conexion()->prepare($sql);
                    $stmt->execute(array(":cedula_anfitrion" => $this->cedula_anfitrion));
                    $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);


                    $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(
                        ":codigo" => $codigo_anfitrion['codigo'] . '-' . $codigo,
                        ":cedula" => $this->cedula_anfitrion
                    ));

                    $sql = ("DELETE FROM discipulos WHERE cedula = :cedula_anfitrion_antiguo");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(":cedula_anfitrion_antiguo" => $cedula_anfitrion_antiguo));

                    $sql = ("INSERT INTO discipulos (cedula,id_discipulado) VALUES (:cedula,:id)");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(
                        ":cedula" => $this->cedula_anfitrion,
                        ":id" => $this->id
                    ));
                }
                if ($codigo_asistente_antiguo != $this->cedula_asistente) {
                    if ($codigo_asistente_antiguo != $this->cedula_anfitrion) {

                        $codigo3 = '-' . $codigo;
                        $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,':codigo3','') WHERE cedula = :cedula_asistente_antiguo");

                        $stmt = $this->conexion()->prepare($sql);

                        $stmt->execute(array(
                            ":codigo3" => $codigo3,
                            ":cedula_asistente_antiguo" => $cedula_asistente_antiguo
                        ));
                    }
                    //agregando el codigo a el usuario nuevo
                    $sql = ("SELECT codigo FROM usuarios WHERE cedula = :cedula_asistente");

                    $stmt = $this->conexion()->prepare($sql);
                    $stmt->execute(array(":cedula_asistente" => $this->cedula_asistente));
                    $codigo_asistente  = $stmt->fetch(PDO::FETCH_ASSOC);

                    $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(
                        ":codigo" => $codigo_asistente['codigo'] . '-' . $codigo,
                        ":cedula" => $this->cedula_asistente
                    ));

                    $sql = ("DELETE FROM discipulos WHERE cedula = :cedula_asistente_antiguo");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(":cedula_asistente_antiguo" => $cedula_asistente_antiguo));

                    $sql = ("INSERT INTO discipulos (cedula,id_discipulado) VALUES (:cedula,:id)");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(
                        ":cedula" => $this->cedula_asistente,
                        ":id" => $this->id
                    ));
                }
            }

            $sql = ("UPDATE celula_discipulado SET  cedula_lider = :cedula_lider , 
            cedula_anfitrion = :cedula_anfitrion, cedula_asistente = :cedula_asistente, dia_reunion = :dia, hora = :hora,
            direccion = :direc WHERE id= :id");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula_lider" => $this->cedula_lider,
                ":cedula_anfitrion" => $this->cedula_anfitrion, "cedula_asistente" => $this->cedula_asistente,
                ":dia" => $this->dia, ":hora" => $this->hora, ":direc" => $this->direccion,
                ":id" => $this->id
            ));

            if (isset($_SESSION['cedula'])) {
                $accion = "Edicion de celula de discipulado";
                $usuario = $_SESSION['cedula'];
                parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            }



            http_response_code(200);
            echo json_encode(array("msj" => "Se ha registrado correctamente la cedula de discipulado", 'status_code' => 200));
            die();
        } catch (Throwable $ex) {

        
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));

            die();
        }
    }


    public function agregar_participantes()
    {
        try {


            $sql = ("INSERT INTO discipulos (cedula,id_discipulado) VALUES (:cedula,:id)");

            foreach ($this->participantes as $participantes) {

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $participantes,
                    ":id" => $this->id

                ));
            }


            http_response_code(200);
            echo json_encode(array("msj" => "Se ha registrado correctamente todos los nuevos participantes", 'status_code' => 200));
            die();
        } catch (Throwable $ex) {


            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));

            die();
        } //fin del foreach

    }

    public function editar_discipulo_nivel($cedula_discipulo, $nivel_actual, $nivel_actualizar)
    {
        try {


            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:nivel_actual,:nivel_actualizar) WHERE cedula = :cedula_discipulo");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":nivel_actual" => $nivel_actual,
                ":nivel_actualizar" => $nivel_actualizar,
                ":cedula_discipulo" => $cedula_discipulo
            ));

            $sql = ("SELECT id_discipulado FROM discipulos WHERE cedula = :cedula_discipulo");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":cedula_discipulo" => $cedula_discipulo));

            $id_discipulado =  $stmt->fetch(PDO::FETCH_ASSOC);

            return $id_discipulado['id_discipulado'];
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    public function eliminar_participantes($cedula_participante)
    {
        try {

            
            $sql = ("DELETE FROM discipulos WHERE cedula = :cedula_participante");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":cedula_participante" => $cedula_participante));

            return true;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //-------- SET DATOS Para registar discipulado-------------------------------------//
    public function setDiscipulado($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion, $participantes)
    {
        $this->cedula_lider = $cedula_lider;
        $this->cedula_anfitrion = $cedula_anfitrion;
        $this->cedula_asistente = $cedula_asistente;
        $this->dia = $dia;
        $this->hora = $hora;
        $this->fecha = gmdate("y-m-d", time());
        $this->direccion = $direccion;
        $this->participantes = $participantes;
    }
    //-------- SET actualizar para actualizar disicpulados-------------------------------------//

    public function setActualizar($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion, $id)
    {
        $this->cedula_lider = $cedula_lider;
        $this->cedula_anfitrion = $cedula_anfitrion;
        $this->cedula_asistente = $cedula_asistente;
        $this->dia = $dia;
        $this->hora = $hora;
        $this->direccion = $direccion;
        $this->fecha = gmdate("y-m-d", time());
        $this->id = $id;
    }


    //METODO SETTER PARA REGISTRAR DISCIPULOS
    public function setParticipantes($participantes, $id)
    {
        $this->participantes = $participantes;
        $this->id = $id;
    }
    //METODO SETTER PARA REGISTRAR ASISTENCIAS
    public function setAsistencias($asistentes, $id, $fecha)
    {
        $this->asistentes = $asistentes;
        $this->id = $id;
        $this->fecha = $fecha;
    }



    //------------------------------------------------------Reportes estadisticos consultas ----------------------//


    public function listar_cantidad_celulas_discipulado($fecha_inicio, $fecha_final)
    {
        try {
            $resultado = [];
            $sql = ("SELECT COUNT(*) AS cantidad_discipulado, 
        MONTHNAME(fecha) AS mes
        FROM celula_discipulado
        WHERE celula_discipulado.fecha BETWEEN :fecha_inicio AND :fecha_final
        GROUP BY MONTHNAME(fecha)");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":fecha_inicio" => $fecha_inicio . "-01", ":fecha_final" => $fecha_final . "-31"
            ));

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                $resultado[] = $filas;
            }
            $accion = "Generado Reporte estadistico cantidad  de celulas de discipulado";
            //cambiando la id del modulo
            $this->id_modulo = 8;
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            return $resultado;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }
    public function listar_numero_discipulos($fecha_inicio, $fecha_final)
    {
        try {
            $resultado = [];

            $sql = ("SELECT COUNT(*) AS cantidad_discipulos, 
        MONTHNAME(fecha) AS mes
        FROM celula_discipulado
        INNER JOIN discipulos ON  celula_discipulado.id = discipulos.id_discipulado
        WHERE celula_discipulado.fecha BETWEEN :fecha_inicio AND :fecha_final
        GROUP BY MONTHNAME(fecha)");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":fecha_inicio" => $fecha_inicio . "-01", ":fecha_final" => $fecha_final . "-31"
            ));
            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                $resultado[] = $filas;
            }
            $accion = "Generado Reporte estadistico cantidad discipulos en celulas de discipulado";
            //cambiando la id del modulo
            $this->id_modulo = 8;
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            return $resultado;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    public function contar_discipulos()
    {
        try {
            $sql = ("SELECT count(*) AS cantidad_discipulos 
                     FROM discipulos ");
            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    public function listar_numero_discipulos_por_lider($fecha_inicio, $fecha_final, $cedula_lider)
    {
        $sql = ("SELECT 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 1 THEN 1 ELSE 0 END) AS Enero, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 2 THEN 1 ELSE 0 END) AS Febrero, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 3 THEN 1 ELSE 0 END) AS Marzo, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 4 THEN 1 ELSE 0 END) AS Abril, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 5 THEN 1 ELSE 0 END) AS Mayo, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 6 THEN 1 ELSE 0 END) AS Junio, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 7 THEN 1 ELSE 0 END) AS Julio, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 8 THEN 1 ELSE 0 END) AS Agosto, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 9 THEN 1 ELSE 0 END) AS Septiembre, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 10 THEN 1 ELSE 0 END) AS Octubre, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 11 THEN 1 ELSE 0 END) AS Noviembre,
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 12 THEN 1 ELSE 0 END) AS Diciembre
        FROM celula_discipulado
        INNER JOIN discipulos ON  celula_discipulado.id = discipulos.id_discipulado
        WHERE celula_discipulado.fecha BETWEEN :fecha_inicio AND :fecha_final
        AND celula_discipulado.cedula_lider= :cedula_lider");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":fecha_inicio" => $fecha_inicio . "-01", ":fecha_final" => $fecha_final . "-31",
            ":cedula_lider" => $cedula_lider
        ));
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    }

    public function listar_cantidad_celulas_discipulado_por_lider($fecha_inicio, $fecha_final, $cedula_lider)
    {
        try {
            $sql = ("SELECT SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 1 THEN 1 ELSE 0 END) AS Enero, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 2 THEN 1 ELSE 0 END) AS Febrero, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 3 THEN 1 ELSE 0 END) AS Marzo, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 4 THEN 1 ELSE 0 END) AS Abril, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 5 THEN 1 ELSE 0 END) AS Mayo, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 6 THEN 1 ELSE 0 END) AS Junio, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 7 THEN 1 ELSE 0 END) AS Julio, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 8 THEN 1 ELSE 0 END) AS Agosto, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 9 THEN 1 ELSE 0 END) AS Septiembre, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 10 THEN 1 ELSE 0 END) AS Octubre, 
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 11 THEN 1 ELSE 0 END) AS Noviembre,
        SUM(CASE WHEN MONTH(celula_discipulado.fecha) = 12 THEN 1 ELSE 0 END) AS Diciembre
        FROM celula_discipulado
        WHERE celula_discipulado.fecha BETWEEN :fecha_inicio AND :fecha_final
        AND celula_discipulado.cedula_lider= :cedula_lider");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":fecha_inicio" => $fecha_inicio . "-01", ":fecha_final" => $fecha_final . "-31",
                ":cedula_lider" => $cedula_lider
            ));
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            $accion = "Generado Reporte estadistico crecimiento  lider de celula de discipulado";
            //cambiando la id del modulo
            $this->id_modulo = 8;
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            return $resultado;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    public function listar_lider($cedula_lider)
    {
        try {
            $sql = ("SELECT lider.nombre,lider.apellido
                    FROM celula_discipulado 
                    INNER JOIN usuarios AS lider ON celula_discipulado.cedula_lider = lider.cedula
                    WHERE celula_discipulado.cedula_lider=:cedula_lider");
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":cedula_lider" => $cedula_lider
            ));
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }



    ///////////////////////////////////////////////////////////// SECCION DE FUNCIONES QUE SE REUTILIZAN EN EL BACKEND ///////////////////////////////////////

    //AQUI CONMIEZNAN LOS METODOS DE LA CLASE



    //VALIDACION INYECCION SQL    
    /**
     * security_validation_sql
     * 
     * Funcion que valida un array donde cada indice contiene una cadeba de texto
     * por cada indicie verifica que ese cadena no contenga un caracter especial y luego valida si es vacio
     * Si alguno de estos casos se cumple arroja una Exception.
     *
     * @param  mixed $array
     * @return void
     */
    public function security_validation_inyeccion_sql($array)
    {
        try {
            for ($i = 0; $i < count($array); $i++) {
                $response = preg_match($this->expresion_especial, $array[$i]);

                if ($response > 0) {
                    //guardar en base de datos hacker


                    throw new Exception(sprintf("Estas intentando enviar caracteres invalidos. caracter invalido-> '%s' ", $array[$i]), 422);
                }

                if ($array[$i] == "") {
                    //guardar en base de datos de hacker


                    throw new Exception("Estas enviando datos vacios", 422);
                }
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }
    //VALIDACION INYECCION SQL    
    /**
     * security_validation_sql
     * 
     * Funcion que valida un array donde cada indice contiene una cadeba de texto
     * por cada indicie verifica que ese cadena no contenga un caracter especial y luego valida si es vacio
     * Si alguno de estos casos se cumple arroja una Exception.
     *
     * @param  mixed $array
     * @return void
     */
    public function security_validation_codigo($array)
    {
        try {
            for ($i = 0; $i < count($array); $i++) {
                $response = preg_match($this->expresion_codigo, $array[$i]);

                if ($response > 0) {
                    //guardar en base de datos hacker


                    throw new Exception(sprintf("Estas intentando enviar caracteres invalidos. caracter invalido-> '%s' ", $array[$i]), 422);
                }

                if ($array[$i] == "") {
                    //guardar en base de datos de hacker


                    throw new Exception("Estas enviando datos vacios", 422);
                }
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }


    //VALIDACION CEDULA    
    /**
     * validar_cedula
     *
     * Funcion que valida la cedula con una expresion regular, si no coicide captura un error
     * @param  mixed $cedula
     * @return void
     */
    public function security_validation_cedula($array)
    {
        try {
            for ($i = 0; $i < count($array); $i++) {
                $response = preg_match($this->expresion_cedula, $array[$i]);

                if ($response == 0) {
                    //guardar ataque de hacker

                    throw new Exception(sprintf("Estas enviando una cedula invalida. cedula-> '%s' ", $array[$i]), 422);
                }
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));

            http_response_code($ex->getCode());

            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }

    /**
     * security_validation_caracteres
     *
     * Metodo que recibe un array donde cada indice es una cadena de texto este metodo verifica
     * que cada indice del array sea un caracter, es decir sin numeros o caracteres especiales.
     * si no es una cadena de texto, arroja una Exception
     * 
     * @param  mixed $array
     * @return void
     */
    public function security_validation_caracteres($array)
    {
        try {
            for ($i = 0; $i < count($array); $i++) {
                $response = preg_match($this->expresion_caracteres, $array[$i]);

                if ($response == 0) {
                    //guardar datos de hacker

                    throw new Exception(sprintf("El dato que estas enviando debe ser una cadena de texto con solo letras. cadena de texto. no mayor a 19 caracteres-> '%s", $array[$i]), 422);
                }
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }


    //VALIDACION DE TELEFONO

    /**
     * security_validation_telefono
     *
     * Metodo que valida una cadena de texto con una expresion regular de telefono.si no cumple con la expresion regular
     * Se arroja una Exception.
     * @param  mixed $telefono
     * @return void
     */
    public function security_validation_telefono($telefono)
    {
        try {
            $response = preg_match($this->expresion_telefono, $telefono);

            if ($response == 0) {
                //guardar datos de hacker

                throw new Exception(sprintf("El telefono que enviaste no cumple con el formato de telefono adecuado. telefono-> '%s' ", $telefono), 422);
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }



    /**
     * security_validation_hora
     * 
     * Función que valida un array donde cada índice contiene una cadena de texto en formato de hora.
     * Verifica si cada cadena cumple con el formato de hora deseado (HH:MM:SS).
     * Si alguna cadena no cumple con el formato o está vacía, arroja una excepción.
     *
     * @param array $array
     * @return void
     */
    public function security_validation_hora($hora)
    {
        try {


            $response = preg_match($this->expresion_hora, $hora);

            if ($response === false) {
                // Error en la expresión regular
                throw new Exception("Error en la expresión regular de hora", 500);
            }

            if ($response === 0) {
                // La cadena no cumple con el formato de hora
                throw new Exception(sprintf("El formato de hora es inválido: '%s'", $hora), 422);
            }

            if ($hora === "") {
                // La cadena está vacía
                throw new Exception("La hora no puede estar vacía", 422);
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }
}

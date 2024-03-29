<?php

namespace Csr\Modelo;

use Csr\Modelo\Conexion;

use PDO;
use Exception;

class Discipulado extends Conexion
{
    private $conexion;
    private $id_modulo;

    private $listar;
    private $codigos;
    private $direccion;
    private $participantes;
    private $asistentes;
    private $cedula_participante;
    private $dia;
    private $hora;
    private $id;
    private $fecha;
    private $cedula_lider;
    private $cedula_anfitrion;
    private $cedula_asistente;
    private $busqueda;

    public function __construct()
    {
        $this->conexion = parent::conexion();
        $this->id_modulo = 6;
    }
    public function buscar_discipulado($busqueda)
    {
        $sql = ("SELECT *, lider.codigo 'cod_lider', anfitrion.codigo 'cod_anfitrion', asistente.codigo 'cod_asistente', lider.cedula 'ced_lider', anfitrion.cedula 'ced_anfitrion', asistente.cedula 'ced_asistente' 
        FROM celula_discipulado 
        JOIN usuarios AS lider ON celula_discipulado.cedula_lider = lider.cedula 
        JOIN usuarios AS anfitrion ON celula_discipulado.cedula_anfitrion = anfitrion.cedula 
        JOIN usuarios AS asistente ON celula_discipulado.cedula_asistente = asistente.cedula  
        WHERE codigo_celula_discipulado  LIKE '%" . $busqueda . "%' 
        OR fecha LIKE '%" . $busqueda . "%' 
        OR dia_reunion LIKE '%" . $busqueda . "%'
        OR hora LIKE '%" . $busqueda . "%'
        OR lider.codigo LIKE '%" . $busqueda . "%'
        OR anfitrion.codigo LIKE '%" . $busqueda . "%'
        OR asistente.codigo LIKE '%" . $busqueda . "%'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());


        if ($stmt->rowCount() > 0) {
            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                $this->busqueda[] = $filas;
            }
        }

        return $this->busqueda;
    }

    public function listar_usuarios_N2()
    {
        $resultado = [];
        $consulta = ("SELECT cedula,codigo FROM usuarios WHERE codigo LIKE '%N2%' OR codigo LIKE '%N3%'");

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
        try{
        $participantes = [];
        $sql = ("SELECT celula_discipulado.id, celula_discipulado.codigo_celula_discipulado AS codigo_celula,
        discipulos.cedula AS participantes_cedula, discipulos.nombre AS participantes_nombre,discipulos.apellido 
        AS participantes_apellido, discipulos.codigo AS participantes_codigo, discipulos.telefono AS participantes_telefono
        FROM celula_discipulado 
        INNER JOIN discipulos AS participantes ON celula_discipulado.id = participantes.id_discipulado
        INNER JOIN usuarios AS discipulos ON participantes.cedula = discipulos.cedula
        WHERE celula_discipulado.id = :id_discipulado");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(":id_discipulado"=>$id_discipulado));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $participantes[] = $filas;
        }

        $accion = "Listar Discipulos";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
        return $participantes;
        }catch(Exception $e){
        echo $e->getMessage();

        echo "Linea del error: " . $e->getLine();

        return false;
        }

    }

    public function listar_celula_discipulado_por_usuario()
    {
        try{
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
        }catch(Exception $e){
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
        RIGHT JOIN `reporte_celula_discipulado` as `rpd` ON `rpd`.`id_discipulado` = $id 
        WHERE `rp`.`fecha` BETWEEN '$fecha_inicio' AND '$fecha_final' AND `rp`.`id_discipulado` = $id AND `rpd`.`fecha` BETWEEN '$fecha_inicio' AND '$fecha_final' GROUP BY `usuarios`.`cedula`";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
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

        $sql = ("SELECT cedula, codigo FROM usuarios WHERE usuarios.cedula NOT IN (SELECT cedula FROM discipulos) 
         AND usuarios.cedula NOT IN (SELECT cedula_lider FROM celula_discipulado)
         AND usuarios.cedula NOT IN (SELECT cedula_anfitrion FROM celula_discipulado)
         AND usuarios.cedula NOT IN (SELECT cedula_asistente FROM celula_discipulado)");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->codigos[] = $filas;
        }

        return $this->codigos;
    }
    //------------------------------------------------------Registrar Asitencias de discipulado ----------------------//
    public function registrar_asistencias()
    {
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

        $accion = "Registrar Asistencias de celula de discipulado";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
    }
    //------------------------------------------------------Registrar discipulado ----------------------//
    public function registrar_discipulado()
    {
        try{
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

        $accion = "Registrar  celula de discipulado";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);

        return true;
        }catch(Exception $e){
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();
            return false;
        }
    }


    public function actualizar_discipulado()
    {
        try {
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
            //guardando en un array asociativo las cedulas
            $cedulas  = $stmt->fetch(PDO::FETCH_ASSOC);

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
                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo1','') WHERE cedula = :cedula_lider_antiguo");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(":cedula_lider_antiguo" => $cedula_lider_antiguo));
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
                    $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo2','') WHERE cedula = :cedula_anfitrion_antiguo");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array(":cedula_anfitrion_antiguo" => $cedula_anfitrion_antiguo));
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
                        $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo2','') WHERE cedula = :cedula_anfitrion_antiguo");

                        $stmt = $this->conexion()->prepare($sql);

                        $stmt->execute(array(":cedula_anfitrion_antiguo" => $cedula_anfitrion_antiguo));
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
                        $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo3','') WHERE cedula = :cedula_asistente_antiguo");

                        $stmt = $this->conexion()->prepare($sql);

                        $stmt->execute(array(":cedula_asistente_antiguo" => $cedula_asistente_antiguo));
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
            cedula_anfitrion = :cedula_anfitrion, cedula_asistente = :cedula_asistente, dia_reunion = :dia, fecha = :fecha , hora = :hora,
            direccion = :direc WHERE id= :id");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula_lider" => $this->cedula_lider,
                ":cedula_anfitrion" => $this->cedula_anfitrion, "cedula_asistente" => $this->cedula_asistente,
                ":dia" => $this->dia, ":fecha" => $this->fecha, ":hora" => $this->hora, ":direc"=>$this->direccion, 
                ":id" => $this->id
            ));

            $accion = "Editar datos de celula de discipulado";
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }


    public function agregar_participantes()
    {
        $sql = ("INSERT INTO discipulos (cedula,id_discipulado) VALUES (:cedula,:id)");

        foreach ($this->participantes as $participantes) {

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $participantes,
                ":id" => $this->id

            ));
        } //fin del foreach

    }

    public function eliminar_participantes($cedula_participante)
    {
        try {

           /*  $sql = ("SELECT id_discipulado FROM discipulos WHERE cedula = :cedula_participante");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":cedula_participante"=>$cedula_participante,
            ));
            $id_discipulado =$stmt->fetch(PDO::FETCH_ASSOC);

            $sql = ("SELECT codigo FROM celula_discipulado WHERE id = :id");

            $stmt=  $this->conexion()->prepare($sql);

            $stmt->execute(array(":id"=>$id_discipulado['id_discipulado']));

            $codigo_celula = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $codigo_celula = "-" . $codigo_celula;
            
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:codigo_discipulado,'') WHERE cedula = :cedula_participante");
            
            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo_disicpulado "=>$codigo_celula,
                ":cedula_participante"=>$cedula_participante
            ));
 */
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

    public function setActualizar($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora,$direccion, $id)
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



    public function setParticipantes($participantes, $id)
    {
        $this->participantes = $participantes;
        $this->id = $id;
    }
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
}

<?php
namespace Csr\Modelo;

use Csr\Modelo\Conexion;

use PDO;
use Exception;

class Consolidacion extends Conexion
{
    private $conexion;
    private $id_modulo;
    private $cedula_lider;
    private $cedula_anfitrion;
    private $cedula_asistente;
    private $asistentes;

    private $dia;
    private $hora;
    private $fecha;
    private $lider;
    private $anfitrion;
    private $asistente;
    private $codigo;
    private $id;
    private $busqueda;
    private $codigos;
    private $consolidacion;
    private $participantes;
    private $direccion;

    
    public function __construct()
    {
        $this->conexion = parent::conexion();
        $this->id_modulo = 6;
    }
    //-------------------------------------------------------Listar todas las celulas------------------------//
    public function listar()
    {
        $resultado = [];
        $sql = ("SELECT * FROM celula_consolidacion");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }
        return $resultado;
    }
    //------------------------------------------------------Listar participantes por celulal de consolidacion---------------------//
    public function listar_participantes($busqueda)
    {
        $resultado = [];
        $sql = ("SELECT celula_consolidacion.id, celula_consolidacion.codigo_celula_consolidacion AS codigo_celula,
        participantes.cedula AS participantes_cedula, participantes.nombre AS participantes_nombre,participantes.apellido 
        AS participantes_apellido, participantes.codigo AS participantes_codigo, participantes.telefono AS participantes_telefono
        FROM celula_consolidacion 
        INNER JOIN participantes_consolidacion AS consolidados ON celula_consolidacion.id = consolidados.id_consolidacion
        INNER JOIN usuarios AS participantes ON consolidados.cedula = participantes.cedula
        WHERE celula_consolidacion.id = :busqueda");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(":busqueda"=>$busqueda));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }
        return $resultado;
    }

    //-------------------------------------------------------Buscar consolidacion con Ajax---------------------//
    public function buscar_consolidacion($busqueda)
    {
        $sql = ("SELECT *, lider.codigo 'cod_lider', anfitrion.codigo 'cod_anfitrion', asistente.codigo 'cod_asistente', lider.cedula 'ced_lider', anfitrion.cedula 'ced_anfitrion', asistente.cedula 'ced_asistente' 
        FROM celula_consolidacion 
        JOIN usuarios AS lider ON celula_consolidacion.cedula_lider = lider.cedula 
        JOIN usuarios AS anfitrion ON celula_consolidacion.cedula_anfitrion = anfitrion.cedula 
        JOIN usuarios AS asistente ON celula_consolidacion.cedula_asistente = asistente.cedula  
        WHERE codigo_celula_consolidacion LIKE '%" . $busqueda . "%' 
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

    //LISTAR USUARIOS DE NIVEL 2 O 3
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


    //LISTAR USUARIOS QUE NO ESTEN INSCRIPTOS EN UNA CELULA DE CONSOLIDACION
    public function listar_no_participantes()
    {

        $sql = ("SELECT cedula, codigo FROM usuarios WHERE usuarios.cedula NOT IN  (SELECT cedula FROM participantes_consolidacion) 
        AND  codigo LIKE  '%N1%' 
        AND usuarios.cedula NOT IN (SELECT cedula_lider FROM celula_consolidacion)
        AND usuarios.cedula NOT IN (SELECT cedula_anfitrion FROM celula_consolidacion)
        AND usuarios.cedula NOT IN (SELECT cedula_asistente FROM celula_consolidacion)");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->codigos[] = $filas;
        }
        return $this->codigos;
    }

    

    //LISTAR REPORTE DE CELULA DE CONSOLIDACION
    public function listar_asistencias($id, $fecha_inicio, $fecha_final)
    {
        $resultado = [];
        try {
           
            $sql = "SELECT `rp`.`id_consolidacion`, `usuarios`.`nombre`, `usuarios`.`apellido`, `usuarios`.`telefono`, `usuarios`.`codigo`, COUNT(DISTINCT `rp`.`fecha`) as `asistencias`, COUNT(DISTINCT `rpd`.`fecha`) as `total` FROM `usuarios` 
            INNER JOIN `reporte_celula_consolidacion` AS `rp` ON `rp`.`cedula_participante` = `usuarios`.`cedula` 
            RIGHT JOIN `reporte_celula_consolidacion` as `rpd` ON `rpd`.`id_consolidacion` = $id 
            WHERE `rp`.`fecha` BETWEEN $fecha_inicio AND $fecha_final AND `rp`.`id_consolidacion` = $id AND `rpd`.`fecha` BETWEEN $fecha_inicio AND $fecha_final GROUP BY `usuarios`.`cedula`";

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());
            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultado[] = $filas;
            }

            return $resultado;

        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return $e;
        }
        
    }
    //-------------------------------------------------------Buscar datos de lider por celula----------------------//

    public function listar_celula_consolidacion()
    {
        $resultado = [];
        $sql = ("SELECT celula_consolidacion.id, celula_consolidacion.codigo_celula_consolidacion, celula_consolidacion.dia_reunion, celula_consolidacion.hora, 
        lider.codigo AS codigo_lider, lider.cedula AS cedula_lider,  
        anfitrion.codigo AS codigo_anfitrion, anfitrion.cedula AS cedula_anfitrion, 
        asistente.codigo AS codigo_asistente, asistente.cedula AS cedula_asistente
        FROM celula_consolidacion 
        INNER JOIN usuarios AS lider  ON   celula_consolidacion.cedula_lider = lider.cedula
        INNER JOIN usuarios AS anfitrion  ON   celula_consolidacion.cedula_anfitrion = anfitrion.cedula
        INNER JOIN usuarios AS asistente  ON   celula_consolidacion.cedula_asistente = asistente.cedula");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }
        $accion = "Listar celula de Consolidacion";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
        return $resultado;
    }
    //------------------------------------------------------Registrar Asitencias de consolidacion ----------------------//
    public function registrar_asistencias()
    {
        $sql = "INSERT INTO reporte_celula_consolidacion (id_consolidacion,cedula_participante,fecha) 
            VALUES(:id_consolidacion,:cedula_participante,:fecha)";

        $stmt = $this->conexion->prepare($sql);
        //recorriendo arreglo de asistentes
        foreach ($this->asistentes as $asistente) {
            $stmt->execute(array(
                ":id_consolidacion" => $this->id,
                ":cedula_participante" => $asistente,
                ":fecha" => $this->fecha
            ));
        } //fin del foeach

        $accion = "Registrar asistencias en celula de Consolidacion";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
    }

    //------------------------------------------------------Registrar consolidacion ----------------------//
    public function registrar_consolidacion()
    {
        try{
        //buscando ultimo id agregando
        $sql = ("SELECT MAX(id) AS id FROM celula_consolidacion");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        $contador = $stmt->fetch(PDO::FETCH_ASSOC);

        $id = $contador['id'];
        //sumandole un numero para que sea dinamico 
        $id++;

        $sql = "INSERT INTO celula_consolidacion (codigo_celula_consolidacion,cedula_lider,
        cedula_anfitrion,cedula_asistente,dia_reunion,fecha,hora) 
        VALUES(:codigo,:cedula_lider,:cedula_anfitrion,:cedula_asistente,:dia,:fecha,:hora)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute(array(
            ":codigo" => 'CC' . $id,
            ":cedula_lider" => $this->cedula_lider, ":cedula_anfitrion" => $this->cedula_anfitrion,
            ":cedula_asistente" => $this->cedula_asistente, ":dia" => $this->dia,
            ":fecha" => $this->fecha, ":hora" => $this->hora
        ));
        //---------Comienzo de funcion de pasar id foraneo con respecto a los participantes de la celula------------------------//
        //agregando codigo de celula a codigo de usuario
        //agregando a lider
        $sql = ("SELECT id FROM celula_consolidacion 
        WHERE cedula_lider= '$this->cedula_lider'
        AND cedula_anfitrion = '$this->cedula_anfitrion'
        AND cedula_asistente = '$this->cedula_asistente'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        $id_consolidacion  = $stmt->fetch(PDO::FETCH_ASSOC);

        foreach ($this->participantes as $participantes) {
            $sql = ("INSERT INTO participantes_consolidacion (cedula,id_consolidacion) VALUES (:cedula,:id) ");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $participantes,
                ":id" => $id_consolidacion['id']
            ));
        } //fin del foreach
        //id foraneo agregado por cada participante


        $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_lider'");

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());
        $codigo_lider  = $stmt->fetch(PDO::FETCH_ASSOC);


        $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":codigo" => $codigo_lider['codigo'] . '-' . 'CC' . $id,
            ":cedula" => $this->cedula_lider
        ));

        //comprobando que el anfitrion y el asistente sean la misma cedula
        if ($this->cedula_anfitrion == $this->cedula_asistente) {
            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_anfitrion'");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());

            $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = ("UPDATE usuarios SET codigo = :codigo  WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_anfitrion['codigo']  . '-' . 'CC' . $id,

                ":cedula" => $this->cedula_anfitrion
            ));

            //registrando en tabla intermediaria los anfitriones y asistentes
            $sql = ("INSERT INTO participantes_consolidacion (cedula,id_consolidacion) VALUES (:cedula,:id) ");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $this->cedula_anfitrion,
                ":id" => $id_consolidacion['id']
            ));
        } else {
            //agregando codigo de celula por separado de anfitrion y asistente
            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_anfitrion'");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());

            $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_anfitrion['codigo']  . '-' . 'CC' . $id,

                ":cedula" => $this->cedula_anfitrion
            ));

            //registrando en tabla intermediaria los anfitriones y asistentes
            $sql = ("INSERT INTO participantes_consolidacion (cedula,id_consolidacion) VALUES (:cedula,:id) ");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $this->cedula_anfitrion,
                ":id" => $id_consolidacion['id']
            ));


            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_asistente'");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array());

            $codigo_asistente  = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_asistente['codigo']  . '-' . 'CC' . $id,
                ":cedula" => $this->cedula_asistente
            ));

            //registrando en tabla intermediaria los anfitriones y asistentes
            $sql = ("INSERT INTO participantes_consolidacion (cedula,id_consolidacion) VALUES (:cedula,:id) ");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $this->cedula_asistente,
                ":id" => $id_consolidacion['id']
            ));
        } //fin del else

        $accion = "Registrar Consolidacion";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);

        return true;
    } catch (Exception $e) {

        echo $e->getMessage();

        echo "Linea del error: " . $e->getLine();

        return false;
    }
    }
    //---------------------------------------------------COMIENZO DE UPDATE-----------------------------------//
    public function update_consolidacion()
    {
        //buscando las cedulas de los usuarios por id de celula
        $sql = ("SELECT  celula_consolidacion.codigo_celula_consolidacion AS codigo_celula,  
        lider.codigo AS codigo_lider, lider.cedula AS cedula_lider,  
        anfitrion.codigo AS codigo_anfitrion, anfitrion.cedula AS cedula_anfitrion, 
        asistente.codigo AS codigo_asistente, asistente.cedula AS cedula_asistente
        FROM celula_consolidacion 
        INNER JOIN usuarios AS lider  ON   celula_consolidacion.cedula_lider = lider.cedula
        INNER JOIN usuarios AS anfitrion  ON   celula_consolidacion.cedula_anfitrion = anfitrion.cedula
        INNER JOIN usuarios AS asistente  ON   celula_consolidacion.cedula_asistente = asistente.cedula
        WHERE celula_consolidacion.id = '$this->id'");
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
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
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo1','') WHERE cedula = '$cedula_lider_antiguo'");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());
            //agregando el codigo a el usuario nuevo
            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_lider'");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array());
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
                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo2','') WHERE cedula = '$cedula_anfitrion_antiguo'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());
                //agregando el codigo a el usuario nuevo
                $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_anfitrion'");

                $stmt = $this->conexion()->prepare($sql);
                $stmt->execute(array());
                $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);


                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_anfitrion['codigo'] . '-' . $codigo,
                    ":cedula" => $this->cedula_anfitrion
                ));


                $sql = ("DELETE FROM participantes_consolidacion WHERE cedula = '$cedula_anfitrion_antiguo'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());

                $sql = ("INSERT INTO participantes_consolidacion (cedula,id_consolidacion) VALUES (:cedula,:id)");

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
                    $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo2','') WHERE cedula = '$cedula_anfitrion_antiguo'");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array());
                }
                //agregando el codigo a el usuario nuevo
                $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_anfitrion'");

                $stmt = $this->conexion()->prepare($sql);
                $stmt->execute(array());
                $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);


                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_anfitrion['codigo'] . '-' . $codigo,
                    ":cedula" => $this->cedula_anfitrion
                ));

                $sql = ("DELETE FROM participantes_consolidacion WHERE cedula = '$cedula_anfitrion_antiguo'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());

                $sql = ("INSERT INTO participantes_consolidacion (cedula,id_consolidacion) VALUES (:cedula,:id)");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $this->cedula_anfitrion,
                    ":id" => $this->id
                ));
            }
            if ($codigo_asistente_antiguo != $this->cedula_asistente) {
                if ($codigo_asistente_antiguo != $this->cedula_anfitrion) {
                    $codigo3 = '-' . $codigo;
                    $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo3','') WHERE cedula = '$cedula_asistente_antiguo'");

                    $stmt = $this->conexion()->prepare($sql);

                    $stmt->execute(array());
                }
                //agregando el codigo a el usuario nuevo
                $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_asistente'");

                $stmt = $this->conexion()->prepare($sql);
                $stmt->execute(array());
                $codigo_asistente  = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_asistente['codigo'] . '-' . $codigo,
                    ":cedula" => $this->cedula_asistente
                ));

                $sql = ("DELETE FROM participantes_consolidacion WHERE cedula = '$cedula_asistente_antiguo'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());

                $sql = ("INSERT INTO participantes_consolidacion (cedula,id_consolidacion) VALUES (:cedula,:id)");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $this->cedula_asistente,
                    ":id" => $this->id
                ));
            }


            $accion = "Actualizar Consolidacion";
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
        }

        $sql = ("UPDATE celula_consolidacion SET  cedula_lider = :cedula_lider , 
            cedula_anfitrion = :cedula_anfitrion, cedula_asistente = :cedula_asistente, dia_reunion = :dia, fecha = :fecha , hora = :hora WHERE id= :id");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":cedula_lider" => $this->cedula_lider,
            ":cedula_anfitrion" => $this->cedula_anfitrion, "cedula_asistente" => $this->cedula_asistente,
            ":dia" => $this->dia, ":fecha" => $this->fecha, ":hora" => $this->hora, ":id" => $this->id
        ));
    }
    //---------------------------------------------------FIN DE UPDATE------------------------------------//


    //---------------------------------------------------Agregar participantes------------------------------------//

    public function agregar_participantes()
    {
        $sql = ("INSERT INTO participantes_consolidacion (cedula,id_consolidacion) VALUES (:cedula,:id)");

        foreach ($this->participantes as $participantes) {

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id,
                ":cedula" => $participantes
            ));
        } //fin del foreach

        $accion = "Agregar participantes a una celula de consolidacion";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
    }

    //---------------------------------------------------Eliminar participantes------------------------------------//
    public function eliminar_participantes($cedula_participante)
    {
        $sql = ("DELETE FROM participantes_consolidacion WHERE cedula = '$cedula_participante'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());


        return true;
    }


    //-------- SET DATOS Para registar consolidacion-------------------------------------//
    public function setConsolidacion($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion, $participantes)
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
    //-------- SET actualizar para actualizar consolidacions-------------------------------------//
    public function setActualizar($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $id)
    {
        $this->cedula_lider = $cedula_lider;
        $this->cedula_anfitrion = $cedula_anfitrion;
        $this->cedula_asistente = $cedula_asistente;
        $this->dia = $dia;
        $this->hora = $hora;
        $this->fecha = gmdate("y-m-d", time());
        $this->id = $id;
    }


    //SET PARA REGISTRAR PARTICIPANTES
    public function setParticipantes($participantes, $id)
    {
        $this->participantes = $participantes;
        $this->id = $id;
    }
    //SET PARA REGISTRAR REPORTE
    public function setAsistencias($asistentes, $id, $fecha)
    {
        $this->asistentes = $asistentes;
        $this->id = $id;
        $this->fecha = $fecha;
    }


    //------------------------------------------------------Reportes estadisticos consultas ----------------------//

    //LISTAR CANTIDAD DE CELULAS DE CONSOLIDACION
    public function listar_cantidad_celulas_consolidacion($fecha_inicio, $fecha_final)
    {
        $resultado = [];
        $sql = ("SELECT COUNT(*) AS cantidad_consolidaciones, 
        MONTHNAME(fecha) AS mes
        FROM celula_consolidacion
        WHERE celula_consolidacion.fecha BETWEEN '$fecha_inicio-01' AND '$fecha_final-31'
        GROUP BY MONTHNAME(fecha)");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }

        return $resultado;
    }

    //LISTAR NUMERO DE PERSONAS GANADAS POR LIDER     
    public function listar_numero_personas_ganadas_por_lider($fecha_inicio, $fecha_final, $cedula_lider)
    {
        $sql = ("SELECT 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 1 THEN 1 ELSE 0 END) AS Enero, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 2 THEN 1 ELSE 0 END) AS Febrero, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 3 THEN 1 ELSE 0 END) AS Marzo, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 4 THEN 1 ELSE 0 END) AS Abril, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 5 THEN 1 ELSE 0 END) AS Mayo, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 6 THEN 1 ELSE 0 END) AS Junio, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 7 THEN 1 ELSE 0 END) AS Julio, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 8 THEN 1 ELSE 0 END) AS Agosto, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 9 THEN 1 ELSE 0 END) AS Septiembre, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 10 THEN 1 ELSE 0 END) AS Octubre, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 11 THEN 1 ELSE 0 END) AS Noviembre,
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 12 THEN 1 ELSE 0 END) AS Diciembre
        FROM celula_consolidacion
        INNER JOIN participantes_consolidacion ON  celula_consolidacion.id = participantes_consolidacion.id_consolidacion
        WHERE celula_consolidacion.fecha BETWEEN '$fecha_inicio-01' AND '$fecha_final-31'
        AND celula_consolidacion.cedula_lider='$cedula_lider'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    }
    //LISTAR CAMTODAD DE CELULAS DE CONSOLIDACION POR LIDER
    public function listar_cantidad_celulas_consolidacion_por_lider($fecha_inicio, $fecha_final, $cedula_lider)
    {
        $sql = ("SELECT 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 1 THEN 1 ELSE 0 END) AS Enero, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 2 THEN 1 ELSE 0 END) AS Febrero, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 3 THEN 1 ELSE 0 END) AS Marzo, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 4 THEN 1 ELSE 0 END) AS Abril, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 5 THEN 1 ELSE 0 END) AS Mayo, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 6 THEN 1 ELSE 0 END) AS Junio, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 7 THEN 1 ELSE 0 END) AS Julio, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 8 THEN 1 ELSE 0 END) AS Agosto, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 9 THEN 1 ELSE 0 END) AS Septiembre, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 10 THEN 1 ELSE 0 END) AS Octubre, 
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 11 THEN 1 ELSE 0 END) AS Noviembre,
        SUM(CASE WHEN MONTH(celula_consolidacion.fecha) = 12 THEN 1 ELSE 0 END) AS Diciembre
        FROM celula_consolidacion
        WHERE celula_consolidacion.fecha BETWEEN '$fecha_inicio-01' AND '$fecha_final-31'
        AND celula_consolidacion.cedula_lider='$cedula_lider'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        //inicializamos la variable de id con el modulo
        $this->id_modulo = 8;
        //accion que se realiza
        $accion = "Generado Reporte estadistico  de celula de consolidacion";
        //guardamos en una variable la cedula del que esta iniciado sesion
        $usuario = $_SESSION['cedula'];
        //usamos la funcion parent para llamar a una funcion heredada de la clase  conexion y registrar la bitacora
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
        return $resultado;
    }
}

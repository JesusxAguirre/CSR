<?php
require_once("clase_usuario.php");

class Consolidacion extends Usuarios
{

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
    }
    //-------------------------------------------------------Listar todas las celulas------------------------//
    public function listar()
    {
        $sql = ("SELECT * FROM celula_consolidacion");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listar[] = $filas;
        }
        return $this->listar;
    }
    //------------------------------------------------------Listar participantes por celulal de consolidacion---------------------//
    public function listar_participantes()
    {
        $sql = ("SELECT celula_consolidacion.id, celula_consolidacion.codigo_celula_consolidacion AS codigo_celula,
        participantes.cedula AS participantes_cedula, participantes.nombre AS participantes_nombre,participantes.apellido 
        AS participantes_apellido, participantes.codigo AS participantes_codigo, participantes.telefono AS participantes_telefono
        FROM celula_consolidacion 
        INNER JOIN usuarios AS participantes ON celula_consolidacion.id = participantes.id_consolidacion");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->participantes[] = $filas;
        }
        return $this->participantes;
    }

    //-------------------------------------------------------Buscar consolidacion con Ajax---------------------//
    public function buscar_consolidacion($busqueda)
    {
        $sql = ("SELECT *, lider.codigo 'cod_lider', anfitrion.codigo 'cod_anfitrion', asistente.codigo 'cod_asistente', lider.cedula 'ced_lider', anfitrion.cedula 'ced_anfitrion', asistente.cedula 'ced_asistente' FROM celula_consolidacion JOIN usuarios AS lider ON celula_consolidacion.cedula_lider = lider.cedula JOIN usuarios AS anfitrion ON celula_consolidacion.cedula_anfitrion = anfitrion.cedula JOIN usuarios AS asistente ON celula_consolidacion.cedula_asistente = asistente.cedula  
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

    public function listar_no_participantes()
    {

        $sql = ("SELECT cedula, codigo FROM usuarios WHERE id_consolidacion IS NULL 
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


    public function listar_asistencias_meses()
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
       WHERE celula_consolidacion.fecha BETWEEN '2022-01-01' AND '2022-12-31'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        $meses = $stmt->fetch(PDO::FETCH_ASSOC);

        return $meses;
    }


    public function listar_asistencias($id,$fecha_inicio,$fecha_final){
        $sql = ("SELECT COUNT(reporte_celula_consolidacion.fecha) AS numero_asistencias, reporte_celula_consolidacion.cedula_participante, usuarios.nombre,
        usuarios.codigo, usuarios.telefono
        FROM reporte_celula_consolidacion 
        INNER JOIN usuarios ON reporte_celula_consolidacion.cedula_participante = usuarios.cedula
        WHERE reporte_celula_consolidacion.fecha BETWEEN '$fecha_inicio' AND  '$fecha_final' 
        AND  reporte_celula_consolidacion.id_consolidacion = '$id'
        GROUP BY cedula_participante");
        
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->septiembre[] = $filas;
        }
        return $this->septiembre;
    }   
    //-------------------------------------------------------Buscar datos de lider por celula----------------------//

    public function listar_celula_consolidacion()
    {
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


            $this->consolidacion[] = $filas;
        }
        return $this->consolidacion;
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
    }

    //------------------------------------------------------Registrar consolidacion ----------------------//
    public function registrar_consolidacion()
    {
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
            $sql = ("UPDATE usuarios SET id_consolidacion = :id WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":id" => $id_consolidacion['id'],
                ":cedula" => $participantes
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
        } //fin del else
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
                ":codigo" => $codigo_lider['codigo'] . '-' . $this->codigo,
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
                    ":codigo" => $codigo_anfitrion['codigo'] . '-' . $this->codigo,
                    ":cedula" => $this->cedula_anfitrion
                ));
            }
        } else {
            if ($codigo_anfitrion_antiguo != $this->cedula_anfitrion) {

                $codigo2 = '-' . $codigo;
                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo2','') WHERE cedula = '$cedula_anfitrion_antiguo'");

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
                    ":codigo" => $codigo_lider['codigo'] . '-' . $this->codigo,
                    ":cedula" => $this->cedula_anfitrion
                ));
            }
            if ($codigo_asistente_antiguo != $this->cedula_asistente) {

                $codigo3 = '-' . $codigo;
                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo3','') WHERE cedula = '$cedula_asistente_antiguo'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());
                //agregando el codigo a el usuario nuevo
                $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_asistente'");

                $stmt = $this->conexion()->prepare($sql);
                $stmt->execute(array());
                $codigo_asistente  = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_asistente['codigo'] . '-' . $this->codigo,
                    ":cedula" => $this->cedula_asistente
                ));
            }
        }

        $sql = ("UPDATE celula_consolidacion SET codigo_celula_consolidacion= :codigo_celula, cedula_lider = :cedula_lider , 
            cedula_anfitrion = :cedula_anfitrion, cedula_asistente = :cedula_asistente, dia_reunion = :dia, fecha = :fecha , hora = :hora WHERE id= :id");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":codigo_celula" => $this->codigo, ":cedula_lider" => $this->cedula_lider,
            ":cedula_anfitrion" => $this->cedula_anfitrion, "cedula_asistente" => $this->cedula_asistente,
            ":dia" => $this->dia, ":fecha" => $this->fecha, ":hora" => $this->hora, ":id" => $this->id
        ));
    }
    //---------------------------------------------------FIN DE UPDATE------------------------------------//


    //---------------------------------------------------Agregar participantes------------------------------------//

    public function agregar_participantes()
    {
        $sql = ("UPDATE usuarios SET id_consolidacion= :id WHERE cedula = :cedula");

        foreach ($this->participantes as $participantes) {

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id,
                ":cedula" => $participantes
            ));
        } //fin del foreach


    }

    //---------------------------------------------------Eliminar participantes------------------------------------//
    public function eliminar_participantes()
    {
        $sql = ("UPDATE usuarios SET id_consolidacion  = NULL WHERE cedula = '$this->cedula_participante'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
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
    //-------- SET DATOS para actualizar consolidacions-------------------------------------//
    public function setDatos2($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $codigo, $id)
    {
        $this->cedula_lider = $cedula_lider;
        $this->cedula_anfitrion = $cedula_anfitrion;
        $this->cedula_asistente = $cedula_asistente;
        $this->dia = $dia;
        $this->hora = $hora;
        $this->fecha = gmdate("y-m-d", time());
        $this->codigo = $codigo;
        $this->id = $id;
    }

    public function setParticipante($cedula_participante)
    {
        $this->cedula_participante = $cedula_participante;
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
}

<?php
require_once("clase_usuario.php");
class Discipulado extends Usuarios
{

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
    private $septiembre;
    public function __construct()
    {
        $this->conexion = parent::conexion();
    }


    public function listar_celula_discipulado()
    {
        $sql = ("SELECT celula_discipulado.id, celula_discipulado.codigo_celula_discipulado, celula_discipulado.dia_reunion, celula_discipulado.hora, 
        lider.codigo AS codigo_lider,  anfitrion.codigo AS codigo_anfitrion, asistente.codigo AS codigo_asistente
        FROM celula_discipulado 
        INNER JOIN usuarios AS lider  ON   celula_discipulado.cedula_lider = lider.cedula
        INNER JOIN usuarios AS anfitrion  ON   celula_discipulado.cedula_anfitrion = anfitrion.cedula
        INNER JOIN usuarios AS asistente  ON   celula_discipulado.cedula_asistente = asistente.cedula");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listar[] = $filas;
        }
        return $this->listar;
    }
    public function listar_participantes()
    {
        $sql = ("SELECT celula_discipulado.id, celula_discipulado.codigo_celula_discipulado AS codigo_celula,
        participantes.cedula AS participantes_cedula, participantes.nombre AS participantes_nombre,participantes.apellido 
        AS participantes_apellido, participantes.codigo AS participantes_codigo, participantes.telefono AS participantes_telefono
        FROM celula_discipulado 
        INNER JOIN usuarios AS participantes ON celula_discipulado.id = participantes.id_discipulado");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->participantes[] = $filas;
        }
        return $this->participantes;
    }


    public function listar_asistencias_septiembre(){
        $sql = ("SELECT COUNT(reporte_celula_discipulado.fecha) AS numero_asistencias, reporte_celula_discipulado.cedula_participante, usuarios.nombre,
        usuarios.codigo, usuarios.telefono
        FROM reporte_celula_discipulado 
        INNER JOIN usuarios ON reporte_celula_discipulado.cedula_participante = usuarios.cedula
        WHERE reporte_celula_discipulado.fecha BETWEEN '2022-09-01' AND  '2022-09-31' 
        GROUP BY cedula_participante");
        
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->septiembre[] = $filas;
        }
        return $this->septiembre;
    }   

    public function listar_no_participantes()
    {

        $sql = ("SELECT cedula, codigo FROM usuarios WHERE id_discipulado IS NULL  AND usuarios.cedula NOT IN (SELECT cedula_lider FROM celula_discipulado);");

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
        foreach($this->asistentes AS $asistente){
        $stmt->execute(array(
            ":id_discipulado" => $this->id,
            ":cedula_participante" => $asistente, 
            ":fecha" => $this->fecha
        ));
        }//fin del foeach
    }
    //------------------------------------------------------Registrar discipulado ----------------------//
    public function registrar_discipulado()
    {
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


        //---------Comienzo de funcion de pasar id foraneo con respecto a los participantes de la celula------------------------//
        //primero vamos a buscar el id que queremos pasar como clave foranea

        $sql = ("SELECT id FROM celula_discipulado 
        WHERE cedula_lider= '$this->cedula_lider'
        AND cedula_anfitrion = '$this->cedula_anfitrion'
        AND cedula_asistente = '$this->cedula_asistente'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        $id_discipulado  = $stmt->fetch(PDO::FETCH_ASSOC);


        foreach ($this->participantes as $participantes) {
            $sql = ("UPDATE usuarios SET id_discipulado = :id WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":id" => $id_discipulado['id'],
                ":cedula" => $participantes
            ));
        } //fin del foreach
        //id foraneo agregado por cada participante



        //---------Comienzo de funcion de pasar id foraneo con respecto a el lider de la celula------------------------//
        //agregando codigo de celula a codigo de usuario
        //agregando a lider
        $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_lider'");

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());
        $codigo_lider  = $stmt->fetch(PDO::FETCH_ASSOC);


        $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":codigo" => $codigo_lider['codigo'] . '-' . 'CD' . $id,
            ":cedula" => $this->cedula_lider
        ));

        //comprobando que el anfitrion y el asistente sean la misma cedula
        if ($this->cedula_anfitrion == $this->cedula_asistente) {
            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_anfitrion'");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());

            $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = ("UPDATE usuarios SET codigo = :codigo, id_discipulado = :id WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_anfitrion['codigo']  . '-' . 'CD' . $id,
                ":id" => $id_discipulado['id'],
                ":cedula" => $this->cedula_anfitrion
            ));
        } else { //comienzo del ELSE y fin del IF
            //agregando codigo de celula por separado de anfitrion y asistente
            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_anfitrion'");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());

            $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = ("UPDATE usuarios SET codigo = :codigo, id_discipulado = :id WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_anfitrion['codigo']  . '-' . 'CD' . $id,
                ":id" => $id_discipulado['id'],
                ":cedula" => $this->cedula_anfitrion
            ));

            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_asistente'");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array());

            $codigo_asistente  = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = ("UPDATE usuarios SET codigo = :codigo, id_discipulado = :id WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_asistente['codigo']  . '-' . 'CD' . $id,
                ":id" => $id_discipulado['id'],
                ":cedula" => $this->cedula_asistente
            ));
        } //fin del else si el asitente de la celula y el anfitrion son distintos
    }


    public function actualizar_discipulado()
    {
        //buscando las cedulas de los usuarios por id de celula
        $sql = ("SELECT  celula_discipulado.codigo_celula_discipulado AS codigo_celula,  
        lider.codigo AS codigo_lider, lider.cedula AS cedula_lider,  
        anfitrion.codigo AS codigo_anfitrion, anfitrion.cedula AS cedula_anfitrion, 
        asistente.codigo AS codigo_asistente, asistente.cedula AS cedula_asistente
        FROM celula_discipulado 
        INNER JOIN usuarios AS lider  ON   celula_discipulado.cedula_lider = lider.cedula
        INNER JOIN usuarios AS anfitrion  ON   celula_discipulado.cedula_anfitrion = anfitrion.cedula
        INNER JOIN usuarios AS asistente  ON   celula_discipulado.cedula_asistente = asistente.cedula
        WHERE celula_discipulado.id = '$this->id'");
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
                    ":codigo" => $codigo_lider['codigo'] . '-' . $codigo,
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
                    ":codigo" => $codigo_asistente['codigo'] . '-' . $codigo,
                    ":cedula" => $this->cedula_asistente
                ));
            }
        }

        $sql = ("UPDATE celula_discipulado SET  cedula_lider = :cedula_lider , 
            cedula_anfitrion = :cedula_anfitrion, cedula_asistente = :cedula_asistente, dia_reunion = :dia, fecha = :fecha , hora = :hora WHERE id= :id");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":cedula_lider" => $this->cedula_lider,
            ":cedula_anfitrion" => $this->cedula_anfitrion, "cedula_asistente" => $this->cedula_asistente,
            ":dia" => $this->dia, ":fecha" => $this->fecha, ":hora" => $this->hora, ":id" => $this->id
        ));
    }


    public function agregar_participantes()
    {
        $sql = ("UPDATE usuarios SET id_discipulado= :id WHERE cedula = :cedula");

        foreach ($this->participantes as $participantes) {

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id,
                ":cedula" => $participantes
            ));
        } //fin del foreach

    }

    public function eliminar_participantes()
    {
        $sql = ("UPDATE usuarios SET id_discipulado  = NULL WHERE cedula = '$this->cedula_participante'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
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
//SELECT COUNT(*) AS numero_asistencias, cedula_participante FROM reporte_celula_discipulado WHERE MONTH(fecha) = 9 AND YEAR(fecha) = 2022 GROUP BY cedula_participante

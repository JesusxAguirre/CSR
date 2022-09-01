<?php
require_once("clase_usuario.php");

class Consolidacion extends Usuarios
{

    private $cedula_lider;
    private $cedula_anfitrion;
    private $cedula_asistente;
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
    //-------------------------------------------------------Buscar consolidacion con Ajax---------------------//
    public function buscar_consolidacion($busqueda){
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
  
        $sql = ("SELECT cedula, codigo FROM usuarios WHERE id_discipulado IS NULL AND usuarios.cedula NOT IN (SELECT cedula_lider FROM celula_discipulado);");
  
        $stmt = $this->conexion()->prepare($sql);
  
        $stmt->execute(array());
  
        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
  
  
            $this->codigos[] = $filas;
        }
        return $this->codigos;
    }

    //-------------------------------------------------------Buscar datos de lider por celula----------------------//
    public function listar_celula_consolidacion()
    {
        $celulas = $this->listar();
        $sql = ("SELECT cedula,codigo, nombre, apellido, telefono
        FROM usuarios 
        WHERE cedula = :cedula");
        $sql = $this->conexion()->prepare($sql);

        $index = 0;
        foreach ($celulas as $celula) {
            $this->cedula_lider = $celula['cedula_lider'];
            $this->cedula_anfitrion = $celula['cedula_anfitrion'];
            $this->cedula_asistente = $celula['cedula_asistente'];

            $sql->execute(array(":cedula" => $this->cedula_lider));


            while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {


                $celulas[$index]["lider"] = $filas;
            }
            $sql->execute(array(":cedula" => $this->cedula_anfitrion));
            while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {

                $celulas[$index]["anfitrion"] = $filas;
            }


            $sql->execute(array(":cedula" => $this->cedula_asistente));
            while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {

                $celulas[$index]['asistente']  = $filas;
            }


            $index++;
        }


        return $celulas;
    }
    //-------------------------------------------------------Buscar datos de anfitrion por celula----------------------//



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

        //agregando codigo de celula a codigo de usuario
        //agregando a lider
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

            $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

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
        }
    }
    //---------------------------------------------------COMIEZNO DE UPDATE-----------------------------------//
    public function update_consolidacion()
    {
        //buscando las cedulas de los usuarios por id de celula
        $sql = ("SELECT cedula_lider,cedula_anfitrion,cedula_asistente,codigo_celula_consolidacion FROM celula_consolidacion WHERE id = '$this->id'");
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        //guardando en un array asociativo las cedulas
        $cedulas  = $stmt->fetch(PDO::FETCH_ASSOC);
        $codigo = $cedulas['codigo_celula_consolidacion'];
        $codigo2 = $cedulas['codigo_celula_consolidacion']; //esto es porque aveces se sobreescribian la variable dependiendo de que if entrara entonces fue mas facil hacer 3 variables que arreglar eso
        $codigo3 = $cedulas['codigo_celula_consolidacion'];
        $cedula_lider = $cedulas['cedula_lider'];
        $cedula_anfitrion = $cedulas['cedula_anfitrion'];
        $cedula_asistente = $cedulas['cedula_asistente'];

        if ($cedula_lider == $this->cedula_lider) {
            //remplazando la cadena del codigo por la nueva
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo','$this->codigo') WHERE cedula = '$cedula_lider'");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());
        } //eliminando el codigo si se cambia el usuario
        else {
            $codigo = '-' . $codigo;
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo','') WHERE cedula = '$cedula_lider'");

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
                ":codigo" => $codigo_lider['codigo'] . $codigo,
                ":cedula" => $this->cedula_lider
            ));
        }
        //comprobando si las cedulas de anfitrion y asistente son iguales
        if ($cedula_anfitrion == $cedula_asistente) {
             //comprobando si las cedula anfitrion es igual a la mandada por el usuario si es igual deja el codigo como antes, si es difernete lo borra
            if ($cedula_anfitrion == $this->cedula_anfitrion) {

                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo','$this->codigo') WHERE cedula = '$cedula_anfitrion'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());
            } else {
            //aqui se borra el codigo del usuario que ya no pertenece a la celula
                $codigo2 = '-' . $codigo2;
                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo','') WHERE cedula = '$cedula_anfitrion'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());
                //aqui se asigna al nuevo usuario que seria el anfitrion
                $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_anfitrion'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());

                $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_anfitrion['codigo']  . $codigo2,
                    ":cedula" => $this->cedula_anfitrion
                ));
            }
        } else {  //entra en el else si las cedulas del anfitrion y la cedula del asistente
            if ($cedula_anfitrion == $this->cedula_anfitrion) {

                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo','$this->codigo') WHERE cedula = '$cedula_anfitrion'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());
            } else {

                $codigo2 = '-' . $codigo2;
                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo','') WHERE cedula = '$cedula_anfitrion'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());

                $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_anfitrion'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());

                $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_anfitrion['codigo']  . $codigo2,
                    ":cedula" => $this->cedula_anfitrion
                ));
            }
            if ($cedula_asistente == $this->cedula_asistente) {

                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo','$this->codigo') WHERE cedula = '$cedula_asistente'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());
            } else {

                $codigo3 = '-' . $codigo3;
                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$codigo','') WHERE cedula = '$cedula_asistente'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());

                $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_asistente'");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array());

                $codigo_asistente  = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_asistente['codigo']  . $codigo2,
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

    //-------- SET DATOS Para registar consolidacion-------------------------------------//
    public function setDatos($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora)
    {
        $this->cedula_lider = $cedula_lider;
        $this->cedula_anfitrion = $cedula_anfitrion;
        $this->cedula_asistente = $cedula_asistente;
        $this->dia = $dia;
        $this->hora = $hora;
        $this->fecha = gmdate("y-m-d", time());
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
}

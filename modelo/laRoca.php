<?php

namespace Csr\Modelo;

use Csr\Modelo\Conexion;

use PDO;
use Exception;
use DateTime;

use Throwable;

class LaRoca extends Conexion
{
    private $conexion;
    private $id_modulo;
    private $nombre_anfitrion;
    private $direccion;
    private $cantidad_integrantes;
    private $telefono;
    private $dia;
    private $hora;
    private $id;
    private $fecha;
    private $cedula_lider;
    private $CSR;
    private $hombres;
    private $mujeres;
    private $niños;
    private $confesiones;
    private $lideres;



    //PROPIEDADES PARA EXPRESIONES REGULARES DE REGISTRAR USUARIO

    private $expresion_telefono = "/^[0-9]{11}$/";

    private $expresion_especial = "/[^a-zA-Z0-9!@#$%^&*]/";

    private $expresion_codigo = "/^([^a-zA-Z0-9!@#$%^&-*])$/";

    private $expresion_cedula = "/^[0-9]{7,8}$/";

    private $expresion_numero = "/^[0-9]{1,200}$/";

    private $expresion_cantidad = "/^[0-9]{1,20}$/";

    private $expresion_caracteres = "/^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]{3,19}$/";

    private $expresion_hora = "/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/";


    public function __construct()
    {
        $this->conexion = parent::conexion();
        $this->id_modulo = 2;
        //LLAMADA DE FUNCION PARA VERIFICAR SI CASA SOBRE LA ROCA DEBERIA ESTAR DESINCORPORADA
        $this->actualizar_status_CSR();
    }
    //BUSCAR CSR CON FILTROS    
    /**
     * buscar_CSR
     *Metodo que se usa para una funcion de search en el back end
     * 
     * @param  mixed $busqueda
     * @return void
     */
    public function buscar_CSR($busqueda)
    {
        try {
            $resultado = [];
            $sql = ("SELECT *, lider.codigo 'cod_lider', lider.cedula 'ced_lider'
        FROM casas_la_roca 
        JOIN usuarios AS lider ON casas_la_roca.cedula_lider = lider.cedula 
        WHERE casas_la_roca.status = 1 AND 
        casas_la_roca .codigo LIKE '%" . $busqueda . "%' 
        OR fecha LIKE '%" . $busqueda . "%' 
        OR dia_visita LIKE '%" . $busqueda . "%'
        OR hora_pautada LIKE '%" . $busqueda . "%'
        OR direccion LIKE '%" . $busqueda . "%'
        OR lider.codigo LIKE '%" . $busqueda . "%' ");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());


            if ($stmt->rowCount() > 0) {
                while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                    $resultado[] = $filas;
                }
            }
            return $resultado;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();
            return false;
        }
    }
    //LISTAR USUARIOS DE NIVEL 2 Y 3    
    /**
     * listar_usuarios_N2
     *
     * Metodo que devuelve una lista de usuarios de nivel 2
     * @return void
     */
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

    //LISTAR LIDERES SIN CSR    
    /**
     * Metodo que devuelve los lideres uqe no tienen casa sobre la roca es usado en el dashboard
     * listar_lideres_sin_CSR
     *
     * @return void
     */
    public function listar_lideres_sin_CSR()
    {

        $sql = ("SELECT nombre,apellido,cedula, codigo FROM usuarios WHERE codigo LIKE  '%N2%' OR codigo LIKE '%N3%'
         AND usuarios.cedula NOT IN (SELECT cedula_lider FROM casas_la_roca WHERE status =1);");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->lideres[] = $filas;
        }
        $accion = "Listar lideres sin casa sobre la roca";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);


        return $this->lideres;
    }

    //LISTAR CSR    
    /**
     * listar_casas_la_roca
     * 
     * Metodo que se usa para listar todas las casas soobre la roca actuales
     *
     * @return void
     */
    public function listar_casas_la_roca()
    {
        try {
            $listar = [];
            $sql = ("SELECT casas_la_roca.id, casas_la_roca.codigo, casas_la_roca.cedula_lider, casas_la_roca.nombre_anfitrion, 
        casas_la_roca.telefono_anfitrion,casas_la_roca.cantidad_personas_hogar,casas_la_roca.dia_visita,
        casas_la_roca.fecha,casas_la_roca.hora_pautada,casas_la_roca.direccion, lider.codigo AS codigo_lider, lider.ruta_imagen
        FROM casas_la_roca 
        INNER JOIN usuarios AS lider  ON casas_la_roca.cedula_lider = lider.cedula
        WHERE casas_la_roca.status = 1");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                $listar[] = $filas;
            }

            if (isset($_SESSION['cedula'])) {

                $accion = "Listar casas sobre la roca";
                $usuario = $_SESSION['cedula'];
                parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            }

            return $listar;
        } catch (Exception $e) {

            return false;
        }
    }
    //LISTAR CASAS SOBRE LA ROCA DESINCORPORADAS ESTO ES PARA LOS REPORTES ESTADISITCOS    
    /**
     * listar_casas_la_roca_sin_status
     * Lista en el dashbaord las casas sobre la rocas que no tienen status de activo
     *
     * @return void
     */
    public function listar_casas_la_roca_sin_status()
    {
        $resultado = [];
        $sql = ("SELECT casas_la_roca.id, casas_la_roca.codigo, casas_la_roca.cedula_lider, casas_la_roca.nombre_anfitrion, 
        casas_la_roca.telefono_anfitrion,casas_la_roca.cantidad_personas_hogar,casas_la_roca.dia_visita,
        casas_la_roca.fecha,casas_la_roca.hora_pautada,casas_la_roca.direccion, lider.codigo AS codigo_lider
        FROM casas_la_roca 
        INNER JOIN usuarios AS lider  ON casas_la_roca.cedula_lider = lider.cedula
        ");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }
        return $resultado;
    }
    //ESTO ES PARA QUE NADIE QUE NO SEA EL USUARIO QUE CREO LA CSR NO PUEDA REPORTARLA ES UN TIPO VALIDACION POR BACKEND    
    /**
     * listar_casas_la_roca_por_usuario
     * funciona como una validacion por back end, para que otros usuarios manejen casas sobre la roca que no sean las suyas
     *
     * @return void
     */
    public function listar_casas_la_roca_por_usuario()
    {
        try {
            $resultado = [];
            $sql = "SELECT casas_la_roca.id, casas_la_roca.codigo, casas_la_roca.cedula_lider, casas_la_roca.nombre_anfitrion, 
            casas_la_roca.telefono_anfitrion,casas_la_roca.cantidad_personas_hogar,casas_la_roca.dia_visita,
            casas_la_roca.fecha,casas_la_roca.hora_pautada,casas_la_roca.direccion, lider.codigo AS codigo_lider, lider.ruta_imagen 
            FROM casas_la_roca 
            INNER JOIN usuarios AS lider ON lider.cedula = :cedulalider 
            WHERE casas_la_roca.status = 1 
            AND casas_la_roca.cedula_lider = :cedulalider";

            //$sql = ("SELECT * FROM casas_la_roca WHERE casas_la_roca.cedula_lider = (SELECT cedula FROM usuarios WHERE usuario = :usuario) AND casas_la_roca.status = 1 ");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedulalider" => $_SESSION['cedula']
            ));

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultado[] = $filas;
            }

            return $resultado;

        } catch (Throwable $ex) {

            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType, "linea del error" => $ex->getLine()));

            die();
        }
    }

    //REGISTRAR CASAS SOBRE LA ROCA    
    /**
     * registrar_CSR
     * FUNCION QUE REGISTRA CASAS SOBRE LA ROCA
     * @return void
     */
    public function registrar_CSR()
    {
        try {
            $sql = ("SELECT hora_pautada AS hora, dia_visita FROM casas_la_roca 
            WHERE cedula_lider = :cedula_lider");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula_lider" => $this->cedula_lider
            ));

            $hora = DateTime::createFromFormat('H:i', $this->hora);


            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($filas['dia_visita'] == $this->dia) {

                    $hora_filas_formateada = substr($filas['hora'], 0, 5);

                    $horas_base_de_datos = DateTime::createFromFormat('H:i', $hora_filas_formateada);

                    //calculando la diferencia entre horarios
                    $diferenciaMinutos = $hora->diff($horas_base_de_datos)->format('%i');

                    if ($diferenciaMinutos < 15) {
                        throw new Exception("Estás intentando registrar un horario de CSR que choca con otro horario. 
                        La diferencia debe ser de al menos 15 minutos.", 422);
                    }
                }
            }

            //buscando ultimo id agregando
            $sql = ("SELECT MAX(id) AS id FROM casas_la_roca");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());

            $contador = $stmt->fetch(PDO::FETCH_ASSOC);

            $id = $contador['id'];
            //sumandole un numero para que sea dinamico 
            $id++;

            $sql = "INSERT INTO casas_la_roca (codigo,cedula_lider,
            nombre_anfitrion,telefono_anfitrion,cantidad_personas_hogar,dia_visita,fecha,hora_pautada,direccion,status) 
            VALUES(:codigo,:cedula_lider,:nombre,:telefono,:cantidad,:dia,:fecha,:hora,:direc, :status)";

            $stmt = $this->conexion->prepare($sql);
            //foreach ($this->cedula_lider as $cedula_lider) {


            $stmt->execute(array(
                ":codigo" => 'CSR' . $id,
                ":cedula_lider" => $this->cedula_lider, ":nombre" => $this->nombre_anfitrion,
                ":telefono" => $this->telefono, ":cantidad" => $this->cantidad_integrantes,
                ":dia" => $this->dia,
                ":fecha" => $this->fecha, ":hora" => $this->hora,
                ":direc" => $this->direccion,
                ":status" => '1'
            ));
            //---------pasando codigo de CSR a lider de la casa sobre la roca------------------------//

            $sql = ("SELECT codigo FROM usuarios WHERE cedula = :cedula_lider");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(":cedula_lider" => $this->cedula_lider));
            $codigo_lider = $stmt->fetch(PDO::FETCH_ASSOC);


            $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_lider['codigo'] . '-' . 'CSR' . $id,
                ":cedula" => $this->cedula_lider
            ));
            //} //fin del foreach

            $accion = "Registrar casas sobre la roca";
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);


            http_response_code(200);
            echo json_encode(array("msj" => "Se ha registrado correctamente la casa sobre la roca", "status_code" => 200));

            die();
        } catch (Throwable $ex) {

            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType, "linea del error" => $ex->getLine()));

            die();
        }
    }




    /**
     * actualizar_CSR
     * Funcion que actualiza los datos de una casa sore la roca 
     *
     * @return array
     */
    public function actualizar_CSR()
    {
        try {
            //buscando las cedulas de los usuarios por id de celula
            $sql = ("SELECT  casas_la_roca.codigo AS codigo_celula, 
            casas_la_roca.nombre_anfitrion AS anfitrion, 
            casas_la_roca.telefono_anfitrion,
            casas_la_roca.cantidad_personas_hogar, casas_la_roca.dia_visita,casas_la_roca.hora_pautada,casas_la_roca.direccion,  
            lider.codigo AS codigo_lider, lider.cedula AS cedula_lider
            FROM casas_la_roca 
            INNER JOIN usuarios AS lider  ON   casas_la_roca.cedula_lider = lider.cedula
            WHERE casas_la_roca.id = :id");
            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":id" => $this->id));

            if ($stmt->rowCount() < 1) {
                throw new Exception("Esta casa sobre la roca no existe en la base de datos", 404);
            }

            //guardando en un array asociativo la CSR
            $cedulas = $stmt->fetch(PDO::FETCH_ASSOC);

            //COMPROBANDO QUE SE ENVIAN DATOS DIFERENTES
            if (
                $cedulas['cedula_lider'] == $this->cedula_lider and $cedulas['anfitrion'] == $this->nombre_anfitrion and
                $cedulas['telefono_anfitrion'] == $this->telefono and $cedulas['cantidad_personas_hogar'] == $this->cantidad_integrantes and
                $cedulas['dia_visita'] == $this->dia and $cedulas['hora_pautada'] == $this->hora and $cedulas['direccion'] == $this->direccion
            ) {
                throw new Exception("Estas enviando la solicitud sin modificar los datos", 422);
            }

            $codigo = $cedulas['codigo_celula'];
            $codigo1 = $cedulas['codigo_celula'];

            $cedula_lider_antiguo = $cedulas['cedula_lider'];


            $sql = ("SELECT hora_pautada AS hora, dia_visita, id FROM casas_la_roca 
            WHERE cedula_lider = :cedula_lider");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula_lider" => $this->cedula_lider
            ));

            $hora = DateTime::createFromFormat('H:i', $this->hora);


            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($filas['dia_visita'] == $this->dia and $filas['id'] != $this->id) {

                    $hora_filas_formateada = substr($filas['hora'], 0, 5);

                    $horas_base_de_datos = DateTime::createFromFormat('H:i', $hora_filas_formateada);

                    //calculando la diferencia entre horarios
                    $diferenciaMinutos = $hora->diff($horas_base_de_datos)->format('%i');

                    if ($diferenciaMinutos < 15) {
                        throw new Exception("Estás intentando registrar un horario de CSR que choca con otro horario. La diferencia debe ser de al menos 15 minutos.", 422);
                    }
                }
            }


            //VERIFICANDO QUE EL LIDER DE LA CASA SOBRE LA ROCA SEA EL MISMO QUE ANTES SI ES DISTINTO QUE EL ANTIGUO SE MODIFICA EL CODIGO DE AMBOS USUARIOS
            if ($cedula_lider_antiguo != $this->cedula_lider) {

                $codigo1 = '-' . $codigo;
                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,':codigo1','') WHERE cedula = :cedula_lider_antiguo");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo1" => $codigo1,
                    ":cedula_lider_antiguo" => $cedula_lider_antiguo,
                ));
                //agregando el codigo a el usuario nuevo
                $sql = ("SELECT codigo FROM usuarios WHERE cedula = :cedula_lider");

                $stmt = $this->conexion()->prepare($sql);
                $stmt->execute(array(":cedula_lider" => $this->cedula_lider));
                $codigo_lider = $stmt->fetch(PDO::FETCH_ASSOC);


                $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo" => $codigo_lider['codigo'] . '-' . $codigo,
                    ":cedula" => $this->cedula_lider
                ));
            }

            $sql = ("UPDATE casas_la_roca SET cedula_lider = :cedula_lider , 
            nombre_anfitrion = :nombre_anfitrion, 
            telefono_anfitrion = :telefono, cantidad_personas_hogar = :cantidad, 
            dia_visita = :dia, hora_pautada = :hora ,direccion = :direc
            WHERE id= :id");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula_lider" => $this->cedula_lider, ":nombre_anfitrion" => $this->nombre_anfitrion,
                ":telefono" => $this->telefono, ":cantidad" => $this->cantidad_integrantes,
                ":dia" => $this->dia, ":hora" => $this->hora,
                ":direc" => $this->direccion, ":id" => $this->id
            ));

            $accion = "Editar casa sobre la roca";
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);

            http_response_code(200);
            echo json_encode(array("msj" => "Se han actualizado correctamente los datos", "status_code" => 200, "filas afecadas" => $stmt->rowCount()));
            die();
        } catch (Throwable $ex) {



            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("hora" => $this->hora, "msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType, "linea del error" => $ex->getLine()));

            die();
        }
    }

    //---------Actualizar status cada 3 meses CSR------------------------//
    //ACTUALIZAR CASA SOBRE LA ROCAS CADA 3 MESES DESDE SU CREACION CON UNA ELIMINACION LOGICA
    public function actualizar_status_CSR()
    {

        $sql = ("SELECT id,codigo,cedula_lider,status
                FROM casas_la_roca  
                WHERE DATE_ADD(fecha, INTERVAL 90 DAY) < NOW();");
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {

            if ($filas["status"] == 1) {
                $codigo_csr = "-" . $filas['codigo'];
                $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:codigo_csr,'') WHERE cedula = :cedula_lider");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":codigo_csr" => $codigo_csr,
                    ":cedula_lider" => $filas['cedula_lider'],
                ));

                $sql = ("UPDATE casas_la_roca 
                        SET status  = 0  
                        WHERE id = :id");

                $stmt = $this->conexion()->prepare($sql);

                $stmt->execute(array(
                    ":id" => $filas["id"],
                ));

                if ($stmt->rowCount() >= 1) {

                    $accion = "Cierre casa sobre la roca";
                    $usuario = $_SESSION['cedula'];
                    parent::registrar_bitacora($usuario, $accion, $this->id_modulo);

                    return true;
                }
            }
        }
    }
    //---------registrar reporte de CSR------------------------//

    public function registrar_reporte_CSR()
    {
        try {

            $sql = "INSERT INTO reportes_casas (id_casa, cantidad_h,
            cantidad_m, cantidad_n, confesiones, fecha) 
            VALUES(:id_casa, :hombres, :mujeres, :cantidad_n, :confesiones, CURDATE())";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute(array(
                ":id_casa" => $this->CSR,
                ":hombres" => $this->hombres, 
                ":mujeres" => $this->mujeres,
                ":cantidad_n" => $this->niños, 
                ":confesiones" => $this->confesiones
                //":fecha" => $this->fecha
            ));

            $accion = "Registar reporte casa sobre la roca";
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);

            http_response_code(200);
            echo json_encode(array("msj" => "Registro de reporte exitoso"));
            die();
        } catch (Throwable $ex) {

            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("hora" => $this->hora, "msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType, "linea del error" => $ex->getLine()));

            die();
        }
    }
    //SET PARA ACTUALIZAR CSR
    public function setActualizar($cedula_lider, $nombre_anfitrion, $telefono_anfitrion, $cantidad, $direccion, $dia, $hora, $id)
    {
        $this->cedula_lider = $cedula_lider;
        $this->nombre_anfitrion = $nombre_anfitrion;
        $this->telefono = $telefono_anfitrion;
        $this->cantidad_integrantes = $cantidad;
        $this->direccion = $direccion;
        $this->dia = $dia;
        $this->hora = $hora;
        $this->id = $id;
    }

    //SET PARA REGISTRAR CSR
    public function setCSR($cedula_lider, $direccion, $nombre_anfitrion, $telefono, $dia, $hora, $cantidad_integrantes)
    {
        $this->cedula_lider = $cedula_lider;
        $this->direccion = $direccion;
        $this->nombre_anfitrion = $nombre_anfitrion;
        $this->telefono = $telefono;
        $this->hora = $hora;
        $this->dia = $dia;
        $this->cantidad_integrantes = $cantidad_integrantes;
        $this->fecha = gmdate("y-m-d", time());
    }
    //SET PARA REGISTRAR REPORTE
    public function setReporte($CSR, $hombres, $mujeres, $niños, $confesiones)
    {
        $this->CSR = $CSR;
        $this->hombres = $hombres;
        $this->mujeres = $mujeres;
        $this->niños = $niños;
        $this->confesiones = $confesiones;

        //$this->fecha = gmdate("y-m-d", time());
    }

    //------------------------------------------------------Reportes estadisticos consultas ----------------------//
    //MOSTRANDO CASAS SOBRE LA ROCA  CON ANIIO ACTUAL
    public function reporte_dashboard()
    {
        $año = date("Y");
        $sql = ("SELECT 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 1 THEN 1 ELSE 0 END) AS Enero, 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 2 THEN 1 ELSE 0 END) AS Febrero, 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 3 THEN 1 ELSE 0 END) AS Marzo, 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 4 THEN 1 ELSE 0 END) AS Abril, 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 5 THEN 1 ELSE 0 END) AS Mayo, 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 6 THEN 1 ELSE 0 END) AS Junio, 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 7 THEN 1 ELSE 0 END) AS Julio, 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 8 THEN 1 ELSE 0 END) AS Agosto, 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 9 THEN 1 ELSE 0 END) AS Septiembre, 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 10 THEN 1 ELSE 0 END) AS Octubre, 
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 11 THEN 1 ELSE 0 END) AS Noviembre,
        SUM(CASE WHEN MONTH(casas_la_roca.fecha) = 12 THEN 1 ELSE 0 END) AS Diciembre
        FROM casas_la_roca
        WHERE casas_la_roca.fecha BETWEEN '$año-01-01' AND '$año-12-31'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    }

    //------------------------------------------------------Count de casas sobre la roca abiertas ----------------------//
    //CONTAR CASAS SOBRE LA ROCAS ACTIVAS
    public function contar_CSR()
    {
        $sql = ("SELECT count(*) AS casas_abiertas FROM casas_la_roca WHERE status=1");
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    }
    //ESTA FUNCION BUSCA EL LIDER DEL MES 
    public function contar_asistencias_CSR()
    {
        $resultado = [];
        $sql = ("SELECT casas_la_roca.id,usuarios.nombre,usuarios.apellido, count(reportes_casas.fecha) AS casas_visitadas FROM casas_la_roca 
        INNER JOIN usuarios ON casas_la_roca.cedula_lider =usuarios.cedula 
        INNER JOIN reportes_casas ON casas_la_roca.id = reportes_casas.id_casa 
        WHERE MONTH(reportes_casas.fecha) = MONTH(CURRENT_DATE()) 
        AND YEAR(reportes_casas.fecha) = YEAR(CURRENT_DATE()) 
        GROUP BY casas_la_roca.id 
        ORDER BY casas_visitadas DESC;");
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultado[] = $filas;
        }

        return $resultado;
    }
    //CONTAR LIDERES DE CSR PARA DASHBOARD
    public function contar_lideres_CSR()
    {
        $sql = ("SELECT count(*) AS cantidad_lideres 
        FROM usuarios 
        WHERE codigo LIKE  '%N2%'
        AND usuarios.cedula IN (SELECT cedula_lider FROM casas_la_roca WHERE status =1)");
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    }

    //------------------------------------------------------Reportes estadisticos consultas ----------------------//
    public function listar_reporte_CSR($fecha_inicio, $fecha_final, $id_casa)
    {

        $resultado = [];
        $sql = ("SELECT SUM(confesiones) AS total_confesiones,
            SUM(cantidad_h)AS total_hombres , SUM(cantidad_m) AS total_mujeres,
            SUM(cantidad_n) AS total_niños, MONTHNAME(fecha) AS mes
            FROM reportes_casas
            WHERE reportes_casas.fecha BETWEEN '$fecha_inicio-01' AND '$fecha_final-31'
            AND reportes_casas.id_casa = '$id_casa'
            GROUP BY MONTHNAME(fecha)");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }

        $accion = "Generado Reporte estadistico  de casas sobre la roca";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);

        return $resultado;
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
    public function security_validation_cedula($cedula)
    {
        try {
            $response = preg_match($this->expresion_cedula, $cedula);

            if ($response == 0) {
                //guardar ataque de hacker

                throw new Exception(sprintf("Estas enviando una cedula invalida. cedula-> '%s' ", $cedula), 422);
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
     * security_validation_numero
     * 
     * Esta funcion generalmente valida un ID verificando con una expresion regular, si no cumple el patron devuelve una excepcion
     * 
     * @param  mixed $numero este parametro suele ser un ID
     * @return void
     */
    public function security_validation_numero($numero)
    {
        try {
            $response = preg_match($this->expresion_numero, $numero);
            if ($response == 0) {
                //guardar datos de hacker

                throw new Exception(sprintf("El id que enviaste no cumple con el formato de id adecuado. id-> '%s' ", $numero), 422);
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }

    /**
     * security_validation_cantidad
     *  
     * Esta funcion valida que no sean mas de 20 personas como poner como muchos en una casa
     * De no cumplir el patron devuelve una excepcion
     * 
     * @param  mixed $cantidad Este parametro es la cantidad de personas que viven en un hogar
     * @return void
     */
    public function security_validation_cantidad($array)
    {
        try {

            for ($i = 0; $i < count($array); $i++) {
                $response = preg_match($this->expresion_cantidad, $array[$i]);

                if ($response == 0) {
                    //guardar datos de hacker

                    throw new Exception(sprintf("El id que enviaste no cumple con el formato de id adecuado. id-> '%s' ", $array[$i]), 422);
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




































    ///////////////////////////////////////////////////////////// SECCION DE FUNCIONES QUE SE REUTILIZAN EN EL BACKEND ///////////////////////////////////////

    public function sanitizar_cadenas($cadena)
    {
        $cadena_minusculas = strtolower($cadena);
        $cadena_capitalizada = ucfirst($cadena_minusculas);
        return $cadena_capitalizada;
    }



    ///////////////////////////////////////////////////////////// SECCION DE VALIDACIONES BACKEND ///////////////////////////////////////////////////////////////




}

<?php
require_once("clase_conexion.php");
class LaRoca extends Conectar
{
    private $conexion;
    private $id_modulo;
    private $listar;
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
    private $busqueda;

    public function __construct()
    {
        $this->conexion = parent::conexion();
        $this->actualizar_status_CSR();
        $this->id_modulo =2;
    }

    public function buscar_CSR($busqueda)
    {
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


                $this->busqueda[] = $filas;
            }
        }
        return $this->busqueda;
    }
    public function listar_usuarios_N2()
    {
        $resultado =[];
        $consulta = ("SELECT cedula,codigo FROM usuarios WHERE codigo LIKE '%N2%' OR codigo LIKE '%N3%'");

        $sql = $this->conexion()->prepare($consulta);

        $sql->execute(array());

        while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }
        return $resultado;
    }


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
        parent::registrar_bitacora($usuario, $accion,$this->id_modulo);


        return $this->lideres;

    }

    public function listar_casas_la_roca()
    {

        $sql = ("SELECT casas_la_roca.id, casas_la_roca.codigo, casas_la_roca.cedula_lider, casas_la_roca.nombre_anfitrion, 
        casas_la_roca.telefono_anfitrion,casas_la_roca.cantidad_personas_hogar,casas_la_roca.dia_visita,
        casas_la_roca.fecha,casas_la_roca.hora_pautada,casas_la_roca.direccion, lider.codigo AS codigo_lider
        FROM casas_la_roca 
        INNER JOIN usuarios AS lider  ON casas_la_roca.cedula_lider = lider.cedula
        WHERE casas_la_roca.status = 1");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $listar[] = $filas;

        }

        $accion = "Listar casas sobre la roca";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion,$this->id_modulo);

        return $listar;
    }
    public function listar_casas_la_roca_sin_status()
    {

        $sql = ("SELECT casas_la_roca.id, casas_la_roca.codigo, casas_la_roca.cedula_lider, casas_la_roca.nombre_anfitrion, 
        casas_la_roca.telefono_anfitrion,casas_la_roca.cantidad_personas_hogar,casas_la_roca.dia_visita,
        casas_la_roca.fecha,casas_la_roca.hora_pautada,casas_la_roca.direccion, lider.codigo AS codigo_lider
        FROM casas_la_roca 
        INNER JOIN usuarios AS lider  ON casas_la_roca.cedula_lider = lider.cedula
        ");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $listar[] = $filas;
        }
        return $listar;
    }

    public function listar_casas_la_roca_por_usuario()
    {
        $usuario = $_SESSION['usuario'];
        $sql = ("SELECT casas_la_roca.id, casas_la_roca.codigo
        FROM casas_la_roca 
        WHERE casas_la_roca.cedula_lider = (SELECT cedula FROM usuarios WHERE usuario = '$usuario') AND casas_la_roca.status = 1 ");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listar[] = $filas;
        }
        return $this->listar;
    }

    public function registrar_CSR()
    {
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
        VALUES(:codigo,:cedula_lider,:nombre,:telefono,:cantidad,:dia,:fecha,:hora,:direc,1)";

        $stmt = $this->conexion->prepare($sql);
        foreach ($this->cedula_lider as $cedula_lider) {


            $stmt->execute(array(
                ":codigo" => 'CSR' . $id,
                ":cedula_lider" => $cedula_lider, ":nombre" => $this->nombre_anfitrion,
                ":telefono" => $this->telefono, ":cantidad" => $this->cantidad_integrantes,
                ":dia" => $this->dia,
                ":fecha" => $this->fecha, ":hora" => $this->hora,
                ":direc" => $this->direccion
            ));
            //---------pasando codigo de CSR a lider de la casa sobre la roca------------------------//

            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$cedula_lider'");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array());
            $codigo_lider  = $stmt->fetch(PDO::FETCH_ASSOC);


            $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_lider['codigo'] . '-' . 'CSR' . $id,
                ":cedula" => $cedula_lider
            ));
        } //fin del foreach

        $accion = "Registrar casas sobre la roca";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion,$this->id_modulo);
        return true;
    }



    //---------Actualizar CSR------------------------//

    public function actualizar_CSR()
    {
        //buscando las cedulas de los usuarios por id de celula
        $sql = ("SELECT  casas_la_roca.codigo AS codigo_celula,  
        lider.codigo AS codigo_lider, lider.cedula AS cedula_lider
        FROM casas_la_roca 
        INNER JOIN usuarios AS lider  ON   casas_la_roca.cedula_lider = lider.cedula
        WHERE casas_la_roca.id = '$this->id'");
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        //guardando en un array asociativo las cedulas
        $cedulas  = $stmt->fetch(PDO::FETCH_ASSOC);

        $codigo = $cedulas['codigo_celula'];
        $codigo1 = $cedulas['codigo_celula'];
        $codigo_lider_antiguo = $cedulas['codigo_lider'];
        $cedula_lider_antiguo = $cedulas['cedula_lider'];


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
        parent::registrar_bitacora($usuario, $accion,$this->id_modulo);
    }

    //---------Actualizar status cada 3 meses CSR------------------------//

    public function actualizar_status_CSR()
    {
        $sql = ("UPDATE casas_la_roca SET 
            status  = 0  
            WHERE DATE_ADD(fecha, INTERVAL 90 DAY) < NOW();");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        if($stmt->rowCount() >= 1){

        $accion = "Cierre casa sobre la roca";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion,$this->id_modulo);
 
        return true;
        }else{
            return true;
        }
    }
    //---------registrar reporte de CSR------------------------//

    public function registrar_reporte_CSR()
    {

        $sql = "INSERT INTO reportes_casas (id_casa,cantidad_h,
        cantidad_m,cantidad_n,confesiones,fecha) 
        VALUES(:id_casa,:hombres,:mujeres,:n,:confesiones,:fecha)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute(array(
            ":id_casa" => $this->CSR,
            ":hombres" => $this->hombres, ":mujeres" => $this->mujeres,
            ":n" => $this->niños, ":confesiones" => $this->confesiones,
            ":fecha" => $this->fecha
        ));

        $accion = "Registar reporte casa sobre la roca";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion,$this->id_modulo);

        return true;
    }

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
    public function setReporte($CSR, $hombres, $mujeres, $niños, $confesiones)
    {
        $this->CSR = $CSR;
        $this->hombres = $hombres;
        $this->mujeres = $mujeres;
        $this->niños = $niños;
        $this->confesiones = $confesiones;

        $this->fecha = gmdate("y-m-d", time());
    }

    //------------------------------------------------------Reportes estadisticos consultas ----------------------//
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

    public function contar_CSR()
    {
        $sql = ("SELECT count(*) AS casas_abiertas FROM casas_la_roca WHERE status=1");
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    }
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
        parent::registrar_bitacora($usuario, $accion,$this->id_modulo);
        
        return $resultado;
    }
}

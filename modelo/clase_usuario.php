<?php
require_once("clase_conexion.php");

class Usuarios extends Conectar
{

    private $conexion;
    private $usuario;
    private $clave;
    private $cedula;
    private $nombre;
    private $apellido;
    private $correo;
    private $telefono;
    private $estado;
    private $nacionalidad;
    private $permisos;
    private $listar;
    private $arreglo_n1;
    private $arreglo_n2;
    private $num_filas;
    private $rol;

    private $cedula_antigua;
    private $permiso_read_casa;
    private $permiso_create_casa;
    private $permiso_update_casa;
    private $permiso_read_usuarios;
    private $permiso_create_usuarios;
    private $permiso_update_usuarios;
    private $permiso_read_ecam;
    private $permiso_create_ecam;
    private $permiso_update_ecam;









    public function __construct()
    {
        $this->conexion = parent::conexion();
    }


    public function getIdRol($usuario)
    {
        $sql = "SELECT usuarios.id_rol FROM usuarios WHERE usuarios.usuario = '$usuario'";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        $idRol = $res['id_rol'];

        return $idRol;
    }

    public function registrar_bitacora($accion)
    {
        $usuario = $_SESSION['usuario'];
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
    public function listar_bitacora()
    {
        //$cedula= $_SESSION['cedula'];
        $sql = ("SELECT `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `fecha_registro`, `hora_registro`, `accion_realizada` FROM `bitacora_usuario` 
        INNER JOIN `usuarios` ON `usuarios`.`cedula` = `bitacora_usuario`.`cedula_usuario` ORDER BY `fecha_registro` DESC;");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $bitacora[] = $filas;
        }

        return $bitacora;
    }
    public function validar()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $ok = 0;
        $sql = $this->conexion->query("SELECT usuario,password FROM usuarios WHERE  usuario='$usuario' AND password='$clave'");
        $ok = $sql->rowCount();
        return $ok;
    }
    //==============mi perfil funcion=======// 
    public function mi_perfil(){
        $usuario = $_SESSION["usuario"];

        $sql = ("SELECT * FROM usuarios WHERE usuario='$usuario'");
        $stmt = $this->conexion()->prepare($sql);
        
        $stmt->execute(array());
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //==============Listar usuarios sin condicionales=======// 
    public function listar()
    {

        $consulta = ("SELECT  usuarios.cedula, usuarios.codigo, usuarios.nombre, usuarios.apellido, usuarios.telefono,
         usuarios.sexo, usuarios.estado_civil, usuarios.nacionalidad, usuarios.estado, usuarios.edad,
         roles.id AS id_rol ,roles.nombre AS nombre_rol
        FROM usuarios 
        INNER JOIN roles ON usuarios.id_rol = roles.id");

        $sql = $this->conexion()->prepare($consulta);

        $sql->execute(array());

        while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {


            $this->usuario[] = $filas;
        }
        $accion = "Listar todos los usuarios";
        $this->registrar_bitacora($accion);
        return $this->usuario;
    }
    public function buscar_cedula($cedula)
    {

        $sql = ("SELECT cedula FROM usuarios WHERE cedula = '$cedula'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        $resultado = $stmt->rowCount();

        return $resultado;
    }
    public function buscar_correo($correo)
    {

        $sql = ("SELECT usuario FROM usuarios WHERE usuario = '$correo'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        $resultado = $stmt->rowCount();

        return $resultado;
    }
    //============== Listar usuarios con condicional de lider =======// 
    public function listar_usuarios_N2()
    {

        $consulta = ("SELECT cedula,codigo FROM usuarios WHERE codigo LIKE  '%N2%'");

        $sql = $this->conexion()->prepare($consulta);

        $sql->execute(array());

        while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {


            $this->arreglo_n2[] = $filas;
        }
        return $this->arreglo_n2;
    }
    public function listar_usuarios_N1()
    {

        $sql = ("SELECT cedula,codigo FROM usuarios WHERE codigo LIKE  '%N1%'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->arreglo_n1[] = $filas;
        }
        $accion = "Listar todos los usuarios de nivel 1";
        $this->registrar_bitacora($accion);
        return $this->arreglo_n1;
    }
    //==============Buscar usuario por cedula, por nombre o por usuario, falta modificarlo para buscar por codigo =======// 
    public function buscar_usuario($busqueda)
    {


        $sql = ("SELECT usuarios.cedula,usuarios.codigo,usuarios.nombre,usuarios.apellido,usuarios.telefono,usuarios.sexo,usuarios.estado_civil,
        usuarios.nacionalidad,usuarios.estado,edad, roles.id AS id_rol ,roles.nombre AS nombre_rol
        FROM usuarios 
        INNER JOIN roles ON usuarios.id_rol = roles.id
        WHERE usuarios.codigo LIKE '%" . $busqueda . "%' 
        OR usuarios.nombre LIKE '%" . $busqueda . "%' 
        OR  usuarios.estado_civil LIKE '%" . $busqueda . "%' ");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        if ($stmt->rowCount() > 0) {
            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                $this->usuario[] = $filas;
            }
        }
        $accion = "Buscar usuarios";
        $this->registrar_bitacora($accion);

        return $this->usuario;
    }

    //============== Registrar usuarios en el inicio de sesion=======// 
    public  function registrar_usuarios()
    {

        $nacionalidad2 = substr($this->nacionalidad, 0, 2);
        $estado2 = substr($this->estado, 0, 2);
        $sexo2 = substr($this->sexo, 0, 1);
        $estadoc2 = substr($this->civil, 0, 1);
        $nacionalidad = strtoupper($nacionalidad2);
        $estado = strtoupper($estado2);
        $sexo = strtoupper($sexo2);
        $estadoc = strtoupper($estadoc2);

        $sql = "INSERT INTO usuarios (cedula,id_rol,
        codigo,nombre,apellido,edad,sexo,estado_civil,nacionalidad,estado,usuario,telefono,password) 
        VALUES(:ced,:id,:cod,:nom,:ape,:edad,:sexo,:estdc,:nacionalidad,:estado,:usuario,:telefono,:pass)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute(array(
            ":ced" => $this->cedula,
            ":id" => 2, ":cod" => $this->cedula . '-' . 'N1' . '-' . $nacionalidad . '-' . $estado . '-' . $sexo . '-' . $estadoc,
            ":nom" => $this->nombre, ":ape" => $this->apellido,
            ":edad" => $this->edad, ":sexo" => $this->sexo,
            ":estdc" => $this->civil, ":nacionalidad" => $this->nacionalidad,
            ":estado" => $this->estado, ":usuario" => $this->correo,
            ":telefono" => $this->telefono,
            ":pass" => $this->clave
        ));
    }


    public function update_usuarios()
    {
        //creando codigo de datos enviados por el usuario
        $nacionalidad2 = substr($this->nacionalidad, 0, 2);
        $estado2 = substr($this->estado, 0, 2);
        $sexo2 = substr($this->sexo, 0, 1);
        $estadoc2 = substr($this->civil, 0, 1);
        $nacionalidad = strtoupper($nacionalidad2);
        $estado = strtoupper($estado2);
        $sexo = strtoupper($sexo2);
        $estadoc = strtoupper($estadoc2);
        //buscando codigo viejo para suplantarlo por el nuevo
        $sql = ("SELECT codigo FROM usuarios WHERE cedula= '$this->cedula_antigua'");

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());
        $codigo_usuario  = $stmt->fetch(PDO::FETCH_ASSOC);

        //funcion para comprobar la longitud de la cedula dependiendo de eso la funcion substr cambia 
        $longitud_cedula_antigua = strlen($this->cedula_antigua);
        if ($longitud_cedula_antigua == 8) {
            $nacionalidad_antigua = substr($codigo_usuario['codigo'], 12, 2);
            $estado_antigua = substr($codigo_usuario['codigo'], 15, 2);
            $sexo_antigua = substr($codigo_usuario['codigo'], 18, 1);
            $estadoCivil_antigua = substr($codigo_usuario['codigo'], 20, 1);
        } else {
            $nacionalidad_antigua = substr($codigo_usuario['codigo'], 11, 2);
            $estado_antigua = substr($codigo_usuario['codigo'], 14, 2);
            $sexo_antigua = substr($codigo_usuario['codigo'], 17, 1);
            $estadoCivil_antigua = substr($codigo_usuario['codigo'], 19, 1);
        }
        //actualizando cedula en codigo
        $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$this->cedula_antigua','$this->cedula') WHERE cedula = '$this->cedula_antigua'");

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        //actualizando nacionalidad del codigo
        $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$nacionalidad_antigua','$nacionalidad') WHERE cedula = '$this->cedula_antigua'");
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        //actualizando estado del codigo
        $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$estado_antigua','$estado') WHERE cedula = '$this->cedula_antigua'");
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        //actualizando sexo del codigo
        $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$sexo_antigua','$sexo') WHERE cedula = '$this->cedula_antigua'");
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        //actualizando estado_civil del codigo
        $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,'$estadoCivil_antigua','$estadoc') WHERE cedula = '$this->cedula_antigua'");
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        //actualizando todos los datos menos el codigo que se hizo mas arriba
        $sql = ("UPDATE usuarios SET cedula = :cedula, id_rol = :rol, nombre = :nombre, apellido = :apellido, edad = :edad, sexo = :sexo, estado_civil = :estadoc 
        , nacionalidad = :nacionalidad , estado = :estado , telefono = :telefono WHERE cedula = :ced");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":cedula" => $this->cedula,
            ":rol" => $this->rol,
            ":nombre" => $this->nombre, ":apellido" => $this->apellido,
            ":edad" => $this->edad, ":sexo" => $this->sexo,
            ":estadoc" => $this->civil, ":nacionalidad" => $this->nacionalidad,
            ":estado" => $this->estado,
            ":telefono" => $this->telefono, ":ced" => $this->cedula_antigua
        ));

        $accion = "Editar datos de usuario";
        $this->registrar_bitacora($accion);
    }









    public function get_permisos()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave'");


        while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {


            $this->permisos[] = $filas;
        }
        return $this->permisos;
    }


    //==============Obtener Permisos casa sobre la roca =======// 
    public    function get_permiso_casa_read()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave' AND intermediaria.id_permisos ='1' AND intermediaria.id_modulos= '2'");

        $this->permiso_read_casa = $sql->rowCount();
        return $this->permiso_read_casa;
    }

    public   function get_permiso_casa_create()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave' AND intermediaria.id_permisos ='2' AND intermediaria.id_modulos= '2'");

        $this->permiso_create_casa = $sql->rowCount();
        return $this->permiso_create_casa;
    }
    function get_permiso_casa_update()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave' AND intermediaria.id_permisos ='3' AND intermediaria.id_modulos= '2'");

        $this->permiso_update_casa = $sql->rowCount();
        return $this->permiso_update_casa;
    }



    //==============Obtener Permisos ecam =======// 
    public function get_permiso_ecam_read()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave' AND intermediaria.id_permisos ='1' AND intermediaria.id_modulos= '3'");

        $this->permiso_read_ecam = $sql->rowCount();
        return $this->permiso_read_ecam;
    }
    public function get_permiso_ecam_create()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave' AND intermediaria.id_permisos ='2' AND intermediaria.id_modulos= '3'");

        $this->permiso_read_ecam = $sql->rowCount();
        return $this->permiso_create_ecam;
    }
    public   function get_permiso_ecam_update()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave' AND intermediaria.id_permisos ='3' AND intermediaria.id_modulos= '3'");

        $this->permiso_read_ecam = $sql->rowCount();
        return $this->permiso_update_ecam;
    }




    //==============Obtener Permisos usuarios =======// 

    public function get_permiso_usuarios_read()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave' AND intermediaria.id_permisos ='1' AND intermediaria.id_modulos= '1'");

        $this->permiso_read_usuarios = $sql->rowCount();
        return $this->permiso_read_usuarios;
    }
    public function get_permiso_usuarios_create()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave' AND intermediaria.id_permisos ='2' AND intermediaria.id_modulos= '1'");

        $this->permiso_create_usuarios = $sql->rowCount();
        return $this->permiso_create_usuarios;
    }
    public function get_permiso_usuarios_update()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave' AND intermediaria.id_permisos ='3' AND intermediaria.id_modulos= '1'");

        $this->permiso_update_usuarios = $sql->rowCount();
        return $this->permiso_update_usuarios;
    }
    public function get_permiso_usuarios_delete()
    {
        $usuario = $_SESSION['usuario'];
        $clave = $_SESSION['clave'];
        $sql = $this->conexion->query("SELECT intermediaria.id_rol, intermediaria.id_permisos, intermediaria.id_modulos FROM intermediaria 
        INNER JOIN roles  ON  intermediaria.id_rol = roles.id
        INNER JOIN usuarios ON roles.id = usuarios.id_rol
        WHERE usuarios.usuario = '$usuario' AND usuarios.password = '$clave' AND intermediaria.id_permisos ='4' AND intermediaria.id_modulos= '1'");

        $this->permiso_delete_usuarios = $sql->rowCount();
        return $this->permiso_delete_usuarios;
    }



    public function setUsuarios($nombre, $apellido, $cedula, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo, $clave)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->edad = $edad;
        $this->sexo = $sexo;
        $this->civil = $civil;
        $this->nacionalidad = $nacionalidad;
        $this->estado = $estado;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->clave = $clave;
    }
    public function setUpdate($nombre, $apellido, $cedula, $cedula_antigua, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $rol)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->cedula_antigua = $cedula_antigua;
        $this->edad = $edad;
        $this->sexo = $sexo;
        $this->civil = $civil;
        $this->nacionalidad = $nacionalidad;
        $this->estado = $estado;
        $this->telefono = $telefono;
        $this->rol = $rol;
    }
}

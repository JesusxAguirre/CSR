<?php

namespace Csr\Modelo;

use Csr\Exception\Usuarios\InvalidData as InvalidData;
use Csr\Exception\Usuarios\UserNotExist as UserNotExist;
use Csr\Modelo\Conexion;
use PDO;
use Exception;


use Throwable;

class Usuarios extends Conexion
{
    //ATRIBUTOS PARA HERENCIA
    private $conexion;

    ///PROPIEDADES DE LA MISMA CLASE/////

    private $id_modulo;

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

    private $rol;

    private $edad;

    private $sexo;

    private $civil;

    private $cedula_antigua;

    //PROPIEDAS PARA GUARDAR IMAGEN

    private $nombre_imagen;
    private $tipo_imagen;
    private $tamaño_imagen;
    private $carpeta_destino;

    //PROPIEDADES PARA EXPRESIONES REGULARES DE REGISTRAR USUARIO
    private $expresion_clave = "/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/";

    private $expresion_correo = "/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i";

    private $expresion_telefono = "/^[0-9]{11}$/";

    public function __construct()
    {
        $this->conexion = parent::conexion();
        $this->id_modulo = 1;
    }

    //BUSCAR ID DE ROL DE USUARIO
    public function getIdRol($usuario)
    {
        $sql = "SELECT usuarios.id_rol FROM usuarios WHERE usuarios.usuario = :usuario";



        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(":usuario" => $usuario));

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        $idRol = $res['id_rol'];

        return $idRol;
    }

    //LISTAR BITACORA
    public function listar_bitacora()
    {
        //$cedula= $_SESSION['cedula'];
        $sql = "SELECT `modulos`.`nombre` AS `nombreModulo`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `fecha_registro`, `hora_registro`, `accion_realizada` 
        FROM `bitacora_usuario` INNER JOIN `usuarios` ON `bitacora_usuario`.`cedula_usuario` = `usuarios`.`cedula` INNER JOIN `modulos` ON `modulos`.`id` = `bitacora_usuario`.`id_modulo` 
        ORDER BY `bitacora_usuario`.`fecha_registro` DESC, `bitacora_usuario`.`hora_registro` DESC";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $bitacora[] = $filas;
        }

        return $bitacora;
    }
    //VALIDACION DE ENTRADA PARA USUARIOS
    public function validar()
    {
        try {
            $usuario = $_SESSION['usuario'];
            $clave = $_SESSION['clave'];

            $sql = ("SELECT usuario,password FROM usuarios WHERE  usuario= :usuario ");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":usuario" => $usuario));


            if ($stmt->rowCount() > 0) {
                while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    if (password_verify($clave, $resultado['password'])) {
                     http_response_code(200);
                     echo json_encode(array("msj" => "Has Iniciado sesion correctamente", "status_code" => 200));
                    } else {
                        throw new InvalidData("Algo esta equivocado en la clave o el usuario");
                    }
                }
            } else {
                throw new UserNotExist();
            }
        } catch (Throwable $ex) {



            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode( array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));

            die();
        }
    }
    //BUSCAR DATOS DE USUARIO PARA COLOCARLOS EN LA VISTA DE MI PERFIL
    public function mi_perfil()
    {
        $usuario = $_SESSION["usuario"];

        $sql = ("SELECT * FROM usuarios WHERE usuario=:usuario");
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(":usuario" => $usuario));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //LISTAR USUARIOS 
    public function listar()
    {

        $resultado = [];
        $sql = ("SELECT  usuarios.cedula, usuarios.codigo, usuarios.nombre, usuarios.apellido, usuarios.telefono,
         usuarios.sexo, usuarios.estado_civil, usuarios.nacionalidad, usuarios.estado, usuarios.edad,
         roles.id AS id_rol ,roles.nombre AS nombre_rol
        FROM usuarios 
        INNER JOIN roles ON usuarios.id_rol = roles.id");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }

        $accion = "Listar todos los usuarios";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);

        return $resultado;
    }


    //BUSCAR CEDULA SI EXISTE EN REGISTRAR USUARIO
    public function buscar_cedula($cedula)
    {
        try {
            $sql = ("SELECT cedula FROM usuarios WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":cedula" => $cedula));

            $resultado = $stmt->rowCount();

            return $resultado;
        } catch (Exception $e) {

            return false;
        }
    }
    //BUSCAR SI CEDULA YA EXISTE EN MENU PERFIL
    public function buscar_cedula_perfil($cedula)
    {
        try {
            $matriz_usuario = $this->mi_perfil();

            foreach ($matriz_usuario as $usuario) {
                $cedula_antigua = $usuario['cedula'];
            }
            $sql = ("SELECT cedula FROM usuarios WHERE cedula != :cedula_antigua AND cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula_antigua" => $cedula_antigua,
                ":cedula" => $cedula
            ));

            $resultado = $stmt->rowCount();

            return $resultado;
        } catch (Exception $e) {

            return false;
        }
    }
    //BUSCAR CORREO EN REGISTRAR USUARIOS
    public function buscar_correo($correo)
    {
        try {

            $sql = ("SELECT usuario FROM usuarios WHERE usuario = :correo");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":correo" => $correo));

            $resultado = $stmt->rowCount();

            return $resultado;
        } catch (Exception $e) {

            return false;
        }
    }

    //BUSCAR CORREO EN MI PERFIL
    public function buscar_correo_perfil($correo)
    {
        try {
            $matriz_usuario = $this->mi_perfil();

            foreach ($matriz_usuario as $usuario) {
                $correo_antiguo = $usuario['usuario'];
            }

            $sql = ("SELECT usuario FROM usuarios WHERE usuario != :correo_antiguo AND usuario = :correo");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":correo_antiguo" => $correo_antiguo,
                ":correo" => $correo
            ));

            $resultado = $stmt->rowCount();

            return $resultado;
        } catch (Exception $e) {

            return false;
        }
    }

    //============== Listar usuarios DE NIVEL 2 Y 3=======// 
    public function listar_usuarios_N2()
    {

        $consulta = ("SELECT cedula,codigo FROM usuarios WHERE codigo LIKE '%N2%' OR codigo LIKE '%N3%'");

        $sql = $this->conexion()->prepare($consulta);

        $sql->execute(array());

        while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {


            $this->arreglo_n2[] = $filas;
        }
        return $this->arreglo_n2;
    }
    //LISTAR USUARIOS DE NIVEL1
    public function listar_usuarios_N1()
    {

        $sql = ("SELECT cedula,codigo FROM usuarios WHERE codigo LIKE  '%N1%'");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->arreglo_n1[] = $filas;
        }
        $accion = "Listar todos los usuarios de nivel 1";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
        return $this->arreglo_n1;
    }
    //==============Buscar usuario por cedula, por nombre o, estado civil y codigo  =======// 
    public function buscar_usuario($busqueda)
    {
        $resultado = [];
        $busqueda = '%' . $busqueda . '%';
        $sql = ("SELECT usuarios.cedula,usuarios.codigo,usuarios.nombre,usuarios.apellido,usuarios.telefono,usuarios.sexo,usuarios.estado_civil,
        usuarios.nacionalidad,usuarios.estado,usuarios.edad, roles.id AS id_rol ,roles.nombre AS nombre_rol
        FROM usuarios 
        INNER JOIN roles ON usuarios.id_rol = roles.id
        WHERE usuarios.codigo LIKE '%" . $busqueda . "%' 
        OR usuarios.nombre LIKE '%" . $busqueda . "%' 
        OR  usuarios.estado_civil LIKE '%" . $busqueda . "%' ");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":busqueda1" => $busqueda,
            ":busqueda2" => $busqueda,
            ":busqueda3" => $busqueda,
        ));

        if ($stmt->rowCount() > 0) {
            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                $resultado[] = $filas;
            }
        }
        $accion = "Buscar usuarios";
        $usuario = $_SESSION['cedula'];
        parent::registrar_bitacora($usuario, $accion, $this->id_modulo);

        return $resultado;
    }

    //REGISTRO DE USUARIOS
    public  function registrar_usuarios()
    {
        try {
            //ESTAS FUNCIONES DE SUBTR ES PARA HACER EL CODIGO DE CADA USUARIO
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

            //ENCRIPTANDO CLAVE
            $stmt = $this->conexion->prepare($sql);

            $this->clave = password_hash($this->clave, PASSWORD_DEFAULT);
            $stmt->execute(array(
                ":ced" => $this->cedula,
                ":id" => 3, ":cod" => $this->cedula . '-' . 'N1' . '-' . $nacionalidad . '-' . $estado . '-' . $sexo . '-' . $estadoc,
                ":nom" => $this->nombre, ":ape" => $this->apellido,
                ":edad" => $this->edad, ":sexo" => $this->sexo,
                ":estdc" => $this->civil, ":nacionalidad" => $this->nacionalidad,
                ":estado" => $this->estado, ":usuario" => $this->correo,
                ":telefono" => $this->telefono,
                ":pass" => $this->clave
            ));

            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return $e;
        }
    }

    //ACTUALIZAR USUARIOS
    public function update_usuarios()
    {
        try {
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
            $sql = ("SELECT codigo FROM usuarios WHERE cedula= :cedula_antigua");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(":cedula_antigua" => $this->cedula_antigua));
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
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:cedula_antigua,:cedula) WHERE cedula = :ced");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":cedula_antigua" => $this->cedula_antigua,
                ":cedula" => $this->cedula,
                ":ced" => $this->cedula_antigua
            ));

            //actualizando nacionalidad del codigo
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:nacionalidad_antigua,:nacionalidad) WHERE cedula = :cedula_antigua");
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":nacionalidad_antigua" => $nacionalidad_antigua,
                ":nacionalidad" => $nacionalidad,
                ":cedula_antigua" => $this->cedula_antigua
            ));

            //actualizando estado del codigo
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:estado_antigua,:estado) WHERE cedula = :cedula_antigua");
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":estado_antigua" => $estado_antigua,
                ":estado" => $estado,
                ":cedula_antigua" => $this->cedula_antigua
            ));

            //actualizando sexo del codigo
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:sexo_antigua,:sexo) WHERE cedula = :cedula_antigua");
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":sexo_antigua" => $sexo_antigua,
                ":sexo" => $sexo,
                ":cedula_antigua" => $this->cedula_antigua
            ));

            //actualizando estado_civil del codigo
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo, :estadoCivil_antigua,:estadoc) WHERE cedula = :cedula_antigua");
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":estadoCivil_antigua" => $estadoCivil_antigua,
                ":estadoc" => $estadoc,
                ":cedula_antigua" => $this->cedula_antigua
            ));


            //cambiando datos ingresados con mayusculas o minisculas
            $this->nombre = strtolower($this->nombre);

            $this->nombre = ucfirst($this->nombre);
            //lo mismo con el apellido
            $this->apellido = strtolower($this->apellido);

            $this->apellido = ucfirst($this->apellido);
            //Lo mismo con la nacionalidad
            $this->nacionalidad = strtolower($this->nacionalidad);

            $this->nacionalidad = ucfirst($this->nacionalidad);
            //Lo mismo con la estado
            $this->estado = strtolower($this->estado);

            $this->estado = ucfirst($this->estado);

            //actualizando todos los datos menos el codigo que se hizo mas arriba
            $sql = ("UPDATE usuarios SET cedula = :cedula, id_rol = :rol, nombre = :nombre, apellido = :apellido, 
            edad = :edad, sexo = :sexo, estado_civil = :estadoc ,nacionalidad = :nacionalidad , estado = :estado,
            telefono = :telf WHERE cedula = :ced");



            $stmt = $this->conexion()->prepare($sql);



            $stmt->execute(array(
                ":cedula" => $this->cedula,
                ":rol" => $this->rol,
                ":nombre" => $this->nombre, ":apellido" => $this->apellido,
                ":edad" => $this->edad, ":sexo" => $this->sexo,
                ":estadoc" => $this->civil, ":nacionalidad" => $this->nacionalidad,
                ":estado" => $this->estado,
                ":telf" => $this->telefono, ":ced" => $this->cedula_antigua
            ));



            $accion = "Editar datos de usuario";
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return $e;
        }
    }

    //ACTUALIZAR USUARIOS SIN ROL
    public function update_usuarios_sin_rol()
    {
        try {
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
            $sql = ("SELECT codigo FROM usuarios WHERE cedula= :cedula_antigua");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(":cedula_antigua" => $this->cedula_antigua));
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
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:cedula_antigua,:cedula) WHERE cedula = :cedula_antigua_condicion");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":cedula_antigua" => $this->cedula_antigua,
                ":cedula" => $this->cedula,
                ":cedula_antigua_condicion" => $this->cedula_antigua,
            ));

            //actualizando nacionalidad del codigo
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:nacionalidad_antigua,:nacionalidad) WHERE cedula = :cedula_antigua");
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":nacionalidad_antigua" => $nacionalidad_antigua,
                ":nacionalidad" => $nacionalidad,
                ":cedula_antigua" => $this->cedula_antigua,
            ));

            //actualizando estado del codigo
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:estado_antigua,:estado) WHERE cedula = :cedula_antigua");
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":estado_antigua" => $estado_antigua,
                ":estado" => $estado,
                ":cedula_antigua" => $this->cedula_antigua,
            ));

            //actualizando sexo del codigo
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:sexo_antigua,:sexo) WHERE cedula = :cedula_antigua");
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":sexo_antigua" => $sexo_antigua,
                ":sexo" => $sexo,
                ":cedula_antigua" => $this->cedula_antigua,
            ));

            //actualizando estado_civil del codigo
            $sql = ("UPDATE usuarios SET codigo = REPLACE(codigo,:estadoCivil_antigua,:estadoc) WHERE cedula = :cedula_antigua");
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":estadoCivil_antigua" => $estadoCivil_antigua,
                ":estadoc" => $estadoc,
                ":cedula_antigua" => $this->cedula_antigua,
            ));

            //actualizando todos los datos menos el codigo que se hizo mas arriba
            $sql = ("UPDATE usuarios SET cedula = :cedula, nombre = :nombre, apellido = :apellido, edad = :edad, sexo = :sexo, estado_civil = :estadoc 
        , nacionalidad = :nacionalidad , estado = :estado , telefono = :telefono, usuario = :usuario, password = :clave WHERE cedula = :ced");

            $stmt = $this->conexion()->prepare($sql);

            $this->clave = password_hash($this->clave, PASSWORD_DEFAULT);

            $stmt->execute(array(
                ":cedula" => $this->cedula,
                ":nombre" => $this->nombre, ":apellido" => $this->apellido,
                ":edad" => $this->edad, ":sexo" => $this->sexo,
                ":estadoc" => $this->civil, ":nacionalidad" => $this->nacionalidad,
                ":estado" => $this->estado,
                ":telefono" => $this->telefono, ":ced" => $this->cedula_antigua,
                ":usuario" => $this->correo,
            ));

            session_destroy();
            echo "<script>
            alert('Sesion Cerrada');
            window.location= 'index.php'
        </script>";
            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    public function actualizar_foto()
    {
        try {
            //agregando archivo a carpeta temporal
            $carpeta_destino = 'resources/imagenes-usuarios/';
            move_uploaded_file($_FILES['imagen']['tmp_name'], $this->carpeta_destino . $this->nombre_imagen);

            //consulta update
            $sql = ("UPDATE usuarios SET ruta_imagen = :ruta
                    WHERE cedula = :ced");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":ruta" => $carpeta_destino . $this->nombre_imagen,
                ":ced" => $this->cedula
            ));

            $accion = "Editar foto de usuario";
            $usuario = $_SESSION['cedula'];
            parent::registrar_bitacora($usuario, $accion, $this->id_modulo);
            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }


    public function bitacora($cedula, $accion, $id_modulo)
    {
        parent::registrar_bitacora($cedula, $accion, $id_modulo);
    }


    //RECUPERAR CONTRASEÑA
    public function recuperar_password()
    {
        try {
            //consulta update
            $sql = ("UPDATE usuarios SET password = :password
         WHERE cedula = :usuario");

            $stmt = $this->conexion()->prepare($sql);

            $this->clave = password_hash($this->clave, PASSWORD_DEFAULT);

            $stmt->execute(array(
                ":password" => $this->clave,
                ":usuario" => $this->cedula
            ));
            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //ELIMINAR USUARIOS
    public function delete_usuarios()
    {
        try {
            $sql = ("DELETE FROM usuarios WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $this->cedula
            ));
            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //METODO GETTER PARA USUARIO CON ROL FUNCION CREADA PARA LAS PRUEBAS
    public function get_usuario_con_rol($cedula)
    {

        try {
            $sql = ("SELECT * FROM usuarios WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":cedula" => $cedula));

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //METODO GETTER PARA USUARIO CON ROL FUNCION CREADA PARA LAS PRUEBAS
    public function get_usuario_sin_rol($cedula)
    {

        try {
            $sql = ("SELECT nombre,apellido,cedula,edad,sexo,estado_civil,nacionalidad,estado,telefono,id_rol 
            FROM usuarios WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(":cedula" => $cedula));

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //METODO GETTER PARA USUARIO CON ROL FUNCION CREADA PARA LAS PRUEBAS
    public function listar_usuarios()
    {
        $resultado = [];
        $consulta = ("SELECT * FROM usuarios ");

        $sql = $this->conexion()->prepare($consulta);

        $sql->execute(array());

        while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {


            $resultado[] = $filas;
        }


        return $resultado;
    }





    //METODO SETTER PARA REGISTRAR USUARIO
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
    //METODO SETTER PARA ACTUALIZAR USUARIO
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

        $this->cedula = trim($this->cedula);
        $this->cedula_antigua = trim($this->cedula_antigua);
    }
    //METODO SETTER PARA ACTUALIZAR USUARIO PERO SIN ID DE ROL
    public function setUpdate_sin_rol($nombre, $apellido, $cedula, $cedula_antigua, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo)
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
        $this->correo = $correo;
    }
    //METODO SETTER PARA ACTUALIZAR FOTO DE USUARIO
    public function setActualizarFoto($cedula, $carpeta_destino, $nombre_imagen, $tipo_imagen, $tamaño_imagen)
    {

        $this->cedula = $cedula;

        $this->carpeta_destino = $carpeta_destino;
        $this->nombre_imagen = $nombre_imagen;
        $this->tipo_imagen = $tipo_imagen;
        $this->tamaño_imagen = $tamaño_imagen;
    }
    //METODO SETTER PARA RECUPERAR CONTRASENIA
    public function setRecuperar($cedula, $clave)
    {
        $this->cedula = $cedula;
        $this->clave = $clave;
    }

    public function setEliminar($cedula)
    {
        $this->cedula = $cedula;
    }


    ///////////////////////////////////////////////////////////// SECCION DE FUNCIONES QUE SE REUTILIZAN EN EL BACKEND ///////////////////////////////////////

    public function sanitizar_cadenas($cadena)
    {
        $cadena_minusculas = strtolower($cadena);
        $cadena_capitalizada = ucfirst($cadena_minusculas);
        return $cadena_capitalizada;
    }


    ///////////////////////////////////////////////////////////// SECCION DE VALIDACIONES BACKEND ///////////////////////////////////////////////////////////////

  
    //VALIDACION DE ESTADO CIVIL

    public function security_validation_estado_civil($civil)
    {
        $estados_civiles = ["soltero", "soltera", "matrimonio"];

        if (!in_array($civil, $estados_civiles)) {
            //guardar datos de hacker

            die("estado civil invalido");
        }
    }

    //VALIDACION NACIONALIDAD

    public function security_validation_nacionalidad($nacionalidad)
    {
        $nacionalidades = ["venezolana", "colombiana", "española"];

        if (!in_array($nacionalidad, $nacionalidades)) {
            //guardar datos de hacker

            die("datos invalidos nacionalidad");
        }
    }

  
    //VALIDACION DE TELEFONO

    public function security_validation_telefono($telefono)
    {

        $response = preg_match_all($this->expresion_telefono, $telefono);

        if ($response == 0) {
            //guardar datos de hacker

            die("telefono invalido");
        }
    }


    //VALIDACION DE CORREO
    public function security_validation_correo($correo)
    {

        $response = preg_match_all($this->expresion_correo, $correo);


        if ($response == 0) {
            //registrar ataque informatico de hacker


            die("datos invalidos de correo");
        }
    }

    //VALIDACION DE SEGURIDAD DE CLAVE
    public function security_validation_clave($clave)
    {
        $response = preg_match_all($this->expresion_clave, $clave);

        if ($response == 0) {

            //registrar ataque informatico de hacker


            die("datos invalidos clave");
        }
    }
}

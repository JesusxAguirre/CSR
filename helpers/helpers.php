<?php

namespace Csr\Helpers;

use Csr\Exception\Usuarios\InvalidData as InvalidData;
use Exception;
use InvalidArgumentException;
use Throwable;


class Helpers
{

    private $estados_venezuela = [
        'amazonas',
        'anzoategui',
        'apure',
        'aragua',
        'barinas',
        'bolivar',
        'carabobo',
        'cojedes',
        'delta amacuro',
        'distrito capital',
        'falcon',
        'guarico',
        'lara',
        'merida',
        'miranda',
        'monagas',
        'nueva esparta',
        'portuguesa',
        'sucre',
        'tachira',
        'trujillo',
        'vargas',
        'yaracuy',
        'zulia'
    ];

    private $nacionalidades = ["venezolana", "colombiana", "española"];

    private $estados_civiles = ["soltero", "soltera", "matrimonio"];

    private $sexos = ["hombre", "mujer"];




    //PROPIEDADES PARA EXPRESIONES REGULARES DE REGISTRAR USUARIO
    private $expresion_clave = "/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/";

    private $expresion_correo = "/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i";

    private $expresion_telefono = "/^[0-9]{11}$/";

    private $expresion_especial = "/^[^a-zA-Z0-9!@#$%^&*]$/";

    private $expresion_cedula = "/^[0-9]{7,8}$/";

    private $expresion_numero = "/^[0-9]$/";



    private $expresion_caracteres = "/^[A-ZÑa-zñáéíóúÁÉÍÓÚ'°]{3,12}$/";








    //AQUI CONMIEZNAN LOS METODOS DE LA CLASE


    //VALIDAR FECHA DE NACIMIENTO    
    /**
     * security_validation_fecha_nacimiento
     *
     * Metodo que valida la fecha de nacimiento , los casos aceptados son mayor a 18 años y menor a 99 años en el caso de que esto no se cumpla
     * se arroja una excepcion
     * @param  mixed $fecha_nacimiento
     * @return void
     */
    public function security_validation_fecha_nacimiento($fecha_nacimiento)
    {
        try {

            $mayoria_edad = strtotime('-18 years'); // fecha actual menos 18 años
            $maxima_edad = strtotime('-99 years'); // fecha actual menos 99 años

            $fecha_nacimiento_ts = strtotime($fecha_nacimiento); // fecha de nacimiento en formato de tiempo

            if ($fecha_nacimiento_ts > $mayoria_edad && $fecha_nacimiento_ts < $maxima_edad) {
                //dguardar datos de hacker

                throw new InvalidData("La fecha de nacimiento no cumple con los requerimientos");
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
     * Si alguno de estos casos se cumple arroja una excepcion.
     *
     * @param  mixed $array
     * @return void
     */
    public function security_validation_inyeccion_sql($array)
    {
        try {
            for ($i = 0; $i < count($array); $i++) {
                $response = preg_match_all($this->expresion_especial, $array[$i]);

                if ($response > 0) {
                    //guardar en base de datos hacker


                    throw new InvalidData(sprintf("Estas intentando enviar caracteres invalidos. caracter invalido-> '%s' "), $array[$i]);
                }

                if ($array[$i] == "") {
                    //guardar en base de datos de hacker


                    throw new InvalidData("Estas enviando datos vacios");
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
            $response = preg_match_all($this->expresion_cedula, $cedula);

            if ($response == 0) {
                //guardar ataque de hacker

                throw new InvalidData(sprintf("Estas enviando una cedula invalida. cedula-> '%s' "), $cedula);
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
     * si no es una cadena de texto, arroja una excepcion
     * 
     * @param  mixed $array
     * @return void
     */
    public function security_validation_caracteres($array)
    {
        try {
            for ($i = 0; $i < count($array); $i++) {
                $response = preg_match_all($this->expresion_caracteres, $array[$i]);

                if ($response == 0) {
                    //guardar datos de hacker

                    throw new InvalidData(sprintf("El dato que estas enviando debe ser una cadena de texto con solo letras. cadena de texto-> '%s", $array[$i]));
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
     * security_validation_estado
     *
     * Metodo que valida que el estado exista en el atributo ya definido al principio del archivo, es decir
     * comprueba que la variable estado exista en el array estados de venezuela. Si no existe en el array 
     * arroja una excepcion
     * @param  mixed $estado
     * @return void
     */
    public function security_validation_estado($estado)
    {

        try {
            if (!in_array($estado, $this->estados_venezuela)) {
                //guardar datos de hacker

                throw new InvalidData(sprintf("El estado que enviaste no existe en los estados de venezuela. estado-> '%s' "), $estado);
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
     * Se arroja una excepcion.
     * @param  mixed $telefono
     * @return void
     */
    public function security_validation_telefono($telefono)
    {
        try {
            $response = preg_match_all($this->expresion_telefono, $telefono);

            if ($response == 0) {
                //guardar datos de hacker

                throw new InvalidData(sprintf("El telefono que enviaste no cumple con el formato de telefono adecuado. telefono-> '%s' "), $telefono);
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }


    //VALIDACION DE CORREO
    public function security_validation_correo($correo)
    {
        try {
            $response = preg_match_all($this->expresion_correo, $correo);


            if ($response == 0) {
                //registrar ataque informatico de hacker


                throw new InvalidData(sprintf("El correo que enviaste  no cumple el formato de correo. Correo-> '%s' ", $correo));
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }

    //VALIDACION DE SEGURIDAD DE CLAVE    
    /**
     * security_validation_clave
     *
     * Metodo que valida que la clave cumpla con los parametros de seguridad. Si no los cumple se arroja una excepcion
     * @param  mixed $clave
     * @return void
     */
    public function security_validation_clave($clave)
    {

        try {
            $response = preg_match_all($this->expresion_clave, $clave);

            if ($response == 0) {

                //registrar ataque informatico de hacker


                throw new InvalidData(sprintf("La clave que estas enviado no cumple con los requisitos de seguridad. clave-> '%s' ", $clave));
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }



    //VALIDACION DE SEXO

    /**
     * security_validation_sexo
     *
     * Este Metodo valida que el sexo enviado sea hombre o mujer de lo contrario se arroja una excepcion.
     * @param  mixed $sexo
     * @return void
     */
    public function security_validation_sexo($sexo)
    {

        try {

            if (!in_array($sexo, $this->sexos)) {
                //guardar datos de hacker

                throw new InvalidData(sprintf("El sexo que estas enviando es invalido. sexo-> '%s'", $sexo));
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }




    //VALIDACION DE ESTADO CIVIL

    /**
     * security_validation_estado_civil
     *
     * Este metodo valida que el estado civil enviado este dentro de los admitidos en el sistema. De lo contrario arroja una excepcion
     * @param  mixed $civil
     * @return void
     */
    public function security_validation_estado_civil($civil)
    {
        try {


            if (!in_array($civil, $this->estados_civiles)) {
                //guardar datos de hacker

                throw new InvalidData(sprintf("El estado civil que estas enviado es invalido. estado_civil-> '%s'", $civil));
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));
            http_response_code($ex->getCode());
            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }





    //VALIDACION NACIONALIDAD

    public function security_validation_nacionalidad($nacionalidad)
    {
        try {

            if (!in_array($nacionalidad, $this->nacionalidades)) {
                //guardar datos de hacker

                throw new InvalidData(sprintf("La nacioliadad que estas enviando no esta permitida en el sistema. nacionalidad-> '%s'", $nacionalidad));
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
}

<?php

namespace Csr\Helpers;

use Csr\Exception\Usuarios\InvalidData as InvalidData;
use Exception;


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
     * validar_inyeccion
     * 
     * Funcion que valida caracter por caracter que no sea un caracter especial y luego valida si es vacio
     * Si alguno de estos casos se cumple arroja una excepcion.
     *
     * @param  mixed $array
     * @return void
     */
    public function validar_inyeccion($array)
    {
        try {
            for ($i = 0; $i < count($array); $i++) {
                $response = preg_match_all($this->expresion_especial, $array[$i]);

                if ($response > 0) {
                    //guardar en base de datos hacker


                    throw new InvalidData("Estas intentando enviar caracteres invalidos");
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
    public function validar_cedula($cedula)
    {
        try {
            $response = preg_match_all($this->expresion_cedula, $cedula);

            if ($response == 0) {
                //guardar ataque de hacker

                throw new InvalidData("Estas enviando una cedula invalida");
            }
        } catch (Throwable $ex) {
            $errorType = basename(get_class($ex));

            http_response_code($ex->getCode());

            echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
            die();
        }
    }

    /**
     * validar_caracteres
     *
     * funcion que recorre una cadena de texto letra por letra validando con la expresion regular de 
     * caracteres.  Si no coicide captura un error
     * 
     * @param  mixed $array
     * @return void
     */
    public function validar_caracteres($array)
    {
        try {
            for ($i = 0; $i < count($array); $i++) {
                $response = preg_match_all($this->expresion_caracteres, $array[$i]);

                if ($response == 0) {
                    //guardar datos de hacker

                    die("datos invalidos en caracteres");
                }
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

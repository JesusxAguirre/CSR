<?php


namespace Csr\Exception\Usuarios;

use Exception;


class UserNotExist extends Exception
{
    
    public function __construct($mensaje = "Este usuario no existe en la base de datos", $codigo = 409, Exception $excepcionPrevia = null)
    {
        parent::__construct($mensaje, $codigo, $excepcionPrevia);
    }


    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}





?>
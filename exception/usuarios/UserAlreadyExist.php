<?php 
namespace Csr\Exception\Usuarios;

use Exception;
class UserAlreadyExist extends  Exception
{


    public function __construct($mensaje = "Este usuario ya existe en la base de datos", $codigo = 409, Exception $excepcionPrevia = null)
    {
        parent::__construct($mensaje, $codigo, $excepcionPrevia);
    }


    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }


}

?> 
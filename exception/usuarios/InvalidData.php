<?php

namespace Csr\Exception\Usuarios;

use Exception;


class InvalidData extends Exception
{
    public function __construct($mensaje = "", $codigo = 422, Exception $excepcionPrevia = null)
    {
        parent::__construct($mensaje, $codigo, $excepcionPrevia);
    }


    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}
?>
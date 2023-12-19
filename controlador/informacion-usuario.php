<?php
//destruye la sesion si se tenia una abierta
session_start();
session_destroy();

if (is_file('vista/'.$pagina.'.php')) {

    require_once 'vista/lideres/'.$pagina.'.php';
}else {
    echo "Pagina en contruccion";
}
?>
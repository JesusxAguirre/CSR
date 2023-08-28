<?php

use Csr\Modelo\Discipulado;
use PhpParser\Node\Stmt\Else_;

//destruye la sesion si se tenia una abierta
session_start();

if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {

        if (!$_SESSION['permisos']['celula_discipulado']['listar']) {
            echo "<script>
            alert('No tienes los permisos para este modulo');
            window.location= 'index.php?pagina=dashboard'
            </script>";
        }

        $objeto = new Discipulado();


        $matriz_usuarios = $objeto->listar_no_participantes();

        $matriz_lideres = $objeto->listar_usuarios_N2();
        //actualizar celula
        $actualizar = true;

        if (isset($_POST['update'])) {
            $cedula_lider = trim($_POST['codigoLider']);
            $cedula_anfitrion = trim($_POST['codigoAnfitrion']);
            $cedula_asistente = trim($_POST['codigoAsistente']);
            $dia = strtolower(trim($_POST['dia']));
            $hora = trim($_POST['hora']);
            $direccion = strtolower(trim($_POST['direccion']));
            $id = trim($_POST['id']);

            $objeto->security_validation_inyeccion_sql([$id, $dia, str_replace(" ", "", $direccion)]);



            $objeto->setActualizar($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion, $id);

            $objeto->actualizar_discipulado();
            $actualizar = false;
        }

        if (isset($_GET['listar_celula_disicpulado'])) {
            $matriz_celula = $objeto->listar_celula_discipulado();

            echo json_encode($matriz_celula);

            die();
        }


        //BUSCAR PARTICIPANTES DE CELULCA

        if(isset($_GET['buscar_participantes'])){
            $matriz_usuarios = $objeto->listar_no_participantes();


            http_response_code(200);

            echo json_encode($matriz_usuarios);
            die();
        }

        //agregar participantes
        if (isset($_POST['participantes'])) {

            $participantes = trim($_POST['participantes']);
            $id = trim($_POST['id']);

            $objeto->setParticipantes($participantes, $id);

            $objeto->agregar_participantes();
            $registrar_participante = false;
        }
        

        //registrar asistencia
        if (isset($_POST['agregar_asistencia'])) {
            $fecha = trim($_POST['fecha']);
            $asistentes = trim($_POST['asistentes']);
            $id = trim($_POST['id']);

            $objeto->setAsistencias($asistentes, $id, $fecha);

            $objeto->registrar_asistencias();
            $registrar_asistencia = false;
        }

        if (isset($_POST['cedula_discipulo'])) {

            $cedula_discipulo = trim($_POST['cedula_discipulo']);
            $nivel = trim($_POST['nivel']);
            $nivel_actual = trim($_POST['codigo_discipulo']);

            if (ctype_digit($cedula_discipulo) && ($nivel == "N1" or $nivel == "N2") && ($nivel_actual == "N1" or $nivel_actual == "N2")) {

                $response = $objeto->editar_discipulo_nivel($cedula_discipulo, $nivel_actual, $nivel);
                echo json_encode(array("response" => $response));
                return true;
            } else {
                echo json_encode(array("response" => 0));

                return false;
            }
        }
        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
if (isset($_POST['cerrar'])) {
    session_destroy();
    echo "<script>
    alert('Sesion Cerrada');
    window.location= 'index.php'
</script>";
}

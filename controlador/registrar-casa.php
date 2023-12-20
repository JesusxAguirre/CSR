<?php

//destruye la sesion si se tenia una abierta
session_start();

// Verificar la expiración del tiempo de la sesiónx
$time_limit = 3600;  // Establecemos el límite de tiempo en segundos, por ejemplo, 1800 segundos = 30 minutos
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $time_limit)) {
    // El tiempo de sesión ha expirado
    
    // Regenera el ID de sesión antes de destruirla
    session_regenerate_id(true);

    // Desestablece todas las variables de sesión
    $_SESSION = array();

    session_destroy();  // Destruye la sesión
    http_response_code(403);
    echo "<script>
    alert('La sesión ha expirado');
    window.location= 'index.php'
    </script>";
    die();
}

$_SESSION['LAST_ACTIVITY'] = time();  // Actualiza el último momento de actividad

use Csr\Modelo\LaRoca;

if (isset($_POST['cerrar'])) {

    // Regenera el ID de sesión antes de destruirla
    session_regenerate_id(true);

    // Desestablece todas las variables de sesión
    $_SESSION = array();

    session_destroy();

    http_response_code(200);
    echo json_encode(array('msj' => 'Ha cerrado sesion con correctamente. Vuelva pronto', 'status' => 200));
    die();
}

if (isset($_SESSION['verdadero']) && $_SESSION['verdadero'] > 0) {
    if (!$_SESSION['permisos']['casa_sobre_la_roca']['crear']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }


    if (is_file('vista/' . $pagina . '.php')) {
        $objeto = new LaRoca();

        $matriz_lider = $objeto->listar_usuarios_N2();

        //registrando casa sobre la roca
        if (isset($_POST['lider'])) {

            $cedula_lider = trim($_POST['lider']);
            $direccion = strtolower(trim($_POST['direccion']));
            $nombre_anfitrion = strtolower(trim($_POST['nombre']));
            $telefono_anfitrion = trim($_POST['telefono']);
            $dia = strtolower(trim($_POST['dia']));
            $hora = trim($_POST['hora']);
            $cantidad_integrantes = trim($_POST['integrantes']);

            $objeto->security_validation_inyeccion_sql([$cedula_lider, $dia, str_replace(" ", "", $nombre_anfitrion), 
            $telefono_anfitrion, $cantidad_integrantes, str_replace(" ", "", $direccion)]);
            $objeto->security_validation_cedula($cedula_lider);
            $objeto->security_validation_caracteres([$dia, $nombre_anfitrion]);
            $objeto->security_validation_hora($hora);
            $objeto->security_validation_telefono($telefono_anfitrion);
            
            //Aqui hay un bug, por eso esta comentado OJO AQUI (En prueba)
            $objeto->security_validation_cantidad([$cantidad_integrantes]);

            $objeto->setCSR($cedula_lider, $direccion, $nombre_anfitrion, $telefono_anfitrion, $dia, $hora, $cantidad_integrantes);
            $objeto->registrar_CSR();
        }

        
        if (isset($_GET['getLideres'])) {
            $matriz_lider = $objeto->listar_usuarios_N2();
            echo json_encode($matriz_lider);
            die();
        }

        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
?>

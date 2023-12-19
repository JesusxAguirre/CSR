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
    echo "<script>
    alert('La sesión ha expirado');
    window.location= 'index.php'
    </script>";

    http_response_code(403);
    echo json_encode(array("msj" => "Sesion expirada", "status_code" => 403));
    die();
}

$_SESSION['LAST_ACTIVITY'] = time();  // Actualiza el último momento de actividad

use Csr\Modelo\LaRoca;
use PhpParser\Node\Expr\Print_;

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

if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {
        $objeto = new LaRoca();
        $matriz_csr = $objeto->listar_casas_la_roca_por_usuario();

        if (isset($_POST['CSR'])) {

            $CSR = $_POST['CSR'];
            $hombres = trim($_POST['hombres']);
            $mujeres = trim($_POST['mujeres']);
            $niños = trim($_POST['niños']);
            $confesiones = trim($_POST['confesiones']);
            //colocando en una variable la id de casa sobre la roca fuera de un arreglo

            $objeto->security_validation_inyeccion_sql([$CSR, $hombres, $mujeres, $niños, $confesiones]);

            $objeto->security_validation_numero($CSR);

            $objeto->security_validation_cantidad([$hombres, $mujeres, $niños, $confesiones]);

            $objeto->setReporte($CSR, $hombres, $mujeres, $niños, $confesiones);

            $objeto->registrar_reporte_CSR();
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

<?php

namespace Csr\Modelo;


use PDO;
use Exception;
use DateTime;


class Conexion
{

    private $config = array(
        "private_key_bits" => 2048,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    );

    private $secret_key_recaptcha = '6Lf5JignAAAAAFQb29kN1lP5eCD_QB2CUWkhznB6';

    // Definir el umbral de solicitud
    private $umbralSolicitudes = 20; // 5 solicitudes en 1 segundo


    //CONEXION CON BASE DE DATOS
    protected static function conexion()
    {

        try {

            $dsn = "mysql: host=localhost; dbname=casa_sobre_la_roca";

            $user = "root";

            $password = "";

            $conexion = new PDO($dsn, $user, $password);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conexion->exec("SET CHARACTER SET UTF8");

            $conexion->query("SET lc_time_names = 'es_ES'");

            return $conexion;
        } catch (Exception $e) {

            http_response_code(500);
            echo json_encode(array("msj" => "No se ha podido conectar con la base de datos", 'status_code' => 500));
            die();
        }
    }

    //REGISTRAR ACCIONES DE USUARIOS EN LA BITACORA 
    protected function registrar_bitacora($cedula, $accion, $id_modulo)
    {
        $sql = "INSERT INTO bitacora_usuario (cedula_usuario, id_modulo, fecha_registro, hora_registro, accion_realizada) 
        VALUES(:ced, :id, CURDATE(), CURTIME(), :accion)";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":ced" => $cedula,
            ":id" => $id_modulo,
            ":accion" => $accion
        ));
    }



    protected function check_requests_danger()
    {
        // Obtener la IP del cliente



        $ip = $_SERVER['REMOTE_ADDR'];
        // Obtener la marca de tiempo actual

        // Eliminar registros antiguos en la tabla 'requests'
        $eliminarRegistrosAntiguos = $this->conexion()->prepare("DELETE FROM requests WHERE timestamp <> (SELECT MAX(timestamp) FROM requests ) AND ip = :ip");

        $eliminarRegistrosAntiguos->bindParam(':ip', $ip);
        $eliminarRegistrosAntiguos->execute();
        // Contar las solicitudes realizadas por la IP en el último segundo

        //Creo que esta llamando mal la columna. Las tablas que me pasaste tiene id en vez de ip
        $consulta = $this->conexion()->prepare("SELECT COUNT(*) AS conteo FROM requests WHERE ip = :ip");
        $consulta->bindParam(':ip', $ip);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        // Verificar el contador y bloquear el acceso si se supera el umbral
        if ($resultado['conteo'] >= $this->umbralSolicitudes) {
            //AQUI FALTA UNA BUENA LOGICA PARA PODER PONER LA VERIFICACION DE NO SOY UN ROBOT

            return false;
        }
        // Registrar la solicitud en la base de datos
        $registrarSolicitud = $this->conexion()->prepare("INSERT INTO requests (ip, timestamp) VALUES (:ip, NOW())");
        $registrarSolicitud->bindParam(':ip', $ip);
        $registrarSolicitud->execute();

        return true;
    }

    protected function check_blacklist()
    {
        // Obtener la IP del cliente

        $ip = $_SERVER['REMOTE_ADDR'];

        // Consultar la tabla de blacklist para verificar si la IP está en la lista negra
        $consulta = $this->conexion()->prepare("SELECT COUNT(*) AS conteo FROM blacklist WHERE ip = :ip");
        $consulta->bindParam(':ip', $ip);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        // Verificar el resultado y bloquear el acceso si la IP está en la lista negra
        if ($resultado['conteo'] > 0) {
            // Bloquear el acceso al servidor
            http_response_code(403);
            echo "Acceso denegado. Tu IP está en la lista negra.";
            die();
        }
    }

    protected function insert_ip_blacklist()
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        // Registrar la IP en la tabla de blacklist
        $insertarBlacklist = $this->conexion()->prepare("INSERT INTO blacklist (ip) VALUES (:ip)");
        $insertarBlacklist->bindParam(':ip', $ip);
        $insertarBlacklist->execute();
        // Bloquear el acceso al servidor
        http_response_code(403);
        echo "Acceso denegado. Has superado el límite de solicitudes por segundo.";
        die();
    }


    protected function generate_csrf_token()
    {
        $token = bin2hex(random_bytes(16));

        $_SESSION['csrf_token'] = $token;

        return $token;
    }

    //Metodo para genear API-KEY para APP movil
    protected function generateAPIKey($ci)
    {
        // Se genera un valor aleatorio
        $randomBytes = random_bytes(16);

        // Se codifica ese valor aleatorio en formato hexadecimal
        $randomHex = bin2hex($randomBytes);

        // Se combina el ID del usuario con el valor aleatorio
        $key = $ci . $randomHex;

        // Se utiliza hash SHA-256 para codificar el resultado y proporcionar una longitud fija
        $apiKey = hash('sha256', $key);

        return $apiKey;
    }

    // Método para generar un par de claves pública y privada
    protected function generateAsymmetricKeys()
    {
        $privateKey = openssl_pkey_new($this->config);

        openssl_pkey_export($privateKey, $privateKeyStr);
        $privateKeyDetails = openssl_pkey_get_details($privateKey);
        $publicKey = $privateKeyDetails['key'];

        return array('private_key' => $privateKeyStr, 'public_key' => $publicKey);
    }



    // Método para encriptar el mensaje con la llave publica
    protected function encryptMessage($message, $publicKey)
    {
        $encrypted = '';
        openssl_public_encrypt($message, $encrypted, $publicKey);
        return base64_encode($encrypted);
    }

    // Método para descriptar utilizanado la llave privada
    protected function decryptMessage($encryptedMessage, $privateKey)
    {
        $decrypted = '';
        openssl_private_decrypt(base64_decode($encryptedMessage), $decrypted, $privateKey);
        return $decrypted;
    }


    protected function decryptMessageMobile($encryptedMessage)
    {

        // Ruta al archivo .key
        $archivoKey = 'modelo/private.key';

        // Leer el contenido del archivo .key
        $contenidoKey = file_get_contents($archivoKey);

        // Obtener la clave privada
        $privateKey = openssl_pkey_get_private($contenidoKey, null);


        openssl_private_decrypt(base64_decode($encryptedMessage), $decrypted, $privateKey);

        return $decrypted;
    }
}

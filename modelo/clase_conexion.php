<?php 

class Conectar{
  
public static function conexion(){    
    
try{

    $dsn ="mysql: host=localhost; dbname=casa_sobre_la_roca";         
        
        $user="root";
        
        $password="";    
            
        $conexion = new PDO($dsn,$user,$password);      
    
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $conexion->exec("SET CHARACTER SET UTF8");  
}
    catch (Exception $e){
            
            echo $e->getMessage();
        
            echo "Linea del error: " . $e->getLine();
        }

                return $conexion;
    
                          }

}
?>

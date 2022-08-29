<?php   
require_once("clase_conexion.php");

class Inventario extends Conectar {
    
    private $id;

    private $codigo;

    private $nombre;

    private $categoria;

    private $marca;

    private $costo_base;
    
    private $existencias;

    private $precio_detal;

    private $precio_mayor;

    private $fecha;

    private $inventarios;

  private $consulta;
    
  private $inventarios2;
    
    public function __construct(){      
    				$this->conexion = parent::conexion();           
    }




    function listar_inventario(){
      
        $consulta=("SELECT id,codigo,
        nombre,categoria,marca,costo_base,existencia_actual,precio_detal,precio_mayor, fecha FROM inventario ORDER BY id ");
        
        $sql = $this->conexion()->prepare($consulta);

        $sql->execute(array());
      
        while($filas = $sql->fetch(PDO::FETCH_ASSOC)){
        
        
            $this->inventarios2[]=$filas;

            
    }
        return $this->inventarios2;
    
    }

    function buscar_inventario(){
      $sql = ("SELECT id,codigo,nombre,categoria,marca,costo_base,existencia_actual,precio_detal,precio_mayor, fecha FROM inventario WHERE codigo LIKE '%" .$this->consulta."%' 
      OR nombre LIKE '%" .$this->consulta. "%' OR marca LIKE '%" .$this->consulta."%' ORDER BY id ");
    
      $resultado = $this->conexion()->prepare($sql);

      $resultado->execute(array());

      if($resultado->rowCount() > 0){
        while($filas = $resultado->fetch(PDO::FETCH_ASSOC)){
        
        
          $this->inventarios[]=$filas;
             }
       

      }
      return $this->inventarios;
    }
    function numero_filas(){
      $sql = ("SELECT id,codigo,nombre,categoria,marca,costo_base,existencia_actual,precio_detal,precio_mayor, fecha FROM inventario WHERE codigo LIKE '%" .$this->consulta."%' 
      OR nombre LIKE '%" .$this->consulta. "%' OR marca LIKE '%" .$this->consulta."%' ORDER BY id ");
    
      $resultado = $this->conexion()->prepare($sql);

      $resultado->execute(array());
      
      $this->inventarios = $resultado->rowCount();
      return $this->inventarios;
    }

    //SETTER

    public function SetConsulta($consulta){

      $this->consulta=$consulta;
      
      return $this->consulta;         
}
    
}

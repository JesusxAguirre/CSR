<?php
 require_once("modelo/clase_inventario.php");
if (is_file('vista/'.$pagina.'.php')) {

    $objeto= new Inventario();

    $matriz_inventario = $objeto->listar_inventario();

    if(isset($_POST['consulta'])){
        $consulta = $_POST['consulta'];
        //echo $resultado;
        $objeto->SetConsulta($consulta);
        $matriz_inventario=$objeto->buscar_inventario();
        $contador = $objeto->numero_filas();
        if($contador > 0){
  ?>
  
                <table role='table' class='table table-centered'>
                <thead>

                <tr role='row'>
                    <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Codigo</th>
                    <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Fecha de entrada</th>
                    <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Nombre</th>
                    <th colspan='1' role='columnheader' class=''>Categoria</th>
                    <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Marca</th>
                    <th colspan='1' role='columnheader' class=''>Costo base</th>
                    <th colspan='1' role='columnheader' class=''>Precio de Venta Detal</th>
                    <th colspan='1' role='columnheader' class=''>Precio de Venta al Mayor</th>
                    <th colspan='1' role='columnheader' class=''>Existencias Actuales</th>
                </tr>
                </thead>
                
                <tbody role='rowgroup'>
                <?php     foreach($matriz_inventario as $producto): ?>
    <tr role='row'>
    <td role='cell'><?php echo $producto['codigo']?> </td>
    <td role='cell'><?php echo  $producto['fecha']?></td>
    <td role='cell'><?php echo  $producto['nombre']?></td>
    <td role='cell'><?php echo  $producto['categoria']?></td>
    <td role='cell'><?php echo  $producto['marca']?></td>
    <td role='cell'><?php echo  $producto['costo_base']?></td>
    <td role='cell'><?php echo  $producto['precio_detal']?></td>
    <td role='cell'><?php echo  $producto['precio_mayor']?></td>
    <td role='cell'><?php echo  $producto['existencia_actual']?></td>
    </tr>
    <?php endforeach;             
                                  ?>
                </tbody>
                </table>
                         
<?php         
}else{

echo "No hay datos";
}
}

    require_once 'vista/'.$pagina.'.php';


}else {
    echo "Pagina en contruccion";
}
?>
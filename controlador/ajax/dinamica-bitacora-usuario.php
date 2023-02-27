<?php
session_start();
use Csr\Modelo\Usuarios;
$objeto = new Usuarios();


//ACTIVAR DATATABLE DE SECCIONES Y TRAER INFORMACION
if (isset($_POST['activarDatatableBitacora'])) {
    $matriz_bitacora = $objeto->listar_bitacora();
    if (!empty($matriz_bitacora)) {
        foreach ($matriz_bitacora as $key) {?>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="fs-2 me-3"><i class="bi bi-person"></i></div>
                        <div class="mb-0">
                            <h6 class="mb-0 fst-italic"><?php echo $key['codigo']; ?></h6>
                            <p class="mb-0"><?php echo $key['nombre'] . ' ' . $key['apellido']; ?></p>
                        </div>
                    </div>
                </td>
                <td><?php echo $key['nombreModulo'] ?></td>
                <td><?php echo $key['fecha_registro'] ?></td>
                <td><?php echo $key['hora_registro'] ?></td>
                <td><?php echo $key['accion_realizada'] ?></td>
            </tr><?php
        }
    }
    
}       

?>
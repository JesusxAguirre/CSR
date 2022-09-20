<?php
require_once('../../modelo/clase_casa_sobre_la_roca.php');
$objeto = new LaRoca();

$$busqueda = $_GET['busqueda'];
$matriz_csr = $objeto->buscar_CSR($busqueda);
?>
<?php if (!empty($matriz_csr)) : ?>
  <?php foreach ($matriz_csr as $csr) : ?>
    <tr role='row'>
      <td hidden class="id" role='cell'><?php echo $csr['id'] ?></td>
      <td class="codigo" role='cell'><?php echo $csr['codigo'] ?></td>
      <td class="dia" role='cell'><?php echo  $csr['dia_visita'] ?></td>
      <td class="hora" role='cell'><?php $hora = substr($csr['hora_pautada'], 0, -3);
                                    echo $hora; ?></td>
      <td class="lider" role='cell'><?php echo  $csr['codigo_lider'] ?></td>
      <td class="nombre_anfitrion" role='cell'><?php echo  $csr['nombre_anfitrion'] ?></td>
      <td class="telefono_anfitrion" role='cell'><?php echo  $csr['telefono_anfitrion'] ?></td>
      <td class="cantidad" role='cell'><?php echo  $csr['cantidad_personas_hogar'] ?></td>
      <td class="direccion" role='cell'><?php echo  $csr['direccion'] ?></td>
      <td class="" role="cell">
        <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
      </td>
    </tr>
  <?php endforeach;       ?>
<?php endif ?>
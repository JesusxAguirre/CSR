<?php
require_once("../../vendor/autoload.php");
session_start();

use Csr\Modelo\Usuarios;
$objeto = new Usuarios;

$busqueda = $_POST['busqueda'];
  $m_usuarios = $objeto->buscar_usuario($busqueda);
?>
 <?php if(!empty($m_usuarios)):?>
  <?php foreach ($m_usuarios as $user):?>
    <tr role='row'>
      <td hidden class="cedula" role='cell'><?php echo $user['cedula'] ?>
      <td hidden class="id_rol" role='cell'><?php echo $user['id_rol'] ?></td>
      <td hidden class="nombre_rol" role='cell'><?php echo $user['nombre_rol'] ?></td>
      <td hidden class="edad" role='cell'><?php echo $user['edad'] ?></td>
      <td hidden class="nacionalidad" role='cell'><?php echo $user['nacionalidad'] ?></td>
      <td hidden class="estado" role='cell'><?php echo $user['estado'] ?></td>
      <td hidden class="telefono" role='cell'><?php echo $usuario['telefono'] ?></td>
      <td role='cell'><?php echo $user['codigo'] ?></td>
      <td class="nombre" role='cell'><?php echo  $user['nombre'] ?></td>
      <td class="apellido" role='cell'><?php echo  $user['apellido'] ?></td>
      <td class="sexo" role='cell'><?php echo  $user['sexo'] ?></td>
      <td class="telefono" role='cell'><?php echo  $user['telefono'] ?></td>
      <td class="estado_civil" role='cell'><?php echo  $user['estado_civil'] ?></td>
      <td class="" role="cell">
        <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#eliminar" class="btn btn-outline-danger delete-btn"><i class="fs-5 bi bi-trash-fill"></i></button>
      </td>
    </tr>
<?php endforeach ?>
<?php endif; ?>

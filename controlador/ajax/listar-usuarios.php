<?php
session_start();
require_once('../../modelo/clase_usuario.php');
$objeto = new Usuarios;

$matriz_usuario = $objeto->listar();

foreach ($matriz_usuario as $usuario) {?>
    <tr role='row'>
      <td hidden class="cedula" role='cell'><?php echo $usuario['cedula'] ?></td>
      <td hidden class="id_rol" role='cell'><?php echo $usuario['id_rol'] ?></td>
      <td hidden class="nombre_rol" role='cell'><?php echo $usuario['nombre_rol'] ?></td>
      <td hidden class="edad" role='cell'><?php echo $usuario['edad'] ?></td>
      <td hidden class="nacionalidad" role='cell'><?php echo $usuario['nacionalidad'] ?></td>
      <td hidden class="estado" role='cell'><?php echo $usuario['estado'] ?></td>
      <td hidden class="telefono" role='cell'><?php echo $usuario['telefono'] ?></td>
      <td role='cell'><?php echo $usuario['codigo'] ?></td>
      <td class="nombre" role='cell'><?php echo  $usuario['nombre'] ?></td>
      <td class="apellido" role='cell'><?php echo  $usuario['apellido'] ?></td>
      <td class="sexo" role='cell'><?php echo  $usuario['sexo'] ?></td>
      <td class="telefono" role='cell'><?php echo  $usuario['telefono'] ?></td>
      <td class="estado_civil" role='cell'><?php echo  $usuario['estado_civil'] ?></td>
      <td class="" role="cell">
        <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#eliminar" class="btn btn-outline-danger delete-btn"><i class="fs-5 bi bi-trash-fill"></i></button>
      </td>
    </tr>
<?php }

?>
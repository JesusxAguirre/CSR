 <?php
    require_once('../../modelo/clase_ecam.php');
    $objeto = new ecam();


    //ACTIVAR DATATABLE DE SECCIONES Y TRAER INFORMACION
    if (isset($_POST['activarDatatableSeccion'])) {
        $listarSecciones = $objeto->listarSeccionesON();
        $json = array();

        if (!empty($listarSecciones)) {
            foreach ($listarSecciones as $key) {
                $json['data'][] = $key;
            }
        } else {
            $json['data'][] = null;
        }
        echo json_encode($json);
    }


    //ACTIVAR LISTA DE ESTUDIANTES POR SECCION
    if (isset($_POST['activarTablaEst'])) {
        $idSeccionConsulta = $_POST['idSeccionConsulta'];

        $listarEstudiantesON = $objeto->listarEstudiantesON($idSeccionConsulta);

        if (!empty($listarEstudiantesON)) {
            foreach ($listarEstudiantesON as $listEst) { ?>
                <tr>
                    <td hidden id="cedulaEstON"><?php echo $listEst['cedula']; ?></td>
                    <td><?php echo $listEst['codigo']; ?></td>
                    <td><?php echo $listEst['nombre']; ?></td>
                    <td><?php echo $listEst['apellido']; ?></td>
                    <td>
                        <button class="btn btn-danger" id="eliminarEstON"><i class="bi bi-x-lg"></i></button>
                    </td>
                </tr> <?php
            }
        }
    }


    //ACTIVAR LISTA DE PROFESORES POR SECCION
    if (isset($_POST['activarTablaProf'])) {
        $idSeccionProfConsulta = $_POST['idSeccionProfConsulta'];

        $listarProfesores_seccionMateria = $objeto->listarProfesores_seccionMateria($idSeccionProfConsulta);

        if (!empty($listarProfesores_seccionMateria)) {
            foreach ($listarProfesores_seccionMateria as $listProf) { ?>
                <tr>
                    <td hidden id="cedulaProfON"><?php echo $listProf['id_materia']; ?></td>
                    <td hidden id="cedulaProfON"><?php echo $listProf['cedula']; ?></td>
                    <td class="table-dark"><?php echo $listProf['nombreMateria']; ?></td>
                    <td><?php echo $listProf['codigo']; ?></td>
                    <td><?php echo $listProf['nombre']; ?></td>
                    <td><?php echo $listProf['apellido']; ?></td>
                    <td>
                        <i type="button" class="text-danger fs-5 bi bi-dash-circle" id="eliminarProfON" title="Pulsa para eliminar"></i>
                    </td>
                </tr> <?php
            }
        }
    }


    //SELECT2 DE LISTAR ESTUDIANTES PARA REGISTRAR UNA SECCION
    if (isset($_POST['verEstudiantes'])) {
        $estudiantes = $objeto->listarEstudiantes();

    ?> <select class="form-select" id="seleccionarEstudiantes" name="states[]" multiple="multiple">
     <?php foreach ($estudiantes as $est) : ?>
     <option value="<?php echo $est['cedula']; ?>">
         <?php echo $est['codigo'] . ' ' . $est['nombre'] . ' ' . $est['apellido']; ?></option>
     <?php endforeach; ?>
 </select> <?php
    }

    //CHOICES DE LISTAR ESTUDIANTES PARA AGREGAR MAS A LA SECCION
    if (isset($_POST['verEstudiantes2'])) {
        $listarEstudiantesOFF = $objeto->listarEstudiantes();

    ?> <select class="form-select" id="seleccionarEstudidantesAdicionales" multiple>
        <?php foreach ($listarEstudiantesOFF as $estOFF) : ?>
            <option value="<?php echo $estOFF['cedula']; ?>"><?php echo $estOFF['codigo'] . ' ' . $estOFF['nombre'] . ' ' . $estOFF['apellido']; ?></option>
        <?php endforeach; ?>
        </select>
        <input hidden id="idSeccionV"><?php
    }


    //CHOICES DE LISTAR PROFESORES PARA A LA MATERIA DE LA SECCION
    if (isset($_POST['verProfesoresSelect'])) {
        $listarProfesoresOFF = $objeto->listarProfesores();

    ?> <select class="form-select" id="seleccionarProfesoresAdicionales">
        <?php foreach ($listarProfesoresOFF as $profOFF) : ?>
            <option value="<?php echo $profOFF['cedula']; ?>"><?php echo $profOFF['codigo'] . ' ' . $profOFF['nombre'] . ' ' . $profOFF['apellido']; ?></option>
        <?php endforeach; ?>
        </select><?php
    }



/////LISTADO DE MATERIAS POR NIVELES Y LISTAR PROFESORES/////
if (isset($_POST['nivelSeleccionado'])) {
    $nivel = $_POST['nivel'];
    $profesoresNivel = $objeto->listarProfesores();

    //NIVEL 1
    if ($nivel == 'I') {
        $numRow = $objeto->cantidadFilasNiveles($nivel);
        $materiasNivel = $objeto->listarMateriasNivel($nivel);

        //LISTAR MATERIAS
        for ($i = 0; $i < $numRow; $i++) { ?>
        
            <div class="row">
                <div class="col-5 mt-2">
                    <input hidden type="text" class="seleccionarMaterias" value="<?php echo $materiasNivel[$i]['id_materia']; ?>">
                    <input disabled type="text" class="form-control" value="<?php echo $materiasNivel[$i]['nombre']; ?>">
                </div>
                
                <div class="col mt-2">
                    <select class="seleccionarProfesores form-select">
                        <option value="ninguno" selected>Selecciona al profesor</option>
                        <?php foreach ($profesoresNivel as $pNivel) : ?>
                        <option value="<?php echo $pNivel['cedula']; ?>">
                        <?php echo $pNivel['codigo'] . ' ' . $pNivel['nombre'] . ' ' . $pNivel['apellido']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div> <?php
        }
    }
    if ($nivel == 'II') {
        $numRow = $objeto->cantidadFilasNiveles($nivel);
        $materiasNivel = $objeto->listarMateriasNivel($nivel);

        //LISTAR MATERIAS
        for ($i = 0; $i < $numRow; $i++) { ?>
        
            <div class="row">
                <div class="col-5 mt-2">
                    <input hidden type="text" class="seleccionarMaterias" value="<?php echo $materiasNivel[$i]['id_materia']; ?>">
                    <input disabled type="text" class="form-control" value="<?php echo $materiasNivel[$i]['nombre']; ?>">
                </div>
                
                <div class="col mt-2">
                    <select class="seleccionarProfesores form-select">
                        <option value="ninguno" selected>Selecciona al profesor</option>
                        <?php foreach ($profesoresNivel as $pNivel) : ?>
                        <option value="<?php echo $pNivel['cedula']; ?>">
                        <?php echo $pNivel['codigo'] . ' ' . $pNivel['nombre'] . ' ' . $pNivel['apellido']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div> <?php
        }
    }
    if ($nivel == 'II+Oracion') {
        $numRow = $objeto->cantidadFilasNiveles($nivel);
        $materiasNivel = $objeto->listarMateriasNivel($nivel);

        //LISTAR MATERIAS
        for ($i = 0; $i < $numRow; $i++) { ?>
        
            <div class="row">
                <div class="col-5 mt-2">
                    <input hidden type="text" class="seleccionarMaterias" value="<?php echo $materiasNivel[$i]['id_materia']; ?>">
                    <input disabled type="text" class="form-control" value="<?php echo $materiasNivel[$i]['nombre']; ?>">
                </div>
                
                <div class="col mt-2">
                    <select class="seleccionarProfesores form-select">
                        <option value="ninguno" selected>Selecciona al profesor</option>
                        <?php foreach ($profesoresNivel as $pNivel) : ?>
                        <option value="<?php echo $pNivel['cedula']; ?>">
                        <?php echo $pNivel['codigo'] . ' ' . $pNivel['nombre'] . ' ' . $pNivel['apellido']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div> <?php
        }   
    }
}
/////FIN DEL LISTADO DE NIVELES Y PROFESORES/////



?>
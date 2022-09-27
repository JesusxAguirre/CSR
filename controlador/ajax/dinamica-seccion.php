 <?php
 session_start();
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

    //LISTAR LAS SECCIONES CERRADAS
    if (isset($_POST['verSeccionesOFF'])) {
        $listarSeccionesOFF= $objeto->listarSeccionesOFF();

        if (!empty($listarSeccionesOFF)) {
            foreach ($listarSeccionesOFF as $seccionesOFF) { ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="fs-2 me-3 text-danger"><i class="bi bi-house"></i></div>
                            <div class="mb-0">
                                <h6 class="mb-0 fst-italic"><?php echo $seccionesOFF['nombre'].' (Nivel '.$seccionesOFF['nivel_academico'].')'; ?></h6>
                                <p class="mb-0"><em><?php echo 'Fecha de cerrado: '.$misEst['fecha_cierre'];?></em></p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-info">Ver estudiantes</button>
                        </div>
                    </td>
                </tr> <?php
            }
        }else{ ?>
                <tr>
                    <td><h5><em>Aun no hay secciones cerradas</em></h5></td>
                </tr> <?php
        }
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


    //SELECT2 DE LISTAR ESTUDIANTES PARA REGISTRAR UNA SECCION
    if (isset($_POST['verEstudiantes'])) {
        $estudiantes = $objeto->listarEstudiantes();

    ?> <select class="form-select" id="seleccionarEstudiantes" multiple>
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



    //ACTIVAR LISTA DE PROFESORES POR SECCION
    if (isset($_POST['activarTablaProf'])) {
        $idSeccionProfConsulta = $_POST['idSMConsulta'];

        $listarProfesores_seccionMateria = $objeto->listarProfesores_seccionMateria($idSeccionProfConsulta);

        if (!empty($listarProfesores_seccionMateria)) {
            foreach ($listarProfesores_seccionMateria as $listProf) { ?>
                <tr>
                    <td hidden class="idMateriaProfON"><?php echo $listProf['id_materia']; ?></td>
                    <td hidden class="cedulaProfON"><?php echo $listProf['cedula']; ?></td>
                    <td class="table-info fw-bold"><?php echo $listProf['nombreMateria']; ?></td>
                    <td><?php echo $listProf['codigo']; ?></td>
                    <td><?php echo $listProf['nombre']; ?></td>
                    <td><?php echo $listProf['apellido']; ?></td>
                    <td>
                        <i type="button" class="text-danger fs-5 bi bi-dash-circle" id="eliminarMP_ON" title="Pulsa para eliminar"></i>
                    </td>
                </tr> <?php
            }
        }
    }
    
    //CHOICES DE LISTAR PROFESORES PARA A LA MATERIA DE LA SECCION
    if (isset($_POST['verProfesoresMateriasSelect'])) {
        $idSeccionReferencial= $_POST['idSeccionRef4'];
        $nivDoctrinaReferencial= $_POST['nivDoctrinaRef4'];

        $listarProfesoresOFF = $objeto->listarProfesores();
        $listarMateriasOFF= $objeto->selectMateriasOFF($idSeccionReferencial, $nivDoctrinaReferencial);
        
    ?> <div class="col">
            <select class="form-select" id="seleccionarMateriasAdicionales">
                <option disabled selected value="ninguno">Seleccione la materia</option>
            <?php foreach ($listarMateriasOFF as $matOFF) : ?>
                <option value="<?php echo $matOFF['id_materia']; ?>"><?php echo $matOFF['nombre'] . ' ' . $matOFF['nivelAcademico']; ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        
        <div class="col">
            <select class="form-select" id="seleccionarProfesoresAdicionales">
            <option disabled selected value="ninguno">Seleccione el profesor</option>
            <?php foreach ($listarProfesoresOFF as $profOFF) : ?>
                <option value="<?php echo $profOFF['cedula']; ?>"><?php echo $profOFF['codigo'] . ' ' . $profOFF['nombre'] . ' ' . $profOFF['apellido']; ?></option>
            <?php endforeach; ?>
            </select>
        </div><?php
    }





    
/////////////////////////////////////////////////////////////
/////LISTADO DE MATERIAS POR NIVELES Y LISTAR PROFESORES/////
if (isset($_POST['nivelSeleccionado'])) {
    $nivel = $_POST['nivel'];

    //NIVEL 1
    if ($nivel == 1) {
        $numRow = $objeto->cantidadFilasNiveles($nivel);
        $materiasNivel = $objeto->listarMateriasNivel($nivel);

?>      
        <form class="formulario_MatProfSeccion">
<?php   
        for ($i = 0; $i < $numRow; $i++) { ?>
           
               <div class="row">
                   <div class="col-5 mt-2">
                       <input hidden type="text" class="seleccionarMaterias" value="<?php echo $materiasNivel[$i]['id_materia']; ?>">
                       <input disabled type="text" class="form-control" value="<?php echo $materiasNivel[$i]['nombre']; ?>">
                   </div>
                   
                   <div class="col-7 mt-2">
                       <select class="seleccionarProfesores form-select">
                           <option value="ninguno" selected>Selecciona al profesor</option>
                           <?php foreach ($objeto->listarProfesoresMateria($materiasNivel[$i]['id_materia']) as $key) { ?>
                               <option value="<?php echo $key['cedula_profesor']; ?>">
                               <?php echo $key['codigo'] . ' ' . $key['nombre'] . ' ' . $key['apellido']; ?></option>
                          <?php } ?>
                       </select>
                   </div>
               </div> 
<?php 
        }
?>      
        </form>
        <div class="alert alert-danger" role="alert">
            ¡No dejes campos sin seleccionar!!
        </div>
        <form class="formulario_seminarioSeccion">
        <div class="row mt-3">
            <span>Si desea agregar un seminario, puede seleccionarlo aqui:</span>
            <div class="col-5 mt-2">
                <input hidden type="text" class="seleccionarMaterias" value="">
                <input disabled type="text" class="form-control" value="">
            </div>
        
            <div class="col-7 mt-2">
                <select class="seleccionarProfesores form-select">
                    <option value="no" selected>Quizas luego</option>
                        <option value="2">adasd</option>
                </select>
            </div>
        </div>
        </form>
<?php
    }
    //NIVEL 2
    if ($nivel == 2) {
        $numRow = $objeto->cantidadFilasNiveles($nivel);
        $materiasNivel = $objeto->listarMateriasNivel($nivel);

?>      
        <form class="formulario_MatProfSeccion">
<?php   
        //LISTAR MATERIAS CON PROFESORES PARA ELEGIR
        for ($i = 0; $i < $numRow; $i++) { ?>
           
               <div class="row">
                   <div class="col-5 mt-2">
                       <input hidden type="text" class="seleccionarMaterias" value="<?php echo $materiasNivel[$i]['id_materia']; ?>">
                       <input disabled type="text" class="form-control" value="<?php echo $materiasNivel[$i]['nombre']; ?>">
                   </div>
                   
                   <div class="col-7 mt-2">
                       <select class="seleccionarProfesores form-select">
                           <option value="ninguno" selected>Selecciona al profesor</option>
                           <?php foreach ($objeto->listarProfesoresMateria($materiasNivel[$i]['id_materia']) as $key2) { ?>
                               <option value="<?php echo $key2['cedula_profesor']; ?>">
                               <?php echo $key2['codigo'] . ' ' . $key2['nombre'] . ' ' . $key2['apellido']; ?></option>
                          <?php } ?>
                       </select>
                   </div>
               </div>
<?php 
        }
?>      
        </form> 
        <div class="alert alert-danger" role="alert">
            ¡No dejes campos sin seleccionar!
        </div>
        <form class="formulario_seminarioSeccion">
        <div class="row mt-3">
            <span>Si desea agregar un seminario, puede seleccionarlo aqui:</span>
            <div class="col-5 mt-2">
                <input hidden type="text" class="seleccionarMaterias" value="">
                <input disabled type="text" class="form-control" value="">
            </div>
        
            <div class="col-7 mt-2">
                <select class="seleccionarProfesores form-select">
                    <option value="ninguno" selected>Selecciona al profesor</option>
                        <option value="2">adasd</option>
                </select>
            </div>
        </div> 
        </form>
<?php
    }
    //NIVEL 3
    if ($nivel == 3) {
        $numRow = $objeto->cantidadFilasNiveles($nivel);
        $materiasNivel = $objeto->listarMateriasNivel($nivel);

        
?>      
        <form class="formulario_MatProfSeccion">
<?php   
        //LISTAR MATERIAS CON PROFESORES PARA ELEGIR
        for ($i = 0; $i < $numRow; $i++) { ?>
            <div class="row">
                <div class="col-5 mt-2">
                    <input hidden type="text" class="seleccionarMaterias" value="<?php echo $materiasNivel[$i]['id_materia']; ?>">
                    <input disabled type="text" class="form-control" value="<?php echo $materiasNivel[$i]['nombre']; ?>">
                </div>
                
                <div class="col-7 mt-2">
                    <select class="seleccionarProfesores form-select">
                        <option value="ninguno" selected>Selecciona al profesor</option>
                        <?php foreach ($objeto->listarProfesoresMateria($materiasNivel[$i]['id_materia']) as $key3) { ?>
                            <option value="<?php echo $key3['cedula_profesor']; ?>">
                            <?php echo $key3['codigo'] . ' ' . $key3['nombre'] . ' ' . $key3['apellido']; ?></option>
                       <?php } ?>
                    </select>
                </div>
            </div>
            
<?php 
        }
?>      
        <div hidden class="alertaMatProf alert alert-danger" role="alert">
            ¡No dejes campos sin seleccionar!
        </div>
        </form> 
        
        <form class="formulario_seminarioSeccion">
        <div class="row mt-3">
            <span>Si desea agregar un seminario, puede seleccionarlo aqui:</span>
            <div class="col-5 mt-2">
                <input hidden type="text" class="seleccionarMaterias" value="">
                <input disabled type="text" class="form-control" value="">
            </div>
        
            <div class="col-7 mt-2">
                <select class="form-select">
                    <option value="ninguno" selected>Selecciona al profesor</option>
                        <option value="2">adasd</option>
                </select>
            </div>
        </div>
        </form> 
<?php
    }

}
/////FIN DEL LISTADO DE NIVELES Y PROFESORES/////



?>
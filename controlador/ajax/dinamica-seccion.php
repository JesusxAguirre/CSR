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
                                <p class="mb-0"><em><?php echo 'Fecha de cerrado: '.$seccionesOFF['fecha_cierre'];?></em></p>
                            </div>
                            <button type="button" class="btn btn-outline-info ms-5">Ver estudiantes</button>
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


    //CHOICES JS DE LISTAR ESTUDIANTES PARA REGISTRAR UNA SECCION DEPENDIENDO DEL NIVEL QUE SE SELECCIONE 
    if (isset($_POST['verEstudiantes'])) {
        $nivelRef= $_POST['nivelRef'];

        switch ($nivelRef) {
            case 1:
                $estudiantes = $objeto->sinNivel1(); ?> 

                <select class="form-select" id="seleccionarEstudiantes" multiple>
                    <?php foreach ($estudiantes as $est) : ?>
                    <option value="<?php echo $est['cedula']; ?>">
                        <?php echo $est['codigo'] . ' ' . $est['nombre'] . ' ' . $est['apellido']; ?></option>
                    <?php endforeach; ?>
                </select> 
                <div hidden class="alertaNoEstudiantes alert alert-danger" role="alert">
                    ¡Debes seleccionar minimo 1 estudiante!
                </div> <?php
                break;

            case 2:
                $estudiantes2 = $objeto->sinNivel2(); ?>

                <select class="form-select" id="seleccionarEstudiantes" multiple>
                    <?php foreach ($estudiantes2 as $est2) : ?>
                    <option value="<?php echo $est['cedula']; ?>">
                        <?php echo $est2['codigo'] . ' ' . $est2['nombre'] . ' ' . $est2['apellido']; ?></option>
                    <?php endforeach; ?>
                </select> 
                <div hidden class="alertaNoEstudiantes alert alert-danger" role="alert">
                    ¡Debes seleccionar minimo 1 estudiante!
                </div> <?php
                break;

            case 3:
                $estudiantes3 = $objeto->sinNivel3(); ?>

                <select class="form-select" id="seleccionarEstudiantes" multiple>
                    <?php foreach ($estudiantes3 as $est3) : ?>
                    <option value="<?php echo $est['cedula']; ?>">
                        <?php echo $est3['codigo'] . ' ' . $est3['nombre'] . ' ' . $est3['apellido']; ?></option>
                    <?php endforeach; ?>
                </select> 
                <div hidden class="alertaNoEstudiantes alert alert-danger" role="alert">
                    ¡Debes seleccionar minimo 1 estudiante!
                </div> <?php
                break;
        }
    }



    //CHOICES DE LISTAR ESTUDIANTES PARA AGREGAR MAS A LA SECCION
    if (isset($_POST['verEstudiantes2'])) {
        $nivelAcademicoRef= $_POST['nivelAcademicoRef'];

        switch ($nivelAcademicoRef) {
            case 1:
                $listarEstudiantesOFF1 = $objeto->sinNivel1();

                ?> <select class="form-select" id="seleccionarEstudiantesAdicionales" multiple>
                    <?php foreach ($listarEstudiantesOFF1 as $estOFF1) : ?>
                        <option value="<?php echo $estOFF1['cedula']; ?>"><?php echo $estOFF1['codigo'] . ' ' . $estOFF1['nombre'] . ' ' . $estOFF1['apellido']; ?></option>
                    <?php endforeach; ?>
                    </select><?php
            break;

            case 2:
                $listarEstudiantesOFF2 = $objeto->sinNivel2();

                ?> <select class="form-select" id="seleccionarEstudiantesAdicionales" multiple>
                    <?php foreach ($listarEstudiantesOFF2 as $estOFF2) : ?>
                        <option value="<?php echo $estOFF2['cedula']; ?>"><?php echo $estOFF2['codigo'] . ' ' . $estOFF2['nombre'] . ' ' . $estOFF2['apellido']; ?></option>
                    <?php endforeach; ?>
                    </select><?php
            break;
            
            case 3:
                $listarEstudiantesOFF3 = $objeto->sinNivel3();
                
                ?> <select class="form-select" id="seleccionarEstudiantesAdicionales" multiple>
                    <?php foreach ($listarEstudiantesOFF3 as $estOF) : ?>
                        <option value="<?php echo $estOF['cedula']; ?>"><?php echo $estOF['codigo'] . ' ' . $estOF['nombre'] . ' ' . $estOF['apellido']; ?></option>
                    <?php endforeach; ?>
                    </select><?php
            break;
        }

    
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


    //CHOICES DE LISTAR MAS PROFESORES Y MAS MATERIAS PARA LA SECCION
    if (isset($_POST['verMateriasAdicionales'])) {
        $idSeccionReferencial= $_POST['idSeccionRef4'];
        $nivDoctrinaReferencial= $_POST['nivDoctrinaRef4'];

        $listarMateriasOFF= $objeto->selectMateriasOFF($idSeccionReferencial, $nivDoctrinaReferencial); ?> 
            <select class="form-select" id="seleccionarMateriasAdicionales">
            <option disabled selected value="ninguno">Seleccione la materia</option>
            <?php foreach ($listarMateriasOFF as $matOFF) : ?>
            <option value="<?php echo $matOFF['id_materia']; ?>"><?php echo $matOFF['nombre'] . ' ' . $matOFF['nivelAcademico']; ?></option>
            <?php endforeach; ?>
            </select> <?php
            
    }
    if (isset($_POST['verProfesoresMateriaAdicional'])) {
        $materiaSeleccionada= $_POST['materiaSeleccionada'];
        $profesores_materia= $objeto->profesores_materiaSeleccionada($materiaSeleccionada);?> 

            <option disabled selected value="ninguno">Seleccione el profesor</option>
            <?php foreach ($profesores_materia as $prof) : ?>
                <option value="<?php echo $prof['cedula_profesor']; ?>"><?php echo $prof['codigo'] . ' ' . $prof['nombre'] . ' ' . $prof['apellido']; ?></option>
            <?php endforeach;          
            
    }


    
    /////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////LISTADO DE MATERIAS POR NIVELES Y LISTAR PROFESORES////////////////////

    if (isset($_POST['nivelSeleccionado'])) {
        $nivel = $_POST['nivel'];

        ///////////////////////////////////////////
        ///////////////////////////////////NIVEL 1
        if ($nivel == 1) {
            $numRow = $objeto->cantidadFilasNiveles($nivel);
            $materiasNivel = $objeto->listarMateriasNivel($nivel); ?>      
            <form class="formulario_MatProfSeccion">
      
        <?php for ($i = 0; $i < $numRow; $i++) { ?>

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
     
        <?php } ?>
            <div hidden class="alertaMatProf alert alert-danger" role="alert">
                ¡No dejes campos sin seleccionar!!
            </div>
            </form>
<?php }
        /////////////////////////////////////////////////
        /////////////////////////////////////////NIVEL 2
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
            <div hidden class="alertaMatProf alert alert-danger" role="alert">
                ¡No dejes campos sin seleccionar!
            </div>
            </form> 
    <?php
        }
        //////////////////////////////////////////////////
        //////////////////////////////////////////NIVEL 3
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
    <?php
        }

    }
    /////FIN DEL LISTADO DE NIVELES Y PROFESORES/////


    //VER SEMINARIOS DISPONIBLES
    if (isset($_POST['verSeminarios'])) { ?>
        <option value="no" selected>Quizas luego</option>
        <?php $materias_seminario= $objeto->materias_seminario(); ?>
        <?php foreach ($materias_seminario as $seminarios) { ?>
            <option value="<?php echo $seminarios['id_materia'] ?>"><?php echo $seminarios['nombre'] ?></option>
      <?php } ?> <?php
    }
    //VER LOS PROFESORES DEL SEMINARIO SELECCIONADO
    if (isset($_POST['seminarioSeleccionado'])) { ?>
        <option disabled value="no" selected>Selecciona un profesor</option>

        <?php $listar_profesorSeminario= $objeto->profesor_selectSeminario($_POST['seminarioSeleccionado']);
            if (!empty($listar_profesorSeminario)) {
                foreach ($listar_profesorSeminario as $profSeminario) { ?>
                <option value="<?php echo $profSeminario['cedula_profesor'] ?>"><?php echo $profSeminario['codigo'].' '.$profSeminario['nombre'].' '.$profSeminario['apellido']; ?></option>
        <?php }
        }
    }


?>
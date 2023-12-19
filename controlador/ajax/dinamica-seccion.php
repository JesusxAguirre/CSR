<?php

require_once("../../vendor/autoload.php");

session_start();
use Csr\Modelo\Ecam;
$objeto = new ecam();


    //CHOICES JS DE LISTAR ESTUDIANTES PARA REGISTRAR UNA SECCION DEPENDIENDO DEL NIVEL QUE SE SELECCIONE 
    if (isset($_POST['verEstudiantes'])) {
        $nivelRef= $_POST['nivelRef'];

        $estudiantes = $objeto->sinNivel($nivelRef); ?>
        <select class="form-select" id="seleccionarEstudiantes" multiple>
            <?php foreach ($estudiantes as $est) : ?>
            <option value="<?php echo $est['cedula']; ?>">
                <?php echo $est['codigo'] . ' ' . $est['nombre'] . ' ' . $est['apellido']; ?></option>
            <?php endforeach; ?>
        </select> 
        <div hidden class="alertaNoEstudiantes alert alert-danger" role="alert">
            ¡Debes seleccionar minimo 10 estudiante!
        </div> <?php

        die();
    }



    //CHOICES DE LISTAR ESTUDIANTES PARA AGREGAR MAS A LA SECCION
    if (isset($_POST['verEstudiantes2'])) {
        $nivelAcademicoRef= $_POST['nivelAcademicoRef'];

        $listarEstudiantesOFF1 = $objeto->sinNivel($nivelAcademicoRef)
        ?> <select class="form-select" id="seleccionarEstudiantesAdicionales" multiple>
            <?php foreach ($listarEstudiantesOFF1 as $estOFF1) : ?>
                <option value="<?php echo $estOFF1['cedula']; ?>"><?php echo $estOFF1['codigo'] . ' ' . $estOFF1['nombre'] . ' ' . $estOFF1['apellido']; ?></option>
            <?php endforeach; ?>
            </select>
        <?php
        die();
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
        
        die();    
            
    }
    if (isset($_POST['verProfesoresMateriaAdicional'])) {
        $materiaSeleccionada= $_POST['materiaSeleccionada'];
        $profesores_materia= $objeto->profesores_materiaSeleccionada($materiaSeleccionada);?> 

            <option disabled selected value="ninguno">Seleccione el profesor</option>
            <?php foreach ($profesores_materia as $prof) : ?>
                <option value="<?php echo $prof['cedula_profesor']; ?>"><?php echo $prof['codigo'] . ' ' . $prof['nombre'] . ' ' . $prof['apellido']; ?></option>
            <?php endforeach;          
        
        die();
    }


    
    /////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////LISTADO DE MATERIAS POR NIVELES Y LISTAR PROFESORES////////////////////

    if (isset($_POST['nivelSeleccionado'])) {
        $nivel = $_POST['nivel'];

        /////////////MOSTRANDO FILAS CON MATERIAS Y PROFESORS QUE LA DICTAN DINAMICAMENTE SEA NIVEL 1, 2 o 3
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        
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
<?php 

        die();
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
<?php
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam();

if (isset($_POST['verEstudiantes'])) {
    $estudiantes= $objeto->listarEstudiantes();

    ?> <select class="form-control" id="seleccionarEstudiantes" name="states[]" multiple="multiple">
        <?php foreach ($estudiantes as $est) : ?>
            <option value="<?php echo $est['cedula']; ?>"> <?php echo $est['codigo'] . ' ' . $est['nombre']. ' ' . $est['apellido']; ?></option>
        <?php endforeach; ?>
    </select> <?php
}

/*if (isset($_POST['fun'])) {
    $aloja = $objeto->listarProfesores();
    $json = array();

    foreach ($aloja as $key) {
        $json['data'][] = $key;
    }

    echo json_encode($json);
}*/

if (isset($_POST['nivel'])) {
    $nivel = $_POST['nivel'];
    $numRow = $objeto->cantidadFilasNiveles();
    $materiasNivel = $objeto->listarMateriasNivel($nivel);
    $profesoresNivel = $objeto->listarProfesores();
    if ($nivel == '1') {
        //LISTAR MATERIAS
        for ($i = 0; $i < $numRow; $i++) { ?>
            <div class="col mt-2">
                <select class="seleccionarMaterias form-control">
                    <option value="ninguno">Selecciona la materia</option>
                    <?php foreach ($materiasNivel as $mNivel) : ?>
                        <option value="<?php echo $mNivel['id_materia']; ?>"> <?php echo $mNivel['nombre'] . ' ' . $mNivel['nivelDoctrina']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col mt-2">
                <select class="seleccionarProfesores form-control">
                    <?php foreach ($profesoresNivel as $pNivel) : ?>
                        <option value="<?php echo $pNivel['cedula']; ?>"> <?php echo $pNivel['codigo'] . ' ' . $pNivel['nombre'] . ' ' . $pNivel['apellido']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        <?php }
    }

    if ($nivel == '2') {
        for ($i = 0; $i < $numRow; $i++) { ?>
            <div class="col">
                <select multiple name="" class="form-select">
                    <?php foreach ($profesores as $prof) : ?>
                        <option value="<?php echo $prof['cedula']; ?>"> <?php echo $prof['codigo'] . ' ' . $prof['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php }
    }
    if ($nivel == '3') {
        for ($i = 0; $i < $numRow; $i++) { ?>
            <div class="col">
                <select multiple name="" class="form-select">
                    <?php foreach ($profesores as $prof) : ?>
                        <option value="<?php echo $prof['cedula']; ?>"> <?php echo $prof['codigo'] . ' ' . $prof['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
<?php }
    }
}

?>
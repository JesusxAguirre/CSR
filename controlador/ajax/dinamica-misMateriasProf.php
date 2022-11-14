<?php
session_start();

require_once('../../modelo/clase_ecam.php');
$objeto= new ecam;

if (isset($_POST['guardarCampo'])) {
    $seccionContRef= $_POST['seccionContRef'];
    $materiaContRef= $_POST['materiaContRef'];
    $contenido= $_POST['contenido'];

    $objeto->agregarContenidos($seccionContRef, $materiaContRef, $contenido);
}

if (isset($_POST['verContenido'])) {
    $idSeccion= $_POST['idSeccion'];
    $idMateria= $_POST['idMateria'];

    $listarContenido= $objeto->listarContenido($idSeccion, $idMateria);
    echo $listarContenido[0]['contenido'];

}

if (isset($_POST['vaciarInfo'])) {
    $idSeccion= $_POST['idSeccion'];
    $idMateria= $_POST['idMateria'];

    $listarContenido= $objeto->listarContenido($idSeccion, $idMateria);
}

if (isset($_POST['listarMisMateriasProf'])) {

    $listar_misMaterias= $objeto->listar_misMateriasProf();

    if (!empty($listar_misMaterias)) {
        foreach ($listar_misMaterias as $misMaterias) { ?>
            <tr>
                <td hidden class="idSeccion_materia"><?php echo $misMaterias['id_seccion']; ?></td>
                <td hidden class="cedula_profesorON"><?php echo $misMaterias['cedula']; ?></td>
                <td hidden class="idMateria_materia"><?php echo $misMaterias['id_materia']; ?></td>
                <td class="fw-bold"><?php echo $misMaterias['nombreSeccion']; ?></td>
                <td><?php echo $misMaterias['nombreMateria']; ?></td>
                <td><?php echo $misMaterias['nivelAcademico']; ?></td>
                <td>
                    <?php if ($misMaterias['contenido'] == NULL || $misMaterias['contenido'] == '<p><br></p>') { ?>
                        <button class="agregarInfo btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_misContenidosProf"><i class="bi bi-plus-circle"></i></button>
                        <button class="btn btn-secondary" disabled>Sin informacion</button><?php
                    }else{ ?>
                        <button class="modalContenidoON btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_misContenidosProf">Ver informacion</button>
                        <i class="vaciarInfo btn btn-outline-danger bi bi-archive-fill"></i><?php
                    }?>
                </td>
            </tr>
        
<?php } ?>

<?php } else { ?>
    <h1>vacio</h1>
<?php } 



} 












?>
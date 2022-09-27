<!-- BIENVENIDA -->
<div class="row text-white text-center">
    <div class="col">
        <div class="card bg-success">
            <div class="card-body">
                <div>
                    <h1 class="fw-bold">AULA VIRTUAL <i class="bi bi-mortarboard-fill"></i></h1>
                    <h5 class="fst-italic">¡Bienvenido "<?php echo $_SESSION['nombre'] ?>"!</h5>
                </div>

                <div class="bg-dark py-2">

                    <ul class="nav justify-content-center">
                        <?php if($_SESSION['status_profesor'] == 0){ ?>
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="?pagina=aula-virtual-Est">Inicio</a>
                        </li>
                        <?php } ?>
                        <?php if($_SESSION['status_profesor'] == 1){ ?>
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="?pagina=aula-virtual-Prof">Inicio</a>
                        </li>
                        <?php } ?>
                        <?php if ($_SESSION['status_profesor'] == 0){ ?>
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="?pagina=mis-materiasEstudiante">Mis materias</a>
                        </li>
                        <?php } ?>
                        <?php if ($_SESSION['status_profesor'] == 1){ ?>
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="?pagina=mis-materiasProfesor">Mis materias</a>
                        </li>
                        <?php } ?>
                        <?php if ($_SESSION['status_profesor'] == 0){ ?>
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="?pagina=mis-notas">Mis notas</a>
                        </li>
                        <?php } ?>
                        <?php if ($_SESSION['status_profesor'] == 1){ ?>
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="?pagina=mis-estudiantes">Mis estudiantes</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- FIN DE BIENVENIDA -->
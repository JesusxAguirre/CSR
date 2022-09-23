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
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="?pagina=mis-materiasEstudiante">Mis materias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="?pagina=aula-virtual">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="#">Mis notas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="?pagina=mis-estudiantes">Mis estudiantes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6 btn btn-success mx-1 text-white font-monospace" href="?pagina=mis-materiasProfesor">Mis materias P</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- FIN DE BIENVENIDA -->
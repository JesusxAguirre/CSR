<div class="col-7"> 
                    <div class="row">
                        <div class="col">
                            <div class="card bg-success">
                                <div class="card-header text-white text-center">
                                    <h5 class="card-title">NOMBRE Y NIVEL ACADEMICO</h5>
                                </div>
                                <div class="card-body">
                                    <!-- CAMPO DE NOMBRE DE SECCION -->
                                    <label class="form-label text-white">Introduzca el nombre de la seccion</label>
                                    <input type="text" id="nombreSeccion" class="form-control">

                                    <!-- CAMPO SELECCION DE NIVEL -->
                                    <div class="mt-3">
                                        <label class="form-label text-white" for="nivelSeccion">Selecciona el nivel de la seccion</label>
                                        <select id="nivelSeccion" class="form-select">
                                            <option value="ninguno" selected>Seleccione un nivel</option>
                                            <option value="1">Nivel 1</option>
                                            <option value="2">Nivel 2</option>
                                            <option value="3">Nivel 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">

                                </div>
                            </div>
                        </div>

                        <!-- AGREGAR ESTUDIANTES A LA SECCION -->
                        <div class="col-7">
                            <div class="card bg-primary cartaEstudiantes">
                                <div class="card-header text-center">
                                    <h5 class="card-title text-white">AGREGAR ESTUDIANTES</h5>
                                </div>
                                <div class="card-body">
                                    <div id="dtos_E">

                                    </div>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SELECCIONAR LOS PROFESORES Y MATERIAS -->
                    <div class="row mt-3">
                        <div class="col">
                            <div class="card bg-warning">
                                <div class="card-header text-center">
                                    <h5 class="card-title">MATERIAS Y PROFESORES</h5>
                                </div>
                                <div class="card-body">
                                    <div id="dtos_PM">
                                        <h2 class="text-center text-white">SELECCIONE EL NIVEL ACADEMICO DE LA SECCION</h2>
                                    </div>

                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-grid mt-3">
                                <button class="btn btn-success fs-1" id="crear">AGREGAR <i class="bi bi-plus-circle"></i></button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form1">APRETA</button>
                    </div>
                </div>
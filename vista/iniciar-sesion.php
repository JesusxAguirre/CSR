<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="./resources/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resources/css/login.css">

    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <script src="resources/js/sweetalert2.js"></script>

    <!-- Jquery-->
    <script src="resources/js/jquery-3.6.0.min.js"></script>

    <!-- Sweet alert 2-->
    <script src="resources/js/sweetalert2.js"></script>

</head>

<body>
    <div class="container image">
        <div class="row">
            <div class="col-5 d-none d-md-block">
            </div>
            <div class="col loginCard">
                <div class="text-center">
                    <img class="img-fluid" src="./resources/img/casawhite.png" width="300" height="210" alt="logo" srcset="">
                </div>
                <div class="text-center">
                    <h3>BIENVENIDO</h3>
                </div>
                <hr>
                <!-- INICIO FORMULARIO -->
                <form id="formulario3" action="?pagina=iniciar-sesion" method="post">
                    <div class="mb-4">
                        <label for="email">Correo electronico</label>
                        <input type="text" name="usuario" class="form-control inputF" placeholder="casasobrelaroca@gmail.com">
                    </div>
                    <div class="mb-4">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="clave" class="form-control inputF" placeholder="********">
                    </div>
                    <div class="d-grid">
                        <button name="enviar" value="enviar" type="submit" class="btn btn-outline-primary botonLogin">INCIAR SESION</button>
                    </div>

                    <div class="text-center mt-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#registrar" class="small btn btn-link text-white mb-5 pb-lg-2" href="?pagina=iniciar-sesion">¿No tienes usuario?</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#recuperar" class="small btn btn-link text-white mb-5 pb-lg-2" href="?pagina=iniciar-sesion">Recuperar Contraseña</button>
                    </div>
                </form>
            </div>

        </div>
    </div>





    <!-- Modal -->
    <div class="modal fade" id="registrar" tabindex="-1" aria-labelledby="registrar" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="registrar">Registrar usuarios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formulario" action="?pagina=iniciar-sesion" method="POST">
                        <div class="container-fluid">
                            <div class="row mt-2">
                                <div class="mb-3 row">
                                    <div id="grupo__nombre" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold">Primer Nombre</label>
                                            <i class="input-icon fs-5"></i>
                                            <input maxlength="12" placeholder="Juan" id="nombre" name="nombre" type="text" class="form-control">
                                        </div>
                                        <p class="text-danger d-none">El nombre que ser de 3 a 20 dígitos y solo puede contener letras </p>
                                    </div>
                                    <div id="grupo__apellido" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold">Primer Apellido</label>
                                            <i class="input-icon fs-5"></i>
                                            <input maxlength="12" placeholder="Jimenez" id="apellido" name="apellido" type="text" class="form-control">
                                        </div>
                                        <p class="text-danger d-none">El apellido deben ser de 3 a 20 dígitos y solo puede contener letras </p>
                                    </div>
                                    <div id="grupo__cedula" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold" ">Cedula</label>    
                                        <i class=" input-icon fs-5"></i>
                                                <input maxlength="8" placeholder=" 22222222" id="cedula" name="cedula" class="form-control">
                                        </div>
                                        <p id="mensaje_cedula" class="text-danger d-none">La cedula deben de ser de 7 a 8 dígitos y solo puede contener numeros </p>
                                    </div>
                                    <div id="grupo__edad" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold">Edad</label>
                                            <i class="input-icon fs-5"></i>
                                            <input maxlength="2" placeholder="21" id="edad" name="edad" type="text" class="form-control">
                                        </div>
                                        <p class="text-danger d-none">La edad deben de ser de 1 a 2 dígitos y solo puede contener numeros </p>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div id="grupo__sexo" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold">Sexo</label>
                                            <i class="input-icon fs-5"></i>
                                            <select name="sexo" id="sexo" class="form-select form-select" aria-label=".form-select-sm example">
                                                <option value=''>Escoge</option>
                                                <option value="hombre">Hombre</option>
                                                <option value="mujer">Mujer</option>
                                            </select>
                                        </div>
                                        <p class="text-danger d-none">No puede dejar este campo vacio </p>
                                    </div>
                                    <div id="grupo__civil" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold">Estado civil</label>
                                            <i class="input-icon fs-5"></i>
                                            <select  name="civil" id="civil" class="form-select form-select" aria-label=".form-select-sm example">
                                                <option value="">Escoge tu estado civil</option>
                                                <option value="soltero">Soltero</option>
                                                <option value="soltera">Soltera</option>
                                                <option value="matrimonio">Casada/o</option>
                                            </select>
                                        </div>
                                        <p class="text-danger d-none">No puede dejar este campo vacio </p>
                                    </div>
                                    <div id="grupo__nacionalidad" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold">Nacionalidad</label>
                                            <i class="input-icon fs-5"></i>
                                            <select id="nacionalidad" name="nacionalidad" class="form-select form-select" aria-label=".form-select-sm example">
                                                <option value="">Escoge tu nacionalidad</option>
                                                <option value="venezolana">Venezolana</option>
                                                <option value="colombiana">Colombiana</option>
                                                <option value="española">Española</option>
                                            </select>
                                        </div>
                                        <p class="text-danger d-none">No puede dejar este campo vacio </p>
                                    </div>
                                    <div id="grupo__estado" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold">Estado en el que vive</label>
                                            <i class="input-icon fs-5"></i>
                                            <select id="estado" name="estado" class="form-select form-select" aria-label=".form-select-sm example">
                                                <option value="">Escoge tu estado</option>
                                                <option value="css">Distritio Capital</option>
                                                <option value="lara">Lara</option>
                                                <option value="yaracuy">Yaracuy</option>
                                            </select>
                                        </div>
                                        <p class="text-danger d-none">No puede dejar este campo vacio </p>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div id="grupo__telefono" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold">Telefono</label>
                                            <i class="input-icon fs-5"></i>
                                            <input maxlength="10" id="telefono" placeholder=" XXXXXXXX" name="telefono" class="form-control">
                                        </div>
                                        <p class="text-danger d-none">el formato de telefono debe ser 0412xxxxxxx (10 números) </p>
                                    </div>
                                    <div id="grupo__correo" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold">Correo</label>
                                            <i class="input-icon fs-5"></i>
                                            <input id="correo" placeholder=" example@gmail.com" name="correo" class="form-control">
                                        </div>
                                        <p id="mensaje_correo" class="text-danger d-none">El formato de correo es ejemplo@gmail.com </p>

                                    </div>
                                    <div id="grupo__clave" class="col-sm col-md-3 ">
                                        <div class="relative">
                                            <label class="form-label fw-bold">Clave</label>
                                            <i class="input-icon fs-5"></i>
                                            <input maxlength="18" id="clave" type="password" placeholder="******" name="clave" class="form-control">
                                        </div>
                                        <p class="text-danger d-none">La clave debe contener una Mayuscula, una minuscula, un caracter especial y un numero
                                        Minimo 6 caracteres maximo 18 </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="registrar" name="registrar" class="btn btn-primary">Enviar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade " id="recuperar" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content ">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="">Recuperar contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formulario2" action="?pagina=iniciar-sesion" method="POST">
                        <div class="container-fluid">
                            <div class="row mt-2">
                                <div id="grupo__correo2" class="col-sm  ">
                                    <div class="relative">
                                        <label class="form-label fw-bold">Correo</label>
                                        <i class="input-icon fs-5"></i>
                                        <input id="correo2" placeholder=" example@gmail.com" name="correo2" class="form-control">
                                    </div>
                                    <p id="mensaje_correo" class="text-danger d-none">El formato de correo es ejemplo@gmail.com </p>
                                </div>
                            </div>
                         
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="recuperar" name="recuperar" class="btn btn-primary">Enviar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        error = <?php echo ($error) ? 'true' : 'false'; ?>;

        recuperacion = <?php echo ($recuperacion) ? 'true' : 'false'; ?>
    </script>
    <script src="resources/js/validar-registro-usuario.js"></script>
</body>
</html>
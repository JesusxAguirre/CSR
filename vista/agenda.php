<!DOCTYPE html>
<html>

<head>
    <title>Agenda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">


    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resources/css/style.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Jquery -->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>

    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>

    <!-- SweetAlert2 -->
    <script type="text/javascript" src="resources/js/sweetalert2.js"></script>

    <!-- FullCalendar.io -->
    <link rel="stylesheet" href="resources/library/fullcalendar/lib/main.min.css">
    <link rel="stylesheet" href="resources/css/agenda.css">
    <script src="resources/library/fullcalendar/lib/main.min.js"></script>
    <script src="resources/library/fullcalendar/lib/locales/es.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('agenda');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'local',
                locale: 'es',
                firstDay: 1,
                headerToolbar: {
                    left: 'dayGridMonth,listMonth',
                    center: 'title',
                    right: 'today prev,next'
                },
                footerToolbar: {
                    right: 'prev,next'
                },
                dateClick: function(info) {
                    // Crear evento al hacer clic sobre una fecha (sobre el numero)
                    const dayNumber = info.dayEl.querySelector('.fc-daygrid-day-number')
                    if (info.jsEvent.target == dayNumber) {
                        if (document.getElementById('crearBtn')) {
                            document.getElementById('inicioInput').value = info.dateStr
                            document.getElementById('crearBtn').click()
                        }
                    }
                    
                },
                eventSources: [
                    {
                        events: [
                            <?php foreach ($eventos as $evento): ?>
                            {
                                id: '<?php echo $evento['id_evento'] ?>',
                                title: '<?php echo $evento['titulo'] ?>',
                                start: '<?php echo $evento['inicio'] ?>',
                                end: '<?php echo $evento['final'] ?? $evento['inicio'] ?>',
                                extendedProps: {
                                    descripcion: '<?php echo $evento['descripcion'] ?? "" ?>',
                                    inicio: '<?php echo $evento['inicio'] ?>',
                                    final: '<?php echo $evento['final'] ?? "" ?>',
                                    oculto: '<?php echo $evento['oculto'] ?? "" ?>',
                                }
                            },
                            <?php endforeach; ?>
                            // {
                            //     title: 'Ejemplo',
                            //     start: '2022-10-03T10:30:00',
                            //     end: '2022-10-03T14:00:00'
                            // }
                        ],
                        color: '#0d6efd'
                    },
                    <?php if (isset($eventosOcultos)): ?>
                    {
                        events: [
                            <?php foreach ($eventosOcultos as $evento): ?>
                            {
                                id: '<?php echo $evento['id_evento'] ?>',
                                title: '<?php echo $evento['titulo'] ?>',
                                start: '<?php echo $evento['inicio'] ?>',
                                end: '<?php echo $evento['final'] ?? $evento['inicio'] ?>',
                                extendedProps: {
                                    descripcion: '<?php echo $evento['descripcion'] ?? "" ?>',
                                    inicio: '<?php echo $evento['inicio'] ?>',
                                    final: '<?php echo $evento['final'] ?? "" ?>',
                                    oculto: '<?php echo $evento['oculto'] ?? "" ?>',
                                }
                            },
                            <?php endforeach; ?>
                        ],
                        color: '#2C3E50'
                    }
                    <?php endif ?>

                ],
                eventDidMount: function(info) {
                    if (info.view.type == "dayGridMonth") {
                        info.el.title = info.event.title
                    }
                },
                eventClick: function(info) {
                    var editModal = new bootstrap.Modal(document.getElementById('editar'))

                    document.getElementById('tituloInputE').value = info.event.title
                    document.getElementById('descripcionInputE').value = info.event.extendedProps.descripcion
                    document.getElementById('inicioInputE').value = info.event.extendedProps.inicio
                    document.getElementById('finalInputE').value = info.event.extendedProps.final
                    if (info.event.extendedProps.oculto == 0) {
                        if (document.getElementById('noOculto'))
                            document.getElementById('noOculto').checked = 'checked'
                    } else {
                        if (document.getElementById('oculto'))
                            document.getElementById('oculto').checked = 'checked'
                    }

                    editModal.show()
                }
            });
            calendar.render();
        });
    </script>

</head>

<body>

    <!-- Menu.php -->
    <?php
    require_once "./resources/View_Components/Menu.php";
    ?>
    <!-- Menu.php -->
    <!-- sidebar.php -->
    <?php
    require_once "./resources/View_Components/Sidebar.php";
    ?>
    <!-- sidebar.php -->
    <main class="pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex justify-content-between">
                        <h4 class="page-title">Agenda de Eventos</h4>
                        <?php if ($_SESSION['permisos']['agenda']['crear']): ?>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#crear" id="crearBtn">Agregar evento</button>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body" id="agenda"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal crear -->
    <div class="modal fade edit-modal" id="crear" tabindex="-1" aria-labelledby="ModalCrear" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title">Crear Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form" method="post" id="createForm">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="tituloInput">
                                Titulo *
                            </label>
                            <input type="text" name="titulo" id="tituloInput" class="form-control" placeholder="Ej: Clases de Algebra" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="descripcionInput">
                                Descripción
                            </label>
                            <textarea name="descripcion" id="descripcionInput" class="form-control"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label fw-bold" for="inicioInput">
                                    Inicia *
                                </label>
                                <input type="date" name="inicio" id="inicioInput" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold" for="finalInput">
                                    Termina (Opcional)
                                </label>
                                <input type="date" name="final" id="finalInput" class="form-control">
                            </div>
                        </div>
                        <?php if ($_SESSION['permisos']['agenda_oculta']['crear']): ?>
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="display: block;">
                                    Tipo de evento *
                                </label>
                                <label><input type="radio" name="oculto" value="0" checked> Normal</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type="radio" name="oculto" value="1"> Oculto</label><br>
                                <span style="display: inline-block; font-size: 12px; color: #333;">Los eventos ocultos son visibles <b>unicamente</b> para los usuarios con el permiso necesario</span>
                            </div>
                        <?php endif ?>
                        
                        <input type="hidden" name="create">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" form="createForm">Crear</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar -->
    <div class="modal fade edit-modal" id="editar" tabindex="-1" aria-labelledby="ModalEditar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title">Editar Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form" method="post" id="editForm">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="tituloInputE">
                                Titulo *
                            </label>
                            <input type="text" name="titulo" id="tituloInputE" class="form-control" placeholder="Ej: Clases de Algebra" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="descripcionInputE">
                                Descripción
                            </label>
                            <textarea name="descripcion" id="descripcionInputE" class="form-control"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label fw-bold" for="inicioInputE">
                                    Inicia *
                                </label>
                                <input type="date" name="inicio" id="inicioInputE" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold" for="finalInputE">
                                    Termina (Opcional)
                                </label>
                                <input type="date" name="final" id="finalInputE" class="form-control">
                            </div>
                        </div>
                        <?php if ($_SESSION['permisos']['agenda_oculta']['crear']): ?>
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="display: block;">
                                    Tipo de evento *
                                </label>
                                <label><input type="radio" name="oculto" id="noOculto" value="0" checked> Normal</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type="radio" name="oculto" id="oculto" value="1"> Oculto</label><br>
                                <span style="display: inline-block; font-size: 12px; color: #333;">Los eventos ocultos son visibles <b>unicamente</b> para los usuarios con el permiso necesario</span>
                            </div>
                        <?php endif ?>
                        
                        <input type="hidden" name="id" id="idInputE">
                        <input type="hidden" name="edit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" form="editForm">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        alertStatus = <?php echo $alert['status'] ?? '""'; ?>;
        alertMsg = <?php echo (isset($alert['msg'])) ? '"' . $alert['msg'] . '"' : '""'; ?>;
    </script>
</body>
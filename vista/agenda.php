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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('agenda');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                firstDay: 1,
                dateClick: function(info) {
                    console.log('Clicked on: ' + info.dateStr);
                    console.log('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    console.log('Current view: ' + info.view.type);
                    console.log(info.dayEl);
                    info.dayEl.style.borderColor = 'red';
                },
                eventSources: [

                    // your event source
                    {
                        events: [
                            <?php foreach ($eventos as $evento): ?>
                            {
                                title: '<?php echo $evento['titulo'] ?>',
                                start: '<?php echo $evento['inicio'] ?>',
                                end: '<?php echo $evento['final'] ?? $evento['inicio'] ?>'
                            },
                            <?php endforeach; ?>
                        ]
                    }

                ]
            });
            calendar.render();
            calendar.addEventSource([
                {
                    title: 'event4',
                    start: '2022-10-30',
                    color: 'white', // an option!
                    textColor: 'red' // an option!
                }
            ])
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
                    <div class="page-title-box">
                        <h4 class="page-title">Agenda de Eventos</h4>
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

    <script type="text/javascript">
        alertStatus = <?php echo $alert['status'] ?? '""'; ?>;
        alertMsg = <?php echo (isset($alert['msg'])) ? '"' . $alert['msg'] . '"' : '""'; ?>;
    </script>
</body>
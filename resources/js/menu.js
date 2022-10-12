
$('#verNotificaciones').click(function (e) { 
    e.preventDefault();
    let li = document.getElementById('notificaciones');

    let status_profesor = document.getElementById('status_profesorPOST').value;
    let id_seccion = document.getElementById('id_seccionPOST').value;

    if (status_profesor == 0 && id_seccion > 0) {
        $.post("controlador/ajax/notificaciones.php", {not_estudiantes: 'not_estudiantes'},
            function (data) {
                li.innerHTML = data;
            },
        );
    }

    if (status_profesor == 1 && id_seccion == 0) {
        $.post("controlador/ajax/notificaciones.php", {not_profesores: 'not_profesores'},
            function (data) {
                li.innerHTML = data;
            },
        );
    }
})
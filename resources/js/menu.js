
fotoPerfil();
$('#verNotificaciones').click(function (e) {
    e.preventDefault();
    let li = document.getElementById('notificaciones');

    let status_profesor = document.getElementById('status_profesorPOST').value;
    let id_seccion = document.getElementById('id_seccionPOST').value;

    if (status_profesor == 0 && id_seccion > 0) {
        $.post("controlador/ajax/notificaciones.php", { not_estudiantes: 'not_estudiantes' },
            function (data) {
                li.innerHTML = data;
            },
        );
    }

    if (status_profesor == 1 && id_seccion == 0) {
        $.post("controlador/ajax/notificaciones.php", { not_profesores: 'not_profesores' },
            function (data) {
                li.innerHTML = data;
            },
        );
    }
})

function fotoPerfil() {
    $.ajax({
        data: { data_load: 'data_load' },
        type: "GET",
        url: "index.php?pagina=mi-perfil",
    }).done((data) => {
        const dato = JSON.parse(data);
        let objeto = [];

        //Guardando objeto en otra variable
        for (const datos of dato) {
            objeto = datos;
        }
        document.getElementById('menu_nombre').textContent = objeto.nombre + ' ' + objeto.apellido;
        document.getElementById('menu_email').textContent = objeto.usuario;

        document.getElementById('menu_img_perfil').src = objeto.ruta_imagen === "" ? "resources/img/nothingPhoto.png" : objeto.ruta_imagen;
        document.getElementById('menu_img_perfil2').src = objeto.ruta_imagen === "" ? "resources/img/nothingPhoto.png" : objeto.ruta_imagen;

    	});
}

document.getElementById('logout').addEventListener('click', () => {
    $.ajax({
        type: "POST",
        url: window.location.href,
        data: {
            cerrar: 'cerrar',
        },
        success: function (response) {
            const data = JSON.parse(response);

            Swal.fire({
                title: 'Ha cerrado sesion correctamente. Vuelva pronto',
                timer: 2000,
                showConfirmButton: false,
                willClose: () => {
                    window.location.replace('index.php')
                }
            });
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
            // Código a ejecutar si se produjo un error al realizar la solicitud
            var response;
            try {
                response = JSON.parse(xhr.responseText);
            } catch (e) {
                response = {};
            }
        }
    })
})


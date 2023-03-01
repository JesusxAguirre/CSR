seccionesCerradas();



//LISTAR SECCIONES CERRADAS
function seccionesCerradas() {
    let div = document.getElementById('listarSeccionesOFF');
    $.post("controlador/ajax/dinamica-seccion.php", {verSeccionesOFF: 'verSeccionesOFF'},
        function (data) {
            div.innerHTML= data;
        },
    );
}


//LISTAR LOS ESTUDIANTES DE LA SECCION CERRADA
$(document).on('click', '#estudiantesOFF', function () {
    let div= document.getElementById('estudiantes_seccionCerrada');

    let elemento= $(this)[0].parentElement;
    let idSeccionCerrada= elemento.querySelector('.idSeccion_cerrada').value;

    var data= {
        verEstudiantes_seccionCerrada: 'verEstudiantes_seccionCerrada',
        idSeccionCerrada: idSeccionCerrada,
    }
    $.post("controlador/ajax/dinamica-seccion.php", data,
        function (data) {
            $('#tituloSeccionOFF').text(elemento.querySelector('.nombre_seccionCerrada').value);
            div.innerHTML= data
        },
    );
});


//ELIMINAR DEFITINTIVAMENTE UNA SECCION SELECCIONADA
$(document).on('click', '#eliminarSeccionOFF', function () {
    let elemento= $(this)[0].parentElement;
    let idSeccionCerrada= elemento.querySelector('.idSeccion_cerrada').value;

    var data= {
        eliminarSeccion2: 'eliminarSeccion2',
        idSeccionCerrada: idSeccionCerrada,
    }
    Swal.fire({
      title: '¿Segur@ que desea eliminar definitivamente la seccion?',
      icon: 'warning',
      iconColor: 'red',
      showCancelButton: true,
      confirmButtonColor: 'green',
      cancelButtonColor: 'red',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("controlador/ajax/CRUD-seccion.php", data,
        function (data) {
            seccionesCerradas();
            Swal.fire({
                icon: 'success',
                iconColor: 'white',
                title: '¡Seccion eliminada definitivamente!',
                background: 'green',
                color: 'white',
                showConfirmButton: false,
                timer: 2000,
            });
        });
      }
    })
    
});
    



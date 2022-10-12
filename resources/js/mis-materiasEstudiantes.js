listarMateriasEst();
let hoy = new Date();
let mes = hoy.getMonth()+1
let fecha = hoy.getFullYear()+'-'+mes+'-'+hoy.getDate();
comprobarBoletin();

function comprobarBoletin() {
    let li = document.getElementById('boletinNotas')
    $.post("controlador/ajax/aula-virtual-Est2.php", {comprobarBoletin: 'comprobarBoletin'},
        function (data)  {
            let json = JSON.parse(data);
            let fechaCierre = json[0]['fecha_cierre'];
            if (fecha >= fechaCierre) {
                li.innerHTML = '<a href="?pagina=boletin_notas" class="nav-link px-3">\
                                    <span class="me-2">\
                                    <i class="bi bi-journal-check"></i></span>\
                                    <span>Boletin de notas</span>\
                                </a>';
            }
        },
    );
}

//LISTAR CONTENIDOS POR MATERIA
$(document).on('click', '.verContenido', function () {
    let div= document.getElementById('miContenido');
    let elemento= $(this)[0].parentElement;
    let contenido= elemento.querySelector('.contenidoMateria').value;

    div.innerHTML= contenido;
})


//LISTAR MATERIAS DEL ESTUDIANTE
function listarMateriasEst() {
    let listadoMateriasEst = document.getElementById("verCartas");
    $.ajax({
      data: {verMaterias: 'verMaterias'},
      type: "post",
      url: "controlador/ajax/dinamica-misMateriasEst.php",
    }).done((data) => {
      listadoMateriasEst.innerHTML = data;
    });
}





  
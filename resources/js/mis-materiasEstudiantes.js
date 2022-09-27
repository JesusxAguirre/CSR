listarMateriasEst();

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





  
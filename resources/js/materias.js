listarMaterias();

//BUSCAR MATERIAS POR AJAX
const buscarMateria = document.getElementById("buscarMateria");
const datosMaterias = document.getElementById("datosMaterias");

buscarMateria.addEventListener("keyup", () => {
  $.ajax({
    data: {
      buscarMateria: document.getElementById("buscarMateria").value,
    },
    url: "controlador/ajax/buscar-materias.php",
    type: "post",
  }).done((data) => {
    datosMaterias.innerHTML = data;
  });
});


//AGREGAR MATERIAS POR AJAX
$("#agregarMateria").on("click", function (e) {
  e.preventDefault();

  const data = {
    agregarMateria: $("#agregarMateria").val(),
    nombreMateria: $("#nombreMateria").val(),
    seleccionarNivel: $("#seleccionarNivel").val(),
  };
  $.post("controlador/ajax/agregar-materias.php", data, function (response) {
    listarMaterias();
    $("#formAgregarMateria").trigger("reset");
  });
});


//LISTAR MATERIAS POR AJAX
function listarMaterias() {
  const listadoMaterias = document.getElementById("datosMaterias");
  $.ajax({
    type: "post",
    url: "controlador/ajax/listar-materias.php",
  }).done((data) => {
    datosMaterias.innerHTML = data;
  });
}

//ELIMINAR MATERIAS
$(document).on('click', '.eliminarMateria', function (e) { 
    let elemento = $(this)[0].parentElement.parentElement;
    var idMateria= elemento.querySelector('.idMateria').textContent;

    Swal.fire({
      icon: 'warning',
      title: 'Estas seguro que deseas eliminar?',
      showDenyButton: true,
      confirmButtonText: `Eliminar`,
      confirmButtonColor: 'black',
      denyButtonText: `Cancelar`,
    }).then((result) => {
      if (result.isConfirmed) {
        console.log('jijiji');
      } 
    })

    /*$.post("controlador/ajax/actualizar-eliminar-materias.php", {idMateria},
        function (response) {
            console.log(response);
        },
    );*/
    
});
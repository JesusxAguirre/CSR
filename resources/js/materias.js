window.onload= function () {
    listarMaterias();
  }


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


//LISTAR MATERIAS POR AJAX
function listarMaterias() {
  let listadoMaterias = document.getElementById("datosMaterias");
  $.ajax({
    type: "post",
    url: "controlador/ajax/listar-materias.php",
  }).done((data) => {
    listadoMaterias.innerHTML = data;
  });
}


//ELIMINAR MATERIAS
$(document).on('click', '#eliminarMateria', function () {

  let elemento = $(this)[0].parentElement.parentElement;
  let idMateria= elemento.querySelector('.idMateria').textContent;
  let botonEliminar= $(this)[0].value;

  Swal.fire({
    icon: 'warning',
    title: 'Estas seguro que deseas eliminar?',
    showDenyButton: true,
    confirmButtonText: `Eliminar`,
    confirmButtonColor: 'red',
    denyButtonText: `Cancelar`,
    denyButtonColor: 'black'
  }).then((result) => {
      if (result.isConfirmed) {
        $.post("controlador/ajax/CRUD-materias.php", {idMateria, botonEliminar}, function (response){
          listarMaterias();
          console.log(response);
        })
      }
    })
});


//AGREGAR MATERIAS POR AJAX
$("#agregarMateria").on("click", function (e) {
  e.preventDefault();

  const data = {
    agregarMateria: $("#agregarMateria").val(),
    nombreMateria: $("#nombreMateria").val(),
    seleccionarNivel: $("#seleccionarNivel").val(),
  };
  $.post("controlador/ajax/CRUD-materias.php", data, function (response) {
    listarMaterias();
    $("#formAgregarMateria").trigger("reset");
  });
});

  
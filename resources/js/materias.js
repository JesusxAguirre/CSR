window.onload= function () {
    listarMaterias();
  }


//BUSCAR MATERIAS POR AJAX
const buscarMateria = document.getElementById("buscarMateria");


buscarMateria.addEventListener("keyup", () => {
  let datosMaterias = document.getElementById("datosMaterias");
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

  if (campos[0] && campos[1]) {
    $.post("controlador/ajax/CRUD-materias.php", data, function (response) {
      listarMaterias();
      $("#formularioMateria").trigger("reset");
      document.getElementById('nombreMateria').classList.remove('validarBien');
      document.getElementById('seleccionarNivel').classList.remove('validarBien');
    });
  }else{
    Swal.fire({
      icon: 'error',
      title: 'Debes cumplir con los requisitos de los campos',
    })
  }
});

/////////////////////////////////////////////////////////////////////////////



//INICIO DE VALIDACIONES ALIAS "COCAINE"

const expresionesMaterias = {
	nombreMateria: /^[a-zA-ZÀ-ÿ0-9\s]{3,30}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
}

const inputsFC= document.querySelectorAll('#formularioMateria input');
const selectsFC= document.querySelectorAll('#formularioMateria select');
var campos= {
  nombreMateria: false,
  nivelMateria: false,
}

//VALIDAR NOMBRE DE LAS MATERIAS
var validarNombreMateria= (evento) => {

  switch (evento.target.name) {
    case 'nombreMateria':
        //console.log('Si funciona');
        if (expresionesMaterias.nombreMateria.test(evento.target.value)) {
          document.getElementById('nombreMateria').classList.remove('validarMal');
          document.getElementById('nombreMateria').classList.add('validarBien');
          document.getElementById("nomMateriaMal").setAttribute("hidden", "hidden");
          campos[0]= true;
        }else{
          document.getElementById('nombreMateria').classList.remove('validarBien');
          document.getElementById('nombreMateria').classList.add('validarMal');
          document.getElementById("nomMateriaMal").removeAttribute("hidden");
          campos[0]= false;
        }
      break;
   
  }
}

inputsFC.forEach((evento) => {
  evento.addEventListener("keyup", validarNombreMateria);
  evento.addEventListener("blur", validarNombreMateria);
});
//FIN DE VALIDAR NOMBRES DE LAS MATERIAS


//VALIDAR SELECTS DE LA MATERIA
var validarNivelMateria= (evento) => {
  if (evento.target.value == 'ninguno') {
    document.getElementById('seleccionarNivel').classList.remove('validarBien');
    document.getElementById('seleccionarNivel').classList.add('validarMal');
    document.getElementById("nivMateriaMal").removeAttribute("hidden");
    campos[1]= false;
  }else{
    document.getElementById('seleccionarNivel').classList.remove('validarMal');
    document.getElementById('seleccionarNivel').classList.add('validarBien');
    document.getElementById("nivMateriaMal").setAttribute("hidden", "hidden");
    campos[1]= true;
  }
}




selectsFC.forEach((evento) => {
  evento.addEventListener("click", validarNivelMateria);
  evento.addEventListener("blur", validarNivelMateria);
});





/*//EXPRESIONES DE RESPALDO
const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
}*/

  
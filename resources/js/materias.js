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


//RELLENANDO DATOS PARA ACTUALIZAR MATERIA
$(document).on('click', '#actualizarM', function () {
  //console.log('verigud Macheturrio');
  var elementoR= $(this)[0].parentElement.parentElement;
  const valoresMateria= elementoR.querySelectorAll('td');

  document.getElementById('idMateria2').value = valoresMateria[0].textContent;
  document.getElementById('nombreMateria2').value = valoresMateria[1].textContent;
  document.querySelector('#seleccionarNivel2').value = valoresMateria[2].textContent;
  campos2[0]= true;
  campos2[1]= true;
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
    const toast= Swal.mixin({
      toast: true,
      background: 'red',
      color: 'white',
      showConfirmButton: false,
      timer: 2000,
    });

    toast.fire({
      icon: 'error',
      iconColor: 'white',
      title: 'Debes cumplir con los requisitos de los campos',
    })
  }
});

//ACTUALIZANDO MATERIAS
$("#actualizarMateria").on("click", function (e) {
  const data2 = {
    actualizarMateria: $("#actualizarMateria").val(),
    idMateria2: $("#idMateria2").val(),
    nombreMateria2: $("#nombreMateria2").val(),
    seleccionarNivel2: $("#seleccionarNivel2").val(),
  };

  if (campos2[0] && campos2[1]) {
    $.post("controlador/ajax/CRUD-materias.php", data2, function (response) {
      console.log(response);
      listarMaterias();
      document.getElementById('nombreMateria2').classList.remove('validarBien');
      document.getElementById('seleccionarNivel2').classList.remove('validarBien');
    });
  }else{
    const toast= Swal.mixin({
      toast: true,
      background: 'red',
      color: 'white',
      showConfirmButton: false,
      timer: 2000,
      position: 'bottom',
    });

    toast.fire({
      icon: 'error',
      iconColor: 'white',
      title: 'Debes cumplir con los requisitos de los campos',
    })
  }
});



/////////////////////////////////////////////
//INICIO DE VALIDACIONES AL AGREGAR MATERIAS
/////////////////////////////////////////////

const expresionesMaterias = {
	nombreMateria: /^[a-zA-ZÀ-ÿ0-9\s]{3,30}$/, // Letras y espacios, pueden llevar acentos.
}

var campos= {
  nombreMateria: false,
  nivelMateria: false,
}


//VALIDAR NOMBRE DE LAS MATERIAS
const inputsFC= document.querySelectorAll('#formularioMateria input');

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
const selectsFC= document.querySelectorAll('#formularioMateria select');

var validarNivelMateria= (evento) => {
  
  if(evento.target.value == '1' || evento.target.value == '2' || evento.target.value == '3' || evento.target.value == 'Especial') {
    document.getElementById('seleccionarNivel').classList.remove('validarMal');
    document.getElementById('seleccionarNivel').classList.add('validarBien');
    document.getElementById("nivMateriaMal").setAttribute("hidden", "hidden");
    campos[1]= true;
  }else{
    document.getElementById('seleccionarNivel').classList.remove('validarBien');
    document.getElementById('seleccionarNivel').classList.add('validarMal');
    document.getElementById("nivMateriaMal").removeAttribute("hidden");
    campos[1]= false;
  }

}

selectsFC.forEach((evento) => {
  evento.addEventListener("click", validarNivelMateria);
  evento.addEventListener("blur", validarNivelMateria);
});
//FIN DE VALIDACIONES AL AGREGAR MATERIAS







///////////////////////////////////////////////
//INICIO DE VALIDACIONES AL ACTUALIZAR MATERIAS
///////////////////////////////////////////////
const expresionesMaterias2 = {
	nombreMateria: /^[a-zA-ZÀ-ÿ0-9\s]{3,30}$/, // Letras y espacios, pueden llevar acentos.
}

var campos2= {
  nombreMateria: false,
  nivelMateria: false,
}


//VALIDAR NOMBRE DE LAS MATERIAS AL ACTUALIZAR

var validarNombreMateria2= function () {
  if (expresionesMaterias2.nombreMateria.test(document.getElementById('nombreMateria2').value)) {
    document.getElementById('nombreMateria2').classList.remove('validarMal');
    document.getElementById('nombreMateria2').classList.add('validarBien');
    document.getElementById("nomMateriaMal2").setAttribute("hidden", "hidden");
    campos2[0]= true;
  }else{
    document.getElementById('nombreMateria2').classList.remove('validarBien');
    document.getElementById('nombreMateria2').classList.add('validarMal');
    document.getElementById("nomMateriaMal2").removeAttribute("hidden");
    campos2[0]= false;
  }
}

$('#nombreMateria2').keyup(function (e) { 
  validarNombreMateria2();
});
$('#nombreMateria2').blur(function (e) { 
  validarNombreMateria2();
});
//FIN DE VALIDAR NOMBRES DE LAS MATERIAS AL ACTUALIZAR


//VALIDAR SELECTS DE LA MATERIA AL ACTUALIZAR
const selectsFA= document.getElementById('seleccionarNivel2');

var validarNivelMateria2= function (){

  if(selectsFA.value == '1' || selectsFA.value == '2' || selectsFA.value == '3' || selectsFA.value == 'Especial') {
    document.getElementById('seleccionarNivel2').classList.remove('validarMal');
    document.getElementById('seleccionarNivel2').classList.add('validarBien');
    document.getElementById("nivMateriaMal2").setAttribute("hidden", "hidden");
    campos2[1]= true;
  }else{
    document.getElementById('seleccionarNivel2').classList.remove('validarBien');
    document.getElementById('seleccionarNivel2').classList.add('validarMal');
    document.getElementById("nivMateriaMal2").removeAttribute("hidden");
    campos2[1]= false;
  }
}

$('#seleccionarNivel2').click(function (e) { 
  validarNivelMateria2();
});
$('#seleccionarNivel2').blur(function (e) { 
  validarNivelMateria2();
});
$('.cancelarActualizar').click(function (e) { 
  document.getElementById('nombreMateria2').classList.remove('validarMal');
  document.getElementById('nombreMateria2').classList.remove('validarBien');
  document.getElementById("nomMateriaMal2").setAttribute("hidden", "hidden");
  document.getElementById('seleccionarNivel2').classList.remove('validarMal');
  document.getElementById('seleccionarNivel2').classList.remove('validarBien');
  document.getElementById("nivMateriaMal2").setAttribute("hidden", "hidden");
});





/*//EXPRESIONES DE RESPALDO
const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
}*/

  
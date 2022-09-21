listarMaterias();
choices1();


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
  var elementoR = $(this)[0].parentElement.parentElement;
  const valoresMateria = elementoR.querySelectorAll('td');

  document.getElementById('idMateria2').value = valoresMateria[0].textContent;
  document.getElementById('nombreMateria2').value = valoresMateria[1].textContent;
  document.querySelector('#seleccionarNivel2').value = valoresMateria[2].textContent;
  campos2[0] = true;
  campos2[1] = true;
});


//LISTAR PROFESORES DE LA MATERIAS
function listarProfesoresMateria(idMateriaP) {
  let listadoProfesores = document.getElementById("datos2");

  $.ajax({
    data: {
      idMateriaProf: idMateriaP,
    },
    type: "post",
    url: "controlador/ajax/listar-profesoresMateria.php",
  }).done((data) => {
    listadoProfesores.innerHTML = data;
  });
}

//CONSULTANDO PROFESOR QUE NO ESTEN VINCULADOS A LA MATERIA PARA AGREGAR
function consultaDeProfesores(idNoMateria, botonEditarProfM) {
  let listadoCDP = document.getElementById("datos3");

  $.ajax({
    data: {
      idNoMateria: idNoMateria,
      botonEditarProfM: botonEditarProfM,
    },
    type: "post",
    url: "controlador/ajax/CRUD-materias.php",
  }).done((data) => {
    listadoCDP.innerHTML = data;
    choices2();
  });
}

//SELECT PARA LA ACTUALIZACION VINCULACION DE PROFESOR CON LA MATERIA
function choices2() {
  var profesores2 = document.getElementById('seleccionarProfV');
  new Choices(profesores2, {
    allowHTML: true,
    maxItemText: 3,
    removeItems: true,
    removeItemButton: true,
    noResultsText: 'No hay coicidencias',
    noChoicesText: 'No hay participantes disponibles',
    placeholderValue: 'Buscar profesor',
  });
}

//BOTON DEL MODAL PARA EDITAR PROFESORES DE LA MATERIA (ABRIR MODAL)
$(document).on('click', '#editarProf', function (e) {
  e.preventDefault();

  let botonEditarProfM = $(this)[0].value;
  let elemento = $(this)[0].parentElement.parentElement;
  let idMateria = elemento.querySelector('.idMateria').textContent;

  listarProfesoresMateria(idMateria);
  consultaDeProfesores(idMateria, botonEditarProfM);
});
///////////////////////////////////////////////////////////////


//ACTUALIZAR Y AGREGAR(VINCULAR) PROFESORES A LA MATERIA DINAMICAMENTE POR AJAX
$(document).on('click', '#actualizarProfesores', function (e) {
  e.preventDefault();
  
  const data2 = {
    actualizarProfesores: $("#actualizarProfesores").val(),
    idMateriaV: $("#idMateriaV").val(),
    cedulaProfesorV: $("#seleccionarProfV").val(),
  };
  
  if (data2.cedulaProfesorV == '') {

    const toast = Swal.mixin({
      toast: true,
      background: 'red',
      color: 'white',
      showConfirmButton: false,
      timer: 2000,
    });

    toast.fire({
      icon: 'error',
      iconColor: 'white',
      title: 'No seleccionaste ninguno de los profesores disponibles',
    });
  } else {
    $.post("controlador/ajax/CRUD-materias.php", data2, function (response) {
      listarProfesoresMateria(data2.idMateriaV);
      $('#formularioVincularProf').trigger('reset');
      consultaDeProfesores(data2.idMateriaV, data2.actualizarProfesores);
    });
  }
})

//ELIMINAR(DESVINCULAR) PROFESORES VINCULADOS A LA MATERIA
$(document).on('click', '#eliminarProfesorMateria', function () {

  let elemento = $(this)[0].parentElement.parentElement;
  let cedulaProf = elemento.querySelector('#cedulaProfesor').textContent;
  let idMateria2 = elemento.querySelector('#idMateriaProfesor').textContent;
  let eliminarProfMat = $(this)[0].value;

  Swal.fire({
    icon: 'warning',
    title: 'Estas segur@ que deseas desvincular al profesor de la materia?',
    showDenyButton: true,
    confirmButtonText: `Eliminar`,
    confirmButtonColor: 'red',
    denyButtonText: `Cancelar`,
    denyButtonColor: 'black'
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("controlador/ajax/CRUD-materias.php", {
        cedulaProf,
        idMateria2,
        eliminarProfMat
      }, function (response) {
        listarProfesoresMateria(idMateria2);
        consultaDeProfesores(idMateria2, eliminarProfMat);
      })
    }
  })
})


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
///////////////////////////////////////////////////////////////////


//ELIMINAR MATERIAS
$(document).on('click', '#eliminarMateria', function () {

  let elemento = $(this)[0].parentElement.parentElement;
  let idMateria = elemento.querySelector('.idMateria').textContent;
  let botonEliminar = $(this)[0].value;

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
      $.post("controlador/ajax/CRUD-materias.php", {
        idMateria,
        botonEliminar
      }, function (response) {
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
    cedulaProfesor: $("#seleccionarProf").val(),
  };

  if (campos[0] && campos[1]) {
    $.post("controlador/ajax/CRUD-materias.php", data, function (response) {
      Swal.fire({
        
        
      });
      listarMaterias();
      $("#formularioMateria").trigger("reset");
      document.getElementById('nombreMateria').classList.remove('validarBien');
      document.getElementById('seleccionarNivel').classList.remove('validarBien');
    });
    
  } else {
    const toast = Swal.mixin({
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


//SELECT PARA AGREGAR LOS PROFESORES CON LAS MATERIAS
function choices1 () {
  var profesores = document.getElementById('seleccionarProf');
  new Choices(profesores, {
    allowHTML: true,
    maxItemText: 3,
    removeItems: true,
    removeItemButton: true,
    noResultsText: 'No hay coicidencias',
    noChoicesText: 'No hay participantes disponibles',
    placeholderValue: 'Buscar profesor',
  });
}


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
      listarMaterias();
      document.getElementById('nombreMateria2').classList.remove('validarBien');
      document.getElementById('seleccionarNivel2').classList.remove('validarBien');
    });
  } else {
    const toast = Swal.mixin({
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



/////////////////////////////////////////////
//INICIO DE VALIDACIONES AL AGREGAR MATERIAS
/////////////////////////////////////////////

const expresionesMaterias = {
  nombreMateria: /^[a-zA-ZÀ-ÿ0-9\s]{3,50}$/, // Letras y espacios, pueden llevar acentos.
}

var campos = {
  nombreMateria: false,
  nivelMateria: false,
}


//VALIDAR NOMBRE DE LAS MATERIAS
const inputsFC = document.querySelectorAll('#formularioMateria input');

var validarNombreMateria = (evento) => {

  switch (evento.target.name) {
    case 'nombreMateria':
      //console.log('Si funciona');
      if (expresionesMaterias.nombreMateria.test(evento.target.value)) {
        document.getElementById('nombreMateria').classList.remove('validarMal');
        document.getElementById('nombreMateria').classList.add('validarBien');
        document.getElementById("nomMateriaMal").setAttribute("hidden", "hidden");
        campos[0] = true;
      } else {
        document.getElementById('nombreMateria').classList.remove('validarBien');
        document.getElementById('nombreMateria').classList.add('validarMal');
        document.getElementById("nomMateriaMal").removeAttribute("hidden");
        campos[0] = false;
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
const selectsFC = document.querySelectorAll('#formularioMateria select');

var validarNivelMateria = (evento) => {

  if (evento.target.value == 'I' || evento.target.value == 'II' || evento.target.value == 'II+Oracion' || evento.target.value == 'Seminario') {
    document.getElementById('seleccionarNivel').classList.remove('validarMal');
    document.getElementById('seleccionarNivel').classList.add('validarBien');
    document.getElementById("nivMateriaMal").setAttribute("hidden", "hidden");
    campos[1] = true;
  } else {
    document.getElementById('seleccionarNivel').classList.remove('validarBien');
    document.getElementById('seleccionarNivel').classList.add('validarMal');
    document.getElementById("nivMateriaMal").removeAttribute("hidden");
    campos[1] = false;
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

var campos2 = {
  nombreMateria: false,
  nivelMateria: false,
}


//VALIDAR NOMBRE DE LAS MATERIAS AL ACTUALIZAR

var validarNombreMateria2 = function () {
  if (expresionesMaterias2.nombreMateria.test(document.getElementById('nombreMateria2').value)) {
    document.getElementById('nombreMateria2').classList.remove('validarMal');
    document.getElementById('nombreMateria2').classList.add('validarBien');
    document.getElementById("nomMateriaMal2").setAttribute("hidden", "hidden");
    campos2[0] = true;
  } else {
    document.getElementById('nombreMateria2').classList.remove('validarBien');
    document.getElementById('nombreMateria2').classList.add('validarMal');
    document.getElementById("nomMateriaMal2").removeAttribute("hidden");
    campos2[0] = false;
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
const selectsFA = document.getElementById('seleccionarNivel2');

var validarNivelMateria2 = function () {

  if (selectsFA.value == '1' || selectsFA.value == '2' || selectsFA.value == '3' || selectsFA.value == 'Seminario') {
    document.getElementById('seleccionarNivel2').classList.remove('validarMal');
    document.getElementById('seleccionarNivel2').classList.add('validarBien');
    document.getElementById("nivMateriaMal2").setAttribute("hidden", "hidden");
    campos2[1] = true;
  } else {
    document.getElementById('seleccionarNivel2').classList.remove('validarBien');
    document.getElementById('seleccionarNivel2').classList.add('validarMal');
    document.getElementById("nivMateriaMal2").removeAttribute("hidden");
    campos2[1] = false;
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
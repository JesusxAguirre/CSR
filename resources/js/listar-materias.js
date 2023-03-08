listarMaterias();


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
function consultaDeProfesores(idNoMateria) {
  let listadoCDP = document.getElementById("datos3");

  $.ajax({
    data: {
      idNoMateria: idNoMateria,
      botonEditarProfM: 'botonEditarProfM',
    },
    type: "post",
    url: "controlador/ajax/CRUD-materias.php",
  }).done((data) => {
    listadoCDP.innerHTML = data;
    choices2();
  });
}



//BOTON DEL MODAL PARA EDITAR PROFESORES DE LA MATERIA (ABRIR MODAL)
$(document).on('click', '#editarProf', function (e) {
  e.preventDefault();

  let botonEditarProfM = $(this)[0].value;
  let elemento = $(this)[0].parentElement.parentElement;
  let idMateria = elemento.querySelector('.idMateria').textContent;

  listarProfesoresMateria(idMateria);
  consultaDeProfesores(idMateria);
});
///////////////////////////////////////////////////////////////


//ACTUALIZAR Y AGREGAR(VINCULAR) PROFESORES A LA MATERIA DINAMICAMENTE POR AJAX
$(document).on('click', '#actualizarProfesores', function (e) {
  e.preventDefault();
  
  const data2 = {
    actualizarProfesores: 'actualizarProfesores',
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
      consultaDeProfesores(data2.idMateriaV);
      Swal.fire({
        icon: 'success',
        title: "¡Profesores agregados correctamente!",
        toast: true,
        background: 'green',
        color: 'white',
        showConfirmButton: false,
        timer: 3000,
      });
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
    iconColor: 'red',
    title: 'AVISO',
    text: 'Estas segur@ que deseas desvincular al profesor de la materia?',
    showDenyButton: true,
    confirmButtonText: `Si, eliminar`,
    confirmButtonColor: '#0059FF',
    denyButtonText: `Cancelar`,
    denyButtonColor: 'grey'
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("controlador/ajax/CRUD-materias.php", {
        cedulaProf,
        idMateria2,
        eliminarProfMat
      }, function (response) {
        var resp = JSON.parse(response);

        if (resp == 'true') {
          listarProfesoresMateria(idMateria2);
          consultaDeProfesores(idMateria2);
          Swal.fire({
            icon: 'success',
            iconColor: 'green',
            title: "¡Profesor desvinculado de la materia correctamente!",
            showConfirmButton: false,
            background: 'green',
            color: 'white',
            timer: 2000,
          });
        }else{
          Swal.fire({
            icon: 'error',
            iconColor: 'red',
            title: "Error",
            text: 'No puedes eliminar a este profesor porque existen datos asociados a el en alguna seccion de la Ecam',
            showConfirmButton: true,
            confirmButtonColor: '#0059FF',
          });
        }
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
    iconColor: 'red',
    title: 'Estas seguro de eliminar la materia?',
    showDenyButton: true,
    confirmButtonText: `Si, eliminar`,
    confirmButtonColor: '#0059FF',
    denyButtonText: `Cancelar`,
    denyButtonColor: 'red'
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("controlador/ajax/CRUD-materias.php", {idMateria, botonEliminar}, function (response) {
        let resp = JSON.parse(response);

        if (resp == 'true') {
          listarMaterias();
          Swal.fire({
            icon: 'success',
            iconColor: 'green',
            title: "¡Materia eliminada correctamente!",
            background: 'white',
            showConfirmButton: false,
            timer: 2000,
          });
        }else{
          Swal.fire({
            icon: 'error',
            iconColor: 'red',
            text: "No puedes eliminar esta materia porque se encuentra asociada a otros datos del sistema",
            background: 'white',
            showConfirmButton: false,
            timer: 3000,
          });
        }
      })
    }
  })
});

/* //EJEMPLO de usar firealert funcion para ahorrar algunas lineas
fireAlert('success', 'Eliminado correctamente!');
function fireAlert(icon, msg) {
  Swal.fire({
    icon: icon,
    title: msg,
    toast: true,
    background: 'green',
    color: 'white',
    showConfirmButton: false,
    timer: 3000,
  });
}
*/



//SELECT PARA LA ACTUALIZACION VINCULACION DE PROFESOR CON LA MATERIA
function choices2() {
  var profesores2 = document.getElementById('seleccionarProfV');
  new Choices(profesores2, {
    allowHTML: true,
    maxItemText: 3,
    removeItems: true,
    removeItemButton: true,
    noResultsText: 'No hay coicidencias',
    noChoicesText: 'No hay profesores disponibles',
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
      var resp = JSON.parse(response);

      //Primero validamos que los datos de la seccion no existan al actualizar
      if (resp == 'true') {
        Swal.fire({
          icon: 'error',
          iconColor: 'red',
          title: "¡La materia ya existe!",
          background: 'white',
          showConfirmButton: false,
          timer: 2000,
        });
      }else{
        listarMaterias();
        document.getElementById('nombreMateria2').classList.remove('validarBien');
        document.getElementById('seleccionarNivel2').classList.remove('validarBien');
        Swal.fire({
          icon: 'success',
          iconColor: 'green',
          title: "¡Materia actualizada correctamente!",
          background: 'white',
          showConfirmButton: false,
          timer: 2000,
        });
      }
    });
  } else {
    Swal.fire({
      icon: 'error',
      iconColor: 'white',
      title: "Debes cumplir con los requisitos de los campos",
      background: 'red',
      color: 'white',
      showConfirmButton: false,
      timer: 3000,
    });
  }
});










///////////////////////////////////////////////
//INICIO DE VALIDACIONES AL ACTUALIZAR MATERIAS
///////////////////////////////////////////////
const expresionesMaterias2 = {
  nombreMateria: /^[a-zA-ZÀ-ÿ\s]{5,20}$/, // Letras y espacios, pueden llevar acentos.
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

  if (selectsFA.value == 1 || selectsFA.value == 2 || selectsFA.value == 3 || selectsFA.value == 'Seminario') {
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
// Actualizar contenido del modal Editar
const formulario = document.getElementById('editForm'); //declarando una constante con la id formulario
const formulario2 = document.getElementById('agregar_usuarios')
const formulario3 = document.getElementById('agregar_asistencias')
const formulario4 = document.getElementById('eliminar_participante')


const inputs = document.querySelectorAll('#editForm input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs2 = document.querySelectorAll('#agregar_usuarios input');
const inputs3 = document.querySelectorAll('#agregar_asistencias input')

const eliminar__participantes =  document.getElementById('eliminar__participantes')

const modal_eliminar_participates = document.getElementById('datos4')
// Agrega los eventos para actualizar y eliminar 
addEvents()

var participantes = document.getElementById('participantes');
var choices1 = new Choices(participantes, {
  allowHTML: true,
  removeItems: true,
  removeItemButton: true,
  noResultsText: 'No hay coicidencias',
  noChoicesText: 'No hay participantes disponibles',
});

var asistentes = document.getElementById('asistentes');
var choices2 = new Choices(asistentes, {
  allowHTML: true,
  removeItems: true,
  removeItemButton: true,
  noResultsText: 'No hay coicidencias',
  noChoicesText: 'No hay participantes disponibles',
});

const campos = {
  codigoLider: true,
  codigoAnfitrion: true,
  codigoAsistente: true,
  dia: true,
  hora: true,
  codigo: true,
  participantes: false,
  fecha: false,
  asistentes: false,
}

const expresiones = { //objeto con varias expresiones regulares

  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, //formato de hora
  codigo: /^[CD]{2}[0-9]{1,5}$/, //expresion regular de codigo, primero espera las dos letras CC y luego de 1 a 20 numeros
  codigo2: /^[a-zA-Z\-0-9]{20,200}$/, //expresion regular de codigo de usuario
}





const ValidarFormulario = (e) => {
  switch (e.target.name) {
    case "dia":
      ValidarDia(e.target, 'dia');
      break;
    case "hora":
      ValidarCampo(expresiones.hora, e.target, 'hora');
      break;
    case "codigo":
      ValidarCampo(expresiones.codigo, e.target, 'codigo');
      break;
    case "codigoLider":
      ValidarCampo(expresiones.codigo2, e.target, 'codigoLider');
      break;
    case "codigoAnfitrion":
      ValidarCampo(expresiones.codigo2, e.target, 'codigoAnfitrion');
      break;
    case "codigoAsistente":
      ValidarCampo(expresiones.codigo2, e.target, 'codigoAsistente');
      break;
    case "participantes[]":
      ValidarSelect(e.target, 'participantes');
      break;
    case "asistentes[]":
      ValidarSelect(e.target, 'asistentes');
      break;
    case "fecha":
      ValidarSelect(e.target, 'fecha');
      break;
  }
}

const ValidarSelect = (select, campo) => {
  if (select.value == '') {
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-check-circle-fill', 'text-check', 'input-icon2');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon2');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    campos[campo] = false;
  } else {
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon2');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-check-circle-fill', 'text-check', 'input-icon2');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = true;
  }
}

const ValidarDia = (input, campo) => {
  if (input.value === "Lunes" || input.value === "Martes" || input.value === "Miercoles" || input.value === "Jueves" || input.value === "Viernes" || input.value === "Sabado" || input.value === "Domingo") {
    console.log("entra en la funcion DE DIA");
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-check-circle-fill', 'text-check', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = true;
  } else {
    console.log("entra en la funcion else");
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-check-circle-fill', 'text-check', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    campos[campo] = false;
  }

}
const ValidarCampo = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
    console.log("entra en la funcion");
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-check-circle-fill', 'text-check', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = true;
  } else {
    console.log("entra en la funcion else");
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-check-circle-fill', 'text-check', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    campos[campo] = false;
  }
}


formulario.addEventListener('submit', (e) => {
  if (!(campos.codigoAnfitrion && campos.codigoAsistente && campos.codigoLider && campos.dia && campos.hora && campos.codigo)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  }
})

formulario2.addEventListener('submit', (e) => {
  if (!(campos.participantes)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  }
})

formulario3.addEventListener('submit', (e) => {
  if (!(campos.asistentes && campos.fecha)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  }
})





inputs.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});
inputs2.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});
inputs3.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});

//listando eventos selects libreria choice
participantes.addEventListener('hideDropdown', ValidarFormulario);
asistentes.addEventListener('hideDropdown', ValidarFormulario);

//busqueda ajax 

const busquedaEl = document.getElementById('caja_busqueda')
const datosEl = document.getElementById('datos')

busquedaEl.addEventListener('keyup', () => {
  let busqueda = busquedaEl.value

  $.ajax({
    data: 'busqueda=' + busqueda,
    url: "controlador/ajax/buscar-discipulado.php",
    type: "get",
  }).done(data => {
    datosEl.innerHTML = data
  })
})


//alerta registrar participante

if (registrar_participante == false) {
  Swal.fire({
    icon: 'success',
    title: 'Se registro correctamente el participante'
  })
  setTimeout(recarga, 2000);

  function recarga() {
    window.location = "index.php?pagina=listar-celula-discipulado";
  }
}
//alerta registrar asistencia
if (registrar_asistencia == false) {
  Swal.fire({
    icon: 'success',
    title: 'Se registro correctamente el participante'
  })
  setTimeout(recarga, 2000);

  function recarga() {
    window.location = "index.php?pagina=listar-celula-discipulado";
  }
}


// Eliminación con Ajax
const deleteButton = document.getElementById('deleteButton')

deleteButton.addEventListener('click', () => {
  let participante_cedula = document.querySelector('#deleteForm .cedula_participante').value

  $.ajax({
    data: 'participante_cedula=' + participante_cedula,
    url: "controlador/ajax/eliminar-participante-discipulado.php",
    type: "post",
  }).done(data => {
    if (data == '1') {
      fireAlert('success', 'Participante  eliminado correctamente')
    } else {
      console.log(data)
      fireAlert('error', 'El participante que intenta eliminar no existe')
    }
  }).then(() => {
    document.querySelector('#eliminar .btn-close').click()

    buscarDiscipulado('')
  })
})

function fireAlert(icon, msg) {
  Swal.fire({
    icon: icon,
    title: msg
  })
}

//busqueda de participantes
eliminar__participantes.addEventListener('click', () => {
	buscarParticipantes()
  console.log("entra a la funcion")

})
function buscarParticipantes() {
  return $.ajax({
    data: 'busqueda=' + idInput.value,
    url: "controlador/ajax/buscar-participante-discipulado.php",
    type: "get"
  }).done(data => {
    modal_eliminar_participates.innerHTML = data
    var v_modal = $('#eliminar_usuario').modal({ show: false });
 
    v_modal.modal("show");
    addEvents()
    console.log("sale de la funcion")
  })
}

function addEvents() {
  // Actualizar contenido del modal Editar
  const editButtons = document.querySelectorAll('table td .edit-btn')

  editButtons.forEach(boton => boton.addEventListener('click', () => {
    let fila = boton.parentElement.parentElement
    let id = fila.querySelector('.id')

    let dia = fila.querySelector('.dia')
    let hora = fila.querySelector('.hora')
    let lider = fila.querySelector('.lider')
    let anfitrion = fila.querySelector('.anfitrion')
    let asistente = fila.querySelector('.asistente')


    const idInput = document.getElementById('idInput')

    const diaInput = document.getElementById('diaInput')
    const horaInput = document.getElementById('horaInput')
    const liderInput = document.getElementById('codigoLider')
    const anfitrionInput = document.getElementById('codigoAnfitrion')
    const asistenteInput = document.getElementById('codigoAsistente')

    liderInput.value = lider.textContent
    anfitrionInput.value = anfitrion.textContent
    asistenteInput.value = asistente.textContent
    idInput.value = id.textContent

    diaInput.value = dia.textContent
    horaInput.value = hora.textContent
    //cedulas de usuarios


  }))

  // Actualizar contenido del modal Eliminar
  const deleteButtons = document.querySelectorAll('table td .delete-btn')

  deleteButtons.forEach(boton => boton.addEventListener('click', () => {
    let fila = boton.parentElement.parentElement
    let cedula_participante = fila.querySelector('.participantes_cedula')
    let nombre = fila.querySelector('.participantes_nombre')
    let apellido = fila.querySelector('.participantes_apellido')

    const cedulaInput = document.querySelector('#deleteForm .cedula_participante')
    const nombre_participante = document.getElementById('deleteParticipanteName')
    const apellido_participante = document.getElementById('deleteParticipanteApellido')

    cedulaInput.value = cedula_participante.textContent
    nombre_participante.textContent = nombre.textContent
    apellido_participante.textContent = apellido.textContent
  }))

  const agregar_participantes = document.querySelectorAll('table td .agregar-btn'); //declarando una constante con la id formulario

  agregar_participantes.forEach(boton => boton.addEventListener('click', () => {
    let fila = boton.parentElement.parentElement
    let id = fila.querySelector('.id')
    const idInput = document.getElementById('idInput2')
    idInput.value = id.textContent
  }))

  const agregar_asistencias = document.querySelectorAll('table td .asistencias-btn'); //declarando una constante con la id formulario
  agregar_asistencias.forEach(boton => boton.addEventListener('click', () => {
    let fila = boton.parentElement.parentElement
    let id = fila.querySelector('.id')
    const idInput = document.getElementById('idInput3')
    idInput.value = id.textContent
  }))
}
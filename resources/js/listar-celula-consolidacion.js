const formulario = document.getElementById('editForm'); //declarando una constante con la id formulario
const formulario2 = document.getElementById('agregar_usuarios')
const formulario3 = document.getElementById('agregar_asistencias')

var lista_lideres = document.getElementById('lider') //buscando id de lista de lideres para retorar array de lidere

var lideres_array = Array.prototype.map.call(lista_lideres.options, function (option) { //retornando array con id de lideres
  return option.value;
});
var lista_anfitriones = document.getElementById('anfitrion') //buscando id de lista de anfitriones

var anfitriones_array = Array.prototype.map.call(lista_anfitriones.options, function (option) { //retornando array de anfitriones
  return option.value;
});
var lista_asistentes = document.getElementById('asistente')

var asistentes_array = Array.prototype.map.call(lista_asistentes.options, function (option) {
  return option.value;
});

const inputs = document.querySelectorAll('#editForm input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs2 = document.querySelectorAll('#agregar_usuarios input');
const inputs3 = document.querySelectorAll('#agregar_asistencias input')

const eliminar__participantes = document.getElementById('eliminar__participantes')
const modal_eliminar_participates = document.getElementById('datos4')
const busquedaEl = document.getElementById('caja_busqueda')
const datosEl = document.getElementById('datos')
const expandir = document.getElementById('asistencias4')

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



const campos = {
  codigoLider: true,
  codigoAnfitrion: true,
  codigoAsistente: true,
  dia: true,
  hora: true,
  direccion: true,
  codigo: true,
  participantes: false,
  fecha: false,
  asistentes: false
}

const expresiones = { //objeto con varias expresiones regulares

  dia: /^[a-zA-ZÀ-ÿ]{5,20}$/, // Letras y espacios, pueden llevar acentos.
  direccion: /^[A-Za-z0-9\s]{10,200}$/, // Letras y espacios, pueden llevar acentos.
  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, //formato de hora
  codigo: /^[CC]{2}[0-9]{1,5}$/ //expresion regular de codigo, primero espera las dos letras CC y luego de 1 a 20 numeros
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
      ValidarCodigo(lideres_array, e.target, 'codigoLider');
      break;

    case "codigoAnfitrion":
      ValidarCodigo(anfitriones_array, e.target, 'codigoAnfitrion');
      break;

    case "codigoAsistente":
      ValidarCodigo(asistentes_array, e.target, 'codigoAsistente');
    case "participantes[]":
      ValidarSelect(e.target, 'participantes');
      break;
    case "asistentes[]":
      ValidarSelect(e.target, 'asistentes');
      break;
    case "fecha":
      ValidarSelect(e.target, 'fecha');
      break;

    case "direccion":
      ValidarCampo(expresiones.direccion, e.target, 'direccion');
      break;
  }
}


const ValidarCodigo = (codigo_array, input, campo) => {
  if (codigo_array.indexOf(input.value) >= 0) {
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-check-circle-fill', 'text-check', 'input-icon2');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = true;
  } else {
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-check-circle-fill', 'text-check', 'input-icon2');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    campos[campo] = false;
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
  if (!(campos.codigoAnfitrion && campos.codigoAsistente && campos.codigoLider && campos.dia && campos.hora && campos.codigo && campos.direccion)) {
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

participantes.addEventListener('hideDropdown', ValidarFormulario);

//alerta registrar participante

if (actualizar == false) {
  Swal.fire({
    icon: 'success',
    title: 'Se actualizo la informacion correctamente'
  })
  setTimeout(recarga, 2000);
}

if (registrar_participante == false) {
  Swal.fire({
    icon: 'success',
    title: 'Se registro correctamente el(la) ó los(as)participante'
  })
  setTimeout(recarga, 2000);
}
//alerta registrar asistencia
if (registrar_asistencia == false) {
  Swal.fire({
    icon: 'success',
    title: 'Se registro correctamente la asistencia'
  })
  setTimeout(recarga, 2000);
}


//busqueda ajax 
busquedaEl.addEventListener('keyup', () => {
  let busqueda = busquedaEl.value

  buscarConsolidacion(busqueda);
})


// Eliminación con Ajax
const deleteButton = document.getElementById('deleteButton')

deleteButton.addEventListener('click', () => {
  let participante_cedula = document.querySelector('#deleteForm .cedula_participante').value
  console.log(participante_cedula)
  $.ajax({
    data: 'participante_cedula=' + participante_cedula,
    url: "controlador/ajax/eliminar-participante-consolidacion.php",
    type: "post",
  }).done(data => {
    if (data == '1') {
      fireAlert('success', 'Participante  eliminado correctamente')
    } else {
      console.log(data)
      fireAlert('error', 'El participante que intenta eliminar no existe')
    }
  }).then(() => {
    setTimeout(recarga, 2000);
  })
})

//FUCNIONES QUE SE LLAMAN MAS ARRIBA
function buscarConsolidacion(busqueda) {
  $.ajax({
    data: 'busqueda=' + busqueda,
    url: "controlador/ajax/buscar-consolidacion.php",
    type: "get",
  }).done(data => {
    console.log(data)
    datosEl.innerHTML = data
    addEvents()
  })
}

function fireAlert(icon, msg) {
  Swal.fire({
    icon: icon,
    title: msg
  })
}
function recarga() {
  window.location = "index.php?pagina=listar-celula-consolidacion";
}

function buscarParticipantes(busqueda) {
  return $.ajax({
    data: 'busqueda=' + busqueda,
    url: "controlador/ajax/buscar-participante-consolidacion.php",
    type: "get"
  }).done(data => {
    modal_eliminar_participates.innerHTML = data
    var v_modal = $('#eliminar_usuario').modal({ show: false });

    v_modal.modal("show");
    addEvents()
  })
}

function buscarParticipantesAsistencias(busqueda) {
  return $.ajax({
    data: 'busqueda=' + busqueda,
    url: "controlador/ajax/buscar-participante-asistencias-consolidacion.php",
    type: "get"
  }).done(data => {
    expandir.innerHTML = data
    const asistentes = document.getElementById('asistentes');
    var choices2 = new Choices(asistentes, {
      allowHTML: true,
      removeItems: true,
      removeItemButton: true,
      noResultsText: 'No hay coicidencias',
      noChoicesText: 'No hay participantes disponibles',
    });
    asistentes.addEventListener('hideDropdown', ValidarFormulario);
    addEvents()
  })
}


function addEvents() {
  // Actualizar contenido del modal Editar
  const editButtons = document.querySelectorAll('table td .edit-btn')

  editButtons.forEach(boton => boton.addEventListener('click', () => {
    let fila = boton.parentElement.parentElement
    let id = fila.querySelector('.id')
    let direccion = fila.querySelector('.direccion')

    let dia = fila.querySelector('.dia')
    let hora = fila.querySelector('.hora')
    let lider = fila.querySelector('.lider')
    let anfitrion = fila.querySelector('.anfitrion')
    let asistente = fila.querySelector('.asistente')


    const idInput = document.getElementById('idInput')

    const diaInput = document.getElementById('diaInput')
    const horaInput = document.getElementById('horaInput')
    const direccionInput = document.getElementById('direccionInput')
    const liderInput = document.getElementById('codigoLider')
    const anfitrionInput = document.getElementById('codigoAnfitrion')
    const asistenteInput = document.getElementById('codigoAsistente')

    liderInput.value = lider.textContent
    anfitrionInput.value = anfitrion.textContent
    asistenteInput.value = asistente.textContent
    idInput.value = id.textContent

    diaInput.value = dia.textContent
    horaInput.value = hora.textContent
    direccionInput.value = direccion.textContent
    //cedulas de usuarios


  }))

  const participanteModal = document.querySelectorAll('table td .modal-btn')

  participanteModal.forEach(boton => boton.addEventListener('click', () => {
    let fila = boton.parentElement.parentElement
    let id = fila.querySelector('.id')

    let busqueda = id.textContent


    buscarParticipantes(busqueda);
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
    let idInput = document.getElementById('idInput3')
    let busqueda = id.textContent
    idInput.value = id.textContent

    buscarParticipantesAsistencias(busqueda);
  }))
}
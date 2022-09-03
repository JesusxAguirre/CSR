// Actualizar contenido del modal Editar
const editButtons = document.querySelectorAll('table td .edit-btn')
const formulario = document.getElementById('editForm'); //declarando una constante con la id formulario
const formulario2 = document.getElementById('#agregar_usuarios')
const agregar = document.querySelectorAll('table td .agregar-btn'); //declarando una constante con la id formulario

const inputs = document.querySelectorAll('#editForm input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs2 = document.querySelectorAll('#agregar_usuarios input');

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
  codigo: true,
}

const expresiones = { //objeto con varias expresiones regulares

  dia: /^[a-zA-ZÀ-ÿ]{5,20}$/, // Letras y espacios, pueden llevar acentos.
  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, //formato de hora
  codigo: /^[CD]{2}[0-9]{1,5}$/ //expresion regular de codigo, primero espera las dos letras CC y luego de 1 a 20 numeros
}

editButtons.forEach(boton => boton.addEventListener('click', () => {
  let fila = boton.parentElement.parentElement
  let id = fila.querySelector('.id')
  let codigo = fila.querySelector('.codigo')
  let dia = fila.querySelector('.dia')
  let hora = fila.querySelector('.hora')
  let lider = fila.querySelector('.lider')
  let anfitrion = fila.querySelector('.anfitrion')
  let asistente = fila.querySelector('.asistente')


  const idInput = document.getElementById('idInput')
  const codigoInput = document.getElementById('codigoInput')
  const diaInput = document.getElementById('diaInput')
  const horaInput = document.getElementById('horaInput')
  const liderInput = document.getElementById('codigoLider')
  const anfitrionInput = document.getElementById('codigoAnfitrion')
  const asistenteInput = document.getElementById('codigoAsistente')

  liderInput.value = lider.textContent
  anfitrionInput.value = anfitrion.textContent
  asistenteInput.value = asistente.textContent
  idInput.value = id.textContent
  codigoInput.value = codigo.textContent
  diaInput.value = dia.textContent
  horaInput.value = hora.textContent
  //cedulas de usuarios


}))
agregar.forEach(boton => boton.addEventListener('click', () => {
  let fila = boton.parentElement.parentElement
  let id = fila.querySelector('.id')
 

  const idInput = document.getElementById('idInput2')
 

  idInput.value = id.textContent




}))



const ValidarFormulario = (e) => {
  switch (e.target.name) {
    case "dia":
      ValidarCampo(expresiones.dia, e.target, 'dia');
      break;
    case "hora":
      ValidarCampo(expresiones.hora, e.target, 'hora');
      break;
    case "codigo":
      ValidarCampo(expresiones.codigo, e.target, 'codigo');
      break;
    case "codigoLider":
      ValidarSelect(e.target, 'codigoLider');
      break;
    case "codigoAnfitrion":
      ValidarSelect(e.target, 'codigoAnfitrion');
      break;
    case "codigoAsistente":
      ValidarSelect(e.target, 'codigoAsistente');
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




inputs.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});



//busqueda ajax 

const busquedaEl = document.getElementById('caja_busqueda')
const datosEl = document.getElementById('datos')

busquedaEl.addEventListener('keyup', () => {
	let busqueda = busquedaEl.value

	$.ajax({
		data: 'busqueda='+busqueda,
		url: "controlador/ajax/buscar-consolidacion.php",
		type: "get",
	}).done(data => {
		datosEl.innerHTML = data
	})
})
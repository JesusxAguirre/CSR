listarUsuarios();


const formulario = document.getElementById('editForm'); //declarando una constante con la id formulario
const inputs = document.querySelectorAll('#editForm input'); //declarando una constante con todos los inputs dentro de la id formulario
const selects = document.querySelectorAll('#editForm select'); //declarando una constante con todos los inputs dentro de la id formulario
addEvents();
const campos = {
	nombre: true,
	apellido: true,
	cedula: true,
	edad: true,
	telefono: true,
	sexo: true,
	civil: true,
	nacionalidad: true,
	estado: true
}

const expresiones = { //objeto con varias expresiones regulares
	cedula: /^[0-9]{7,8}$/,
	edad: /^[0-9]{2}$/,
	nombre: /^[a-zA-ZÀ-ÿ\s]{3,20}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{7,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^[0-9]{11}$/, // solo 11 numeros.
	vacio: /^\s*$/
}


const ValidarFormulario = (e) => {
	switch (e.target.name) {
		case "cedula":
		ValidarCampo(expresiones.cedula, e.target, 'cedula');
		break;
		case "nombre":
		ValidarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "apellido":
		ValidarCampo(expresiones.nombre, e.target, 'apellido');
		break;
		case "edad":
		ValidarCampo(expresiones.edad, e.target, 'edad');
		break;
		case "sexo":
		ValidarSelect(e.target, 'sexo');
		break;
		case "civil":
		ValidarSelect(e.target, 'civil');
		break;
		case "nacionalidad":
		ValidarSelect(e.target, 'nacionalidad');
		break;
		case "estado":
		ValidarSelect(e.target, 'estado');
		break;
		case "telefono":
		ValidarCampo(expresiones.telefono, e.target, 'telefono');
		break;	
	}
}

const ValidarSelect = (select, campo) => {
	if (select.value == '') {
		console.log('Debes seleccionar un tipo de usuario.')
		document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-check-circle-fill', 'text-check', 'input-icon2');
		document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
		document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
		document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
		campos[campo] = false;
	} else {
		console.log('Has seleccionado: ' );
		document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
		document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
		document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-check-circle-fill', 'text-check', 'input-icon2');
		document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
		campos[campo] = true;
	}
}

const ValidarCampo = (expresion, input, campo) => {
	if (expresion.test(input.value)) {
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


inputs.forEach((input) => {
	input.addEventListener('keyup', ValidarFormulario);
	input.addEventListener('blur', ValidarFormulario);
	// input.addEventListener('click', ValidarFormulario);
});
selects.forEach((select) => {
	select.addEventListener('keyup', ValidarFormulario);
	select.addEventListener('blur', ValidarFormulario);
});

formulario.addEventListener('submit', (e) => {
	if (!(campos.nombre && campos.apellido && campos.cedula && campos.edad && campos.telefono && campos.estado  && campos.nacionalidad  && campos.sexo  && campos.civil)) {
		e.preventDefault();
		Swal.fire({
			icon: 'error',
			title: 'Lo siento ',
			text: 'Registra el formulario correctamente '
		})	
	}
})

if (actualizar == true) {
  Swal.fire({
    icon: 'success',
    title: 'Se actualizo la informacion correctamente'
  })
  setTimeout(recarga, 2000);
}
if (eliminar == true) {
  Swal.fire({
    icon: 'success',
    title: 'Se elimino la usuario'
  })
  setTimeout(recarga, 2000);
}
//------------------------------------------------Funciones ajax --------------------------//

//busqueda ajax 

const busquedaEl = document.getElementById('caja_busqueda')
const datosEl = document.getElementById('datos')

busquedaEl.addEventListener('keyup', () => {
	let busqueda = busquedaEl.value

	$.ajax({
		data: 'busqueda='+busqueda,
		url: "controlador/ajax/buscar-usuarios.php",
		type: "post",
	}).done(data => {
		datosEl.innerHTML = data
		addEvents();
	})
})

//Listado de AJAX
function listarUsuarios() {
	let listadoUsuarios = document.getElementById("datos");
	$.ajax({
	  type: "post",
	  url: "controlador/ajax/listar-usuarios.php",
	}).done((data) => {
	  listadoUsuarios.innerHTML = data;
		addEvents();
	});
}

function addEvents(){
	const editButtons = document.querySelectorAll('table td .edit-btn')
	editButtons.forEach(boton => boton.addEventListener('click', () => {
		console.log("entra a la funcion")
		let fila = boton.parentElement.parentElement
		let cedula = fila.querySelector('.cedula')
		let nombre = fila.querySelector('.nombre')
		let apellido = fila.querySelector('.apellido')
		let edad = fila.querySelector('.edad')
		let sexo = fila.querySelector('.sexo')
		let estado = fila.querySelector('.estado')
		let estado_civil = fila.querySelector('.estado_civil')
		let nacionalidad = fila.querySelector('.nacionalidad')
		let telefono = fila.querySelector('.telefono')
		let id_rol = fila.querySelector('.id_rol')		
		let nombre_rol = fila.querySelector('.nombre_rol')		

		const cedulaInput = document.getElementById('cedulaInput')
		const cedulaInput2 = document.getElementById('cedulaInput2')
		const nombreInput = document.getElementById('nombreInput')
		const apellidoInput = document.getElementById('apellidoInput')
		const edadInput = document.getElementById('edadInput')
		const sexoInput = document.getElementById('sexoInput')
		const estadoInput = document.getElementById('estadoInput')
		const estado_civilInput = document.getElementById('estado_civilInput')
		const nacionalidadInput = document.getElementById('nacionalidadInput')
		const telefonoInput = document.getElementById('telefonoInput')
		const rolInput = document.getElementById('rolInput')
		cedulaInput.value = cedula.textContent
		cedulaInput2.value = cedula.textContent
		nombreInput.value = nombre.textContent
		apellidoInput.value = apellido.textContent
		edadInput.value = edad.textContent
		
		sexoInput.value = sexo.textContent
		sexoInput.label = sexo.textContent
		
		estadoInput.value = estado.textContent
		estadoInput.label = estado.textContent
		
		estado_civilInput.value = estado_civil.textContent
		estado_civilInput.label = estado_civil.textContent
	
		nacionalidadInput.value = nacionalidad.textContent
		nacionalidadInput.label = nacionalidad.textContent
		telefonoInput.value = telefono.textContent
		
		rolInput.value = id_rol.textContent
		rolInput.label = nombre_rol.textContent
		const options = []
	
		document.querySelectorAll('#sexo > option').forEach((option) => {
				if (options.includes(option.value)) option.remove()
				else options.push(option.value)
		})
	
		document.querySelectorAll('#civil > option').forEach((option) => {
				if (options.includes(option.value)) option.remove()
				else options.push(option.value)
		})
	
		document.querySelectorAll('#nacionalidad > option').forEach((option) => {
				if (options.includes(option.value)) option.remove()
				else options.push(option.value)
		})
		document.querySelectorAll('#estado > option').forEach((option) => {
				if (options.includes(option.value)) option.remove()
				else options.push(option.value)
		})
		document.querySelectorAll('#rol > option').forEach((option) => {
				if (options.includes(option.value)) option.remove()
				else options.push(option.value)
		})
	
	}))

	// Actualizar contenido del modal Eliminar
  const deleteButtons = document.querySelectorAll('table td .delete-btn')

  deleteButtons.forEach(boton => boton.addEventListener('click', () => {
    let fila = boton.parentElement.parentElement
    let cedula_participante = fila.querySelector('.cedula')
    let nombre = fila.querySelector('.nombre')
    let apellido = fila.querySelector('.apellido')

    const cedulaInput = document.querySelector('#deleteForm .cedula_participante')
    const nombre_participante = document.getElementById('deleteParticipanteName')
    const apellido_participante = document.getElementById('deleteParticipanteApellido')

    cedulaInput.value = cedula_participante.textContent
    nombre_participante.textContent = nombre.textContent
    apellido_participante.textContent = apellido.textContent
  }))
}

function recarga() {
  window.location = "index.php?pagina=listar-usuarios";
}

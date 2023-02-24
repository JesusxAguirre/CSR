

const formulario = document.getElementById('formulario'); //declarando una constante con la id formulario

const formulario2 = document.getElementById('formulario2'); //declarando una constante con la id formulario

const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs2 = document.querySelectorAll('#formulario2 input'); //declarando una constante con todos los inputs dentro de la id formulario
const selects = document.querySelectorAll('#formulario select'); //declarando una constante con todos los inputs dentro de la id formulario

const campos = {
	nombre: true,
	apellido: false,
	cedula: true,
	edad: false,
	correo: false,
	telefono: false,
	clave: false,
	sexo: false,
	civil: false,
	nacionalidad: false,
	estado: false,
	//segundo formulario
	correo2: false,
	clave2: false
}

const expresiones = { //objeto con varias expresiones regulares
	cedula: /^[0-9]{7,8}$/,
	edad: /^[0-9]{2}$/,
	nombre: /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{7,12}$/, // 4 a 12 digitos.
	correo: /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i,
	telefono: /^[0-9]{11}$/, // solo 11 numeros.
	vacio: /^\s*$/
}

const ValidarFormulario = (e) => {
	switch (e.target.name) {
		// case "cedula":
		// 	ValidarCampo(expresiones.cedula, e.target, 'cedula');
		// 	break;
		// case "nombre":
		// 	ValidarCampo(expresiones.nombre, e.target, 'nombre');
		// 	break;
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
		case "correo":
			ValidarCampo(expresiones.correo, e.target, 'correo');
			break;
		case "telefono":
			ValidarCampo(expresiones.telefono, e.target, 'telefono');
			break;
		case "clave":
			ValidarCampo(expresiones.password, e.target, 'clave');
			break;
		//segundo formulario
		case "correo2":
			ValidarCampo(expresiones.correo, e.target, 'correo2');
			break;
		case "clave2":
			ValidarCampo(expresiones.password, e.target, 'clave2');
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
		console.log('Has seleccionado: ');
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
		//comprobando si la cedula existe en la bd
		// if (campos.cedula == true) {
		// 	let id = document.getElementById("cedula")
		// 	let cedula = id.value

		// 	$.ajax({
		// 		data: 'cedula=' + cedula,
		// 		url: "controlador/ajax/buscar-cedula.php",
		// 		type: "post",
		// 	}).done(data => {
		// 		if (data == '1') {
		// 			fireAlert('error', 'Esta cedula ya existe')
		// 			document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-check-circle-fill', 'text-check', 'input-icon2');
		// 			document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
		// 			document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
		// 			document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
		// 			campos.cedula = false;
		// 			let mensaje = document.getElementById("mensaje_cedula")
		// 			mensaje.textContent = "Esta cedula ya existe en la base de datos, ingrese otra por favor"
		// 		}
		// 	})
		// }
		if (campos.correo == true) {
			let id = document.getElementById("correo")
			let correo = id.value
			$.ajax({
				data: 'correo=' + correo,
				url: "controlador/ajax/buscar-correo.php",
				type: "post",
			}).done(data => {
				if (data == '1') {
					fireAlert('error', 'Este corrreo ya existe')
					document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-check-circle-fill', 'text-check', 'input-icon2');
					document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
					document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
					document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
					campos.correo = false;
					let mensaje = document.getElementById("mensaje_correo")
					mensaje.textContent = "Esta correo ya existe en la base de datos, ingrese otro por favor"
				}
			})
		}
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

inputs2.forEach((input) => {
	input.addEventListener('keyup', ValidarFormulario);
	input.addEventListener('blur', ValidarFormulario);

	// input.addEventListener('click', ValidarFormulario);
});


formulario.addEventListener('submit', (e) => {
	if (!(campos.nombre && campos.apellido && campos.cedula && campos.edad && campos.telefono && campos.correo
		&& campos.clave && campos.estado && campos.nacionalidad && campos.sexo && campos.civil)) {
		e.preventDefault();
		Swal.fire({
			icon: 'error',
			title: 'Lo siento ',
			text: 'Registra el formulario correctamente '
		})
	}
})

formulario2.addEventListener('submit', (e) => {
	if (!(campos.correo2 && campos.clave2)) {
		e.preventDefault();
		Swal.fire({
			icon: 'error',
			title: 'Lo siento ',
			text: 'Registra el formulario correctamente '
		})
	}
})

if (error == false) {
	Swal.fire({
		icon: 'success',
		title: 'Se registro el usuario correctamente'
	})
	setTimeout(recarga, 2000);
}

if (recuperacion == false) {
	Swal.fire({
		icon: 'success',
		title: 'Se cambio la contraseña correctamente'
	})
	setTimeout(recarga, 2000);
}

function fireAlert(icon, msg) {
	Swal.fire({
		icon: icon,
		title: msg
	})
}

function recarga() {
  window.location = "index.php?pagina=iniciar-sesion";
}
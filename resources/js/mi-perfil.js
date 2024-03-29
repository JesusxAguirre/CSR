let hoy = new Date();
let mes = hoy.getMonth() + 1
let fecha = hoy.getFullYear() + '-' + mes + '-' + hoy.getDate();
comprobarBoletin();

function comprobarBoletin() {
	let li = document.getElementById('boletinNotas')
	$.post("controlador/ajax/aula-virtual-Est2.php", { comprobarBoletin: 'comprobarBoletin' },
		function (data) {
			let json = JSON.parse(data);
			let fechaCierre = json[0]['fecha_cierre'];
			if (fecha >= fechaCierre) {
				li.innerHTML = '<a href="?pagina=boletin_notas" class="nav-link px-3">\
                                    <span class="me-2">\
                                    <i class="bi bi-journal-check"></i></span>\
                                    <span>Boletin de notas</span>\
                                </a>';
			}
		},
	);
}

const formulario = document.getElementById('formulario'); //declarando una constante con la id formulario
const formulario2 = document.getElementById('formulario2'); //declarando una constante con la id formulario
const formulario3 = document.getElementById('formulario3'); //declarando una constante con la id formulario
const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs2 = document.querySelectorAll('#formulario2 input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs3 = document.querySelectorAll('#formulario3 input'); //declarando una constante con todos los inputs dentro de la id formulario
const selects = document.querySelectorAll('#formulario select'); //declarando una constante con todos los inputs dentro de la id formulario
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
	estado: true,
	imagen: false,
	correo: true,
	correo2: true,
	clave: false,
}


const expresiones = { //objeto con varias expresiones regulares
	cedula: /^[0-9]{7,8}$/,
	edad: /^[0-9]{2}$/,
	nombre: /^[a-zA-ZÀ-ÿ\s]{3,20}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{7,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^[0-9]{11}$/, // solo 11 numeros.
	vacio: /^\s*$/,
	imagen: /^.*\.(jpg|JPG|gif|GIF|doc|DOC|pdf|PDF)$/

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
		case "imagen":
			ValidarCampo(expresiones.imagen, e.target, 'imagen');
			break;
		case "correo":
			ValidarCampo(expresiones.correo, e.target, 'correo');
			break;
		case "correo2":
			ValidarCampo(expresiones.correo, e.target, "correo2")
			break;
		case "clave":
			ValidarCampo(expresiones.password, e.target, 'clave');
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
		if (campos.cedula == true) {
			let id = document.getElementById("cedula")
			let cedula = id.value
			console.log('entra en la funcin')
			$.ajax({
				data: 'cedula=' + cedula,
				url: "controlador/ajax/buscar-cedula-perfil.php",
				type: "post",
			}).done(data => {
				console.log(data)
				if (data == '1') {
					fireAlert('error', 'Esta cedula ya existe')
					document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-check-circle-fill', 'text-check', 'input-icon2');
					document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
					document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
					document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
					campos.cedula = false;
					let mensaje = document.getElementById("mensaje_cedula")
					mensaje.textContent = "Esta cedula ya existe en la base de datos, ingrese otra por favor"
				}
			})
		}
		if (campos.correo == true) {
			let id = document.getElementById("correo")
			let correo = id.value
			$.ajax({
				data: 'correo=' + correo,
				url: "controlador/ajax/buscar-correo-perfil.php",
				type: "post",
			}).done(data => {
				console.log(data)
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
inputs2.forEach((input) => {
	input.addEventListener('keyup', ValidarFormulario);
	input.addEventListener('blur', ValidarFormulario);
});
inputs3.forEach((input) => {
	input.addEventListener('keyup', ValidarFormulario);
	input.addEventListener('blur', ValidarFormulario);
});
selects.forEach((select) => {
	select.addEventListener('keyup', ValidarFormulario);
	select.addEventListener('blur', ValidarFormulario);
});

formulario.addEventListener('submit', (e) => {
	if (!(campos.nombre && campos.apellido && campos.cedula && campos.edad && campos.telefono && campos.estado && campos.nacionalidad && campos.sexo && campos.civil && campos.correo)) {
		e.preventDefault();
		Swal.fire({
			icon: 'error',
			title: 'Lo siento ',
			text: 'Registra el formulario correctamente '
		})
	}
})

if (actualizar == false) {
	Swal.fire({
		icon: 'success',
		title: 'Se actualizo la informacion correctamente'
	})
	setTimeout(recarga, 2000);
}

formulario2.addEventListener('submit', (e) => {
	if (!(campos.imagen)) {
		e.preventDefault();
		Swal.fire({
			icon: 'error',
			title: 'Lo siento ',
			text: 'Registra el formulario correctamente '
		})
	}
})

formulario3.addEventListener('submit', (e) => {
	if (!(campos.correo && campos.clave)) {
		e.preventDefault();
		Swal.fire({
			icon: 'error',
			title: 'Lo siento ',
			text: 'Registra el formulario correctamente '
		})
	}
})


if (actualizar == false) {
	Swal.fire({
		icon: 'success',
		title: 'Se actualizo la informacion correctamente'
	})
	setTimeout(recarga, 2000);
}
//------------------------------------------------Funciones ajax --------------------------//

function addEvents() {

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

}

function recarga() {
	window.location = "index.php?pagina=mi-perfil";
}

function fireAlert(icon, msg) {
	Swal.fire({
		icon: icon,
		title: msg
	})
}
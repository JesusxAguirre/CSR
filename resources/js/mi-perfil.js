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

function data_load() {
	$.ajax({
		data: { data_load: 'data_load' },
		type: "GET",
		url: "index.php?pagina=mi-perfil",
	}).done((data) => {
		const dato = JSON.parse(data);
		let objeto = [];

		//Guardando objeto en otra variable
		for (const datos of dato) {
			objeto = datos;
		}


		//Actualizando datos del apartado perfil con JS
		document.getElementById('nombre_perfil').textContent = objeto.nombre + ' ' + objeto.apellido;
		document.getElementById('codigo_perfil').textContent = objeto.codigo;
		document.getElementById('nombreInput').value = objeto.nombre;
		document.getElementById('apellidoInput').value = objeto.apellido;
		document.getElementById('cedula').value = objeto.cedula;
		document.getElementById('cedulaInput2').value = objeto.cedula;
		document.getElementById('ruta_imagen').src = objeto.ruta_imagen === "" ? "resources/img/nothingPhoto.png" : objeto.ruta_imagen;
		
		//document.getElementById('cedulaInput3').value = objeto.cedula;
		document.getElementById('cedulaInput4').value = objeto.cedula;
		document.getElementById('edadInput').value = objeto.fecha_nacimiento;
		document.getElementById('sexo').value = objeto.sexo;
		document.getElementById('civil').value = objeto.estado_civil;
		document.getElementById('nacionalidad').value = objeto.nacionalidad;
		document.getElementById('estado').value = objeto.estado;
		document.getElementById('telefonoInput').value = objeto.telefono;
		document.getElementById('correo').value = objeto.usuario;
		document.getElementById('correo2').value = objeto.usuario;
	});
}
data_load();


//Constantes para capturar los datos del formulario y poder ser enviados
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
	clave2: false,
	comparacion: false
}


const expresiones = { //objeto con varias expresiones regulares
	cedula: /^[0-9]{7,8}$/,
	nombre: /^[a-zA-ZÀ-ÿ\s]{3,20}$/, // Letras y espacios, pueden llevar acentos.
	password: /^(?=.*[!@#$%^&*])(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,20}$/, // 6 a 20 digitos.
	correo: /^[a-zA-Z0-9._%+-]{1,60}@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/,
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
			validarFecha_nacimiento(e.target, 'edad');
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
		// case 'clave':
		// 	validar_password(expresiones.password, e.target, 'error_password1', 'clave');
		// 	break;
		case "new_password1":
			validar_password(expresiones.password, e.target, 'error_password2', 'clave2');
			break;
		case "new_password2":
			validarSimilitud_clave(e.target, document.getElementById('new_password1').value, 'error_password3')
	}
}


//Validando nueva password
const validar_password = (expresions, target, id, campo) => {
	if (expresions.test(target.value)) {
		if (target.value == document.getElementById('clave').value) {
			document.querySelector(`#error_claveIgual`).classList.remove('d-none');
			campos[campo] = false;
		}else{
			document.querySelector(`#${id}`).classList.add('d-none');
			document.querySelector(`#error_claveIgual`).classList.add('d-none');
			campos[campo] = true;
		}
		
	} else {
		document.querySelector(`#${id}`).classList.remove('d-none');
		campos[campo] = false;
	}
}

//Validando similitud entre las dos claves
const validarSimilitud_clave = (target, clave, id) => {
	if (target.value === clave) {
		document.querySelector(`#${id}`).classList.add('d-none');
		campos['comparacion'] = true;
	} else {
		document.querySelector(`#${id}`).classList.remove('d-none');
		campos['comparacion'] = false;
	}
}




/////Validando fecha de nacimiento
const validarFecha_nacimiento = (input, campo) => {
	const mayoriaEdad = new Date();
	mayoriaEdad.setFullYear(mayoriaEdad.getFullYear() - 18);


	const maximaEdad = new Date();
	maximaEdad.setFullYear(maximaEdad.getFullYear() - 99);

	const fechaNacimientoTS = new Date(input.value).getTime();

	if (fechaNacimientoTS < mayoriaEdad.getTime() && fechaNacimientoTS > maximaEdad.getTime()) {
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


//ACTUALIZANDO DATOS DE MI PERFIL
formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	if (campos.nombre && campos.apellido && campos.cedula && campos.edad && campos.telefono && campos.estado && campos.nacionalidad && campos.sexo && campos.civil && campos.correo) {
		
		const datos = {
			nombre: document.getElementById('nombreInput').value,
			apellido: document.getElementById('apellidoInput').value,
			cedula: document.getElementById('cedula').value,
			fecha_nacimiento: document.getElementById('edadInput').value,
			sexo: document.getElementById('sexo').value,
			estado_civil: document.getElementById('civil').value,
			nacionalidad: document.getElementById('nacionalidad').value,
			estado: document.getElementById('estado').value,
			telefono: document.getElementById('telefonoInput').value,
			correo: document.getElementById('correo').value,
			token: document.getElementById('token').value,
			update: 'update'
		}

		$.ajax({
			type: "POST",
			url: "?pagina=mi-perfil",
			data: datos,
			//data: $(this).serialize(),
			success: function (response) {
				console.log(response);
				let data = JSON.parse(response);
				console.log(data);

				if (data.status_code === 202) {
					fire_alerta(data.msj, 'success');
					
				}else{
					fire_alerta('Algo ocurrio en la BD', 'error')
				}
			},
			error: function (xhr, status, error) {

				// Código a ejecutar si se produjo un error al realizar la solicitud

				console.log(xhr)

				var response;
				try {
					response = JSON.parse(xhr.responseText);
				} catch (e) {
					response = {};
				}

				fire_alerta_problem(response.status_code, response.msg, 'error')
			}
		})

	} else {
		fire_alerta_problem('Lo siento', 'Registra el formulario correctamente', 'error')
	}
})

function fire_alerta(titulo, icono) {
	Swal.fire({
		icon: icono,
		title: titulo,
		showConfirmButton: false,
		timer: 2000,
	})
}
function fire_alerta_problem(titulo, texto, icono) {
	Swal.fire({
		icon: icono,
		title: titulo,
		text: texto,
		showConfirmButton: false,
		timer: 2000,
	})
}


if (actualizar == false) {
	Swal.fire({
		icon: 'success',
		title: 'Se actualizo la informacion correctamente'
	})
	setTimeout(recarga, 2000);
}



//ACTUALIZANDO IMAGEN DE PERFIL
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



//ACTUALIZANDO PASSWORD
formulario3.addEventListener('submit', (e) => {
	e.preventDefault();
	if (document.getElementById('clave').value === '') {
		campos['clave'] = true;
	}
	if (campos['clave'] && campos['clave2'] && campos['correo'] && campos['comparacion']) {
		if (campos['comparacion']) {
			const datos = {
				clave_actual: document.getElementById('clave').value,
				clave_nueva: document.getElementById('new_password2').value,
				token: document.getElementById('token').value,
				actualizar_clave: 'actualizar_clave'
			}
			console.log(datos['clave_actual']);
			$.ajax({
				type: "POST",
				url: "?pagina=mi-perfil",
				data: datos,
				success: function (response) {

					let data = JSON.parse(response);

					if (data.status_code === 200) {
						campos['clave'] = false;
						campos['clave2'] = false;
						campos['comparacion'] = false;
						document.getElementById("formulario3").reset()

						fire_alerta(data.msj, 'success');
						document.getElementById('clave').value = '';
						document.getElementById('new_password1').value = '';
						document.getElementById('new_password2').value = '';

						setTimeout(() => {window.location = 'index.php';}, 3500);
					} else {
						fire_alerta('Algo ocurrio en la BD', 'error')
					}
				},
				error: function (xhr, status, error) {
					// Código a ejecutar si se produjo un error al realizar la solicitud

					var response;
					try {
						response = JSON.parse(xhr.responseText);
					} catch (e) {
						response = {};
					}
					
					fire_alerta_problem(response.status_code, response.msj, 'error')
				}
			})
		}else{
			fire_alerta('Comprueba que contraseñas sean iguales', 'error');
		}
	} else {
		fire_alerta('Ingresa los datos correctamente', 'error')
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
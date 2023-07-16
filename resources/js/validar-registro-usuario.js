
$(document).ready(function () {
const formulario2 = document.getElementById('formulario2'); //declarando una constante con la id formulario

const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs2 = document.querySelectorAll('#formulario2 input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs3 = document.querySelectorAll('#formulario3 input'); //declarando una constante con todos los inputs dentro de la id formulario
const selects = document.querySelectorAll('#formulario select'); //declarando una constante con todos los inputs dentro de la id formulario

//CONSTANTES PARA TEMPORIZADOR
const countdownToast = new bootstrap.Toast(document.getElementById("countdown-toast"));
const duration = 300;

var lista_sexos = document.getElementById('sexo') //buscando id de lista de sexos para retorar array de lidere

var sexos_array = Array.prototype.map.call(lista_sexos.options, function (option) { //retornando array con id de lideres
	return option.value;
});
var lista_civil = document.getElementById('civil') //buscando id de lista de civil para retorar array de lidere

var civil_array = Array.prototype.map.call(lista_civil.options, function (option) { //retornando array con id de lideres
	return option.value;
});
var lista_nacionalidad = document.getElementById('nacionalidad') //buscando id de lista de nacionalidad para retorar array de lidere

var nacionalidad_array = Array.prototype.map.call(lista_nacionalidad.options, function (option) { //retornando array con id de lideres
	return option.value;
});
var lista_estado = document.getElementById('estado') //buscando id de lista de estado para retorar array de lidere

var estado_array = Array.prototype.map.call(lista_estado.options, function (option) { //retornando array con id de lideres
	return option.value;
});

const campos = {
	nombre: true,
	apellido: true,
	cedula: false,
	edad: true,
	correo: false,
	telefono: true,
	clave: true,
	sexo: true,
	civil: true,
	nacionalidad: true,
	estado: true,
	//segundo formulario
	correo2: false,
	tokenCorreo: false,

	//formulario inicio de sesion
	email: false
}

const expresiones = { //objeto con varias expresiones regulares
	cedula: /^[0-9]{7,8}$/,
	edad: /^[0-9]{2}$/,
	nombre: /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'°]{3,12}$/, // Letras y espacios, pueden llevar acentos.
	password: /^(?=.*[!@#$%^&*])(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,16}$/,
	token: /^[a-zA-Z0-9]{60,70}$/, // 6 a 16 digitos.
	correo: /^[a-zA-Z0-9._%+-]{1,60}@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/,
	telefono: /^[0-9]{11}$/, // solo 11 numeros.
	vacio: /^\s*$/
}

const ValidarFormulario = (e) => {
	switch (e.target.name) {
		case "cedula":
			ValidarCampo(expresiones.cedula, e.target, 'cedula');
			break;
		/* case "nombre":
			ValidarCampo(expresiones.nombre, e.target, 'nombre');
			break; */
		case "apellido":
			ValidarCampo(expresiones.nombre, e.target, 'apellido');
			break;
		case "edad":
			ValidarFecha_nacimiento(e.target, 'edad');
			break;
		case "sexo":
			ValidarSelect(sexos_array, e.target, 'sexo');
			break;
		case "civil":
			ValidarSelect(civil_array, e.target, 'civil');
			break;
		case "nacionalidad":
			ValidarSelect(nacionalidad_array, e.target, 'nacionalidad');
			break;
		case "estado":
			ValidarSelect(estado_array, e.target, 'estado');
			break;
		case "correo":
			ValidarCampo(expresiones.correo, e.target, 'correo');
			break;
		case "telefono":
			ValidarCampo(expresiones.telefono, e.target, 'telefono');
			break;
		//segundo formulario
		case "correo2":
			ValidarCampo(expresiones.correo, e.target, 'correo2');
			break;
		case "clave":
			ValidarCampo(expresiones.password, e.target, 'clave');
			break;

		case "tokenCorreo":
			ValidarCampo(expresiones.token, e.target, 'tokenCorreo')

		//CASE DE INICIO DE SESION

		case "email":

			ValidarCampo(expresiones.correo, e.target, "email")
	}
}


const ValidarFecha_nacimiento = (input, campo) => {
	const mayoriaEdad = new Date();
	mayoriaEdad.setFullYear(mayoriaEdad.getFullYear() - 18);


	const maximaEdad = new Date();
	maximaEdad.setFullYear(maximaEdad.getFullYear() - 99);

	const fechaNacimientoTS = new Date(input.value).getTime();

	if (fechaNacimientoTS < mayoriaEdad.getTime() && fechaNacimientoTS > maximaEdad.getTime()) {
		document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
		document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
		campos[campo] = true;
	} else {
		document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
		document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
		campos[campo] = false;
	}
}

const ValidarSelect = (codigo_array, input, campo) => {
	if (codigo_array.indexOf(input.value) >= 0 && input.value != 0) {
		document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
		document.querySelector(`#grupo__${campo} select`).classList.remove('is-invalid')

		document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
		campos[campo] = true;
	} else {
		document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');

		document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
		document.querySelector(`#grupo__${campo} select`).classList.add('is-invalid')
		campos[campo] = false;
	}
}


const ValidarCampo = (expresion, input, campo) => {
	if (expresion.test(input.value)) {
		document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
		document.querySelector(`#grupo__${campo} input`).classList.remove('is-invalid')

		document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
		campos[campo] = true;

		//comprobando si la cedula existe en la bd
		if (campos.cedula == true) {
			let id = document.getElementById("cedula")
			let cedula = id.value

			$.ajax({
				data: 'cedula_existente=' + cedula,
				url: "?pagina=iniciar-sesion",
				type: "POST",
				error: function (xhr, status, error) {
					// Código a ejecutar si se produjo un error al realizar la solicitud

					document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');

					document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
					document.querySelector(`#grupo__${campo} input`).classList.add('is-invalid')
					campos.cedula = false;

					let mensaje = document.getElementById("mensaje_cedula")

					mensaje.textContent = "Esta cedula ya existe en la base de datos, ingrese otra por favor"

					var response;
					try {
						response = JSON.parse(xhr.responseText);
					} catch (e) {
						response = {};
					}

					Swal.fire({
						icon: 'error',
						title: response.ErrorType,
						text: response.msj
					})
				}
			})
		}
		if (campos.correo == true) {
			let id = document.getElementById("correo")
			let correo = id.value
			$.ajax({
				data: 'correo_existente=' + correo,
				url: " ?pagina=iniciar-sesion",
				type: "post",
				error: function (xhr, status, error) {
					// Código a ejecutar si se produjo un error al realizar la solicitud
					document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');

					document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
					document.querySelector(`#grupo__${campo} input`).classList.add('is-invalid')
					campos.correo = false;
					let mensaje = document.getElementById("mensaje_correo")
					mensaje.textContent = "Esta correo ya existe en la base de datos, ingrese otro por favor"

					var response;
					try {
						response = JSON.parse(xhr.responseText);
					} catch (e) {
						response = {};
					}

					Swal.fire({
						icon: 'error',
						title: response.ErrorType,
						text: response.msj
					})
				}
			})
		}

	} else {
		document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');

		document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
		document.querySelector(`#grupo__${campo} input`).classList.add('is-invalid')
		campos[campo] = false;
	}
}


inputs.forEach((input) => {
	input.addEventListener('input', ValidarFormulario);
	input.addEventListener('blur', ValidarFormulario);
	// input.addEventListener('click', ValidarFormulario);
});
selects.forEach((select) => {
	select.addEventListener('change', ValidarFormulario);
	select.addEventListener('blur', ValidarFormulario);
});

inputs2.forEach((input) => {
	input.addEventListener('input', ValidarFormulario);
	input.addEventListener('blur', ValidarFormulario);

	// input.addEventListener('click', ValidarFormulario);
});
inputs3.forEach((input) => {
	input.addEventListener('input', ValidarFormulario);
	input.addEventListener('blur', ValidarFormulario);

	// input.addEventListener('click', ValidarFormulario);
});


$("#formulario").submit(function (e) {
	e.preventDefault()
	if (!(campos.nombre && campos.apellido && campos.cedula && campos.edad && campos.telefono && campos.correo
		&& campos.clave && campos.estado && campos.nacionalidad && campos.sexo && campos.civil)) {
		Swal.fire({
			icon: 'error',
			title: 'Lo siento ',
			text: 'Registra el formulario correctamente '
		})
	} else {

		$.ajax({
			type: "POST",
			url: "?pagina=iniciar-sesion",
			data: $(this).serialize(),
			success: function (response) {

				var data = JSON.parse(response);

				console.log(data.status_code);
				if (data.status_code === 200) {
					for (let campo in campos) {
						campos[campo] = false
					}

					document.getElementById("formulario").reset()



					fireAlert('success', 'Se registro el usuario correctamente')
				} else {
					console.log(data)
					console.log("algo sucedio con la base de datos")
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

				switch (response.status_code) {
					case 403:
						response.ErrorType = "DENIED"
					case 409:
						response.ErrorType = "User Already Exist"
						break;
					case 422:
						response.ErrorType = "Invalid Data"
						break;
					case 404:
						response.ErrorType = "User Not Exist"
						break;
					default:
						break;
				}

				Swal.fire({
					icon: 'error',
					title: response.ErrorType,
					text: response.msj
				})
			}
		})
	}
})


formulario2.addEventListener('submit', (e) => {
	if (!(campos.correo2)) {
		e.preventDefault();
		Swal.fire({
			icon: 'error',
			title: 'Lo siento ',
			text: 'Registra el formulario correctamente '
		})
	}
})




function fireAlert(icon, msg) {
	Swal.fire({
		icon: icon,
		title: msg
	})
}

function recarga() {
	window.location = "index.php?pagina=iniciar-sesion";
}


//POST DE INICIO DE SESION

$(document).on('submit', '#formulario3', function (event) {
	event.preventDefault(); // Evita que el formulario se envíe automáticamente


	if (!(campos.email)) {
		Swal.fire({
			icon: 'error',
			title: 'Lo siento ',
			text: 'registre el formulario correctamente ',
			position: 'center'
		})
	} else {

		console.log($(this).serialize())

		$.ajax({
			type: 'POST',
			url: window.location.href,
			data: $(this).serialize(),// Obtiene los datos del formulario
			success: function (response) {
				console.log(response)
				document.getElementById("formulario").reset()

				Swal.fire({
					icon: 'success',
					title: 'Has iniciado session correctamente',
					text: response.msj
				}).then((result) => {

					if (result.isConfirmed) {
						window.location.replace("index.php?pagina=dashboard");
					}
				})

				setTimeout(function () {
					window.location.replace("index.php?pagina=dashboard");
				}, 4000);


			},
			error: function (xhr, status, error) {
				// Código a ejecutar si se produjo un error al realizar la solicitud


				var response;
				try {
					response = JSON.parse(xhr.responseText);
				} catch (e) {
					response = {};
				}

				switch (response.status_code) {
					case 403:
						response.ErrorType = "DENIED"
					case 409:
						response.ErrorType = "User Already Exist"
						break;
					case 422:
						response.ErrorType = "Invalid Data"
						break;
					case 404:
						response.ErrorType = "User Not Exist"
						break;
					default:
						break;
				}

				Swal.fire({
					icon: 'error',
					title: response.ErrorType,
					text: response.msj
				})



			}
		});
	}
});


//FUNCION QUE DE ENVIAR FORMULARIO DE RECUPERAR PASSWORD
$(document).on('submit', '#formulario2', function (event) {
	event.preventDefault(); // Evita que el formulario se envíe automáticamente


	if (!(campos.correo2)) {
		Swal.fire({
			icon: 'error',
			title: 'Lo siento ',
			text: 'registre el formulario correctamente ',
			position: 'center'
		})
	} else {


		$.ajax({
			type: 'POST',
			url: window.location.href,
			data: $(this).serialize(),// Obtiene los datos del formulario
			success: function (response) {

				// Crear un elemento div
				var div = document.createElement('div');
				div.id = 'grupo__tokenCorreo'
				div.innerHTML = `
                    <div class="input-group mb-3 mt-4">
                        <input maxlength="70" id="tokenCorreo" name="tokenCorreo" type="text" class="form-control" placeholder="Codigo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="bi bi-key-fill"></span>
                            </div>
                        </div>
                    </div>
                    <p class="text-danger d-none">Escriba un token valido</p>`;


				var appends = document.getElementById('appends');

				// Insertar el elemento div antes del nodo padre del botón_submit
				appends.appendChild(div);

				// Deshabilitar el elemento con el id "email"
				document.getElementById("correo2").setAttribute('readonly', true);

				formulario2.id = "formulario4"



				document.getElementById("boton_submit_recuperar").textContent = "Enviar codigo"

				//creando un nodeList con todos los inputs denfro de el id formulario2
				const inputs = document.querySelectorAll("#formulario4 input")

				inputs.forEach((input) => {
					input.addEventListener('keyup', ValidarFormulario);
					input.addEventListener('blur', ValidarFormulario);

				});

				//Agregando evento submit a formulario2
				addEvent_formulario2()
				countdown_toast()






			},
			error: function (xhr, status, error) {
				// Código a ejecutar si se produjo un error al realizar la solicitud


				document.querySelector(`#grupo__correo2 p`).classList.remove('d-none');

				document.querySelector(`#grupo__correo2 p`).classList.add('d-block');
				document.querySelector(`#grupo__correo2 input`).classList.add('is-invalid')
				campos.correo2 = false;

				var response;
				try {
					response = JSON.parse(xhr.responseText);
				} catch (e) {
					response = {};
				}

				let mensaje = document.getElementById("mensaje_correo_recuperar")
				mensaje.textContent = response.msj


				switch (response.status_code) {
					case 403:
						response.ErrorType = "DENIED"
					case 409:
						response.ErrorType = "User Already Exist"
						break;
					case 422:
						response.ErrorType = "Invalid Data"
						break;
					case 404:
						response.ErrorType = "User Not Exist"
						break;
					default:
						break;
				}


				Swal.fire({
					icon: 'error',
					title: response.ErrorType,
					text: response.msj
				})



			}
		});
	}
});




function addEvent_formulario2() {

	$(document).on('submit', '#formulario4', function (event) {
		console.log("entra en el cuarto formulario")
		event.preventDefault(); // Evita que el formulario se envíe automáticamente
		if (!(campos.correo2 && campos.tokenCorreo)) {
			Swal.fire({
				icon: 'error',
				title: 'Lo siento ',
				text: 'Registra el formulario correctamente ',
				position: 'center'
			})
		} else {

			var datos = $(this).serialize()

			datos = datos.split('&')[1]

			$.ajax({
				type: 'POST',
				url: window.location.href,
				data: datos,// Obtiene los datos del formulario
				success: function (response) {


					Swal.fire({
						icon: 'success',
						title: 'Se ha restaurado tu contraseña correctamente, revisa tu correo'
					}).then((result) => {

						if (result.isConfirmed) {
							window.location.replace(window.location);
						}
					})

					setTimeout(function () {
						window.location.replace(window.location);
					}, 4000);



				},
				error: function (xhr, status, error) {
					// Código a ejecutar si se produjo un error al realizar la solicitud

					var response;
					try {
						response = JSON.parse(xhr.responseText);
					} catch (e) {
						response = {};
					}

					switch (response.status_code) {

						case 408:

							response.ErrorType = "Time Out"

							break;

						case 409:
							response.ErrorType = "User Already Exist"
							break;
						case 422:
							response.ErrorType = "Invalid Data"
							break;
						case 404:
							response.ErrorType = "User Not Exist"
							break;
						default:
							break;
					}


					Swal.fire({
						icon: 'error',
						title: response.ErrorType,
						text: response.msj
					})



				}
			});
		}
	});



}


// CREANDO FUNCION DEL TOAST
function countdown_toast() {
	// Muestra el toast

	countdownToast.show();

	// Establece la fecha límite para el countdown
	var countDownDate = new Date(new Date().getTime() + duration * 1000).getTime();

	// Actualiza el countdown cada segundo
	var x = setInterval(function () {

		// Obtiene la fecha y hora actual
		var now = new Date().getTime();

		// Calcula la distancia entre la fecha límite y la fecha actual
		var distance = countDownDate - now;

		// Calcula los minutos y segundos restantes
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// Muestra el countdown en el elemento con ID "countdown"
		document.getElementById("countdown").innerHTML = minutes + "m " + seconds + "s ";

		// Si la fecha límite ha pasado, muestra un mensaje de finalizado y cierra el toast
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("countdown").innerHTML = "CODIGO EXPIRADO";
			setTimeout(function () {
				countdownToast.hide();
			}, 2000);
		}
	}, 1000);
}


	if (requests == false) {
		showRecaptchaPopup()
		verified_rectcha()
	}
	
	function verified_rectcha(){
		// Espera 30 segundos antes de enviar la respuesta
		setTimeout(function () {
			if (!grecaptcha.getResponse()) {
				// Si no se ha completado el reCAPTCHA en 30 segundos, envía la respuesta a una URL
				$.ajax({
					type: 'POST',
					url: window.location,
					data: { 'respuesta': 'no completado' },
					success: function () {
						console.log('Respuesta enviada');
					}
				});
				$('#recaptcha-popup').modal('hide');
			}
		}, 10000);
	}

	// Función para mostrar el popup con el reCAPTCHA
	function showRecaptchaPopup() {
		$('#recaptcha-popup').modal('show');
		// Inicializa el reCAPTCHA
	
		
	}
});
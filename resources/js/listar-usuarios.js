//import { spanish } from "../js/constantes-globales";

//APARTADO DE INICIALIZACION DATATABLES JS
$(document).ready(function () {
	const dataTable_users = $('#tableUsers').DataTable({
		responsive: true,
		ajax: {
			method: "GET",
			url: 'index.php?pagina=listar-usuarios',
			data: { cargar: 'cargar' }
		},
		columns: [
			/*{
				data: null,
				render: function(data, type, row, meta) {
				  return `{cedula: '${data.cedula}', estado: '${data.estado}'`;
				}
			},
			{data: 'cedula'},*/
			{ data: 'codigo' },
			{ data: 'nombre' },
			{ data: 'apellido' },
			{ data: 'sexo' },
			{ data: 'fecha_nacimiento' },
			{
				defaultContent: `
			<button type="button" id="editar_user" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
			<button type="button" data-bs-toggle="modal" data-bs-target="#eliminar_usuarios" class="btn btn-outline-danger delete-btn"><i class="bi bi-person-dash-fill fs-5"></i></button>
			`}
		],
		//language: spanish,
	});


	$('#tableUsers tbody').on('click', '#editar_user', function () {
		const datos = dataTable_users.row($(this).parents()).data();
		document.getElementById('nombreInput').value = datos.nombre;
		document.getElementById('apellidoInput').value = datos.apellido;
		document.getElementById('cedulaInput').value = datos.cedula;
		document.getElementById('cedulaInput2').value = datos.cedula;
		document.getElementById('edadInput').value = datos.fecha_nacimiento;
		document.getElementById('sexo').value = datos.sexo;
		document.getElementById('civil').value = datos.estado_civil;
		document.getElementById('nacionalidad').value = datos.nacionalidad;
		document.getElementById('estado').value = datos.estado;
		document.getElementById('telefonoInput').value = datos.telefono;
		document.getElementById('rol').value = datos.id_rol;
	})


	//ACTUALIZAR DATOS DE LOS USUARIOS
	formulario.addEventListener('submit', (e) => {
		e.preventDefault();
		if (campos.nombre && campos.apellido && campos.cedula && campos.edad && campos.telefono && campos.estado && campos.nacionalidad && campos.sexo && campos.civil) {
			const datos = {
				nombre: document.getElementById('nombreInput').value,
				apellido: document.getElementById('apellidoInput').value,
				cedula: document.getElementById('cedulaInput').value,
				cedula_antigua: document.getElementById('cedulaInput2').value,
				fecha_nacimiento: document.getElementById('edadInput').value,
				sexo: document.getElementById('sexo').value,
				estado_civil: document.getElementById('civil').value,
				nacionalidad: document.getElementById('nacionalidad').value,
				estado: document.getElementById('estado').value,
				telefono: document.getElementById('telefonoInput').value,
				rol: document.getElementById('rol').value,
				update: 'update'
			}

			$.ajax({
				type: "POST",
				url: "?pagina=listar-usuarios",
				data: datos,
				success: function (response) {
					let data = JSON.parse(response);
					console.log(data);

					if (data.status_code === 202) {
						fire_alerta(data.msj, 'success');
						dataTable_users.ajax.reload();
					} else {
						fire_alerta('Algo ocurrio en la BD', 'error')
					}
				},
				error: function (xhr, status, error) {
					console.log(xhr);
					console.log(status);
					console.log(error);
					// Código a ejecutar si se produjo un error al realizar la solicitud
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

});


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
			ValidarFecha_nacimiento(e.target, 'edad');
			//ValidarCampo(expresiones.edad, e.target, 'edad');
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


/////Validando fecha de nacimiento
const ValidarFecha_nacimiento = (input, campo) => {
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



//Alerta de SweetAlert para alertas generales
function fire_alerta(titulo, icono) {
	Swal.fire({
		icon: icono,
		title: titulo,
		showConfirmButton: false,
		timer: 2000,
	})
}

//Alerta de SweetAlert para alertar de errores
function fire_alerta_problem(titulo, texto, icono) {
	Swal.fire({
		icon: icono,
		title: titulo,
		text: texto,
		showConfirmButton: false,
		timer: 2000,
	})
}



function addEvents() {


	// Actualizar contenido del modal Eliminar
	const deleteButtons = document.querySelectorAll('table td .delete-btn')

	deleteButtons.forEach(boton => boton.addEventListener('click', () => {
		let fila = boton.parentElement.parentElement
		let cedula_participante = fila.querySelector('.cedula')
		let nombre = fila.querySelector('.nombre')
		let apellido = fila.querySelector('.apellido')
		console.log(fila)
		console.log(cedula_participante)
		console.log(nombre)
		console.log(apellido)

		const cedulaInput = document.querySelector('#deleteForm .delete_usuario_cedula')
		const nombre_participante = document.getElementById('delete_usuario_name')
		const apellido_participante = document.getElementById('delete_usuario_apellido')

		cedulaInput.value = cedula_participante.textContent
		nombre_participante.textContent = nombre.textContent
		apellido_participante.textContent = apellido.textContent


	}))
}


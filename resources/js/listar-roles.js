// Elementos
const busquedaEl = document.getElementById('search-input')
const rolesEl = document.getElementById('roles')

// Agrega los eventos para actualizar y eliminar cada rol
addEvents()

// Notificación SweetAlert
if (alertMsg != "") {
	let iconText
	if (alertStatus) {iconText = 'success'} else {iconText = 'error'}
	Swal.fire({
		icon: iconText,
		title: alertMsg
	})
}

// Alternar botones y checkbox de los permisos
const botones = document.querySelectorAll('.edit-modal form table tbody button')

botones.forEach(boton => boton.addEventListener('click', () => {
	let checkbox = boton.querySelector('input[type=checkbox]')
	let span = boton.querySelector('span')

	checkbox.checked = !checkbox.checked
	boton.classList.toggle('btn-primary')
	boton.classList.toggle('btn-secondary')
	if (checkbox.checked) {
		span.textContent = "SI"
	} else {
		span.textContent = "NO"
	}
}))

// Busqueda con Ajax
busquedaEl.addEventListener('keyup', () => {
	let busqueda = busquedaEl.value

	buscarRoles(busqueda)
})

// Eliminación con Ajax
const deleteButton = document.getElementById('deleteButton')

deleteButton.addEventListener('click', () => {
	let rolId = document.querySelector('#deleteForm .id').value

	$.ajax({
		data: 'id='+rolId,
		url: "controlador/ajax/eliminar-rol.php",
		type: "post",
	}).done(data => {
		var resp = JSON.parse(data);

		if (resp == 'eliminado') {
			fireAlert('success', 'Rol eliminado correctamente')
		} else {
			fireAlert('error', 'No puedes eliminar este rol porque se encuentra en uso');
		}
	}).then(() => {
		document.querySelector('#eliminar .btn-close').click()

		buscarRoles('')
	})
})

function fireAlert(icon, msg) {
	Swal.fire({
		icon: icon,
		title: msg
	})
}

// Buscar roles con Ajax
function buscarRoles(busqueda) {
	return $.ajax({
		data: 'busqueda='+busqueda,
		url: "controlador/ajax/buscar-roles.php",
		type: "get"
	}).done(data => {
		rolesEl.innerHTML = data
		addEvents()
	})
}

// Agrega los eventos para editar y eliminar cada rol
function addEvents() {
	// Actualizar contenido del modal Editar
	const editButtons = document.querySelectorAll('table td .edit-btn')

	editButtons.forEach(boton => boton.addEventListener('click', () => {
		let fila = boton.parentElement.parentElement
		let id = fila.querySelector('.id')
		let nombre = fila.querySelector('.nombre')
		let descripcion = fila.querySelector('.descripcion')

		const idInput = document.getElementById('idInput')
		const rolInput = document.getElementById('rolInput')
		const descripcionInput = document.getElementById('descripcionInput')

		idInput.value = id.textContent
		rolInput.value = nombre.textContent
		descripcionInput.value = descripcion.textContent
	}))

	// Actualizar contenido del modal Eliminar
	const deleteButtons = document.querySelectorAll('table td .delete-btn')

	deleteButtons.forEach(boton => boton.addEventListener('click', () => {
		let fila = boton.parentElement.parentElement
		let id = fila.querySelector('.id')
		let nombre = fila.querySelector('.nombre')

		const idInput = document.querySelector('#deleteForm .id')
		const rolText = document.getElementById('deleteRolName')

		idInput.value = id.textContent
		rolText.textContent = nombre.textContent
	}))
}
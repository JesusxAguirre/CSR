// Notificación SweetAlert
if (alertMsg != "") {
	let iconText
	if (alertStatus) {iconText = 'success'} else {iconText = 'error'}
	Swal.fire({
		icon: iconText,
		title: alertMsg
	})
}
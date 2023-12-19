const formulario = document.getElementById('formulario'); //declarando una constante con la id formulario

var csr = document.getElementById('CSR');

var csr_array = Array.prototype.map.call(csr.options, function (option) { //retornando array con id de lideres
	return option.value;
});

var choices1 = new Choices(csr, {
  allowHTML: true,
  removeItems: true,
  removeItemButton: true,
  noResultsText: 'No hay coicidencias',
  noChoicesText: 'No hay lideres disponibles',
});

const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario

const campos = {
  hombres: false,
  mujeres: false,
  niños: false,
  confesiones: false,
  csr: false,
}

const expresiones = { //objeto con varias expresiones regulares

  cantidad: /^[0-9]{1,2}$/,
  //expresion regular de codigo de usuario
}

const ValidarFormulario = (e) => {
  switch (e.target.name) {
    case "hombres":
      ValidarCampo(expresiones.cantidad, e.target, 'hombres');
      break;
    case "mujeres":
      ValidarCampo(expresiones.cantidad, e.target, 'mujeres');
      break;
    case "niños":
      ValidarCampo(expresiones.cantidad, e.target, 'niños');
      break;
    case "confesiones":
      ValidarCampo(expresiones.cantidad, e.target, 'confesiones');
      break;
    case "CSR":
      ValidarSelect(csr_array, e.target, 'csr');
      break;
  }
}



const ValidarSelect = (codigo_array, input, campo) => {
	if (codigo_array.indexOf(input.value) >= 0 && input.value != 0) {
		document.querySelector(`#grupo__CSR p`).classList.remove('d-block');
		document.querySelector(`#grupo__CSR select`).classList.remove('is-invalid')

		document.querySelector(`#grupo__CSR p`).classList.add('d-none');
		campos[campo] = true;
	} else {
		document.querySelector(`#grupo__CSR p`).classList.remove('d-none');

		document.querySelector(`#grupo__CSR p`).classList.add('d-block');
		document.querySelector(`#grupo__CSR select`).classList.add('is-invalid')
		campos[campo] = false;
	}
}

const ValidarCampo = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} input`).classList.remove('is-invalid')

    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = true;
  } else {
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');

    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    document.querySelector(`#grupo__${campo} input`).classList.add('is-invalid')
    campos[campo] = false;
  }
}




inputs.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);
});


csr.addEventListener('hideDropdown', ValidarFormulario);


$(document).on('submit', '#formulario', function (e) {
  e.preventDefault();
  console.log($(this).serialize());
  
  if (!(campos.mujeres && campos.niños && campos.confesiones && campos.csr && campos.hombres)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  }else{
    $.ajax({
			type: 'POST',
			url: window.location.href,
			data: $(this).serialize(),// Obtiene los datos del formulario
			success: function (response) {
        console.log(response);
        document.getElementById("formulario").reset()
        
        for(let campo in campos){
          campos[campo] = false
        }
				Swal.fire({
					icon: 'success',
					title: 'Se ha registrado el reporte correctamente',
					text: response.msj
				})
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
        console.log(response)
				switch (response.status_code) {
					case 409:
						response.ErrorType = "Hay conflicto con los horarios de visitas de casa sobre la roca"
						break;
					case 422:
						response.ErrorType = "Invalid Data"
						break;
					case 404:
						response.ErrorType = "Hubo algun error en la base de datos intente de nuevo"
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


})



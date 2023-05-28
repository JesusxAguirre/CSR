const formulario = document.getElementById('formulario'); //declarando una constante con la id formulario
 

var lideres = document.getElementById('lider');

var lideres_array = Array.prototype.map.call(lideres.options, function (option) { //retornando array con id de lideres
	return option.value;
});
var choices1 = new Choices(lideres, {
  allowHTML: true,
  removeItems: true,
  removeItemButton: true,
  noResultsText: 'No hay coicidencias',
  noChoicesText: 'No hay lideres disponibles',
});


const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario
const selects = document.querySelectorAll('#formulario select'); //declarando una constante con todos los inputs dentro de la id formulario

const campos = {
  lider: false,
  dia: false,
  hora: false,
  direccion: false,
  nombre: false,
  telefono: false,
  integrantes: false,
}


const expresiones = { //objeto con varias expresiones regulares

  direccion: /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]{3,30}$/, // Letras y espacios, pueden llevar acentos.
  // Letras y espacios, pueden llevar acentos.
  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, //formato de hora
  nombre: /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]{3,12}$/, // Letras y espacios, pueden llevar acentos.
  telefono: /^[0-9]{11}$/,
  
  integrantes: /^[0-9]{1,2}$/,
  //expresion regular de codigo de usuario
}

const ValidarFormulario = (e) => {
  switch (e.target.name) {
    case "dia":
      ValidarDia(e.target, 'dia');
      break;
    case "hora":
      ValidarCampo(expresiones.hora, e.target, 'hora');
      break;
    case "nombre":
      ValidarCampo(expresiones.nombre, e.target, 'nombre');
      break;
    case "telefono":
      ValidarCampo(expresiones.telefono, e.target, 'telefono');
      break;
    case "integrantes":
      ValidarCampo(expresiones.integrantes, e.target, 'integrantes');
      break;

    case "lider[]":
      ValidarSelect(lideres_array,e.target, 'lider');
      break;
    case "direccion":
      ValidarCampo(expresiones.direccion, e.target, 'direccion');
      break;

  }
}


const ValidarDia = (input, campo) => {
  if (input.value === "Lunes" || input.value === "Martes" || input.value === "Miercoles" || input.value === "Jueves" || input.value === "Viernes" || input.value === "Sabado" || input.value === "Domingo") {

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

lideres.addEventListener('hideDropdown', ValidarFormulario);


$(document).on('submit', '#formulario', function (e) {
  e.preventDefault();
  console.log($(this).serialize())
  if (!(campos.lider && campos.dia && campos.direccion && campos.hora && campos.integrantes && campos.nombre && campos.telefono)) {
   
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
				console.log(response)
				
        document.getElementById("formulario").reset()
        
        for(let campo in campos){
          campos[campo] = false
        }
				Swal.fire({
					icon: 'success',
					title: 'Se ha registrado correctamente la CSR',
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




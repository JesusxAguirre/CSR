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
  CSR: false,
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
    case "CSR[]":
      ValidarSelect(csr_array,e.target, 'CSR');
      break;
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


csr.addEventListener('hideDropdown', ValidarFormulario);


formulario.addEventListener('submit', (e) => {
  if (!(campos.mujeres && campos.niños && campos.confesiones && campos.CSR && campos.hombres)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  }

})



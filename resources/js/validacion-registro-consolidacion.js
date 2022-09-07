const formulario = document.getElementById('formulario'); //declarando una constante con la id formulario

var participantes = document.getElementById('participantes');
var choices1 = new Choices(participantes, {
  allowHTML : true,
    removeItems: true,
    removeItemButton: true,
    noResultsText: 'No hay coicidencias',
});


const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario
const selects = document.querySelectorAll('#formulario select'); //declarando una constante con todos los inputs dentro de la id formulario

const campos = {
  codigoLider: false,
  codigoAnfitrion: false,
  codigoAsistente: false,
  dia: false,
  hora: false,
  participantes: false,
  direccion: false,
}

const expresiones = { //objeto con varias expresiones regulares

  dia: /^[a-zA-ZÀ-ÿ]{5,20}$/, // Letras y espacios, pueden llevar acentos.
  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/ //formato de hora

}

const ValidarFormulario = (e) => {
  switch (e.target.name) {
    case "dia":
      ValidarCampo(expresiones.dia, e.target, 'dia');
      break;
    case "hora":
      ValidarCampo(expresiones.hora, e.target, 'hora');
      break;
    case "codigoLider":
      ValidarSelect(e.target, 'codigoLider');
      break;
    case "codigoAnfitrion":
      ValidarSelect(e.target, 'codigoAnfitrion');
      break;
    case "codigoAsistente":
      ValidarSelect(e.target, 'codigoAsistente');
      break;
    case "participantes[]":
      ValidarSelect(e.target, 'participantes');
      break;
    case "direccion":
      ValidarSelect(e.target, 'direccion');
      break;

  }
}

const ValidarSelect = (select, campo) => {
  if (select.value == '') {

    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-check-circle-fill', 'text-check', 'input-icon2');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon2');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    campos[campo] = false;
  } else {
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon2');
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
});

participantes.addEventListener('hideDropdown', ValidarFormulario);


formulario.addEventListener('submit', (e) => {
  if (!(campos.codigoAnfitrion && campos.codigoAsistente && campos.codigoLider && campos.dia && campos.hora)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  }
})



//prueba de elimnar valores datalist 
const datalist = document.getElementById('codigoLider')

datalist.addEventListener('keyup', () => {

  $('#lider option').each(function () {
    console.log('entra a la funcion')
    var abd = $(this).val();
    $('#anfitrion option[value=' + abd + ']').remove();


  });
})
const formulario = document.getElementById('formulario'); //declarando una constante con la id formulario

var lideres = document.getElementById('lider');
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
  codigoLider: false,
  codigoAnfitrion: false,
  codigoAsistente: false,
  dia: false,
  hora: false,
  participantes: false,
  direccion: false,
}

const expresiones = { //objeto con varias expresiones regulares

  direccion: /^[A-Za-z0-9\s]{10,200}$/, // Letras y espacios, pueden llevar acentos.
  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, //formato de hora
  codigo: /^[a-zA-Z\-0-9]{20,200}$/, //expresion regular de codigo de usuario
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

    case "codigoLider":
      ValidarCampo(expresiones.codigo, e.target, 'codigoLider');
      break;

    case "codigoAnfitrion":
      ValidarCampo(expresiones.codigo, e.target, 'codigoAnfitrion');
      break;

    case "codigoAsistente":
      ValidarCampo(expresiones.codigo, e.target, 'codigoAsistente');
      break;

    case "participantes[]":
      ValidarSelect(e.target, 'participantes');
      break;

    case "direccion":
      ValidarCampo(expresiones.direccion, e.target, 'direccion');
      break;

  }
}


const ValidarDia = (input, campo) => {
  if (input.value === "Lunes" || input.value === "Martes" || input.value === "Miercoles" || input.value === "Jueves" || input.value === "Viernes" || input.value === "Sabado" || input.value === "Domingo") {
    console.log("entra en la funcion DE DIA");
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-check-circle-fill', 'text-check', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = true;
  } else {
    console.log("entra en la funcion else");
    document.querySelector(`#grupo__${campo} i`).classList.remove('bi', 'bi-check-circle-fill', 'text-check', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');
    document.querySelector(`#grupo__${campo} i`).classList.add('bi', 'bi-exclamation-triangle-fill', 'text-danger', 'input-icon');
    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    campos[campo] = false;
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

//probando elimnar option value

$("#codigoLider").on('change', function () {
  var val = $('#codigoLider').val();
  var cedula = $('#lider').find('option[value="' + val + '"]').data('ejemplo');



  let codigo = $('#codigoLider').val();
  console.log(codigo)

  $('#anfitrion option').each(function () {
    console.log('entra a la funcion')
    if ($(this).val() == codigo) {
      $(this).remove();
    }
  });
  $('#asistente option').each(function () {
    console.log('entra a la funcion')
    if ($(this).val() == codigo) {
      $(this).remove();
    }
  })


});


if (error == false) {
  Swal.fire({
    icon: 'success',
    title: 'Se registro la celula correctamente'
  })
  const myTimeout = setTimeout(recarga, 2000);

  function recarga() {
    window.location = "index.php?pagina=registrar-celula-discipulado";
  }
}
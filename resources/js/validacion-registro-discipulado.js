const formulario = document.getElementById('formulario'); //declarando una constante con la id formulario

var lista_lideres = document.getElementById('lider') //buscando id de lista de lideres para retorar array de lidere

var lideres_array = Array.prototype.map.call(lista_lideres.options, function (option) { //retornando array con id de lideres
  return option.value;
});
var lista_anfitriones = document.getElementById('anfitrion')

var anfitriones_array = Array.prototype.map.call(lista_anfitriones.options, function (option) {
  return option.value;
});
var lista_asistentes = document.getElementById('asistente')

var asistentes_array = Array.prototype.map.call(lista_asistentes.options, function (option) {
  return option.value;
});

var participantes = document.getElementById('participantes');
var choices1 = new Choices(participantes, {
  allowHTML: true,
  removeItems: true,
  removeItemButton: true,
  noResultsText: 'No hay coicidencias',
  noChoicesText: 'No hay participantes disponibles',
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
      ValidarHora(expresiones.hora, e.target, 'hora');
      break;

    case "codigoLider":
      ValidarCodigo(lideres_array, e.target, 'codigoLider');
      break;

    case "codigoAnfitrion":
      ValidarCodigo(anfitriones_array, e.target, 'codigoAnfitrion');
      break;

    case "codigoAsistente":
      ValidarCodigo(asistentes_array, e.target, 'codigoAsistente');
      break;

    case "participantes[]":
      ValidarSelect(e.target, 'participantes');
      break;

    case "direccion":
      ValidarCampo(expresiones.direccion, e.target, 'direccion');
      break;

  }
}

const ValidarCodigo = (codigo_array, input, campo) => {
  if (codigo_array.indexOf(input.value) >= 0 && input.value != 0) {
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

const ValidarHora = (expresion, input, campo) => {
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
const ValidarSelect = (select, campo) => {
  if (select.value == '') {

    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} select`).classList.remove('is-invalid')

    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = false;
  } else {
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');

    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    document.querySelector(`#grupo__${campo} select`).classList.add('is-invalid')
    campos[campo] = true;
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

participantes.addEventListener('hideDropdown', ValidarFormulario);


$(document).on('submit', '#formulario', function (event) {

  event.preventDefault()


  if (!(campos.codigoAnfitrion && campos.codigoAsistente && campos.codigoLider && campos.dia && campos.hora)) {
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })

    return false
  }


  $.ajax({
    type: 'POST',
    url: window.location.href,
    data: $(this).serialize(),// Obtiene los datos del formulario
    success: function (response) {

      console.log(response)

      document.getElementById("formulario").reset()

      for (let campo in campos) {
        campos[campo] = false
      }
      Swal.fire({
        icon: 'success',
        title: 'Se ha registrado correctamente la celula de discipulado',
        text: response.msj
      })
    },
    error: function (xhr, status, error) {
      // Código a ejecutar si se produjo un error al realizar la solicitud


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
          response.ErrorType = 'Hubo un error desconocido contacte con los administradores'
          break;
      }

      Swal.fire({
        icon: 'error',
        title: response.ErrorType,
        text: response.msj
      })



    }
  });


})

//probando elimnar option value

$("#codigoLider").on('change', function () {
  var val = $('#codigoLider').val();
  var cedula = $('#lider').find('option[value="' + val + '"]').data('ejemplo');



  let codigo = $('#codigoLider').val();


  $('#anfitrion option').each(function () {

    if ($(this).val() == codigo) {
      $(this).remove();
    }
  });
  $('#asistente option').each(function () {

    if ($(this).val() == codigo) {
      $(this).remove();
    }
  })


});
$("#codigoAnfitrion").on('change', function () {
  var val = $('#codigoAnfitrion').val();
  var cedula = $('#lider').find('option[value="' + val + '"]').data('ejemplo');



  let codigo = $('#codigoAnfitrion').val();


  $('#lider option').each(function () {

    if ($(this).val() == codigo) {
      $(this).remove();
    }
  });


});
$("#codigoAsistente").on('change', function () {
  var val = $('#codigoAsistente').val();
  var cedula = $('#lider').find('option[value="' + val + '"]').data('ejemplo');



  let codigo = $('#codigoAsistente').val();


  $('#lider option').each(function () {

    if ($(this).val() == codigo) {
      $(this).remove();
    }
  });


});



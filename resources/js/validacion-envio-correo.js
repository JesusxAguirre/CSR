const formulario = document.getElementById('formulario'); //declarando una constante con la id formulario

var usuarios = document.getElementById('usuario');
var choices1 = new Choices(usuarios, {
  allowHTML: true,
  removeItems: true,
  removeItemButton: true,
  noResultsText: 'No hay coicidencias',
  noChoicesText: 'No hay usuarios disponibles',
});


const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario
const selects = document.querySelectorAll('#formulario select'); //declarando una constante con todos los inputs dentro de la id formulario

const campos = {
  usuario: false,
  html : true,
}

const expresiones = { //objeto con varias expresiones regulares

  direccion: /^[A-Za-z0-9\s]{10,200}$/, // Letras y espacios, pueden llevar acentos.
  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, //formato de hora
  codigo: /^[a-zA-Z\-0-9]{20,200}$/, //expresion regular de codigo de usuario
  nombre: /^[a-zA-ZÀ-ÿ\s]{3,20}$/,
  telefono: /^[0-9]{11}$/,
  direccion: /^[A-Za-z0-9\s]{10,200}$/,
  integrantes: /^[0-9]{1,2}$/,
  //expresion regular de codigo de usuario
}

const ValidarFormulario = (e) => {
  switch (e.target.name) {
 
    case "usuario":
      ValidarSelect(e.target, 'usuario');
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

usuarios.addEventListener('hideDropdown', ValidarFormulario);
$("#formulario").on("submit", function (e) {

  var hvalue2 = $('#mensaje .ql-editor').html();
  $(this).append("<textarea name='mensaje' style='display:none'>" + hvalue2 + "</textarea>");
  if (!(campos.html && campos.usuario)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  }

});


  



/* if (error == false) { 
  Swal.fire({
    icon: 'success',
    title: 'Se registro la casa sobre la roca correctamente'
  })
  const myTimeout = setTimeout(recarga, 2000);

  function recarga() {
    window.location = "index.php?pagina=registrar-casa";
  }
} */

//libreria quill

var toolbarOptions = [
  [{
    'header': [1, 2, 3, 4, 5, 6, false]
  }],
  [{
    'font': []
  }],
  [{
    'color': []
  }, {
    'background': []
  }], // dropdown with defaults from theme

  [{
    'align': []
  }],
  ['bold', 'italic', 'underline', 'strike'], // toggled buttons
  [{
    'header': 1
  }, {
    'header': 2
  }], // custom button values
  [{
    'list': 'ordered'
  }, {
    'list': 'bullet'
  }],
  [{
    'indent': '-1'
  }, {
    'indent': '+1'
  }], // outdent/indent


  ['clean'] // remove formatting button
];
var options = {
  debug: 'info',
  modules: {
    toolbar: toolbarOptions
  },
  placeholder: 'Escribe el asunto del correo',
  theme: 'snow'
};
var toolbarOptions2 = [
  [{
    'header': [1, 2, 3, 4, 5, 6, false]
  }],
  [{
    'font': []
  }],
  [{
    'color': []
  }, {
    'background': []
  }], // dropdown with defaults from theme

  [{
    'align': []
  }],
  ['bold', 'italic', 'underline', 'strike'], // toggled buttons
  [{
    'header': 1
  }, {
    'header': 2
  }], // custom button values
  [{
    'list': 'ordered'
  }, {
    'list': 'bullet'
  }],
  [{
    'indent': '-1'
  }, {
    'indent': '+1'
  }], // outdent/indent


  ['clean'] // remove formatting button
];
var options2 = {
  debug: 'info',
  modules: {
    toolbar: toolbarOptions2
  },
  placeholder: 'Aqui va el texto que quieres enviar al destinatario',
  theme: 'snow'
};
var quill = new Quill('#asunto', options);
var quill2 = new Quill('#mensaje', options2);
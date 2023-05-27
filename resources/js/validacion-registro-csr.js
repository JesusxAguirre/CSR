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
  dia: false,
  hora: false,
  direccion: false,
  nombre: false,
  telefono: false,
  integrantes: false,
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
      ValidarSelect(e.target, 'lider');
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

const ValidarSelect = (select, campo) => {
  if (select.value == '') {

    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} input`).classList.remove('is-invalid')

    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = false;
  } else {
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');

    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    document.querySelector(`#grupo__${campo} input`).classList.add('is-invalid')
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

lideres.addEventListener('hideDropdown', ValidarFormulario);


formulario.addEventListener('submit', (e) => {
  if (!(campos.dia && campos.direccion && campos.hora && campos.integrantes && campos.nombre && campos.telefono)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  }
})



if (error == false) {
  Swal.fire({
    icon: 'success',
    title: 'Se registro la casa sobre la roca correctamente'
  })
  const myTimeout = setTimeout(recarga, 2000);

  function recarga() {
    window.location = "index.php?pagina=registrar-casa";
  }
}
const formulario = document.getElementById('formulario'); //declarando una constante con la id formulario

var csr = document.getElementById('CSR');
var choices1 = new Choices(csr, {
  allowHTML: true,
  removeItems: true,
  removeItemButton: true,
  noResultsText: 'No hay coicidencias',
  noChoicesText: 'No hay lideres disponibles',
});


const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario
const textarea = document.querySelectorAll('#formulario textarea'); //declarando una constante con todos los inputs dentro de la id formulario

const campos = {
  hombres: false,
  mujeres: false,
  niños: false,
  confesiones: false,
  observaciones: false,
  CSR: false,
}

const expresiones = { //objeto con varias expresiones regulares

  observaciones: /^[A-Za-z0-9\s]{40,200}$/, // Letras y espacios, pueden llevar acentos.
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
    case "observaciones":
      ValidarCampo(expresiones.observaciones, e.target, 'observaciones');
      break;
    case "CSR[]":
      ValidarSelect(e.target, 'CSR');
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
textarea.forEach((text) => {
  text.addEventListener('keyup', ValidarFormulario);
  text.addEventListener('blur', ValidarFormulario);
});

csr.addEventListener('hideDropdown', ValidarFormulario);


formulario.addEventListener('submit', (e) => {
  if (!(campos.observaciones && campos.mujeres && campos.niños && campos.confesiones && campos.CSR && campos.hombres)) {
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
    title: 'Se registro el reporte satisfactoriamentete'
  })
  const myTimeout = setTimeout(recarga, 2000);

  function recarga() {
    window.location = "index.php?pagina=reporte-casa";
  }
}
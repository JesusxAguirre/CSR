// Actualizar contenido del modal Editar
const formulario = document.getElementById('editForm'); //declarando una constante con la id formulario


const inputs = document.querySelectorAll('#editForm input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs2 = document.querySelectorAll('#agregar_usuarios input');

var codigo_discipulado = document.getElementById('codigo_discipulado');
var choices1 = new Choices(codigo_discipulado, {
  allowHTML: true,
  removeItems: true,
  removeItemButton: true,
  noResultsText: 'No hay coicidencias',
  noChoicesText: 'No hay codigo_discipulado disponibles',
});



const campos = {
  codigo_celula: false,
  fecha_inicio: false,
  fecha_final: false,
}

const expresiones = { //objeto con varias expresiones regulares

  dia: /^[a-zA-ZÀ-ÿ]{5,20}$/, // Letras y espacios, pueden llevar acentos.
  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, //formato de hora
  codigo: /^[CC]{2}[0-9]{1,5}$/ //expresion regular de codigo, primero espera las dos letras CC y luego de 1 a 20 numeros
}



const ValidarFormulario = (e) => {
  switch (e.target.name) {

    case "codigo_discipulado":
      ValidarSelect(e.target, 'codigo_discipulado');
      break;
    case "fecha_inicio":
      ValidarSelect(e.target, 'fecha_inicio');
      break;
    case "fecha_final":
      ValidarSelect(e.target, 'fecha_final');
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




formulario.addEventListener('submit', (e) => {
  if (!(campos.codigoAnfitrion && campos.codigoAsistente && campos.codigoLider && campos.dia && campos.hora && campos.codigo)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  }
})






inputs.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});


codigo_discipulado.addEventListener('hideDropdown', ValidarFormulario);


//busqueda ajax 

const busquedaEl = document.getElementById('caja_busqueda')
const datosEl = document.getElementById('datos')

busquedaEl.addEventListener('keyup', () => {
  let busqueda = busquedaEl.value

  $.ajax({
    data: 'busqueda=' + busqueda,
    url: "controlador/ajax/buscar-codigo_discipulado.php",
    type: "get",
  }).done(data => {
    datosEl.innerHTML = data
  })
})
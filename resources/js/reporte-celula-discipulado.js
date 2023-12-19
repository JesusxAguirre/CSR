// Actualizar contenido del modal Editar
const formulario = document.getElementById('consultar'); //declarando una constante con la id formulario


const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario


var codigo_discipulado = document.getElementById('codigo_discipulado');
var choices1 = new Choices(codigo_discipulado, {
  allowHTML: true,
  removeItems: true,
  removeItemButton: true,
  noResultsText: 'No hay coicidencias',
  noChoicesText: 'No hay codigo_discipulado disponibles',
});



const campos = {
  codigo_discipulado: false,
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
      ValidarFecha(e.target, 'fecha_inicio');
      break;
    case "fecha_final":
      ValidarFecha(e.target, 'fecha_final');
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

const ValidarFecha = (select, campo) => {
  if (select.value == '') {
    
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');

    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    campos[campo] = false;
  } else {

    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');

    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = true;
  }
}
const enviar = document.getElementById('consultar');
enviar.addEventListener('click', (e) => {
    if (!(campos.codigo_discipulado && campos.fecha_inicio && campos.fecha_final)) {
      e.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Lo siento ',
        text: 'Registra el formulario correctamente'
      })
    }else{
      //busqueda ajax 
      const codigo_discipulado_ajax = document.getElementById('codigo_discipulado')
      const fecha_inicio = document.getElementById('fecha_inicio')
      const fecha_final = document.getElementById('fecha_final')
      const respuesta = document.getElementById('respuesta');
      let codigo_discipulado2 = codigo_discipulado_ajax.value
      let fecha_inicio2 = fecha_inicio.value
      let fecha_final2 = fecha_final.value

      $.ajax({
        data: {
          codigo_discipulado: codigo_discipulado2,
          fecha_inicio: fecha_inicio2,
          fecha_final: fecha_final2,
        },
        url: "?pagina=reporte-celula-discipulado",
        type: "POST",
      }).done(data => {
        respuesta.innerHTML = data
      })
  }
})

inputs.forEach((input) => {
  input.addEventListener('change', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});

codigo_discipulado.addEventListener('hideDropdown', ValidarFormulario);


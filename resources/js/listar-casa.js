// Actualizar contenido del modal Editar
const formulario = document.getElementById('editForm'); //declarando una constante con la id formulario
const inputs = document.querySelectorAll('#editForm input'); //declarando una constante con todos los inputs dentro de la id formulario


const busquedaEl = document.getElementById('caja_busqueda')
const datosEl = document.getElementById('datos')


// Agrega los eventos para actualizar y eliminar 
addEvents()


const campos = {
  dia: true,
  hora: true,
  direccion: true,
  anfitrion: true,
  telefono_anfitrion: true,
  cantidad: true,
  lider : true
}

const expresiones = { //objeto con varias expresiones regulares

  direccion: /^[A-Za-z0-9\s]{10,200}$/, // Letras y espacios, pueden llevar acentos.
  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, //formato de hora
  codigo: /^[a-zA-Z\-0-9]{20,200}$/, //expresion regular de codigo de usuario
  nombre: /^[a-zA-ZÀ-ÿ\s]{3,20}$/,
  telefono: /^[0-9]{11}$/,
  direccion: /^[A-Za-z0-9\s]{10,200}$/,
  cantidad: /^[0-9]{1,2}$/,
}



const ValidarFormulario = (e) => {
  switch (e.target.name) {
    case "dia":
      ValidarDia(e.target, 'dia');
      break;
    case "hora":
      ValidarCampo(expresiones.hora, e.target, 'hora');
      break;
    case "anfitrion":
      ValidarCampo(expresiones.nombre, e.target, 'anfitrion');
      break;
    case "telefono_anfitrion":
      ValidarCampo(expresiones.telefono, e.target, 'telefono_anfitrion');
      break;
    case "cantidad":
      ValidarCampo(expresiones.cantidad, e.target, 'cantidad');
      break;
    case "lider":
      ValidarSelect(e.target, 'lider');
      break;
    case "direccion":
      ValidarCampo(expresiones.direccion, e.target, 'direccion');
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
const ValidarCampo = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
    console.log("entra en la funcion");
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


formulario.addEventListener('submit', (e) => {
  if (!(campos.lider && campos.dia && campos.hora && campos.direccion && campos.cantidad && campos.telefono_anfitrion && campos.anfitrion )) {
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



//alerta registrar participante

if (actualizar == false) {
  Swal.fire({
    icon: 'success',
    title: 'Se actualizo la informacion correctamente'
  })
  setTimeout(recarga, 2000);
}

//funciones ajax

//busqueda CSR
busquedaEl.addEventListener('keyup', () => {
  let busqueda = busquedaEl.value

  buscarCSR(busqueda);
})

//FUCNIONES QUE SE LLAMAN MAS ARRIBA
function buscarCSR(busqueda) {
  $.ajax({
    data: 'busqueda=' + busqueda,
    url: "controlador/ajax/buscar-CSR.php",
    type: "get",
  }).done(data => {
    datosEl.innerHTML = data
    addEvents()
  })
}

function fireAlert(icon, msg) {
  Swal.fire({
    icon: icon,
    title: msg
  })
}
function recarga() {
  window.location = "index.php?pagina=listar-casa";
}


function addEvents() {
  // Actualizar contenido del modal Editar
  const editButtons = document.querySelectorAll('table td .edit-btn')

  editButtons.forEach(boton => boton.addEventListener('click', () => {
    let fila = boton.parentElement.parentElement
    let id = fila.querySelector('.id')

    let dia = fila.querySelector('.dia')
    let hora = fila.querySelector('.hora')
    let lider = fila.querySelector('.lider')
    let nombre_anfitrion = fila.querySelector('.nombre_anfitrion')
    let telefono_anfitrion = fila.querySelector('.telefono_anfitrion')
    let cantidad = fila.querySelector('.cantidad')
    let direccion = fila.querySelector('.direccion')


    const idInput = document.getElementById('idInput')

    const diaInput = document.getElementById('diaInput')
    const horaInput = document.getElementById('horaInput')
    const liderInput = document.getElementById('lider')
    const nombre_anfitrionInput = document.getElementById('anfitrion')
    const telefono_anfitrionInput = document.getElementById('telefono_anfitrion')
    const cantidadInput = document.getElementById('cantidad')
    const direccionInput = document.getElementById('direccion')

    liderInput.value = lider.textContent
    nombre_anfitrionInput.value = nombre_anfitrion.textContent
    telefono_anfitrionInput.value = telefono_anfitrion.textContent
    idInput.value = id.textContent

    diaInput.value = dia.textContent
    horaInput.value = hora.textContent
    cantidadInput.value = cantidad.textContent
    direccionInput.value =  direccion.textContent
    //cedulas de usuarios


  }))


}
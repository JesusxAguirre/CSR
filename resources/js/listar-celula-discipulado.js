// Actualizar contenido del modal Editar

solicitar_tabla()


const formulario = document.getElementById('editForm'); //declarando una constante con la id formulario
const formulario2 = document.getElementById('agregar_usuarios')
const formulario3 = document.getElementById('agregar_asistencias')
const formulario4 = document.getElementById('eliminar_participante')
const selects = document.querySelectorAll('#EditarNivelForm select');

let participantes_array = ''

var choices1 = null

let lista_lideres = document.getElementById('lider') //buscando id de lista de lideres para retorar array de lidere

let lideres_array = Array.prototype.map.call(lista_lideres.options, function (option) { //retornando array con id de lideres
  return option.value;
});
let lista_anfitriones = document.getElementById('anfitrion')

let anfitriones_array = Array.prototype.map.call(lista_anfitriones.options, function (option) {
  return option.value;
});
let lista_asistentes = document.getElementById('asistente')

let asistentes_array = Array.prototype.map.call(lista_asistentes.options, function (option) {
  return option.value;
});

const inputs = document.querySelectorAll('#editForm input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs2 = document.querySelectorAll('#agregar_usuarios input');
const inputs3 = document.querySelectorAll('#agregar_asistencias input')

const eliminar__participantes = document.getElementById('eliminar__participantes')
const modal_eliminar_participates = document.getElementById('datos4')
const datosEl = document.getElementById('datos')
const expandir = document.getElementById('asistencias4')

// Agrega los eventos para actualizar y eliminar 
addEvents()



const campos = {
  codigoLider: true,
  codigoAnfitrion: true,
  codigoAsistente: true,
  dia: true,
  hora: true,
  codigo: true,
  participantes: false,
  fecha: false,
  asistentes: false,
  cedula_discipulo: false,
  nivel: false,
}

const expresiones = { //objeto con varias expresiones regulares

  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, //formato de hora
  direccion: /^[A-Za-z0-9\s]{10,200}$/, // Letras y espacios, pueden llevar acentos.
  codigo: /^[CD]{2}[0-9]{1,5}$/, //expresion regular de codigo, primero espera las dos letras CC y luego de 1 a 20 numeros
  codigo2: /^[a-zA-Z\-0-9]{20,200}$/, //expresion regular de codigo de usuario
}





var ValidarFormulario = (e) => {
  switch (e.target.name) {
    case "dia":
      ValidarDia(e.target, 'dia');
      break;
    case "hora":
      ValidarCampo(expresiones.hora, e.target, 'hora');
      break;
    case "codigo":
      ValidarCampo(expresiones.codigo, e.target, 'codigo');
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
      ValidarCodigo(participantes_array, e.target, 'participantes');
      break;
    case "asistentes[]":
      ValidarCodigo(asistentes_array, e.target, 'asistentes');
      break;
    case "fecha":
      ValidarFecha(e.target, 'fecha');
      break;
    case "direccion":
      ValidarCampo(expresiones.direccion, e.target, 'direccion');
      break;
    case "nivel":

      ValidarSelect(e.target, 'nivel');
      break;
  }
}


const ValidarCodigo = (codigo_array, input, campo) => {

  if (codigo_array.indexOf(input.value) >= 0) {
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

const ValidarSelect = (select, campo) => {
  if (select.value == '') {
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');

    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    document.querySelector(`#grupo__${campo} select`).classList.add('is-invalid')

    campos[campo] = false;
  } else {
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} select`).classList.remove('is-invalid')

    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');


    campos[campo] = true;
  }
}
const ValidarFecha = (select, campo) => {
  if (select.value == '') {
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-none');

    document.querySelector(`#grupo__${campo} p`).classList.add('d-block');
    document.querySelector(`#grupo__${campo} input`).classList.add('is-invalid')
    campos[campo] = false;
  } else {



    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} input`).classList.remove('is-invalid')

    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = true;
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

$('#editForm').submit(function (event) {

  event.preventDefault(); // Evita que el formulario se envíe automáticamente event.preventDefault();
  console.log($(this).serialize())
  if (!(campos.codigoAnfitrion && campos.codigoAsistente && campos.codigoLider && campos.dia && campos.hora && campos.codigo)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  } else {
    $.ajax({
      type: "POST",
      url: "?pagina=listar-celula-discipulado",
      data: $(this).serialize(),
      success: function (response) {

        document.getElementById("editForm").reset()

        for (let campo in campos) {
          campos[campo] = false
        }

        $("#editar").removeClass('fade').modal('hide');
        $('#tabla_discipulos').DataTable().destroy();

        $("#editar").addClass('fade')
        solicitar_tabla()

        fireAlert('success', 'Se actualizo correctamente los datos')

      },
      error: function (xhr, status, error) {

        // Código a ejecutar si se produjo un error al realizar la solicitud
        var response;
        try {
          response = JSON.parse(xhr.responseText);
        } catch (e) {
          response = {};
        }

        switch (response.status_code) {
          case 409:
            response.ErrorType = "Celula de discipulado ya existe"
            break;
          case 422:
            response.ErrorType = "Datos invalidos"
            break;
          case 404:
            response.ErrorType = "Celula de discipulado no existe"
            break;
          default:
            break;
        }
        Swal.fire({
          icon: 'error',
          title: response.ErrorType,
          text: response.msj
        })
      }
    })
  }
})

$('#agregar_usuarios').submit(function (event) {
  event.preventDefault(); // Evita que el formulario se envíe automáticamente event.preventDefault();
  console.log($(this).serialize())
  if (!(campos.participantes)) {
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  } else {
    $.ajax({
      type: "POST",
      url: "?pagina=listar-celula-discipulado",
      data: $(this).serialize(),
      success: function (response) {
        console.log(response)
        document.getElementById("agregar_usuarios").reset()

        for (let campo in campos) {
          campos[campo] = false
        }

        $("#agregar_usuario").removeClass('fade').modal('hide');
        $('#tabla_discipulos').DataTable().destroy();

        $("#agregar_usuario").addClass('fade')
        solicitar_tabla()

        fireAlert('success', 'Se agregaron participantes correctamente ')

      },
      error: function (xhr, status, error) {

        // Código a ejecutar si se produjo un error al realizar la solicitud
        var response;
        try {
          response = JSON.parse(xhr.responseText);
        } catch (e) {
          response = {};
        }

        switch (response.status_code) {
          case 409:
            response.ErrorType = "celula de discipulado ya existe"
            break;
          case 422:
            response.ErrorType = "Datos invalidos"
            break;
          case 404:
            response.ErrorType = "Celulua de discipulado no existe"
            break;
          default:
            break;
        }
        Swal.fire({
          icon: 'error',
          title: response.ErrorType,
          text: response.msj
        })
      }
    })
  }
})




formulario3.addEventListener('submit', (e) => {
  if (!(campos.asistentes && campos.fecha)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  }
})

$("#EditarNivelForm").submit(function (e) {
  e.preventDefault()
  if (!(campos.nivel)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente '
    })
  } else {

    $.ajax({
      type: "POST",
      url: "?pagina=listar-celula-discipulado",
      data: $(this).serialize(),
      success: function (response) {

        var data = JSON.parse(response);

        if (data.response != 0) {
          Swal.fire({
            icon: 'success',
            title: 'Se actualizo la informacion correctamente'
          })
          let busqueda = busquedaEl.value

          buscarDiscipulado(busqueda)

          buscarParticipantes(data.response)

          addEvents()
        } else {
          console.log("Envio malicioso de datos")
        }
      }
    })
  }
})

selects.forEach((select) => {
  select.addEventListener('click', ValidarFormulario);

});

inputs.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});
inputs2.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});
inputs3.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});



//alerta registrar participante


//funciones ajax


// Eliminación con Ajax
const deleteButton = document.getElementById('deleteButton')

deleteButton.addEventListener('click', () => {
  let participante_cedula = document.querySelector('#deleteForm .cedula_participante').value
  console.log(participante_cedula)
  $.ajax({
    data: 'participante_cedula=' + participante_cedula,
    url: "controlador/ajax/eliminar-participante-discipulado.php",
    type: "post",
  }).done(data => {
    if (data == '1') {
      fireAlert('success', 'Discipulo  eliminado correctamente')
    } else {
      console.log(data)
      fireAlert('error', 'El Discipulo que intenta eliminar no existe')
    }
  }).then(() => {
    setTimeout(recarga, 2000);
  })
})


function fireAlert(icon, msg) {
  Swal.fire({
    icon: icon,
    title: msg
  })
}
function recarga() {
  window.location = "index.php?pagina=listar-celula-discipulado";
}




function addEvents() {




  //EDITAR NIVEL DE COLOCAR CAMPOS OCULTOS
  const editar_nivel_buttons = document.querySelectorAll('table td .edit-nivel-btn')

  editar_nivel_buttons.forEach(boton => boton.addEventListener('click', () => {
    let fila = boton.parentElement.parentElement
    let cedula_participante = fila.querySelector('.participantes_cedula')
    var id_discipulado_nivel = fila.querySelector('.id')
    let nombre = fila.querySelector('.participantes_nombre')
    let apellido = fila.querySelector('.participantes_apellido')
    let codigo_discipulo = fila.querySelector('.participantes_codigo')
    codigo_discipulo = codigo_discipulo.textContent.split("-")
    const cedulaInput = document.querySelector('#EditarNivelForm .cedula_participante')
    const codigoInput = document.getElementById('codigo_discipulo')
    const nombre_participante = document.getElementById('nivel_discipulo_nombre')
    const apellido_participante = document.getElementById('nivel_discipulo_apellido')

    cedulaInput.value = cedula_participante.textContent
    codigoInput.value = codigo_discipulo[1]
    nombre_participante.textContent = nombre.textContent
    apellido_participante.textContent = apellido.textContent
  }))



}



$('#tabla_discipulos tbody').on('click', '.btn-edit', function () {
  // Actualizar contenido del modal Editar

  console.log("ENTRO EN EL BTN EDT")

  const editButtons = document.querySelectorAll('table td .btn-edit')

  let row = $(this).closest('tr');





  const idInput = document.getElementById('idInput')
  const diaInput = document.getElementById('diaInput')
  const horaInput = document.getElementById('horaInput')
  const liderInput = document.getElementById('codigoLider')
  const nombre_anfitrionInput = document.getElementById('codigoAnfitrion')
  const telefono_anfitrionInput = document.getElementById('codigoAsistente')
  const direccionInput = document.getElementById('direccionInput')

  hora_completa = row.find('td:eq(3)').text()

  idInput.value = row.find('td:eq(0)').text()
  diaInput.value = row.find('td:eq(2)').text()

  horaInput.value = hora_completa.slice(0, 5)
  liderInput.value = row.find('td:eq(4)').text()
  nombre_anfitrionInput.value = row.find('td:eq(5)').text()
  telefono_anfitrionInput.value = row.find('td:eq(6)').text()
  direccionInput.value = row.find('td:eq(8)').text()
  //cedulas de usuarios

  console.log(hora_completa.slice(0, 5))
});

$('#tabla_discipulos tbody').on('click', '.btn-add', function () {


  let row = $(this).closest('tr');

  let idInput = document.getElementById('idInput2')
  idInput.value = row.find('td:eq(0)').text()


  $.ajax({
    url: window.location,
    type: 'GET',
    data: {
      buscar_participantes: 'buscar_participantes',
    },
    dataType: 'json',
    success: function (data) {

      if (choices1 !== null) {
        choices1.destroy()
      }

      let participantes = document.getElementById('participantes');



      participantes_array = data.map(function (participante) {
        return {
          value: participante.cedula,
          label: participante.nombre + ' ' + participante.apellido + ' ' + participante.codigo,
        };
      });


      choices1 = new Choices(participantes, {
        choices: participantes_array,
        allowHTML: true,
        removeItems: true,
        removeItemButton: true,
        noResultsText: 'No hay coincidencias',
        noChoicesText: 'No hay participantes disponibles',
      });

      participantes_array = data.map(function (participante) {
        return String(participante.cedula)
      });

      //listando eventos selects libreria choice
      participantes.addEventListener('hideDropdown', ValidarFormulario);

    },
    error: function (xhr, status, error) {
      console.log(xhr)
    }
  });

})

$('#tabla_discipulos tbody').on('click', '.btn-add-date', function () {


  let row = $(this).closest('tr');

  let idInput = document.getElementById('idInput3')
  idInput.value = row.find('td:eq(0)').text()

  $.ajax({
    data: 'busqueda=' + row.find('td:eq(0)').text(),
    url: "controlador/ajax/buscar-participante-asistencias-discipulado.php",
    type: "GET"
  }).done(data => {
    console.log(data);
    expandir.innerHTML = data
    const asistentes = document.getElementById('asistentes');
    var choices2 = new Choices(asistentes, {
      allowHTML: true,
      removeItems: true,
      removeItemButton: true,
      noResultsText: 'No hay coicidencias',
      noChoicesText: 'No hay participantes disponibles',
    });
    asistentes.addEventListener('hideDropdown', ValidarFormulario);
  })
})

$('#tabla_discipulos tbody').on('click', '.modal-btn', function () {
  let row = $(this).closest('tr');

  $.ajax({
    data: 'busqueda=' + row.find('td:eq(0)').text(),
    url: "controlador/ajax/buscar-participante-discipulado.php",
    type: "get"
  }).done(data => {
    modal_eliminar_participates.innerHTML = data
    var v_modal = $('#eliminar_usuario').modal({ show: false });

    v_modal.modal("show");
  })

})


$('#tabla_participantes tbody').on('click', '.delete-btn', function() {
  let row = $(this).closest('tr');

  const cedulaInput = document.querySelector('#deleteForm .cedula_participante')
    const nombre_participante = document.getElementById('deleteParticipanteName')
    const apellido_participante = document.getElementById('deleteParticipanteApellido')

    cedulaInput.value = row.find('td:eq(6)').text()
    nombre_participante.textContent = row.find('td:eq(2)').text()
    apellido_participante.textContent = row.find('td:eq(3)').text()

})

  function solicitar_tabla() {
    $.ajax({
      url: window.location,
      type: 'GET',
      data: {
        listar_celula_disicpulado: 'listar_celula_disicpulado',
      },
      dataType: 'json',
      success: function (data) {

        console.log(data)

        $('#tabla_discipulos').DataTable({
          language: {
            url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" // Ruta del archivo de idioma en español
          },
          data: data,
          columns: [
            { data: 'id', title: 'ID', className: "d-none" },
            { data: 'codigo_celula_discipulado', title: 'Codigo de celula' },
            { data: 'dia_reunion', className: "text-capitalize dia", title: 'Dia de reunion' },
            { data: 'hora', className: "text-capitalize hora", title: 'Hora de reunion' },
            { data: 'codigo_lider', title: 'Codigo de lider' },
            { data: 'codigo_anfitrion', title: 'Codigo de anfitrion', className: "d-none" },
            { data: 'codigo_asistente', title: 'Codigo de asistente', className: "d-none" },
            { data: 'direccion', title: 'Direccion', className: "d-none" },
            {
              data: null,
              title: "Acciones",
              className: "text-center",
              defaultContent: `
           
            <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary btn-edit">
              <i class="fs-5 bi bi-pencil-fill"></i>
              </button>
              <button type="button" data-bs-toggle="modal" data-bs-target="#agregar_usuario" class="btn btn-outline-primary btn-add"> 
                <i class=" fs-5 bi bi-person-plus-fill"></i> 
              </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#agregar_asistencia" class="btn btn-outline-primary btn-add-date"> 
              <i class=" fs-5 bi bi-calendar-date-fill"></i> 
              </button>
              <button type="button" class="btn btn-outline-danger modal-btn ">
                <i class="fs-5 bi bi bi-person-dash-fill"></i>
              </button>
              `,
              orderable: false
            },

          ],
          "lengthChange": false, "autoWidth": false,
          buttons: [
            'csv', 'excel', 'pdf', 'print'
          ],

        }).buttons().container().appendTo('#tabla_usuarios_wrapper .col-md-6:eq(0)');

      },
      error: function (xhr, status, error) {
        console.log(xhr)
      }
    });
  }
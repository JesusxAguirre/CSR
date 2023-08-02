// Actualizar contenido del modal Editar
solicitar_tabla()
const formulario = document.getElementById('editForm'); //declarando una constante con la id formulario
const inputs = document.querySelectorAll('#editForm input'); //declarando una constante con todos los inputs dentro de la id formulario

var lista_lideres = document.getElementById('codigoLider') //buscando id de lista de lideres para retorar array de lidere

var lideres_array = Array.prototype.map.call(lista_lideres.options, function (option) { //retornando array con id de lideres
  return option.value;
});





const campos = {
  dia: true,
  hora: true,
  direccion: true,
  anfitrion: true,
  telefono_anfitrion: true,
  cantidad: true,
  lider: true
}

const expresiones = { //objeto con varias expresiones regulares

  direccion: /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]{3,30}$/, // Letras y espacios, pueden llevar acentos.
  hora: /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, //formato de hora

  nombre: /^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]{3,12}$/, // Letras y espacios, pueden llevar acentos.
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
      ValidarCodigo(lideres_array, e.target, 'lider');
      break;
    case "direccion":
      ValidarCampo(expresiones.direccion, e.target, 'direccion');
      break;
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

const ValidarDia = (input, campo) => {
  if (input.value === "lunes" || input.value === "martes" || input.value === "miercoles" || input.value === "jueves" || input.value === "viernes" || input.value === "sabado" || input.value === "domingo") {
    console.log("entra en la funcion DE DIA");
    document.querySelector(`#grupo__${campo} p`).classList.remove('d-block');
    document.querySelector(`#grupo__${campo} input`).classList.remove('is-invalid')

    document.querySelector(`#grupo__${campo} p`).classList.add('d-none');
    campos[campo] = true;
  } else {
    console.log("entra en la funcion else");
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

const ValidarCodigo = (codigo_array, input, campo) => {
  if (codigo_array.indexOf(input.value) >= 0) {
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
  if (!(campos.lider && campos.dia && campos.hora && campos.direccion && campos.cantidad && campos.telefono_anfitrion && campos.anfitrion)) {
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  } else {
    $.ajax({
      type: "POST",
      url: "?pagina=listar-casa",
      data: $(this).serialize(),
      success: function (response) {

        console.log(response)
        document.getElementById("editForm").reset()

        campos.anfitrion = false
        campos.cantidad = false
        campos.dia = false
        campos.hora = false
        campos.direccion = false
        campos.hora = false
        campos.lider = false
        campos.telefono_anfitrion = false

        $("#editar").removeClass('fade').modal('hide');
        $('#mi_tabla').DataTable().destroy();

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
            response.ErrorType = "Casa sobre la roca Already Exist"
            break;
          case 422:
            response.ErrorType = "Invalid Data"
            break;
          case 404:
            response.ErrorType = "Casa sobre la roca Not Exist"
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




inputs.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});






function fireAlert(icon, msg) {
  Swal.fire({
    icon: icon,
    title: msg
  })
}
function recarga() {
  window.location = "index.php?pagina=listar-casa";
}


$('#mi_tabla tbody').on('click', '.btn-edit', function () {
  // Actualizar contenido del modal Editar
  const editButtons = document.querySelectorAll('table td .btn-edit')

  let row = $(this).closest('tr');





  const idInput = document.getElementById('idInput')
  const diaInput = document.getElementById('diaInput')
  const horaInput = document.getElementById('horaInput')
  const liderInput = document.getElementById('lider')
  const nombre_anfitrionInput = document.getElementById('anfitrion')
  const telefono_anfitrionInput = document.getElementById('telefono_anfitrion')
  const cantidadInput = document.getElementById('cantidad')
  const direccionInput = document.getElementById('direccion')

  hora_completa = row.find('td:eq(3)').text()

  idInput.value = row.find('td:eq(0)').text()
  diaInput.value = row.find('td:eq(2)').text()

  horaInput.value = hora_completa.slice(0, 5)
  liderInput.value = row.find('td:eq(4)').text()
  nombre_anfitrionInput.value = row.find('td:eq(5)').text()
  telefono_anfitrionInput.value = row.find('td:eq(6)').text()
  cantidadInput.value = row.find('td:eq(7)').text()
  direccionInput.value = row.find('td:eq(8)').text()
  //cedulas de usuarios

  console.log(hora_completa.slice(0, 5))
});

$('#mi_tabla tbody').on('click', '.btn-view', function () {

  let row = $(this).closest('tr');

  $("#codigo_ver").text(row.find('td:eq(1)').text())
  $("#dia_ver").text(row.find('td:eq(2)').text())
  $("#hora_ver").text(row.find('td:eq(3)').text())

  $("#codigo_lider_ver").text(row.find('td:eq(4)').text())
  $("#anfitrion_ver").text(row.find('td:eq(5)').text())
  $("#telefono_ver").text(row.find('td:eq(6)').text())
  $("#cantidad_ver").text(row.find('td:eq(7)').text())
  $("#direccion_ver").text(row.find('td:eq(8)').text())

});

function solicitar_tabla() {
  $.ajax({
    url: "controlador/ajax/listar-casa-ajax.php",
    type: 'GET',
    dataType: 'json',
    
    success: function (data) {
      $('#mi_tabla').DataTable({
        language: {
          url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" // Ruta del archivo de idioma en español
        },
        data: data,
        columns: [
          { data: 'id', title: 'ID', className: "d-none" },
          { data: 'codigo', title: 'codigo' },
          { data: 'dia_visita', className: "text-capitalize dia", title: 'Dia de visita' },
          { data: 'hora_pautada', className: "text-capitalize hora", title: 'Hora de reunion' },
          { data: 'codigo_lider', title: 'Codigo de lider' },
          { data: 'nombre_anfitrion', title: 'Nombre de anfitrion', className: "d-none" },
          { data: 'telefono_anfitrion', title: 'Telefono de anfitrion', className: "d-none" },
          { data: 'cantidad_personas_hogar', title: 'Cantidad de personas por hogar', className: "d-none" },
          { data: 'direccion', title: 'Direccion', className: "d-none" },
          {
            data: null,
            title: "Acciones",
            className: "text-center",
            defaultContent: '<button type="button" data-bs-toggle="modal" data-bs-target="#view" class="btn btn-success btn-view"><i class="fs-5 bi bi-eye-fill"></i></button><button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary btn-edit"><i class="fs-5 bi bi-pencil-fill"></i></button>',
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

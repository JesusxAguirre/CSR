
// Actualizar contenido del modal Editar
const formulario = document.getElementById('consultar'); //declarando una constante con la id formulario
const formulario2 = document.getElementById('consultar2'); //declarando una constante con la id formulario
const formulario3 = document.getElementById('consultar3'); //declarando una constante con la id formulario
var chart1;
var options;
var enero;
const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs2 = document.querySelectorAll('#formulario2 input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs3 = document.querySelectorAll('#formulario3 input'); //declarando una constante con todos los inputs dentro de la id formulario

const campos = {
  fecha_inicio: false,
  fecha_final: false,
  fecha_inicio2: false,
  fecha_final2: false,
  fecha_inicio3: false,
  fecha_final3: false,
}

const ValidarFormulario = (e) => {
  switch (e.target.name) {
    case "fecha_inicio":
      ValidarSelect(e.target, 'fecha_inicio');
      break;
    case "fecha_final":
      ValidarSelect(e.target, 'fecha_final');
      break;
    case "fecha_inicio2":
      ValidarSelect(e.target, 'fecha_inicio2');
      break;
    case "fecha_final2":
      ValidarSelect(e.target, 'fecha_final2');
      break;
    case "fecha_inicio3":
      ValidarSelect(e.target, 'fecha_inicio3');
      break;
    case "fecha_final3":
      ValidarSelect(e.target, 'fecha_final3');
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

formulario.addEventListener('click', (e) => {
  if (!(campos.fecha_inicio && campos.fecha_final)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  } else {
    //busqueda ajax 
    const fecha_inicio = document.getElementById('fecha_inicio')
    const fecha_final = document.getElementById('fecha_final')
    const enviar = document.getElementById('consultar')
    const respuesta = document.getElementById('respuesta');
    enviar.addEventListener('click', () => {

      let fecha_inicio2 = fecha_inicio.value
      let fecha_final2 = fecha_final.value

      $.ajax({
        data: {
          fecha_inicio: fecha_inicio2,
          fecha_final: fecha_final2,
        },
        url: "controlador/ajax/mostrar-grafico-discipulado.php",
        type: "post",
        dataType: "json",
      }).done(data => {
        var titulo = [];
        var cantidad = [];
        console.log(data);
        for (prop in data) {
          titulo.push(prop);
          cantidad.push(data[prop]);
        }
        console.log(titulo);
        console.log(cantidad);
        var v_modal = $('#discipulado-grafico').modal({ show: false });
        Highcharts.chart('grafico', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Cantidad de celulas de discipulado'
          },
          xAxis: {
            categories: titulo
          },
          yAxis: {
            title: {
              text: 'Cantidad'
            }
          },
          credits: {
            enabled: false
          },
          series: [{
            name: 'Celulas de discipulado',
            data: cantidad
          }],
        });



        v_modal.on("show", function () { })
        v_modal.modal("show");
      })
    })
  }
})
formulario2.addEventListener('click', (e) => {
  if (!(campos.fecha_inicio2 && campos.fecha_final2)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  } else {
    //busqueda ajax 
    const fecha_inicio2 = document.getElementById('fecha_inicio2')
    const fecha_final2 = document.getElementById('fecha_final2')
    const enviar2 = document.getElementById('consultar2')
    const respuesta2 = document.getElementById('respuesta2');
    enviar2.addEventListener('click', () => {

      let fecha_inicio = fecha_inicio2.value
      let fecha_final = fecha_final2.value

      $.ajax({
        data: {
          fecha_inicio: fecha_inicio,
          fecha_final: fecha_final,
        },
        url: "controlador/ajax/mostrar-grafico-cantidad-discipulos.php",
        type: "post",
        dataType: "json",
      }).done(data => {
        var titulo = [];
        var cantidad = [];
        console.log(data);
        for (prop in data) {
          titulo.push(prop);
          cantidad.push(data[prop]);
        }
        console.log(titulo);
        console.log(cantidad);
        var v_modal = $('#discipulado-grafico2').modal({ show: false });
        Highcharts.chart('grafico2', {
          title: {
            text: 'Cantidad de discipulos'
          },
          xAxis: {
            categories: titulo
          },
          yAxis: {
            title: {
              text: 'Cantidad'
            }
          },
          credits: {
            enabled: false
          },
          series: [{
            name: 'Cantidad de discipulos',
            data: cantidad
          }],
        });



        v_modal.on("show", function () { })
        v_modal.modal("show");
      })
    })
  }
})
formulario3.addEventListener('click', (e) => {
  if (!(campos.fecha_inicio3 && campos.fecha_final3)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  } else {
    //busqueda ajax 
    const fecha_inicio3 = document.getElementById('fecha_inicio3')
    const fecha_final3 = document.getElementById('fecha_final3')
    const enviar3 = document.getElementById('consultar3')
    const respuesta3 = document.getElementById('respuesta3');
    enviar3.addEventListener('click', () => {

      let fecha_inicio = fecha_inicio3.value
      let fecha_final = fecha_final3.value

      $.ajax({
        data: {
          fecha_inicio: fecha_inicio,
          fecha_final: fecha_final,
        },
        url: "controlador/ajax/mostrar-grafico-cantidad-discipulos.php",
        type: "post",
        dataType: "json",
      }).done(data => {
        var titulo = [];
        var cantidad = [];
        console.log(data);
        for (prop in data) {
          titulo.push(prop);
          cantidad.push(data[prop]);
        }
        console.log(titulo);
        console.log(cantidad);
        var v_modal = $('#discipulado-grafico2').modal({ show: false });
        Highcharts.chart('grafico2', {
          title: {
            text: 'Cantidad de discipulos'
          },
          xAxis: {
            categories: titulo
          },
          yAxis: {
            title: {
              text: 'Cantidad'
            }
          },
          credits: {
            enabled: false
          },
          series: [{
            name: 'Cantidad de discipulos',
            data: cantidad
          }],
        });



        v_modal.on("show", function () { })
        v_modal.modal("show");
      })
    })
  }
})



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



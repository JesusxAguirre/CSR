
// Actualizar contenido del modal Editar
const formulario = document.getElementById('consultar'); //declarando una constante con la id formulario
const formulario2 = document.getElementById('consultar2'); //declarando una constante con la id formulario
const formulario3 = document.getElementById('consultar3'); //declarando una constante con la id formulario
const formulario4 = document.getElementById('consultar4'); //declarando una constante con la id formulario
var chart1;
var options;
var enero;
const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs2 = document.querySelectorAll('#formulario2 input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs3 = document.querySelectorAll('#formulario3 input'); //declarando una constante con todos los inputs dentro de la id formulario
const inputs4 = document.querySelectorAll('#formulario4 input'); //declarando una constante con todos los inputs dentro de la id formulario


var lider = document.getElementById('lider');
var choices1 = new Choices(lider, {
  allowHTML: true,
  removeItems: true,
  removeItemButton: true,
  noResultsText: 'No hay coicidencias',
  noChoicesText: 'No hay participantes disponibles',
});

const campos = {
  fecha_inicio: false,
  fecha_final: false,
  fecha_inicio2: false,
  fecha_final2: false,
  fecha_inicio3: false,
  fecha_final3: false,
  lider: false,
  fecha_inicio4: false,
  fecha_final4: false,
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
    case "lider[]":
      ValidarSelect(e.target, 'lider');
      break;
    case "fecha_inicio4":
      ValidarSelect(e.target, 'fecha_inicio4');
      break;
    case "fecha_final4":
      ValidarSelect(e.target, 'fecha_final4');
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
            data: cantidad,
            colorByPoint: true,

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
            data: cantidad,
            colorByPoint: true,

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
        url: "controlador/ajax/mostrar-grafico-consolidacion.php",
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
        var v_modal = $('#consolidacion-grafico').modal({ show: false });
        Highcharts.chart('grafico3', {
          chart: {
            type: 'area'
          },
          title: {
            text: 'Cantidad de celulas de consolidacion'
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
            name: "cantidad de celulas de consolidacion",
            data: cantidad,
            colorByPoint: true,
          }],
        });



        v_modal.on("show", function () { })
        v_modal.modal("show");
      })
    })
  }
})
formulario4.addEventListener('click', (e) => {
  if (!(campos.fecha_inicio4 && campos.fecha_final4 && campos.lider)) {
    e.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Lo siento ',
      text: 'Registra el formulario correctamente'
    })
  } else {
    //busqueda ajax 
    const fecha_inicio4 = document.getElementById('fecha_inicio4')
    const fecha_final4 = document.getElementById('fecha_final4')
    const lider = document.getElementById('lider')
    const enviar4 = document.getElementById('consultar4')
    const respuesta4 = document.getElementById('respuesta4');
    enviar4.addEventListener('click', () => {
      console.log("inicio de la funcion")

      let cedula_lider =  lider.value
      let fecha_inicio = fecha_inicio4.value
      let fecha_final = fecha_final4.value
      $.ajax({
        data: {
          fecha_inicio: fecha_inicio,
          fecha_final: fecha_final,
          cedula_lider: cedula_lider,
        },
        url: "controlador/ajax/mostrar-grafico-lider.php",
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
        var v_modal = $('#lider-grafico').modal({ show: false });
        Highcharts.chart('grafico4', {
          chart: {
            type: 'area'
          },
          title: {
            text: 'Cantidad de celulas de consolidacion'
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
            name: "cantidad de celulas de consolidacion",
            data: cantidad,
            colorByPoint: true,
          }],
        });

        console.log("final de la funcion")

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
inputs4.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);
});


lider.addEventListener('hideDropdown', ValidarFormulario);

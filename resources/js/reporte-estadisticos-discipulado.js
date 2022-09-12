
// Actualizar contenido del modal Editar
const formulario = document.getElementById('consultar'); //declarando una constante con la id formulario
var chart1;
var options;
var enero;
const inputs = document.querySelectorAll('#formulario input'); //declarando una constante con todos los inputs dentro de la id formulario

const campos = {
  fecha_inicio: false,
  fecha_final: false,
}

const ValidarFormulario = (e) => {
  switch (e.target.name) {
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
        Highcharts.chart('grafico2', {
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


function datos() {

  options = {
    chart: {
      renderTo: 'grafico',
      type: 'column',
    },
    title: {
      text: 'Numero de celulas creadas',
    },
    yAxys: {
      title: {
        text: 'cantidad',
      }
    },
    plotOptions: {
      series: {
        borderWidth: 50,
        dataLabels: {
          enabled: true,
          format: '{point.y:of}',
        }
      }
    },
    tooltip: {
      headerFormat: "<span style='font-size: 11px'> {series.name}</span> <br>",
      pointFormat: "<span style='color:{point.color}'>{point.name}</span>: <b>{point.y.0f}</b>",
    },
    series: [{
      name: "Celulas",
      colorByPoint: true,
      data: {},
    }]
  }



}



inputs.forEach((input) => {
  input.addEventListener('keyup', ValidarFormulario);
  input.addEventListener('blur', ValidarFormulario);

});



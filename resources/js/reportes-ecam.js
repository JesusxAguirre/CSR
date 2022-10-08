infoSecciones();
infoCantidad_graduandos();

let fecha= new Date();
var am_pm = fecha.getHours() >= 12 ? 'PM' : 'AM'; 
$('.fechaActual').text('Fecha actual: '+fecha.getFullYear()+'/'+fecha.getMonth()+'/'+fecha.getDate());
$('.horaActual').text('Hora actual: '+fecha.getHours()+':'+fecha.getMinutes()+' '+am_pm);

//GRAFICO DE CANTIDAD DE ESTUDIANTES POR SECCION
function grafico1(ctxRef, refNombres, refCantidad) {
  var charizard = new Chart(ctxRef, {
    type: "doughnut",
    data: {
      labels: refNombres,
      datasets: [
        {
          data: refCantidad,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
          ],
          borderColor: ['rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}

function infoSecciones() {
  $.post(
    "controlador/ajax/generar-reportes-ecam.php",
    { grafico1: "grafico1" },
    function (response) {
      var json = JSON.parse(response);

      var ctx = document.getElementById("cantidadEstudiantes").getContext("2d");
      let nombreSeccion = [];
      let cantidadEstudiantes = [];

      for (let i = 0; i < json.length; i++) {
        nombreSeccion.push(json[i]["nombreSeccion"]);
        cantidadEstudiantes.push(json[i]["cantidadEstudiantes"]);
      }
      grafico1(ctx, nombreSeccion, cantidadEstudiantes);
    }
  );
}
////////////////////////FIN DEL GRAFICO///////////////////////



//GRAFICO DE CANTIDAD DE GRADUANDOS DEL ANO ACTUAL
function grafico2(ctxRef, meses, cantidad) {
  const myChart = new Chart(ctxRef, {
    type: 'bar',
    data: {
        labels: meses,
        datasets: [{
            label: 'Graduandos de este año',
            data: cantidad,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
  });
}


function infoCantidad_graduandos() {
  var ctx = document.getElementById("graduandosDeHoy").getContext("2d");

  $.post("controlador/ajax/generar-reportes-ecam.php", {grafico2: 'grafico2'},
    function (data) {
      let respuesta = JSON.parse(data);
      let meses= [];
      let cantidad= [];
      for (datos in respuesta) {
        meses.push(datos)
        cantidad.push(respuesta[datos]);
      }
      grafico2(ctx, meses, cantidad);
    },
  );
}

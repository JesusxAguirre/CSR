infoSecciones();
infoCantidad_graduandos();

let fecha= new Date();
var am_pm = fecha.getHours() >= 12 ? 'PM' : 'AM'; 
$('.fechaActual').text('Fecha actual: '+fecha.getFullYear()+'/'+fecha.getMonth()+'/'+fecha.getDate());
$('.horaActual').text('Hora actual: '+fecha.getHours()+':'+fecha.getMinutes()+' '+am_pm);

//GRAFICO DE CANTIDAD DE ESTUDIANTES POR SECCION
function grafico1(ctxRef, refNombres, refCantidad, colores) {
  var charizard = new Chart(ctxRef, {
    type: "doughnut",
    data: {
      labels: refNombres,
      datasets: [
        {
          data: refCantidad,
          backgroundColor: colores,
          borderColor: colores,
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
      let colores = [];

      for (let i = 0; i < json.length; i++) {
        nombreSeccion.push(json[i]["nombreSeccion"]);
        cantidadEstudiantes.push(json[i]["cantidadEstudiantes"]);
        colores.push(colorRGB());
      }
      grafico1(ctx, nombreSeccion, cantidadEstudiantes, colores);
    }
  );
}
////////////////////////FIN DEL GRAFICO///////////////////////



//GRAFICO DE CANTIDAD DE GRADUANDOS DEL ANO ACTUAL
function grafico2(ctxRef, meses, cantidad, colores) {
  const myChart = new Chart(ctxRef, {
    type: 'bar',
    data: {
        labels: meses,
        datasets: [{
            label: 'Graduandos de este año',
            data: cantidad,
            backgroundColor: colores,
            borderColor: colores,
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
      let colores= [];

      for (datos in respuesta) {
        meses.push(datos)
        cantidad.push(respuesta[datos]);
        colores.push(colorRGB());
      }
      grafico2(ctx, meses, cantidad, colores);
    },
  );
}

function generarNumero(numero){
	return (Math.random()*numero).toFixed(0);
}
function colorRGB(){    
  var color = "("+generarNumero(255)+"," + generarNumero(255) + "," + generarNumero(255) +", 0.4)";
  return "rgb" + color;
}
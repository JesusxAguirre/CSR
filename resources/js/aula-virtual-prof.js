listarProfesores();
cantidad_materiasSecciones();

let fecha= new Date();
var am_pm = fecha.getHours() >= 12 ? 'PM' : 'AM'; 
$('#fechaActual').text(fecha.getFullYear()+'/'+fecha.getMonth()+'/'+fecha.getDate());
$('#horaActual').text(fecha.getHours()+':'+fecha.getMinutes()+' '+am_pm);


function grafico1(ctxRef, nombreSeccionRef, cantidadMateriasRef) {

new Chart(ctxRef,{
    type: 'polarArea',
    data: {
        labels: nombreSeccionRef,
        datasets: [{
            label: nombreSeccionRef,
            data: cantidadMateriasRef,
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
})
}


function cantidad_materiasSecciones() {
    $.post(
      "controlador/ajax/dinamica-aulaProf.php",
      { datosSeccionMaterias: "datosSeccionmateria" },
      function (response) {
        var json = JSON.parse(response);
  
        var ctx = document.getElementById("grafico_materiasSecciones").getContext("2d");
        let nombreSeccion = [];
        let cantidadMaterias = [];
  
        for (let i = 0; i < json.length; i++) {
          nombreSeccion.push(json[i]["nombreSeccion"]);
          cantidadMaterias.push(json[i]["cantidadMaterias"]);
        }

        grafico1(ctx, nombreSeccion, cantidadMaterias);
      }
    );
  }

function listarProfesores() {
    let div= document.getElementById('listarProfesores');

    $.post("controlador/ajax/dinamica-aulaProf.php", {verProfesores: 'verProfesores'},
        function (data) {
            div.innerHTML= data;
        },
    );
}
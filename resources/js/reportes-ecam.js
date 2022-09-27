infoSecciones();
infoSecciones2();


function ole(ctxRef, refNombres, refCantidad) {
  var charizard = new Chart(ctxRef, {
    type: "bar",
    data: {
      labels: refNombres,
      datasets: [
        {
          label: refNombres,
          data: refCantidad,
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
          ],
          borderColor: ["rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)"],
          borderWidth: 1,
        },
      ],
    },
    options: {
      title: {
        display: true,
        text: "Custom Cafdsgsdgha",
        padding: {
          top: 10,
          bottom: 30,
        },
      },
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
    { ver1: "ver1" },
    function (response) {
      var json = JSON.parse(response);

      var ctx = document.getElementById("canva1").getContext("2d");
      let nombreSeccion = [];
      let cantidadEstudiantes = [];

      for (let i = 0; i < json.length; i++) {
        nombreSeccion.push(json[i]["nombreSeccion"]);
        cantidadEstudiantes.push(json[i]["cantidadEstudiantes"]);
      }
      ole(ctx, nombreSeccion, cantidadEstudiantes);
    }
  );
}
function infoSecciones2() {
  $.post(
    "controlador/ajax/generar-reportes-ecam.php",
    { ver1: "ver1" },
    function (response) {
      var json = JSON.parse(response);

      var ctx = document.getElementById("canva2").getContext("2d");
      let nombreSeccion = [];
      let cantidadEstudiantes = [];

      for (let i = 0; i < json.length; i++) {
        nombreSeccion.push(json[i]["nombreSeccion"]);
        cantidadEstudiantes.push(json[i]["cantidadEstudiantes"]);
      }
      ole(ctx, nombreSeccion, cantidadEstudiantes);
    }
  );
}

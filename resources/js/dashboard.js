const click = document.getElementById('reporte')

var titulo = [];

var cantidad = [];

console.log(reporte);
for (prop in reporte) {
  titulo.push(prop)
  cantidad.push(reporte[prop]);
}
function estadistico(){
  Highcharts.chart('grafico', {
    chart: {
      type: 'area'
    },
    title: {
      text: 'Reporte de CSR anual'
    },
    subtitle: {
      text: 'Este reporte incluye las casas que estan desincorporadas',
    },
    xAxis: {
      categories: titulo,
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
      name: 'cantidad de CSR',
      data: cantidad
    },
    ],
  })
}
$( document ).ready(function() {
 estadistico()
});

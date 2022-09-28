var titulo = [];
var cantidad = [];
console.log(reoirte);
for (prop in reporte) {
  titulo.push(prop)
  cantidad.push(reporte[prop]);
}
Highcharts.chart('grafico', {
  chart: {
    type: 'area'
  },
  title: {
    text: 'Reporte de crecimiento de lider'
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
});
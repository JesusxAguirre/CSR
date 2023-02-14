$(document).ready(function (e) {
//creando objeto websocket
var msgBox = $('#areaChat');
var objeto_websocket = new WebSocket("ws://localhost:8080");
var formulario = document.getElementById('chatForm');
var mensaje = document.getElementById('mensaje');
var color= generar_color()
objeto_websocket.onopen = function (e) {//cuando la conexion se abre 
  console.log("conexion establecida!");
  msgBox.append('<div class="system_msg" style="color:#bbbbbb">Bienvenido al chat de casa sobre la roca !</div>'); //notify user
  
  

}

objeto_websocket.onmessage = function (e) {
  console.log(e.data);
  var data = JSON.parse(e.data);
  var div = document.createElement('div');
  div.innerHTML = data.mensaje;
  div.className = 'alert alert-primary';
  div.role = 'alert';

  msgBox.append(div);
}



formulario.addEventListener('submit', function(e) {
    e.preventDefault();
    if (campo[0]) {
        let mensaje = document.getElementById('mensaje').value;
        
        var data = {
            mensaje: mensaje,
            color: color
        }

        objeto_websocket.send(JSON.stringify(data));
    }
})


  //////////Validaciones de mensaje vacio
  const expresiones = {
    expresioness: /^[a-zA-ZÀ-ÿ0-9\s]{1,10000}$/, // Letras y espacios, pueden llevar acentos.
}

var campo = {
    existe: false,
}

function validar(evento) {
    if (expresiones.expresioness.test(evento.value)) {
        document.getElementById('enviar').removeAttribute('disabled');
        campo[0]= true;
    }else{
        document.getElementById('enviar').setAttribute('disabled', "");
        campo[0] = false;
    }
}

mensaje.addEventListener('keyup', function(e) {
    validar(mensaje);
});
//////////Fin de la validacion

function generar_color(){
  //creamos los arrays
  var r = new Array("00","33","66","99","CC","FF");
  var g = new Array("00","33","66","99","CC","FF");
  var b = new Array("00","33","66","99","CC","FF");

  //hacemos el bucle anidado
  for (i=0;i<r.length;i++) {
      for (j=0;j<g.length;j++) {
          for (k=0;k<b.length;k++) {
              //creamos el color
              return color = "#" + r[i] + g[j] + b[k];
          }
        }
      }
}
});

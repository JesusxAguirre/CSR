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
  var response = JSON.parse(e.data);
  var user_color = response.color
  var user_message = response.mensaje
  msgBox.append('<div><span class="user_name" style="color:' + user_color + '"></span> : <span class="user_message">' + user_message + '</span></div>');
  msgBox[0].scrollTop = msgBox[0].scrollHeight;
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
  var colors= ['aqua', 'black', 'blue', 'fuchsia', 'gray', 'green', 
  'lime', 'maroon', 'navy', 'olive', 'orange', 'purple', 'red', 
  'silver', 'teal', 'white', 'yellow'];

  color =colors[Math.floor(Math.random() * colors.length)];

  return color
}
});

$(document).ready(function (e) {
//creando objeto websocket
var objeto_websocket = new WebSocket("ws://localhost:8080");
var formulario = document.getElementById('chatForm');
var mensaje = document.getElementById('mensaje');
var nombre = document.getElementById("nombre").value
var apellido = document.getElementById("apellido").value


objeto_websocket.onopen = function (e) {//cuando la conexion se abre 
  var saludo_div = document.createElement('div')
  saludo_div.className=  'd-flex justify-content-center';
  saludo_div.innerHTML ='<div class="system_msg" style="color:#bbbbbb">Bienvenido al chat de casa sobre la roca !</div>';

  document.getElementById('areaChat').append(usuario_conectado_div)

}

objeto_websocket.onmessage = function (e) {
  console.log(e.data);
  var data = JSON.parse(e.data);
  var row_class = ''
  var backgroud_class = ''
  
  if(data.from == "Me"){
    row_class = "row justify-content-start"
    backgroud_class = "text-dark alert-light"
  }else{
    row_class = "row justify-content-end"
    backgroud_class = "alert-success"
  }
  var html_data = "<div class='"+ row_class + "'<div class='col-sm-10'><div class='shadow-sm alert '" + backgroud_class+"'><b>"+data.from+" - </b>"
  + data.mensaje + " <br /><div class='text-right'><small><i></i></small></div></div></div> </div>"
  
  $("#areaChat").append(html_data)

  $("mensaje").value("")
}



formulario.addEventListener('submit', function(e) {
    e.preventDefault();
    if (campo[0]) {
        let mensaje = document.getElementById('mensaje').value;
        
        var data = {
            mensaje: mensaje,
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

});

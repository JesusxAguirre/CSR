$(document).ready(function (e) {
//creando objeto websocket
var objeto_websocket = new WebSocket("ws://localhost:8080");
var formulario = document.getElementById('chatForm');
var mensaje = document.getElementById('mensaje');
var nombre_usuario = $("#nombre").val() + " " + $("#apellido").val()
var fecha_hora = new Date().toLocaleDateString()
var cedula_usuario = $("#cedula").val()

objeto_websocket.onopen = function (e) {//cuando la conexion se abre 
  var saludo_html ='<div class="row justify-content-center" style="color:#bbbbbb">Bienvenido al chat de casa sobre la roca !</div>';
  $("#areaChat").append(saludo_html)

  var aviso_html = "<div class='d-flex justify-content-center'><div class='text-warning'>el usuario " +nombre_usuario+ " ha entrado en el chat, "+fecha_hora +"</div></div>"  //variable donde se guarda el div html para enviar un mensaje de que usuario ha entrado a la sala
  $("#areaChat").append(aviso_html)
}

objeto_websocket.onmessage = function (e) {
  console.log(e.data);
  var data = JSON.parse(e.data);
  var row_class = ''
  var backgroud_class = ''
  switch(data.event){
    case "mensaje":
        if(data.from == "Yo"){
            row_class = "row justify-content-start"
            backgroud_class = "text-dark alert alert-light"
          }else{
            row_class = "row justify-content-end"
            backgroud_class = "alert-success"
          }
          var html_data = "<div class='"+ row_class + "'><div class='col-sm-10'><div class='shadow-sm alert " + backgroud_class+"'><b>"+data.from+" - </b>"
          + data.mensaje + " <br /><div class='d-flex justify-content-end'><small><i>"+ data.date +"</i></small></div></div></div> </div>"
          
          $("#areaChat").append(html_data)
        
          $("#mensaje").val('')
          break
    case "left":
        if(data.from){
            row_class = "d-flex justify-content-center"

            var html_data = "<div class='" + row_class + "'><div class='text-secondary'> el usuario " +data.from+ " ha salido de la sala " 
            + data.date+ "</div</div>"
            $("#areaChat").append(html_data)
        }else{
            row_class = "d-flex justify-content-center"
            var html_data = "<div class='" +row_class +"'><div class='text-secondary'>" +data.mensaje +"</div></div>"
            $("#areaChat").append(html_data)
        }
  }
  
}

objeto_websocket.onclose =function(e){
    var data = {
        event: "mensaje",
        cedula: cedula_usuario,
        mensaje: mensaje,
        from: nombre_usuario
    }
    console.log(data)
    objeto_websocket.send(JSON.stringify(data))
}

formulario.addEventListener('submit', function(e) {
    e.preventDefault();
    if (campo[0]) {
        let mensaje = $("#mensaje").val();
        console.log(cedula_usuario)
        var data = {
            event: "mensaje",
            cedula: cedula_usuario,
            mensaje: mensaje,
            from: nombre_usuario
        }
        console.log(data)
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

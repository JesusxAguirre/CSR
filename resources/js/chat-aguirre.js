//creando objeto websocket
var msgBox = document.getElementById('areaChat')
var objeto_websocket = new WebSocket("ws://localhost:8080");

objeto_websocket.onopen = function (e) {//cuando la conexion se abre 
  console.log("conexion establecida!")
  msgBox.append("<div  style='color:#bbbbbb'>Welcome to my Demo WebSocket Chat box!</div>") //notify user
}

objeto_websocket.onmessage = function (e) {
  var response = JSON.parse(e.data) //PHP envia datos en formato json

  var res_type = response.type //tipo de mensaje
  var user_message = response.message //texto de mensaje
  var user_name = response.name // nombre del usuario que envia el mensaje
  var user_color = response.color

  switch (res_type) {
    case 'usermsg':
      msgBox.append('<div><span class="user_name" style="color:' + user_color + '">' + user_name + '</span> : <span class="user_message">' + user_message + '</span></div>');
      break;
    case 'system':
      msgBox.append('<div style="color:#bbbbbb">' + user_message + '</div>');
      break;
  }
  msgBox[0].scrollTop = msgBox[0].scrollHeight; //scroll message
}

var formulario = document.getElementById('chatForm');
var mensaje = document.getElementById('mensaje');

formulario.addEventListener('submit', function(e) {
    e.preventDefault();
    if (campo[0]) {
        let mensaje = document.getElementById('mensaje').value;
        
        var data = {
            mensaje: mensaje,
        }

        conn.send(JSON.stringify(data));
    }
})
//creando objeto websocket
var msgBox = $('areaChat')
var wsUri = "ws://localhost:8000"
objeto_websocket = new WebSocket(wsUri)

objeto_websocket.onopen = function (e) {//cuando la conexion se abre 
  console.log("conexion establecida!")
  var div = document.createElement('div');
  div.innerHTML = "conexion establecida!"
  div.className = 'alert alert-primary';
  div.role = 'alert';
  msgBox.append(div)
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

websocket.onerror = function (e) { msgBox.append('<div class="system_error">Error Occurred - ' + e.data + '</div>'); };
websocket.onclose = function (e) { msgBox.append('<div class="system_msg">Connection Closed</div>'); };

//Message send button 
$('#enviar').click(function () {
  send_message();
});

//User hits enter key 
$("#mensaje").on("keydown", function (event) {
  if (event.which == 13) {
    send_message();
  }
});


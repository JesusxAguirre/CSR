//creando objeto websocket
var msgBox = document.getElementById('areaChat')
var objeto_websocket = new WebSocket("ws://localhost:8080");
var formulario = document.getElementById('chatForm');
var mensaje = document.getElementById('mensaje');

objeto_websocket.onopen = function (e) {//cuando la conexion se abre 
  console.log("conexion establecida!")
  msgBox.append("<div  style='color:#bbbbbb'>Welcome to my Demo WebSocket Chat box!</div>") //notify user
}

objeto_websocket.onmessage = function (e) {
  console.log(e.data);
  var data = JSON.parse(e.data);
  var div = document.createElement('div');
  div.innerHTML = data.mensaje;
  div.className = 'alert alert-primary';
  div.role = 'alert';

  document.getElementById('areaChat').append(div);
}



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
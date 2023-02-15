$(document).ready(function (e) {

    var conn = new WebSocket("ws://localhost:8080");
    conn.onopen = function (e) {
        console.log("Connection established!");
    };

    conn.onmessage = function (e) {
        console.log(e.data);
        var data = JSON.parse(e.data);

        var div = document.createElement('div');
        div.className = 'd-flex justify-content-end';
        div.innerHTML = `<div class = "alert alert-secondary msgStyle" role = "alert">
        ${data.mensaje}
        <div class="divisorMsg"></div>
        <span class="msgInfo d-flex justify-content-between"><i class = "me-5"><b>${data.usuario}</b></i> 12:27PM</span>
        </div>`;

        document.getElementById('areaChat').append(div);
    };

    var formulario = document.getElementById('chatForm');
    var mensaje = document.getElementById('mensaje');

    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        if (campo[0]) {
            //Capturando mensaje
            let mensaje = document.getElementById('mensaje').value;

            //Capturando cedula del usuario\
            let usuario = document.getElementById('nombre').textContent;

            //Hora del envio del mensaje
            //var now = tiempo.toLocaleTimeString(); //otra solucion "mas rapida"
            var tiempo = new Date();
            var hora = tiempo.getHours() > 12 ? tiempo.getHours() - 12 : tiempo.getHours();
            var am_pm = tiempo.getHours() >= 12 ? 'PM' : 'AM';
            const msgHora = hora + ":" + tiempo.getMinutes() + am_pm;
            //Fin de la hora de envio

            var data = {
                mensaje: mensaje,
                msgHora: msgHora,
                usuario: usuario,
            }

            var div = document.createElement('div');
            div.className = 'd-flex justify-content-start';
            div.innerHTML = `<div class = "alert alert-primary msgStyle" role = "alert">
            ${data.mensaje}
            <div class="divisorMsg"></div>
            <span class="msgInfo d-flex justify-content-between"><i class = "me-5"><b>Me:</b></i>${msgHora}</span>
            </div>`;

            document.getElementById('areaChat').append(div);
            document.getElementById('mensaje').value = '';

            conn.send(JSON.stringify(data));
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
            campo[0] = true;
        } else {
            document.getElementById('enviar').setAttribute('disabled', "");
            campo[0] = false;
        }
    }

    mensaje.addEventListener('keyup', function (e) {
        validar(mensaje);
    });
    mensaje.addEventListener('blur', function (e) {
        validar(mensaje);
    });
    //////////Fin de la validacion


});



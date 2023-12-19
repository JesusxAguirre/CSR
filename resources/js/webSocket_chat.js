$(document).ready(function (e) {
    
    var conn = new WebSocket("ws://localhost:8080");
    conn.onopen = function (e) {
        console.log("Connection established!");
    };


    //scroll hacia abajo
    function scrollFinal() {
        var element = document.getElementById("areaChat");
        element.scrollTop = element.scrollHeight;
    }
    window.onload = function() {
        scrollFinal();
    }

    //Capturando datos del usuario
    let timeSocket = new Date();
    var timeNow = timeSocket.toLocaleTimeString(); //otra solucion "mas rapida"
    const usuarioSocket = document.getElementById('usuarioSocket').textContent;
    const cedulaSocket = document.getElementById('cedulaSocket').textContent;
    parseInt(cedulaSocket);


    conn.onmessage = function (e) {
        console.log(e.data);
        var data = JSON.parse(e.data);

        switch (data.event) {
            case 'mensaje':
                if (data.from == 'Me') {
                    var div = document.createElement('div');
                    div.className = 'd-flex justify-content-start';
                    div.innerHTML = `<div class = "alert alert-primary msgStyle" role = "alert">
                    ${data.mensaje}
                    <div class="divisorMsg"></div>
                    <span class="msgInfo d-flex justify-content-between"><i class="me-5"><b>Me:</b></i>${data.msgHora}</span>
                    </div>`;
        
                    document.getElementById('areaChat').append(div);
                    scrollFinal();
                }else{
                    var div = document.createElement('div');
                    div.className = 'd-flex justify-content-end';
                    div.innerHTML = `<div class = "alert alert-secondary msgStyle" role = "alert">
                    ${data.mensaje}
                    <div class="divisorMsg"></div>
                    <span class="msgInfo d-flex justify-content-between"><i class = "me-5"><b>${data.usuario}:</b></i>${data.msgHora}</span>
                    </div>`;

                    document.getElementById('areaChat').append(div);
                    scrollFinal();

                    //Creando notificacion
                    /*let div2 = document.createElement('div');
                    div2.className = 'alert alert-primary text-center';
                    div2.role = 'alert';
                    div2.innerHTML = `<i><b>${data.usuario}</b> ha escrito en el Chat Virtual</i>`;
                    document.getElementById('notificaciones2').append(div2);*/
                }
                break;

            case 'outside':
                let outside = `<div class="alert-dark d-flex justify-content-center">
                <span><i>${data.respuesta}</i></span>
                </div>`;

                $('#areaChat').append(outside);
                scrollFinal();
            break;

            case 'inside':
                let inside = `<div class="alert-info d-flex justify-content-center">
                <span><i>${data.respuesta}</i></span>
                </div>`;

                $('#areaChat').append(inside);
                scrollFinal();
                break;
        
        }

    };

    var formularioSocket = document.getElementById('chatForm');
    var mensajeSocket = document.getElementById('mensajeChat');

    formularioSocket.addEventListener('submit', function (e) {
        e.preventDefault();
        if (campoSocket[0]) {

            //Capturando mensaje
            let mensaje = document.getElementById('mensajeChat').value;

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
                usuario: usuarioSocket,
                cedula: cedulaSocket,
            }

            document.getElementById('mensajeChat').value = '';

            conn.send(JSON.stringify(data));
        }
    })


    //////////Validaciones de mensaje vacio
    const expresionesSocket = {
        expresiones: /^[a-zA-ZÀ-ÿ0-9\s]{1,10000}$/, // Letras y espacios, pueden llevar acentos.
    }

    var campoSocket = {
        existe: false,
    }

    function validar(evento) {
        if (evento.value != '') {
            document.getElementById('enviarMensajeChat').removeAttribute('disabled');
            campoSocket[0] = true;
        } else {
            document.getElementById('enviarMensajeChat').setAttribute('disabled', "");
            campoSocket[0] = false;
        }
        /*if (expresionesSocket.expresiones.test(evento.value)) {
            document.getElementById('enviarMensajeChat').removeAttribute('disabled');
            campoSocket[0] = true;
        } else {
            document.getElementById('enviarMensajeChat').setAttribute('disabled', "");
            campoSocket[0] = false;
        }*/
    }

    mensajeSocket.addEventListener('keyup', function (e) {
        validar(mensajeSocket);
    });
    mensajeSocket.addEventListener('blur', function (e) {
        validar(mensajeSocket);
    });
    //////////Fin de la validacion


});



$(document).ready(function (e) {
    
    var conn = new WebSocket("ws://localhost:8080");
    conn.onopen = function (e) {
        console.log("Connection established!");
    };

    conn.onmessage = function (e) {
        console.log(e.data);
        var data = JSON.parse(e.data);
        var div = document.createElement('div');
        div.innerHTML = data.mensaje;
        div.className = 'alert alert-primary';
        div.role = 'alert';

        document.getElementById('areaChat').append(div);
    };

    
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



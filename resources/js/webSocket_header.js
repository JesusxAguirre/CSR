$(document).ready(function (e) {

    var conn = new WebSocket("ws://localhost:8080");
    conn.onopen = function (e) {
        console.log("Connection established!");
    };


    conn.onmessage = function (e) {
        console.log(e.data);
        var data = JSON.parse(e.data);

        switch (data.event) {
            case 'mensaje':
                if (data.from == 'Me') {
                    
                }else{
                    Swal.fire({
                        icon: false,
                        position: 'bottom-end',
                        toast: true,
                        background: 'black',
                        color: 'white',
                        showConfirmButton: false,
                        timer: 5000,
                        title: `${data.usuario}`,
                        text: `${data.mensaje}`,
                      })
                    //Creando notificacion
                    /*let div2 = document.createElement('div');
                    div2.className = 'alert alert-primary text-center';
                    div2.role = 'alert';
                    div2.innerHTML = `<i><b>${data.usuario}</b> ha escrito en el Chat Virtual</i>`;
                    document.getElementById('notificaciones2').append(div2);*/
                }
                break;
            case 'outside':
               
            break;
        
        }

    };


});



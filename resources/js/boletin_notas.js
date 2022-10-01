function verListado(id_seccion) {
    let div= document.getElementById('listados');

    let data= {
        verListado: 'verListado',
        idSeccion: id_seccion,
    }
    $.post("controlador/ajax/dinamica-boletin_notas.php", data,
        function (data) {
            div.innerHTML= data;
        },
    );
}
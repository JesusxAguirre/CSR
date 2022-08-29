function realizaProceso(consulta){ 
    var parametros = {
            "consulta" : consulta
    };
     
    return $.ajax({
            data:  parametros, //datos que se envian a traves de ajax
            url:   '?pagina=listar-usuarios', //archivo que recibe la peticion
            type:  'post', //método de envio
          
            })
            .done(function (data) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                     $("#datos").html(data);
                     event: stopPropagation();
            })
};
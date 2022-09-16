ejecutar();

$("#nivelSeccion").click(function () {
    let nivel = document.getElementById("nivelSeccion").value;
    let div = document.getElementById("datos_PM");
    if (nivel == "1" || nivel == "2" || nivel == "3") {
        $.ajax({
            data: {
                nivel: nivel,
            },
            type: "post",
            url: "controlador/ajax/dinamica-seccion.php",
        }).done((data) => {
            div.innerHTML = data;
            $(".seleccionarMaterias").select2({
                placeholder: "Select a state",
            });
            $(".seleccionarProfesores").select2();
        });
    }
});

$("#crear").click(function () {
    //ALMACENANDO TODOS LOS VALORES DE LOS SELECT DE MATERIAS
    let seleccionarMaterias = document.querySelectorAll(".seleccionarMaterias");
    let arregloMateria = [];
    seleccionarMaterias.forEach((sm) => {
        arregloMateria.push(sm.value);
    });

    //ALMACENANDO TODOS LOS VALORES DE LOS SELECT DE PROFESOR
    let seleccionarProfesores = document.querySelectorAll(".seleccionarProfesores");
    let arregloProfesores = [];
    seleccionarProfesores.forEach((sp) => {
        arregloProfesores.push(sp.value);
    });

    let nombreSeccion= document.getElementById('nombreSeccion');
    let nivelSeccion= document.getElementById('nombreSeccion');

    let data = {
        crear: $('#crear').val(),
        nombreSeccion: nombreSeccion.value,
        nivelSeccion: nivelSeccion.value,
        idMateriaSeccion: arregloMateria,
        cedulaProfSeccion: arregloProfesores,
        cedulaEstSeccion: $('#seleccionarEstudiantes').val(),
    };
    $.post("controlador/ajax/CRUD-seccion.php", data, function (response) {
        console.log(response);
    });
});

function ejecutar() {
    let div = document.getElementById("datos_E");
    let verEstudiantes = "valor";
    $.ajax({
        data: {
            verEstudiantes: verEstudiantes,
        },
        type: "post",
        url: "controlador/ajax/dinamica-seccion.php",
    }).done((data) => {
        div.innerHTML = data;
        $("#seleccionarEstudiantes").select2({
            placeholder: "Seleccione los estudiantes",
            closeOnSelect: false,
            amdLanguageBase: "es",
        });
    });
}

/*function choices1() {
    
    let mat= document.getElementsByClassName('seleccionarMaterias');

    for (let i = 0; i < mat.length; i++) {
        var materias = document.querySelector('.seleccionarMaterias');
        new Choices(materias,{
            allowHTML: true,
            maxItemText: 4,
            removeItems: true,
            removeItemButton: true,
            noResultsText: 'No hay coicidencias',
            noChoicesText: 'No hay participantes disponibles',
            placeholderValue: 'Buscar profesor',
          });
    }
        
}
function choices2() {
    var profesores = document.querySelector('.seleccionarProfesores');
    new Choices(profesores, {
      allowHTML: true,
      maxItemText: 4,
      removeItems: true,
      removeItemButton: true,
      noResultsText: 'No hay coicidencias',
      noChoicesText: 'No hay participantes disponibles',
      placeholderValue: 'Buscar profesor',
    });
}*/

/*$('#ver').click(function () { 
    var div= document.getElementsByClassName('1');
    var cu= ['cuenca', 'sas', 'culoemono'];
    for(var i = 0; i < div.length; i++){
        console.log(div[i].value);
      }
    //console.log(cu);
});*/

/*let spanish= {
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %ds fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir",
        "renameState": "Cambiar nombre",
        "updateState": "Actualizar",
        "createState": "Crear Estado",
        "removeAllStates": "Remover Estados",
        "removeState": "Remover",
        "savedStates": "Estados Guardados",
        "stateRestore": "Estado %d"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "notEmpty": "No Vacio",
                "not": "Diferente de"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con",
                "not": "Diferente de",
                "notContains": "No Contiene",
                "notStarts": "No empieza con",
                "notEnds": "No termina con"
            },
            "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d",
        "showMessage": "Mostrar Todo",
        "collapseMessage": "Colapsar Todo"
    },
    "select": {
        "cells": {
            "1": "1 celda seleccionada",
            "_": "%d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        },
        "rows": {
            "1": "1 fila seleccionada",
            "_": "%d filas seleccionadas"
        }
    },
    "thousands": ".",
    "datetime": {
        "previous": "Anterior",
        "next": "Proximo",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
            "AM",
            "PM"
        ],
        "months": {
            "0": "Enero",
            "1": "Febrero",
            "10": "Noviembre",
            "11": "Diciembre",
            "2": "Marzo",
            "3": "Abril",
            "4": "Mayo",
            "5": "Junio",
            "6": "Julio",
            "7": "Agosto",
            "8": "Septiembre",
            "9": "Octubre"
        },
        "weekdays": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ]
    },
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "title": "Crear Nuevo Registro",
            "submit": "Crear"
        },
        "edit": {
            "button": "Editar",
            "title": "Editar Registro",
            "submit": "Actualizar"
        },
        "remove": {
            "button": "Eliminar",
            "title": "Eliminar Registro",
            "submit": "Eliminar",
            "confirm": {
                "_": "¿Está seguro que desea eliminar %d filas?",
                "1": "¿Está seguro que desea eliminar 1 fila?"
            }
        },
        "error": {
            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
        },
        "multi": {
            "title": "Múltiples Valores",
            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
            "restore": "Deshacer Cambios",
            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
        }
    },
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "stateRestore": {
        "creationModal": {
            "button": "Crear",
            "name": "Nombre:",
            "order": "Clasificación",
            "paging": "Paginación",
            "search": "Busqueda",
            "select": "Seleccionar",
            "columns": {
                "search": "Búsqueda de Columna",
                "visible": "Visibilidad de Columna"
            },
            "title": "Crear Nuevo Estado",
            "toggleLabel": "Incluir:"
        },
        "emptyError": "El nombre no puede estar vacio",
        "removeConfirm": "¿Seguro que quiere eliminar este %s?",
        "removeError": "Error al eliminar el registro",
        "removeJoiner": "y",
        "removeSubmit": "Eliminar",
        "renameButton": "Cambiar Nombre",
        "renameLabel": "Nuevo nombre para %s",
        "duplicateError": "Ya existe un Estado con este nombre.",
        "emptyStates": "No hay Estados guardados",
        "removeTitle": "Remover Estado",
        "renameTitle": "Cambiar Nombre Estado"
    }
};

let fun= 'fun'
$('#example').DataTable({
    ajax:{
        method: "POST",
        url: "controlador/ajax/prueba.php",
        data: {fun: fun},
    },
    columns: [
        { data: 'codigo' },
        { data: 'nombre' },
        {data: 'cedula',
        render: function ( data, type, row, meta ) {
            return '<input type="text" value="'+data+'">';
          }
        }
    ],
    language: spanish
});*/

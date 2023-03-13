listar_misMateriasProf();
var quill = new Quill('#editarContenido', {
    theme: 'snow',
});;

function listar_misMateriasProf() {
    let div = document.getElementById("listar_misMateriasProf");
    $.ajax({
      data: {
        listarMisMateriasProf: 'listarMisMateriasProf',
      },
      type: "post",
      url: "controlador/ajax/dinamica-misMateriasProf.php",
    }).done((data) => {
      div.innerHTML = data;
    });
}

//ELIMINAR INFORMACION DE LA MATERIA
$('#tabla_misMateriasProf tbody').on('click', '.vaciarInfo', function() {
    let elemento = $(this)[0].parentElement.parentElement;
    let div= document.querySelector('.ql-editor');

    let idSeccion= elemento.querySelector('.idSeccion_materia').textContent;
    let idMateria= elemento.querySelector('.idMateria_materia').textContent;
    let vaciarInfo = 'vaciarInfo';

    const data = {
        vaciarInfo: vaciarInfo,
        idSeccion: idSeccion,
        idMateria: idMateria,
    }

    Swal.fire({
        icon: 'info',
        title: '¿Estas seguro de eliminar la informacion de la materia?',
        confirmButtonText: `Si, eliminar`,
        confirmButtonColor: '#0078FF',
        showDenyButton: true,
        denyButtonText: `Cancelar`,
        denyButtonColor: 'grey',
        background: 'white',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("controlador/ajax/dinamica-misMateriasProf.php", data, function (response) {
                console.log(response);
                listar_misMateriasProf();
                Swal.fire({
                    icon: 'success',
                    iconColor: 'green',
                    title: '¡Informacion eliminada correctamente!',
                    toast: true,
                    background: 'white',
                    showConfirmButton: false,
                    timer: 3000,
                    })
                })
        }
    })
    
});


//VER INFORMACION DE LA MATERIA
$('#tabla_misMateriasProf tbody').on('click', '.modalContenidoON', function() {
    let elemento = $(this)[0].parentElement.parentElement;
    let div= document.querySelector('.ql-editor');

    let idSeccion= elemento.querySelector('.idSeccion_materia').textContent;
    let idMateria= elemento.querySelector('.idMateria_materia').textContent;
    $('#seccionContRef').text(idSeccion);
    $('#materiaContRef').text(idMateria);

    $.ajax({
        data: {
            verContenido: 'verContenido',
            idSeccion: idSeccion,
            idMateria: idMateria,
        },
        type: "post",
        url: "controlador/ajax/dinamica-misMateriasProf.php",
    }).done((data) => {
        div.innerHTML = data;
    })
    
});

//AGREGAR INFORMACION A LA MATERIA
$('#tabla_misMateriasProf tbody').on('click', '.agregarInfo', function() {
    let elemento = $(this)[0].parentElement.parentElement;

    let idSeccion= elemento.querySelector('.idSeccion_materia').textContent;
    let idMateria= elemento.querySelector('.idMateria_materia').textContent;
    $('#seccionContRef').text(idSeccion);
    $('#materiaContRef').text(idMateria);
});

$('#guardarCampo').click(function (e) {
    let contenido= quill.root.innerHTML;
    let seccionContRef= document.getElementById('seccionContRef').textContent;
    let materiaContRef= document.getElementById('materiaContRef').textContent;

    const data= {
        guardarCampo: 'guardarCampo',
        seccionContRef: seccionContRef,
        materiaContRef: materiaContRef,
        contenido: contenido,
    }
    if (contenido == '<p><br></p>') {
        Swal.fire({
            icon: 'error',
            iconColor: 'white',
            title: '¡No puedes dejar el campo vacio!',
            toast: true,
            background: 'red',
            color: 'white',
            showConfirmButton: false,
            timer: 3000,
        })
    }else{
        $.post("controlador/ajax/dinamica-misMateriasProf.php", data, function (response) {
            listar_misMateriasProf();
            $('#modal_misContenidosProf').modal('hide');
            Swal.fire({
                icon: 'success',
                iconColor: 'white',
                title: '¡Contenido actualizado!',
                toast: true,
                background: 'green',
                color: 'white',
                showConfirmButton: false,
                timer: 3000,
            })
            console.log(response);
        });
        
    }
});




//DATATABLES LISTA DE MIS MATERIAS ESTUDIANTE
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
*/

listar_misEstudiantes();
function listar_misEstudiantes() {
    let div = document.getElementById("lista_misEstudiantes");
    $.ajax({
      data: {listarMisEstudiantes: 'listarMisEstudiantes'},
      type: "post",
      url: "controlador/ajax/dinamica-misEstudiantes.php",
    }).done((data) => {
      div.innerHTML = data;
    });
}

//Aqui hice esta vaina porque sino se pone como gei el Datatables JS
setTimeout(() => {
    //DATATABLES LISTA DE MIS MATERIAS ESTUDIANTE
    let spanish= {
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
    let dataTableMisEstudiantes= $('#tabla_misEstudiantes').DataTable({
        responsive: true,
        language: spanish,
    });
    //FIN DE LA INICIALIZACION DE DATATABLES


    //AGREGAR NOTA AL ESTUDIANTE DINAMICAMENTE POR JS
    $('#tabla_misEstudiantes tbody').on('click', '.agregarNota', function() {
        let elemento = $(this)[0].parentElement.parentElement;
        
        Swal.fire({
            title: 'Asigne la nota del estudiante',
            icon: 'question',
            input: 'range',
            inputLabel: 'Deslize la barra',
            confirmButtonText: `AGREGAR`,
            confirmButtonColor: '#0078FF',
            showDenyButton: true,
            denyButtonText: `CANCELAR`,
            denyButtonColor: 'red',
            inputAttributes: {
              min: 0,
              max: 20,
              step: 1
            },
            inputValue: 0,
            preConfirm: (value) => {
                if (value == 0) {
                    Swal.showValidationMessage('No puedes agregar "0" como nota');
                }
            }
        }).then((result) => {
        if (result.isConfirmed) {
            const data= {
                agregarNota: 'agregarNota',
                notaCIestudiante: elemento.querySelector('.notaCIestudiante').textContent,
                notaIDmateria: elemento.querySelector('.notaIDmateria').textContent,
                notaIDseccion: elemento.querySelector('.notaIDseccion').textContent,
                notaEstudiante: result.value,
            };
            $.post("controlador/ajax/dinamica-misEstudiantes.php", data, function (response) {
                console.log(response);
                listar_misEstudiantes();
                Swal.fire({
                    icon: 'success',
                    iconColor: 'white',
                    title: '¡Nota agregada!',
                    toast: true,
                    background: 'green',
                    color: 'white',
                    showConfirmButton: false,
                    timer: 3000,
                })
            });
            }
        })
    })

    //VER LA NOTA DEL ESTUDIANTE SELECCIONADO
    $('#tabla_misEstudiantes tbody').on('click', '.verNotaAgregada', function() {
        let elemento2= $(this)[0].parentElement.parentElement;
        let nombreEstudiante= elemento2.querySelector('.notaNombreEstudiante').textContent;
        let nombreMateria= elemento2.querySelector('.notaNombreMateria').textContent;

        const data= {
            verNota: 'verNota',
            notaCIestudianteRef: elemento2.querySelector('.notaCIestudiante').textContent,
            notaIDmateriaRef: elemento2.querySelector('.notaIDmateria').textContent,
            notaIDseccionRef: elemento2.querySelector('.notaIDseccion').textContent,
        };

        $.post("controlador/ajax/dinamica-misEstudiantes.php", data).done(function (data) {
            Swal.fire({
                html: '<span>'+nombreEstudiante+'</span><h5>Materia: '+nombreMateria+'</h5><h1>'+data+'/20</h1>',
                inputLabel: 'Puedes cambiar la nota aqui si deseas',
                input: 'range',
                confirmButtonText: `ACTUALIZAR`,
                confirmButtonColor: '#0078FF',
                showDenyButton: true,
                denyButtonText: `CANCELAR`,
                denyButtonColor: 'orange',
                inputAttributes: {
                  min: 0,
                  max: 20,
                  step: 1
                },
                inputValue: data,
            }).then((result) => { //EN TAL CASO QUE QUIERA ACTUALIZARLA; ENTRA AQUI MISMO Y HACE ESO JEJE
                if (result.isConfirmed) {
                    const data= {
                        actualizarNota: 'actualizarNota',
                        notaCIestudiante2: elemento2.querySelector('.notaCIestudiante').textContent,
                        notaIDmateria2: elemento2.querySelector('.notaIDmateria').textContent,
                        notaIDseccion2: elemento2.querySelector('.notaIDseccion').textContent,
                        notaNueva: result.value,
                    };
                    $.post("controlador/ajax/dinamica-misEstudiantes.php", data, function (response) {
                        console.log(response)
                        listar_misEstudiantes();
                        Swal.fire({
                            icon: 'success',
                            iconColor: 'white',
                            title: '¡Nota actualizada!',
                            toast: true,
                            background: 'green',
                            color: 'white',
                            showConfirmButton: false,
                            timer: 3000,
                        })
                    });
                    }
                })
        });

    })

    //ELIMINAR LA NOTA DE LA MATERIA DEL ESTUDIANTE SELECCIONADO
    $('#tabla_misEstudiantes tbody').on('click', '.eliminarNota', function() {
        let elemento3= $(this)[0].parentElement.parentElement;

        const data= {
            eliminarNota: 'eliminarNota',
            cedulaEstudianteRef2: elemento3.querySelector('.notaCIestudiante').textContent,
            idMateriaRef2: elemento3.querySelector('.notaIDmateria').textContent,
            idSeccionRef2: elemento3.querySelector('.notaIDseccion').textContent,
        };

        Swal.fire({
            icon: 'warning',
            iconColor: 'red',
            title: '¿Estas seguro?',
            confirmButtonText: `Si, eliminar`,
            confirmButtonColor: '#0078FF',
            showDenyButton: true,
            denyButtonText: `Cancelar`,
            denyButtonColor: 'red',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("controlador/ajax/dinamica-misEstudiantes.php", data, function (response) {
                    console.log(response);
                listar_misEstudiantes();
                Swal.fire({
                    icon: 'success',
                    iconColor: 'green',
                    title: '¡Nota eliminada!',
                    toast: true,
                    background: 'white',
                    showConfirmButton: false,
                    timer: 3000,
                    })
                })
            }
        })
    })

        
}, 100);







    

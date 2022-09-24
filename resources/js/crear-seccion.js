ejecutar();


//ACTIVA LA SELECCION DE MATERIAS Y PROFESORES
$("#nivelSeccion").click(function () {
    const nivel = document.getElementById("nivelSeccion").value;
    let div = document.getElementById("datos_PM");
    if (nivel == "ninguno") {
        div.innerHTML= '<h2 class="text-center text-danger">¡SELECCIONE EL NIVEL ACADEMICO DE LA SECCION!</h2>'
    }else if (nivel == 1 || nivel == 2 || nivel == 3) {
        $.ajax({
            data: {
                nivelSeleccionado: 'nivelSeleccionado',
                nivel: nivel,
            },
            type: "post",
            url: "controlador/ajax/dinamica-seccion.php",
        }).done((data) => {
            div.innerHTML = data;
            $(".seleccionarProfesores").select2({
                theme: "bootstrap4",
                dropdownParent: $("#form2")
            });
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
    let nivelSeccion= document.getElementById('nivelSeccion');

    let data = {
        crear: $('#crear').val(),
        nombreSeccion: nombreSeccion.value,
        nivelSeccion: nivelSeccion.value,
        idMateriaSeccion: arregloMateria,
        cedulaProfSeccion: arregloProfesores,
        cedulaEstSeccion: $('#seleccionarEstudiantes').val(),
    };
    $.post("controlador/ajax/CRUD-seccion.php", data, function (response) {
        dataTableSec.ajax.reload();
        Swal.fire({
            icon: 'success',
            iconColor: 'white',
            title: '¡Seccion creada exitosamente!',
            toast: true,
            background: 'success',
            showConfirmButton: false,
            timer: 2000,
        })
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
        choices2();
        /*$("#seleccionarEstudiantes").select2({
            placeholder: "Seleccione los estudiantes",
            closeOnSelect: false,
            amdLanguageBase: "es",
            theme: "bootstrap4",
            dropdownParent: $("#form3")
        });*/
    });
}



/////LISTAR PROFESORES DE LA SECCION SELECCIONADA/////
function listarProfesoresSeccion() { 
    let idSMConsulta= $('#idSeccionProfMatU').val();
    var div= document.getElementById("listaProfDatos"); //PARA ACTUALIZAR LA LISTA DE MATERIAS Y PROFESORES TAMBIEN
    $.ajax({
        data: {
            activarTablaProf: 'activarTablaProf',
            idSMConsulta: idSMConsulta,
        },
        type: "post",
        url: "controlador/ajax/dinamica-seccion.php",
    }).done((data) => {
        div.innerHTML = data;
    });
}
//SELECT DE LOS PROFESORES PARA AGREGAR A LA MATERIA (LISTA)
function selectMasProfesoresMaterias() { //PARA ACTUALIZAR EL SELECT DE LA SECCION SELECCIONADA
    let div = document.getElementById("selectMasProfesoresMaterias");
    let idSeccionRef4= $('#idSeccionProfMatU').val();
    let nivDoctrinaRef4= $('#nivDoctrinaSeccionProfMatU').text();

    $.ajax({
        data: {
            verProfesoresMateriasSelect: 'verProfesoresMateriasSelect',
            idSeccionRef4: idSeccionRef4,
            nivDoctrinaRef4: nivDoctrinaRef4,
        },
        type: "post",
        url: "controlador/ajax/dinamica-seccion.php",
    }).done((data) => {
        div.innerHTML = data;
        choicesMasProfesoresMaterias();
    });
}
//AGREGAR MATERIAS CON PROFESORES ASIGNADOS ADICIONALES AL QUERER EDITAR EN EL MODAL
$('#agregarEditado3').click(function (e) { //AGREGAR MATERIAS Y PROFESORES NUEVOS
    e.preventDefault();
    
    const data= {
        actualizarMP: 'actualizarMP',
        idMateriaAdicional: $('#seleccionarMateriasAdicionales').val(),
        cedulaProfesorAdicional: $('#seleccionarProfesoresAdicionales').val(),
        idSeccionRef5: $("#idSeccionProfMatU").val(),
    };

    $.post("controlador/ajax/CRUD-seccion.php", data, function (response) {
        listarProfesoresSeccion();
        selectMasProfesoresMaterias();
        Swal.fire({
            icon: 'success',
            iconColor: 'white',
            title: '¡Agregado correctamente!',
            toast: true,
            background: 'green',
            color: 'white',
            showConfirmButton: false,
            timer: 2000,
        })
    });

});
//ELIMINAR MATERIAS Y PROFESOR DE LA SECCION SELECCIONADA
$(document).on('click', '#eliminarMP_ON', function (e) {
    e.preventDefault();
    let elemento= $(this)[0].parentElement.parentElement;
    let idMateriaSec= elemento.querySelector('.idMateriaProfON').textContent;
    let cedulaProfSec= elemento.querySelector('.cedulaProfON').textContent;
    let idSeccionMatProfSec= $('#idSeccionProfMatU').val();

    const data= {
        eliminarMateriaProf: 'eliminarMateriaProf',
        idMateriaSec: idMateriaSec,
        cedulaProfSec: cedulaProfSec,
        idSeccionMatProfSec: idSeccionMatProfSec,
    }
    
    Swal.fire({
        icon: 'warning',
        iconColor: 'white',
        title: '¿Estas segur@ que deseas eliminarlo?',
        background: 'orange',
        showDenyButton: true,
        confirmButtonText: `SI`,
        confirmButtonColor: 'green',
        denyButtonText: `NO`,
        denyButtonColor: 'red',
      }).then((result) => {
        if (result.isConfirmed) {
          $.post("controlador/ajax/CRUD-seccion.php", data, function (response) {
            listarProfesoresSeccion();
            selectMasProfesoresMaterias();

            Swal.fire({
                icon: 'success',
                iconColor: 'green',
                title: '¡Eliminado correctamente!',
                toast: true,
                background: 'white',
                showConfirmButton: false,
                timer: 2000,
            })
          })
        }
      })
})



/////LISTAR ESTUDIANTES DE LA SECCION SELECCIONADA/////
function listarEstudiantesSeccion(idSeccionVer) { //Este parametro es para que la funcion liste los estudiantes de la seccion correspondiente. Un parametro de referencia
    var div= document.getElementById("listaEstDatos");
    $.ajax({
        data: {
            activarTablaEst: 'listar',
            idSeccionConsulta: idSeccionVer,
        },
        type: "post",
        url: "controlador/ajax/dinamica-seccion.php",
    }).done((data) => {
        div.innerHTML = data;
    });
}
//LISTAR SELECT DE LOS ESTUDIANTES QUE NO ESTAN EN NINGUNA SECCION 
function selectEstudiantesOFF(idSeccionRef) { //Ese parametro es para llenarlo en un input y tomarlo cuando se vaya a agregar un estudiante a la seccion
    let div = document.getElementById("selectMasEstudiantes");
    let verEstudiantes2 = "ver";
    $.ajax({
        data: {
            verEstudiantes2: verEstudiantes2,
        },
        type: "post",
        url: "controlador/ajax/dinamica-seccion.php",
    }).done((data) => {
        div.innerHTML = data;
        $('#idSeccionV').val(idSeccionRef);
        choices1();
    });
}
//GUARDAR EL AGREGADO DE MAS ESTUDIANTES A LA SECCION
$("#agregarEditado2").on("click", function (e) {
    e.preventDefault();
    const data = {
      actualizarEstudiantes: 'actualizarEstudiantes',
      idSeccionV: $("#idSeccionV").val(),
      estudiantesNuevos: $("#seleccionarEstudidantesAdicionales").val(),
    };
    $.post("controlador/ajax/CRUD-seccion.php", data, function (response) {
        listarEstudiantesSeccion(data.idSeccionV);
        selectEstudiantesOFF(data.idSeccionV);
        Swal.fire({
            icon: 'success',
            iconColor: 'white',
            title: '¡Estudiante guardado correctamente!',
            toast: true,
            background: 'green',
            color: 'white',
            showConfirmButton: false,
            timer: 2000,
        });
    });
});
/////ELIMINAR ESTUDIANTE DE LA SECCION SELECCIONADA/////
$(document).on('click', '#eliminarEstON', function () {
    let elemento = $(this)[0].parentElement.parentElement;
    let cedulaEstborrar= elemento.querySelector('#cedulaEstON').textContent;
    let idSeccionRef= $("#idSeccionV").val();
    
    const data = {
        eliminarEstSeccion: 'eliminarEstSeccion',
        cedulaEstborrar: cedulaEstborrar,
    }

    Swal.fire({
        background: '#ebebeb',
        icon: 'warning',
        title: '¿Segur@a de eliminar a este estudiante?',
        showDenyButton: true,
        confirmButtonText: `SI`,
        confirmButtonColor: 'green',
        denyButtonText: `NO`,
        denyButtonColor: 'red',
    }).then((result) => {
            if (result.isConfirmed) {
                $.post("controlador/ajax/CRUD-seccion.php", data, function (response) {
                    listarEstudiantesSeccion(idSeccionRef);
                    selectEstudiantesOFF(idSeccionRef);
                });
            }
    })
})


////////////////////FUNCIONES CHOICES SELECT////////////////////
function choices1 () {
    var estudiantesOFF = document.getElementById('seleccionarEstudidantesAdicionales');
    new Choices(estudiantesOFF, {
      allowHTML: true,
      maxItemText: 3,
      removeItems: true,
      removeItemButton: true,
      noResultsText: 'No hay coicidencias',
      noChoicesText: 'No hay estudiantes disponibles',
      placeholderValue: 'Buscar estudiantes',
    });
}

function choices2 () {
    var estudiantesON = document.getElementById('seleccionarEstudiantes');
    new Choices(estudiantesON, {
      position: 'top',
      allowHTML: true,
      removeItems: true,
      maxItemCount: 40,
      removeItemButton: true,
      noResultsText: 'No hay coicidencias',
      noChoicesText: 'No hay estudiantes disponibles',
      placeholderValue: 'Buscar estudiantes',
    });
}
function choicesMasProfesoresMaterias() {

  (function () {
    var profesoresOFF = document.getElementById("seleccionarProfesoresAdicionales");
    new Choices(profesoresOFF, {
      allowHTML: true,
      removeItems: true,
      removeItemButton: true,
      noResultsText: "No hay coicidencias",
      noChoicesText: "No hay profesores disponibles",
      placeholder: true,
      placeholderValue: "Buscar profesores",
    });
  })();

  (function () {
    var materiasOFF = document.getElementById("seleccionarMateriasAdicionales");
    new Choices(materiasOFF, {
      allowHTML: true,
      maxItemText: 3,
      removeItems: true,
      removeItemButton: true,
      noResultsText: "No hay coicidencias",
      noChoicesText: "No hay materias disponibles",
      placeholder: true,
      placeholderValue: "Buscar materias",
    });
  })();
}
////////////////////////////////////////////////////////////



/////APARTADO DE RELLENO DE DATOS/////

//RELLENANDO MODAL PARA EDITAR INFORMACION DE LA SECCION
$('#listaSecciones tbody').on('click', '.editarDatosSeccion', function() {
    let data= dataTableSec.row($(this).parents()).data();
    $('#idSeccionRefU').val(data.id_seccion);
    $('#nombreSeccionEdit').val(data.nombre);
    $('#nivelDoctrinaEdit').val(data.nivel_academico);
})




/////APARTADO DE DATATABLES/////

//IDIOMA DEL DATATABLES
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

//DATATABLES LISTA DE SECCIONES INICIALIZACION
let activarDatatableSeccion= 'activarsec';
let dataTableSec= $('#listaSecciones').DataTable({
    ajax:{
        method: "POST",
        url: "controlador/ajax/dinamica-seccion.php",
        data: {activarDatatableSeccion: activarDatatableSeccion},
    },
    columns: [
        {data: 'id_seccion'},
        {data: 'nombre' },
        {data: 'nivel_academico' },
        {defaultContent: 
        '<button type="button" class="btn btn-primary editarDatosSeccion mx-1" data-bs-toggle="modal" data-bs-target="#modalEditarDatosSeccion" title="Editar datos de la seccion"><i class="bi bi-pencil-square"></i></button>'  
        +'<button type="button" class="btn btn-info editardatosEstudiantes mx-1" data-bs-toggle="modal" data-bs-target="#modalEditarEstudiantesSeccion" title="Ver y editar estudiantes"><i class="bi bi-person-lines-fill"></i></button>'
        +'<button type="button" class="btn btn-info editardatosProfesores mx-1" data-bs-toggle="modal" data-bs-target="#modalEditarProfesoresSeccion" title="Ver y editar profesores"><i class="bi bi-people-fill"></i></button>' 
        +'<button type="button" class="btn btn-danger eliminarSeccion mx-1" title="Eliminar seccion"><i class="bi bi-dash-circle"></i></button>'},
    ],
    language: spanish,
});
//GUARDANDO LA TABLA EN UNA VARIABLE PARA USARLA PARA RECUPERAR DATOS
dataTableSec.column( 0 ).visible( false );
/////////////////////////////////////////////////////////////////////////////////////////



/////ENTRAR AL MODAL PROFESORES-MATERIAS Y LISTAR LOS PROFESORES-MATERIAS DE LA SECCION SELECCIONADA/////
$('#listaSecciones tbody').on('click', '.editardatosProfesores', function() {
    
    let idSeccionRef3= dataTableSec.row($(this).parents()).data().id_seccion;
    let nivDoctrinaSeccionRef3= dataTableSec.row($(this).parents()).data().nivel_academico;
    let nombreSeccionRef3= dataTableSec.row($(this).parents()).data().nombre;
    $('#idSeccionProfMatU').val(idSeccionRef3);
    $('#nivDoctrinaSeccionProfMatU').text(nivDoctrinaSeccionRef3);
    $('#nombreSeccionProMatfU').text(nombreSeccionRef3);
    
    let div = document.getElementById("listaProfDatos");

    $.ajax({
        data: {
            activarTablaProf: 'activarTablaProf',
            idSMConsulta: idSeccionRef3,
        },
        type: "post",
        url: "controlador/ajax/dinamica-seccion.php",
    }).done((data) => {
        div.innerHTML = data;
        selectMasProfesoresMaterias();
    })
})



/////ENTRAR AL MODAL ESTUDIANTES Y LISTAR LOS ESTUDIANTES DE LA SECCION SELECCIONADA/////
$('#listaSecciones tbody').on('click', '.editardatosEstudiantes', function() {
    
    let idSeccionRef= dataTableSec.row($(this).parents()).data().id_seccion;
    
    let div = document.getElementById("listaEstDatos");
    let activarTablaEst = "activarTablaEst";

    $.ajax({
        data: {
            activarTablaEst: activarTablaEst,
            idSeccionConsulta: idSeccionRef,
        },
        type: "post",
        url: "controlador/ajax/dinamica-seccion.php",
    }).done((data) => {
        div.innerHTML = data;
        selectEstudiantesOFF(idSeccionRef);
    })
})

/////ACTUALIZAR DATOS DE LA SECCION/////
$('#guardarEditado1').click(function (e) { 
    e.preventDefault();
    const data = {
        actualizarDatosSeccion: 'actualizarDatosSeccion',
        nombreSeccionU: $("#nombreSeccionEdit").val(),
        nivelSeccionU: $("#nivelDoctrinaEdit").val(),
        idSeccionRefU: $("#idSeccionRefU").val(),
    }

    Swal.fire({
        background: '#ebebeb',
        icon: 'warning',
        title: '¿Procesar informacion a actualizar?',
        showDenyButton: true,
        confirmButtonText: `DE ACUERDO`,
        confirmButtonColor: 'green',
        denyButtonText: `NO`,
        denyButtonColor: 'orange',
    }).then((result) => {
            if (result.isConfirmed) {
                $.post("controlador/ajax/CRUD-seccion.php", data, function (response) {
                    dataTableSec.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        iconColor: 'white',
                        title: '¡Actualizado correctamente!',
                        toast: true,
                        background: 'green',
                        color: 'white',
                        showConfirmButton: false,
                        timer: 2000,
                    })
                });
            }
    })
      
});

/////ELIMINAR SECCION DE LA DATATABLE SECCION/////
$('#listaSecciones tbody').on('click', '.eliminarSeccion', function() {
    let idSeccionRef= dataTableSec.row($(this).parents()).data().id_seccion;
    let data= {
        eliminarSeccion: 'eliminarSeccion',
        idSeccionEliminar: idSeccionRef,
    }
    Swal.fire({
        background: '#ebebeb',
        icon: 'warning',
        title: '¿Estas segur@ que deseas cerrar la seccion?',
        showDenyButton: true,
        confirmButtonText: `CERRAR`,
        confirmButtonColor: 'red',
        denyButtonText: `CANCELAR`,
        denyButtonColor: 'orange',
    }).then((result) => {
            if (result.isConfirmed) {
                $.post("controlador/ajax/CRUD-seccion.php", data, function (response) {
                    dataTableSec.ajax.reload();
                })
            }
        })
    
})






///////////////////////////////////////////////////////////////
////////APARTADO DE VALIDACIONES PARA CREAR UNA SECCION////////
///////////////////////////////////////////////////////////////

const expresionesSecciones = {
    nombreSeccion: /^[a-zA-ZÀ-ÿ0-9\s]{8,20}$/, // Letras y espacios, pueden llevar acentos.
  }
  
  var camposForm_1 = {
    nombreSeccion: false,
    nivelSeccion: false,
  }

function validarSiguiente1(params) {
    if (camposForm_1[0] && camposForm_1[1]) {
        document.getElementById("siguiente1").removeAttribute("disabled");
    }else{
        document.getElementById("siguiente1").setAttribute("disabled", "disabled");
    }
}

  //VALIDAR NOMBRE DE LAS SECCIONES
const inputs_DatosSeccion = document.querySelectorAll('#formulario_datosSeccion input');

var validarNombreSeccion = (evento) => {

  switch (evento.target.name) {
    case 'nombreSeccion':

      if (expresionesSecciones.nombreSeccion.test(evento.target.value)) {
        document.getElementById('nombreSeccion').classList.remove('validarMal');
        document.getElementById('nombreSeccion').classList.add('validarBien');
        document.getElementById("alertaNombre").setAttribute("hidden", "hidden");
        camposForm_1[0] = true;
      } else {
        document.getElementById('nombreSeccion').classList.remove('validarBien');
        document.getElementById('nombreSeccion').classList.add('validarMal');
        document.getElementById("alertaNombre").removeAttribute("hidden");
        camposForm_1[0] = false;
      }
      validarSiguiente1();
      break;

  }
}

inputs_DatosSeccion.forEach((evento) => {
  evento.addEventListener("keyup", validarNombreSeccion);
  evento.addEventListener("blur", validarNombreSeccion);
});
//FIN DE VALIDAR NOMBRES DE LAS SECCIONES
//////////////////////////////////////////
//////////////////////////////////////////
//VALIDAR SELECTS DE LA SECCIONES
const select_DatosSeccion = document.querySelectorAll('#formulario_datosSeccion select');

var validarNivelSeccion = (evento) => {

  if (evento.target.value == 1 || evento.target.value == 2 || evento.target.value == 3 || evento.target.value == 'Seminario') {
    document.getElementById('nivelSeccion').classList.remove('validarMal');
    document.getElementById('nivelSeccion').classList.add('validarBien');
    document.getElementById("alertaSeccion").setAttribute("hidden", "hidden");
    camposForm_1[1] = true;
  } else {
    document.getElementById('nivelSeccion').classList.remove('validarBien');
    document.getElementById('nivelSeccion').classList.add('validarMal');
    document.getElementById("alertaSeccion").removeAttribute("hidden");
    camposForm_1[1] = false;
  }
  validarSiguiente1();
}

select_DatosSeccion.forEach((evento) => {
  evento.addEventListener("click", validarNivelSeccion);
  evento.addEventListener("blur", validarNivelSeccion);
});





//FIN DE VALIDACIONES AL AGREGAR SECCIONES







    



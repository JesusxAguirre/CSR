/*$("#seleccionarProfesoresAdicionales").select2({
    allowClear: true,
    theme: "bootstrap4",
    dropdownParent: $("#selectMasProfesoresMaterias")
});*/


//ACTIVA LA SELECCION DE MATERIAS Y PROFESORES
$("#nivelSeccion").click(function () {
    const nivel = document.getElementById("nivelSeccion").value;
    let div = document.getElementById("datos_PM");
    if (nivel == "ninguno") {
        div.innerHTML= '<h2 class="text-center text-danger">¡SELECCIONE EL NIVEL ACADEMICO DE LA SECCION!</h2>'
    }else if (nivel == 1 || nivel == 2 || nivel == 3) {
        seleccionarEstudiantes(nivel);
        $.ajax({
            data: {
                nivelSeleccionado: 'nivelSeleccionado',
                nivel: nivel,
            },
            type: "post",
            url: "controlador/ajax/dinamica-seccion.php",
        }).done((data) => {
            div.innerHTML = data;
        });
    }
});


function seleccionarEstudiantes(nivelRef) {
    let div = document.getElementById("datos_E");
    let verEstudiantes = "valor";

    $.ajax({
        data: {
            verEstudiantes: verEstudiantes,
            nivelRef: nivelRef,
        },
        type: "post",
        url: "controlador/ajax/dinamica-seccion.php",
    }).done((data) => {
        div.innerHTML = data;
        choices2();
    });
}



//LISTAR SELECT DE LOS ESTUDIANTES QUE NO ESTAN EN NINGUNA SECCION 
function selectEstudiantesOFF() {
    let div = document.getElementById("selectMasEstudiantes");
    let verEstudiantes2 = "ver";
    let nivelAcademicoRef= $('#nivelAcademicoRef').val();

    $.ajax({
        data: {
            verEstudiantes2: verEstudiantes2,
            nivelAcademicoRef: nivelAcademicoRef,
        },
        type: "post",
        url: "controlador/ajax/dinamica-seccion.php",
    }).done((data) => {
        div.innerHTML = data;
        choices1();
    });
}






////////////////////////////////////////////////////////////////
////////////////////FUNCIONES CHOICES SELECT////////////////////


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

function choices3 () {
    var estudiantesON = document.getElementById('estudiante');
    new Choices(estudiantesON, {
      position: 'bottom',
      allowHTML: true,
      removeItems: true,
      removeItemButton: true,
      noResultsText: 'No hay coicidencias',
      noChoicesText: 'No hay estudiantes disponibles',
      placeholderValue: 'Buscar estudiantes',
    });
}
////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////
////////////////////////APARTADO DE VALIDACIONES PARA CREAR UNA SECCION////////
///////////////////////////////////////////////////////////////////////////////

const expresionesSecciones = {
    nombreSeccion: /^[a-zA-ZÀ-ÿ0-9\s]{8,20}$/, // Letras y espacios, pueden llevar acentos.
}
  
  var camposForm_1 = {
    nombreSeccion: false,
    nivelSeccion: false,
    fechaCierre: false,
  }

function validarSiguiente1() {
    if (camposForm_1[0] && camposForm_1[1] && camposForm_1[2]) {
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

    case 'fechaCierre':
      if (evento.target.value == "") {
        document.getElementById('fechaCierre').classList.remove('validarBien');
        document.getElementById('fechaCierre').classList.add('validarMal');
        document.getElementById("alertaFecha").removeAttribute("hidden");
        camposForm_1[2] = false;
      }else{
        document.getElementById('fechaCierre').classList.remove('validarMal');
        document.getElementById('fechaCierre').classList.add('validarBien');
        document.getElementById("alertaFecha").setAttribute("hidden", "hidden");
        camposForm_1[2] = true;
      }
        validarSiguiente1();
        break;

  }
}

inputs_DatosSeccion.forEach((evento) => {
  evento.addEventListener("keyup", validarNombreSeccion);
  evento.addEventListener("blur", validarNombreSeccion);
});

//VALIDAR SELECTS DE SELECCIONAR NIVEL DE LA SECCIONES
const select_DatosSeccion = document.querySelectorAll('#formulario_datosSeccion select');

var validarNivelSeccion = (evento) => {

  if (evento.target.value == 1 || evento.target.value == 2 || evento.target.value == 3) {
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
//FIN DE VALIDACIONES DE DATOS DE LAS SECCIONES


//ACTIVAR VER SEMINARIOS PARA CREAR SECCION
$('#siguiente1').click(function (e) { 
    let div= document.querySelector('#seleccionarMateriaSeminario');
    $.post("controlador/ajax/dinamica-seccion.php", {verSeminarios: 'prueba1'}, function (data) {
        div.innerHTML= data;
        $(".seleccionarProfesores").select2({
            theme: "bootstrap4",
            dropdownParent: $("#form2")
        });
        
        $("#seleccionarProfesorSeminario").select2({
            theme: "bootstrap4",
            dropdownParent: $("#form2")
        });
    });
})

//ACTIVAR O DESACTIVAR EL CAMPO PARA ELEGIR SEMINARIOS
$('#seleccionarMateriaSeminario').click(function (e) { 
    let div= document.getElementById('seleccionarProfesorSeminario');
    let seminario= document.getElementById('seleccionarMateriaSeminario');

    if (seminario.value == 'no') {
        document.querySelector("#seleccionarProfesorSeminario").setAttribute("disabled", "disabled");
        document.querySelector("#seleccionarProfesorSeminario").value= '';
    }else{
        let seminarioSeleccionado= seminario.value;
        $.post("controlador/ajax/dinamica-seccion.php", {seminarioSeleccionado: seminarioSeleccionado}, function (data) {
            div.innerHTML= data;
            document.querySelector("#seleccionarProfesorSeminario").removeAttribute("disabled");
            
        } );
        
    }
    
});



//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////VALIDACIONES DE SELECCIONAR MATERIAS Y PROFESORES Y SEMINARIO/////////////////////
var camposForm_2 = {
    profesoresMaterias: false,
    profesorSeminario: false,
};

$('#siguiente2').click(function (e) { 
    
    let datos1= document.querySelectorAll('.seleccionarProfesores');
    let info1=[];
    datos1.forEach(elemento => {
        info1.push(elemento.value);
    });

    let info2= document.querySelector('#seleccionarProfesorSeminario').value;

    if (info1.includes('ninguno') || info1.length === 0 || info2 == 'no') {
        document.querySelector(".alertaMatProf").removeAttribute("hidden");
        camposForm_2[0] = false;
        camposForm_2[1] = false;
    }else{
        info2 == 'no' || info2 == '' ? camposForm_2[1] = false : camposForm_2[1] = true;
        camposForm_2[0] = true;
        document.querySelector(".alertaMatProf").setAttribute("hidden", "hidden");
        $('#form2').modal('hide');
        $('#form3').modal('show');
    }
});
///////////////////////////////////////////////////////////////////////////////////////////////////////////


var camposForm_3 = {
    minimoEstudiantes: false,
}

$('#datos_E').on('change', 'div div', function () {
    let arregloEstudiante= $('#seleccionarEstudiantes').val();
    if (arregloEstudiante.length >= 1) {
        document.querySelector(".alertaNoEstudiantes").setAttribute("hidden", "hidden");
        document.querySelector("#crear").removeAttribute("disabled");
        camposForm_3[0]= true;
    }else{
        document.querySelector(".alertaNoEstudiantes").removeAttribute("hidden");
        document.querySelector("#crear").setAttribute("disabled", "disabled");
        camposForm_3[0]= false;
    }
});






/////////////////////////////////////////////////////////////////////////////
///////////////////////////////////CREAR LA SECCION//////////////////////////
$("#crear").click(function () {

    if (camposForm_1[0] && camposForm_1[1] && camposForm_1[2] && camposForm_2[0] && camposForm_3[0]) {
        //ALMACENANDO TODOS LOS VALORES DE LOS SELECT DE MATERIAS
        let seleccionarMaterias = document.querySelectorAll(".seleccionarMaterias");
        let arregloMateria = [];
        seleccionarMaterias.forEach((sm) => {
            arregloMateria.push(sm.value);
        });
        camposForm_2[1] ? arregloMateria.push($('#seleccionarMateriaSeminario').val()): false ;

        //ALMACENANDO TODOS LOS VALORES DE LOS SELECT DE PROFESOR
        let seleccionarProfesores = document.querySelectorAll(".seleccionarProfesores");
        let arregloProfesores = [];
        seleccionarProfesores.forEach((sp) => {
            arregloProfesores.push(sp.value);
        });
        camposForm_2[1] ? arregloProfesores.push($('#seleccionarProfesorSeminario').val()): false ;

        let nombreSeccion = document.getElementById('nombreSeccion');
        let nivelSeccion = document.getElementById('nivelSeccion');
        let fechaCierre= document.getElementById('fechaCierre');

        let data = {
            crear: $('#crear').val(),
            nombreSeccion: nombreSeccion.value,
            nivelSeccion: nivelSeccion.value,
            fechaCierre: fechaCierre.value,
            idMateriaSeccion: arregloMateria,
            cedulaProfSeccion: arregloProfesores,
            cedulaEstSeccion: $('#seleccionarEstudiantes').val(),
        };
        $.post("controlador/ajax/CRUD-seccion.php", data, function (response) {
            Swal.fire({
                icon: 'success',
                iconColor: 'white',
                color: 'white',
                background: 'green',
                title: '¡Seccion creada exitosamente!',
                toast: true,
                showConfirmButton: false,
                timer: 2000,
            })
            $('#form3').modal('hide');
            document.getElementById("formulario_datosSeccion").reset();
            document.getElementById("formulario_seminarioSeccion").reset();
            document.getElementById("siguiente1").setAttribute("disabled", "disabled");
            document.getElementById('nombreSeccion').classList.remove('validarMal');
            document.getElementById('nombreSeccion').classList.remove('validarBien');
            document.getElementById("alertaNombre").setAttribute("hidden", "hidden");
            document.getElementById('nivelSeccion').classList.remove('validarMal');
            document.getElementById('nivelSeccion').classList.remove('validarBien');
            document.getElementById("alertaSeccion").setAttribute("hidden", "hidden");
            document.getElementById('fechaCierre').classList.remove('validarMal');
            document.getElementById('fechaCierre').classList.remove('validarBien');
            document.getElementById("alertaFecha").setAttribute("hidden", "hidden");
        });
    } else {
        console.log('o ooouuu');
    }
   
});

$(".cerrarCrear").click(function () {
    document.getElementById("formulario_datosSeccion").reset();
    document.getElementById("formulario_seminarioSeccion").reset();
    document.getElementById("siguiente1").setAttribute("disabled", "disabled");
    document.getElementById('nombreSeccion').classList.remove('validarMal');
    document.getElementById('nombreSeccion').classList.remove('validarBien');
    document.getElementById("alertaNombre").setAttribute("hidden", "hidden");
    document.getElementById('nivelSeccion').classList.remove('validarMal');
    document.getElementById('nivelSeccion').classList.remove('validarBien');
    document.getElementById("alertaSeccion").setAttribute("hidden", "hidden");
    document.getElementById('fechaCierre').classList.remove('validarMal');
    document.getElementById('fechaCierre').classList.remove('validarBien');
    document.getElementById("alertaFecha").setAttribute("hidden", "hidden");
    
})



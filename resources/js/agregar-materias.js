listarProfesores();

//LISTAR SELECT PARA AGREGAR PROFESORES
function listarProfesores() {
    let div = document.getElementById('profesoresAgregar');
  
    $.post("controlador/ajax/CRUD-materias.php", {listarProfesores: 'listarProfesores'},
      function (data) {
        div.innerHTML= data;
        choices1();
      },
    );
  }

//SELECT PARA AGREGAR LOS PROFESORES CON LAS MATERIAS
function choices1 () {
    var profesores = document.getElementById('seleccionarProf');
    new Choices(profesores, {
      allowHTML: true,
      maxItemText: 3,
      removeItems: true,
      removeItemButton: true,
      noResultsText: 'No hay coicidencias',
      noChoicesText: 'No hay participantes disponibles',
      placeholderValue: 'Buscar profesor',
    });
}


//AGREGAR MATERIAS POR AJAX
$("#agregarMateria").on("click", function (e) {
    e.preventDefault();
  
    const data = {
      agregarMateria: $("#agregarMateria").val(),
      nombreMateria: $("#nombreMateria").val(),
      seleccionarNivel: $("#seleccionarNivel").val(),
      cedulaProfesor: $("#seleccionarProf").val(),
    };
  
    if (campos[0] && campos[1] && campos[2]) {
      $.post("controlador/ajax/CRUD-materias.php", data, function (response) {
        var resp = JSON.parse(response);

        if (resp == 'true') {
          Swal.fire({
            icon: 'success',
            title: "¡Agregado exitosamente!",
            showConfirmButton: false,
            timer: 2000,
          });
          $("#formularioMateria").trigger("reset");
          document.getElementById('nombreMateria').classList.remove('validarBien');
          document.getElementById('seleccionarNivel').classList.remove('validarBien');
          document.getElementById('profesoresAgregar').classList.remove('validarBien');
        }else{
          Swal.fire({
            icon: 'error',
            title: "¡Esta materia ya existe!",
            showConfirmButton: false,
            timer: 2000,
          });
        }
        
      });
      
    } else {
      Swal.fire({
        icon: 'error',
        iconColor: 'white',
        title: "Debes cumplir con los requisitos de los campos",
        background: 'red',
        color: 'white',
        showConfirmButton: false,
        timer: 3000,
      });
    }
  });



  
/////////////////////////////////////////////
//INICIO DE VALIDACIONES AL AGREGAR MATERIAS
/////////////////////////////////////////////

const expresionesMaterias = {
    nombreMateria: /^[a-zA-ZÀ-ÿ\s]{5,20}$/, // Letras y espacios, pueden llevar acentos.
  }
  
  var campos = {
    nombreMateria: false,
    nivelMateria: false,
    profesores: false,
  }
  
  
  //VALIDAR NOMBRE DE LAS MATERIAS
  const inputsFC = document.querySelectorAll('#formularioMateria input');
  
  var validarNombreMateria = (evento) => {
  
    switch (evento.target.name) {
      case 'nombreMateria':
        if (expresionesMaterias.nombreMateria.test(evento.target.value)) {
          document.getElementById('nombreMateria').classList.remove('validarMal');
          document.getElementById('nombreMateria').classList.add('validarBien');
          document.getElementById("nomMateriaMal").setAttribute("hidden", "hidden");
          campos[0] = true;
        } else {
          document.getElementById('nombreMateria').classList.remove('validarBien');
          document.getElementById('nombreMateria').classList.add('validarMal');
          document.getElementById("nomMateriaMal").removeAttribute("hidden");
          campos[0] = false;
        }
        break;
  
    }
  }
  
  inputsFC.forEach((evento) => {
    evento.addEventListener("keyup", validarNombreMateria);
    evento.addEventListener("blur", validarNombreMateria);
  });
  //FIN DE VALIDAR NOMBRES DE LAS MATERIAS
  
  
  //VALIDAR SELECTS DE LA MATERIA
  const selectsFC = document.querySelectorAll('#formularioMateria select');
  
  var validarNivelMateria = (evento) => {
  
    if (evento.target.value == 1 || evento.target.value == 2 || evento.target.value == 3 || evento.target.value == 'Seminario') {
      document.getElementById('seleccionarNivel').classList.remove('validarMal');
      document.getElementById('seleccionarNivel').classList.add('validarBien');
      document.getElementById("nivMateriaMal").setAttribute("hidden", "hidden");
      campos[1] = true;
    } else {
      document.getElementById('seleccionarNivel').classList.remove('validarBien');
      document.getElementById('seleccionarNivel').classList.add('validarMal');
      document.getElementById("nivMateriaMal").removeAttribute("hidden");
      campos[1] = false;
    }
  
  }
  
  selectsFC.forEach((evento) => {
    evento.addEventListener("click", validarNivelMateria);
    evento.addEventListener("blur", validarNivelMateria);
  });


  $('#profesoresAgregar').on('change', function(e) {
    var validar = $('#seleccionarProf').val();

    if (validar == '') {
      document.getElementById('profesoresAgregar').classList.remove('validarBien');
      document.getElementById('profesoresAgregar').classList.add('validarMal');
      campos[2] = false;
    }else{
      document.getElementById('profesoresAgregar').classList.remove('validarMal');
      document.getElementById('profesoresAgregar').classList.add('validarBien');
      campos[2] = true;
    }
  })
  //FIN DE VALIDACIONES AL AGREGAR MATERIAS
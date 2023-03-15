listarFuturosProfesores();
listarProfesores2();

function choices3() {
    let crearProfesores = new Choices(document.getElementById('profesores'), {
      allowHTML: true,
      maxItemText: 3,
      removeItems: true,
      removeItemButton: true,
      noResultsText: 'No hay coicidencias',
      noChoicesText: 'No hay profesores disponibles',
      placeholderValue: 'Buscar profesor',
    });
}

//LISTAR PROFESORES AGREGADOS A LA ECAM
function listarProfesores2() {
    let div = document.getElementById('listarProfesores');
  
    $.post("controlador/ajax/CRUD-materias.php", {listarProfesores2: 'listarProfesores2'},
      function (data) {
        div.innerHTML= data;
      },
    );
  }
  //LISTAR SELECT PARA CREAR FUTUROS PROFESORES
  function listarFuturosProfesores() {
    let div = document.getElementById('verProfesoresFuturos');
  
    $.post("controlador/ajax/CRUD-materias.php", {listarFuturosProfesores: 'listarFuturosProfesores'},
      function (data) {
        div.innerHTML= data;
        choices3();
      },
    );
  }

  //ELIMINAR PROFESORES DE LA ECAM DEFINITIVAMENTE
$(document).on('click', '.eliminarProfEcam', function () {
    var elemento = $(this)[0].parentElement.parentElement;
    var cedulaProf = elemento.querySelector('.cedulaProfesor').value;
    let data = {
      eliminar_profesor: 'eliminar_profesor',
      cedulaProf: cedulaProf,
    }
  
    Swal.fire({
      title: 'AVISO',
      text: 'Para poder eliminar un profesor, este seguro que no este vinculado a otras secciones del sistema para poder proceder',
      icon: 'warning',
      iconColor: 'red',
      showCancelButton: true,
      confirmButtonColor: '#0059FF',
      cancelButtonColor: 'red',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Estoy seguro, proceder'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("controlador/ajax/CRUD-materias.php", data,
        function (response) {
          let resp = JSON.parse(response);

          if (resp == 'true') {
            listarFuturosProfesores();
            listarProfesores2();
            Swal.fire({
              icon: 'success',
              iconColor: 'green',
              title: '¡Profesor eliminado correctamente!',
              background: 'white',
              showConfirmButton: false,
              timer: 2000,
            })
          }else{
            Swal.fire({
              icon: 'error',
              iconColor: 'red',
              title: 'Error',
              text: 'No puedes eliminar a este profesor del sistema porque aun existen datos asociados a el/ella',
              background: 'white',
              confirmButtonColor: '#0059FF',
              timer: 4000,
            })
          }
        });
      }
    })
    
});


//AGREGANDO PROFESORES A LA ECAM
$('#crearProfesores').click(function (e) {
    e.preventDefault();
    let cedulasProfesores= $('#profesores').val();
    let data = {
      agregarProfesores: 'agregarProfesores',
      cedulasProfesores: cedulasProfesores,
    }
    
    if (cedulasProfesores == '') {
      Swal.fire({
        title: 'Error',
        text: '¡No seleccionaste profesores!',
        icon: 'error',
        showConfirmButton: false,
        timer: 2000,
      })
    }else{
      $.post("controlador/ajax/CRUD-materias.php", data, function (data) {
        listarFuturosProfesores();
        listarProfesores2();
        Swal.fire({
          title: '¡Agregados exitosamente!',
          icon: 'success',
          showConfirmButton: false,
          timer: 2000,
        })
      });
    }
    
  });
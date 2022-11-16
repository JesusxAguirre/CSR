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
      text: 'Al eliminar un profesor de la ECAM, automaticamente se desvinculara de todo a lo\
      que estaba asociado a sus datos, incluyendo contenidos, notificaciones, acciones y demas',
  
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: 'green',
      cancelButtonColor: 'red',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Estoy seguro, proceder'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("controlador/ajax/CRUD-materias.php", data,
        function (data) {
          listarFuturosProfesores();
          listarProfesores2();
          Swal.fire({
                    icon: 'success',
                    iconColor: 'white',
                    title: '¡Profesor eliminado correctamente!',
                    toast: true,
                    background: 'green',
                    color: 'white',
                    showConfirmButton: false,
                    timer: 2000,
                })
        },
        );
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
        title: '¡No seleccionaste profesores!',
        icon: 'error',
        iconColor: 'white',
        toast: true,
        background: 'red',
        color: 'white',
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
          iconColor: 'white',
          toast: true,
          background: 'green',
          color: 'white',
          showConfirmButton: false,
          timer: 2000,
        })
      });
    }
    
  });
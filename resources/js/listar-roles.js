// Elementos
const busquedaEl = document.getElementById("search-input");
const rolesEl = document.getElementById("roles");

// Notificación SweetAlert
if (alertMsg != "") {
  let iconText;
  if (alertStatus) {
    iconText = "success";
  } else {
    iconText = "error";
  }
  Swal.fire({
    icon: iconText,
    title: alertMsg,
  });
}

// Alternar botones y checkbox de los permisos
const botones = document.querySelectorAll(
  ".edit-modal form table tbody button"
);

botones.forEach((boton) =>
  boton.addEventListener("click", () => {
    let checkbox = boton.querySelector("input[type=checkbox]");
    let span = boton.querySelector("span");

    checkbox.checked = !checkbox.checked;
    boton.classList.toggle("btn-primary");
    boton.classList.toggle("btn-secondary");
    if (checkbox.checked) {
      span.textContent = "SI";
    } else {
      span.textContent = "NO";
    }
  })
);

// Busqueda con Ajax
busquedaEl.addEventListener("keyup", () => {
  let busqueda = busquedaEl.value;

  buscarRoles(busqueda);
});

// Eliminación con Ajax
const deleteButton = document.getElementById("deleteButton");

deleteButton.addEventListener("click", () => {
  let rolId = document.querySelector("#deleteForm .id").value;

  $.ajax({
    data: "id=" + rolId,
    url: "controlador/ajax/eliminar-rol.php",
    type: "post",
  })
    .done((data) => {
      var resp = JSON.parse(data);

      if (resp == "eliminado") {
        fireAlert("success", "Rol eliminado correctamente");
      } else {
        fireAlert(
          "error",
          "No puedes eliminar este rol porque se encuentra en uso"
        );
      }
    })
    .then(() => {
      location.reload();
    });
});

function fireAlert(icon, msg) {
  Swal.fire({
    icon: icon,
    title: msg,
  });
}

// Buscar roles con Ajax
function buscarRoles(busqueda) {
  return $.ajax({
    data: "busqueda=" + busqueda,
    url: "controlador/ajax/buscar-roles.php",
    type: "get",
  }).done((data) => {
    rolesEl.innerHTML = data;
  });
}

// Actualizar contenido del modal Editar
const editButtons = document.querySelectorAll("table td .edit-btn");

editButtons.forEach((boton) =>
  boton.addEventListener("click", () => {
    let fila = boton.parentElement.parentElement;
    let id = fila.querySelector(".id");
    let nombre = fila.querySelector(".nombre");
    let descripcion = fila.querySelector(".descripcion");

    const idInput = document.getElementById("idInput");
    const rolInput = document.getElementById("input_nombreEditar");
    const descripcionInput = document.getElementById("input_descripcionEditar");

    idInput.value = id.textContent;
    rolInput.value = nombre.textContent;
    descripcionInput.value = descripcion.textContent;
  })
);

// Actualizar contenido del modal Eliminar
const deleteButtons = document.querySelectorAll("table td .delete-btn");

deleteButtons.forEach((boton) =>
  boton.addEventListener("click", () => {
    let fila = boton.parentElement.parentElement;
    let id = fila.querySelector(".id");
    let nombre = fila.querySelector(".nombre");

    const idInput = document.querySelector("#deleteForm .id");
    const rolText = document.getElementById("deleteRolName");

    idInput.value = id.textContent;
    rolText.textContent = nombre.textContent;
  })
);

//Validaciones para Crear Rol
const initialValidation = {
  name: false,
  description: false,
  name2: true,
  description2: true,
};

const expresionesCrear = {
  name: /^[a-zA-Z-\s_]{1,20}$/,
  description: /^[a-zA-Z0-9.,\s\u00C0-\u00FF]{1,70}$/,
};

const form = document.getElementById("createForm");

const editForm = document.getElementById("editForm");

const inputCrearNombre = document.getElementById("input_nombreCrear");
const inputCrearDescripcion = document.getElementById("input_descripcionCrear");
const inputEditarNombre = document.getElementById("input_nombreEditar");
const inputEditarDescripcion = document.getElementById(
  "input_descripcionEditar"
);

editForm.addEventListener("submit", (event) => {
  event.preventDefault();

  if (!(initialValidation.name2 && initialValidation.description2)) {
    fireAlert("error", "Algunos campos no son validos");
    return;
  }
  $.ajax({
    type: "POST",
    url: "?pagina=listar-roles",
    data: {
      edit: "edit",
      id: document.getElementById("idInput").value,
      nombre: inputEditarNombre.value,
      descripcion: inputEditarDescripcion.value,
    },
    success: function (response) {
      Swal.fire({
        icon: "success",
        title: "Rol Actualizado correctamente",
        text: response.msj,
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.replace(window.location.href);
        }
      });

      setTimeout(function () {
        window.location.replace(window.location.href);
      }, 4000);
    },
    error: function (xhr, status, error) {
      // Código a ejecutar si se produjo un error al realizar la solicitud

      initialValidation.name2 = false;
      initialValidation.description2 = false;
      var response;
      try {
        response = JSON.parse(xhr.responseText);
      } catch (e) {
        response = {};
      }

      switch (response.status_code) {
        case 403:
          response.ErrorType = "DENIED";
        case 409:
          response.ErrorType = "User Already Exist";
          break;
        case 422:
          response.ErrorType = "Invalid Data";
          break;
        case 404:
          response.ErrorType = "User Not Exist";
          break;
        default:
          break;
      }

      Swal.fire({
        icon: "error",
        title: response.ErrorType,
        text: response.msj,
      });
    },
  });
});

form.addEventListener("submit", (event) => {
  event.preventDefault();

  if (!(initialValidation.name && initialValidation.description)) {
    fireAlert("error", "Algunos campos no son validos");
    return;
  }
  $.ajax({
    type: "POST",
    url: "?pagina=listar-roles",
    data: {
      create: "create",
      nombre: document.getElementById("input_nombreCrear").value,
      descripcion: document.getElementById("input_descripcionCrear").value,
    },
    success: function (response) {
      Swal.fire({
        icon: "success",
        title: "Rol Actualizado correctamente",
        text: response.msj,
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.replace(window.location.href);
        }
      });

      setTimeout(function () {
        window.location.replace(window.location.href);
      }, 4000);
    },
    error: function (xhr, status, error) {
      // Código a ejecutar si se produjo un error al realizar la solicitud

      initialValidation.name2 = false;
      initialValidation.description2 = false;
      var response;
      try {
        response = JSON.parse(xhr.responseText);
      } catch (e) {
        response = {};
      }

      switch (response.status_code) {
        case 403:
          response.ErrorType = "DENIED";
        case 409:
          response.ErrorType = "User Already Exist";
          break;
        case 422:
          response.ErrorType = "Invalid Data";
          break;
        case 404:
          response.ErrorType = "User Not Exist";
          break;
        default:
          break;
      }

      Swal.fire({
        icon: "error",
        title: response.ErrorType,
        text: response.msj,
      });
    },
  });
});

inputCrearNombre.addEventListener("keyup", (event) => {
  validarNombre(event.target.value, "name", "alertNombreCrear", "nombreCrear");
});
inputCrearDescripcion.addEventListener("keyup", (event) => {
  validarDescripcion(
    event.target.value,
    "description",
    "alertDescripcionCrear",
    "descripcionCrear"
  );
});

inputEditarNombre.addEventListener("keyup", (event) => {
  validarNombre(
    event.target.value,
    "name2",
    "alertNombreEditar",
    "nombreEditar"
  );
});
inputEditarDescripcion.addEventListener("keyup", (event) => {
  validarDescripcion(
    event.target.value,
    "description2",
    "alertDescripcionEditar",
    "descripcionEditar"
  );
});

function validarNombre(valor, indice, alerta, input) {
  if (expresionesCrear.name.test(valor)) {
    initialValidation[indice] = true;
    document.getElementById(`msj_${alerta}`).classList.add("d-none");
    document.getElementById(`input_${input}`).classList.remove("border-danger");
    //initialValidation.name = true;
    //msjAlertNombre.classList.add('d-none')
    //inputCrearNombre.classList.remove('border-danger')
  } else {
    initialValidation[indice] = false;
    document.getElementById(`msj_${alerta}`).classList.remove("d-none");
    document.getElementById(`input_${input}`).classList.add("border-danger");
    //initialValidation.name = false;
    //msjAlertNombre.classList.remove('d-none')
    //inputCrearNombre.classList.add('border-danger')
  }
}

function validarDescripcion(valor, indice, alerta, input) {
  if (expresionesCrear.description.test(valor)) {
    initialValidation[indice] = true;
    document.getElementById(`msj_${alerta}`).classList.add("d-none");
    document.getElementById(`input_${input}`).classList.remove("border-danger");
  } else {
    initialValidation[indice] = false;
    document.getElementById(`msj_${alerta}`).classList.remove("d-none");
    document.getElementById(`input_${input}`).classList.add("border-danger");
  }
}

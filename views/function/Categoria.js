async function view_categorias() {
  try {
    let respuesta = await fetch(
      base_url + "control/categoriaController.php?tipo=ver_categorias",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
      }
    );
    json = await respuesta.json();
    contenidot = document.getElementById("content_categorias");
    if (json.status) {
      let cont = 1;
      json.data.forEach((categoria) => {
        let nueva_fila = document.createElement("tr");
        nueva_fila.id = "fila" + categoria.id;
        nueva_fila.className = "filas_tabla";
        nueva_fila.innerHTML =
          `
                            <td>${cont}</td>
                            <td>${categoria.nombre}</td>
                            <td>${categoria.detalle}</td>
                            <td>
                                <a href="` +
          base_url +
          `categoria-edit/` +
          categoria.id +
          `" class="btn btn-primary btn-sm">Editar</a>
            <button class="btn btn-danger btn-sm" onclick="fn_eliminar(` +
          categoria.id +
          `);">Eliminar</button>
                            </td>
                `;
        cont++;
        contenidot.appendChild(nueva_fila);
      });
    }
  } catch (error) {
    console.log("error en mostrar categoria " + error);
  }
}

if (document.getElementById("content_categorias")) {
  view_categorias();
}

function validar_form(tipo) {
  let nombre = document.getElementById("nombre").value;
  let detalle = document.getElementById("detalle").value;
  if (nombre == "" || detalle == "") {
    Swal.fire({
      title: "Error, campos vacíos!",
      icon: "error",
      draggable: true,
    });
    return;
  }
  if (tipo == "nuevo") {
    registrarCategoria();
  }
  if (tipo == "actualizar") {
    actualizarCategoria();
  }
}

if (document.querySelector("#frm_categorie")) {
  // evita que se envie el formulario
  let frm_category = document.querySelector("#frm_categorie");
  frm_category.onsubmit = function (e) {
    e.preventDefault();
    validar_form("nuevo");
  };
}

async function registrarCategoria() {
  try {
    //capturar campos de formulario (HTML)
    const datos = new FormData(frm_category);
    //enviar datos a controlador
    let respuesta = await fetch(
      base_url + "control/categoriaController.php?tipo=registrar",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
      }
    );
    let json = await respuesta.json();
    // validamos que json.status sea = True
    if (json.status) {
      //true
      alert(json.msg);
      document.getElementById("frm_categorie").reset();
    } else {
      alert(json.msg);
    }
  } catch (e) {
    console.log("Error al registrar Categoria:" + e);
  }
}

async function edit_categoria() {
  try {
    let id_categoria = document.getElementById("id_categoria").value;
    const datos = new FormData();
    datos.append("id_categoria", id_categoria);

    let respuesta = await fetch(
      base_url + "control/categoriaController.php?tipo=ver",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
      }
    );
    json = await respuesta.json();
    if (!json.status) {
      alert(json.msg);
      return;
    }
    document.getElementById("nombre").value = json.data.nombre;
    document.getElementById("detalle").value = json.data.detalle;
  } catch (error) {
    console.log("oops, ocurrió un error " + error);
  }
}

if (document.querySelector("#frm_edit_categorie")) {
  edit_categoria();
  // evita que se envie el formulario
  let frm_user = document.querySelector("#frm_edit_categorie");
  frm_user.onsubmit = function (e) {
    e.preventDefault();
    validar_form("actualizar");
  };
}

async function actualizarCategoria() {
  try {
    const datos = new FormData(document.querySelector("#frm_edit_categorie"));
    let respuesta = await fetch(
      base_url + "control/categoriaController.php?tipo=actualizar",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
      }
    );
    json = await respuesta.json();
    if (!json.status) {
      alert("Oooooops, ocurrio un error al actualizar, intentelo nuevamente");
      console.log(json.msg);
      return;
    } else {
      alert(json.msg);
      location.replace(base_url + "categoria-lista");
    }
  } catch (e) {
    console.log("Error al actualizar Categoria:" + e);
  }
}

async function fn_eliminar(id) {
  if (window.confirm("Confirmar eliminar?")) {
    eliminar(id);
  }
}

async function eliminar(id) {
  let datos = new FormData();
  datos.append("id_categoria", id);
  let respuesta = await fetch(
    base_url + "control/categoriaController.php?tipo=eliminar",
    {
      method: "POST",
      mode: "cors",
      cache: "no-cache",
      body: datos,
    }
  );
  json = await respuesta.json();
  if (!json.status) {
    alert(
      "Oooooops, ocurrio un error al eliminar categoria, intentelo mas tarde"
    );
    console.log(json.msg);
    return;
  } else {
    alert(json.msg);
    location.replace(base_url + "categoria-lista");
  }
}

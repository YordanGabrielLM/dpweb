function validar_form(tipo) {
  let codigo = document.getElementById("codigo").value;
  let nombre = document.getElementById("nombre").value;
  let detalle = document.getElementById("detalle").value;
  let precio = document.getElementById("precio").value;
  let stock = document.getElementById("stock").value;
  let id_categoria = document.getElementById("id_categoria").value;
  let fecha_vencimiento = document.getElementById("fecha_vencimiento").value;

  if (codigo == "" || nombre == "" || detalle == "" || precio == "" || stock == "" || id_categoria == "" || fecha_vencimiento == "") {
     Swal.fire({
      title: "Error: campos vacíos!",
      icon: "error",
      draggable: true,
    });
    return;  
}
if (tipo === "nuevo") {
    registrarProducto();
  }
  if (tipo === "actualizar") {
    actualizarProducto();
  }
  }

if (document.querySelector("#frm_product")) {
  //evita que se envie el formulario
  let frm_product = document.querySelector("#frm_product");
  frm_product.onsubmit = function (e) {
    e.preventDefault();
    validar_form("nuevo");
  };
}

async function registrarProducto() {
  try {
    const frm_product = document.querySelector("#frm_product");
    const datos = new FormData(frm_product);
    let respuesta = await fetch(
      base_url + "control/productosController.php?tipo=registrar",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
      }
    );
    let json = await respuesta.json();
    if (json.status) {
      Swal.fire({
        icon: "success",
        title: "Éxito",
        text: json.msg,
      });
      document.getElementById("frm_product").reset();
    } else {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: json.msg,
      });
    }
  } catch (error) {
    console.log("Error al registrar producto: " + error);
  }
}

function cancelar() {
  Swal.fire({
    icon: "warning",
    title: "¿Estás seguro?",
    text: "Se cancelará el registro",
    showCancelButton: true,
    confirmButtonText: "Sí, cancelar",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = base_url + "?views=new-products";
    }
  });
}

async function view_producto() {
  try {
    let respuesta = await fetch(
      base_url + "control/productosController.php?tipo=ver_productos",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
      }
    );
    json = await respuesta.json();
    contenidot = document.getElementById("content_productos");
    if (json.status) {
      let cont = 1;
      json.data.forEach((producto) => {
        let nueva_fila = document.createElement("tr");
        nueva_fila.id = "fila" + producto.id;
        nueva_fila.className = "filas_tabla";
        nueva_fila.innerHTML =
          `
                            <td>${cont}</td>
                            <td>${producto.codigo}</td>
                            <td>${producto.nombre}</td>
                            <td>${producto.precio}</td>
                            <td>${producto.stock}</td>
                            <td>${producto.categoria}</td>
                            <td>${producto.fecha_vencimiento}</td>
                            <td><svg id="barcode${producto.id}"></svg></td>
                            <td>
                        <a href="` +
          base_url +
          `edit-products/` +
          producto.id +
          `" class="btn btn-primary">Editar</a>
                        <button onclick="eliminar(` +
          producto.id +
          `)" class="btn btn-danger">Eliminar</button>
                    </td>
                `;
        cont++;
        contenidot.appendChild(nueva_fila);
      });
      json.data.forEach((producto) => {
        JsBarcode("#barcode" + producto.id, "" + producto.codigo, {
          width: 2,
          height: 40,
        });
      });
    }
  } catch (e) {
    console.log("error en mostrar producto " + e);
  }
}
if (document.getElementById("content_productos")) {
  view_producto();
}

async function edit_producto() {
  try {
    let id_producto = document.getElementById("id_producto").value;
    const datos = new FormData();
    datos.append("id_producto", id_producto);

    let respuesta = await fetch(
      base_url + "control/productosController.php?tipo=ver",
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
    document.getElementById('codigo').value = json.data.codigo;
    document.getElementById('nombre').value = json.data.nombre;
    document.getElementById('detalle').value = json.data.detalle;
    document.getElementById('precio').value = json.data.precio;
    document.getElementById('stock').value = json.data.stock;
    document.getElementById('id_categoria').value = json.data.id_categoria;
    document.getElementById('id_proveedor').value = json.data.id_proveedor;
    document.getElementById('fecha_vencimiento').value = json.data.fecha_vencimiento;
    document.getElementById('direccion').value = json.data.direccion;
    document.getElementById('rol').value = json.data.rol;

  } catch (error) {
    console.log("oops, ocurrio un error" + error);
  }
}
if (document.querySelector('#frm_edit_producto')) {
  let frm_user = document.querySelector('#frm_edit_producto');
  frm_user.onsubmit = function (e) {
    e.preventDefault();
    validar_form("actualizar");
  };
}

async function actualizarProducto() {
  const datos = new FormData(frm_edit_producto);
  let respuesta = await fetch(base_url + 'control/productosController.php?tipo=actualizar',{
      method: "POST",
      mode: "cors",
      cache: "no-cache",
      body: datos,
    }
  );
  json = await respuesta.json();
  if (!json.status) {
    alert("Ops ocurrio un error al actualizar producto, intentalo nuevamente");
    console.log(json.msg);
    return;
  } else {
    alert(json.msg);
  }
}

async function eliminar(id) {
  Swal.fire({
    icon: "warning",
    title: "¿Estás seguro?",
    text: "Esta acción no se puede revertir",
    showCancelButton: true,
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "No, cancelar",
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
  }).then(async (result) => {
    if (result.isConfirmed) {
      try {
        const datos = new FormData();
        datos.append("id_producto", id);
        let respuesta = await fetch(
          base_url + "control/productosController.php?tipo=eliminar",
          {
            method: "POST",
            mode: "cors",
            cache: "no-cache",
            body: datos,
          }
        );
        json = await respuesta.json();
        if (json.status) {
          Swal.fire({
            icon: "success",
            title: "Eliminado",
            text: json.msg,
          }).then(() => {
            view_producto();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: json.msg,
          });
        }
      } catch (error) {
        console.log("oops, ocurrio un error" + error);
      }
    }
  });
}
function nuevoProducto() {
  // Redirige al formulario de registro de productos
  window.location.href = base_url + "new-products";
}
async function cargar_categorias() {
  let respuesta = await fetch(
    base_url + "control/categoriaController.php?tipo=ver_categorias",
    {
      method: "POST",
      mode: "cors",
      cache: "no-cache",
    }
  );
  let json = await respuesta.json();
  let contenido = '<option value="">Seleccione una categoría</option>';
  json.data.forEach((categoria) => {
    contenido += `<option value="${categoria.id}">${categoria.nombre}</option>`;
  });
  //console.log(contenido);
  document.getElementById("id_categoria").innerHTML = contenido;
}

async function cargar_proveedores() {
  let respuesta = await fetch(
    base_url + "control/UsuarioController.php?tipo=ver_proveedores",
    {
      method: "POST",
      mode: "cors",
      cache: "no-cache",
    }
  );
  let json = await respuesta.json();
  let contenido = '<option value="">Seleccione un proveedor</option>';
  json.data.forEach((proveedor) => {
    contenido += `<option value="${proveedor.id}">${proveedor.razon_social}</option>`;
  });
  document.getElementById("id_proveedor").innerHTML = contenido;
}

async function listar_productos_venta() {
  try {
    let dato = document.getElementById("busqueda_venta").value;
    const datos = new FormData();
    datos.append("dato", dato);
    let respuesta = await fetch(
      base_url + "control/productosController.php?tipo=buscar_producto_venta",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
      }
    );
    json = await respuesta.json();
    contenidot = document.getElementById("productos_venta");
    if (json.status) {
      let cont = 1;
      contenidot.innerHTML = ``;
      json.data.forEach((producto) => {
        let producto_list = ``;
        producto_list += `<div class="card m-2 col-12">
                                <img src="${
                                  base_url + producto.imagen
                                }" alt="" width="100%" height="150px">
                                <p class="card-text">${producto.nombre}</p>
                                <p>Precio: ${producto.precio}</p>
                                <p>Stock: ${producto.stock}</p>
                                <button onclick="agregar_producto_venta(${
                                  producto.id
                                })" class="btn btn-primary">Agregar</button>
                            </div>`;

        let nueva_fila = document.createElement("div");
        nueva_fila.className = "div col-md-3 col-sm-6 col-xs-12";
        nueva_fila.innerHTML = producto_list;
        cont++;
        contenidot.appendChild(nueva_fila);
        let id = document.getElementById('id_producto_venta');
        let precio = document.getElementById('producto_precio_venta');
        let cantidad = document.getElementById('producto_cantidad_venta');
        id.value = producto.id;
        precio.value = producto.precio;
        cantidad.value = 1;
      });
    }
  } catch (e) {
    console.log("error en mostrar producto " + e);
  }
}
if (document.getElementById("productos_venta")) {
  listar_productos_venta();
}

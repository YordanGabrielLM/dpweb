// Función para agregar producto a la lista de compra (temporal_venta)
async function agregar_producto_venta(id_producto) {
  try {
    // Primero obtener el precio del producto
    const datosProducto = new FormData();
    datosProducto.append('id_producto', id_producto);

    let respuestaProducto = await fetch(
      base_url + "control/productosController.php?tipo=ver",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datosProducto,
      }
    );
    let jsonProducto = await respuestaProducto.json();

    if (!jsonProducto.status) {
      console.log('Error: No se pudo obtener información del producto');
      return;
    }

    const datos = new FormData();
    datos.append('id_producto', id_producto);
    datos.append('precio', jsonProducto.data.precio);
    datos.append('cantidad', 1);

    let respuesta = await fetch(
      base_url + "control/VentaController.php?tipo=registrarTemporal",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
      }
    );
    let json = await respuesta.json();

    if (json.status) {
      // Actualizar la lista de compra inmediatamente
      listar_compra();
    }
  } catch (error) {
    console.log("Error en agregar producto a venta: " + error);
  }
}

// Función para listar productos en la lista de compra
async function listar_compra() {
  try {
    let respuesta = await fetch(
      base_url + "control/VentaController.php?tipo=listarTemporales",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
      }
    );
    let json = await respuesta.json();
    let contenido = document.getElementById("lista_compra");
    contenido.innerHTML = '';

    let subtotal = 0;

    if (json.status) {
      json.data.forEach((item) => {
        let total_item = parseFloat(item.precio) * parseInt(item.cantidad);
        subtotal += total_item;

        let fila = `<tr>
                    <td>${item.nombre_producto}</td>
                    <td>${item.cantidad}</td>
                    <td>$${parseFloat(item.precio).toFixed(2)}</td>
                    <td>$${total_item.toFixed(2)}</td>
                    <td><button onclick="eliminar_de_lista(${item.id})" class="btn btn-danger btn-sm">Eliminar</button></td>
                </tr>`;
        contenido.innerHTML += fila;
      });
    } else {
      contenido.innerHTML = '<tr><td colspan="5" class="text-center text-muted">No hay productos en la lista</td></tr>';
    }

    // Calcular IGV y total
    let igv = subtotal * 0.18;
    let total = subtotal + igv;

    document.getElementById("subtotal").textContent = '$' + subtotal.toFixed(2);
    document.getElementById("igv").textContent = '$' + igv.toFixed(2);
    document.getElementById("total").textContent = '$' + total.toFixed(2);

  } catch (error) {
    console.log("Error al listar compra: " + error);
  }
}

// Función para eliminar producto de la lista de compra
async function eliminar_de_lista(id) {
  try {
    const datos = new FormData();
    datos.append('id', id);

    let respuesta = await fetch(
      base_url + "control/VentaController.php?tipo=eliminarTemporal",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
      }
    );
    let json = await respuesta.json();

    if (json.status) {
      listar_compra();
    }
  } catch (error) {
    console.log("Error al eliminar de lista: " + error);
  }
}

// Función para realizar la venta
async function realizar_venta() {
  let subtotal = document.getElementById("subtotal").textContent;
  if (subtotal === '$0.00') {
    alert('Agregue productos a la lista antes de realizar la venta');
    return;
  }

  alert('Venta realizada correctamente');
  // Aquí puedes agregar la lógica para guardar la venta en la base de datos
}

// Función para agregar producto temporal (por si se usa con Enter)
async function agregar_producto_temporal() {
  let id = document.getElementById('id_producto_venta').value;
  let precio = document.getElementById('producto_precio_venta').value;
  let cantidad = document.getElementById('producto_cantidad_venta').value;

  if (!id || id === '') {
    return;
  }

  const datos = new FormData();
  datos.append('id_producto', id);
  datos.append('precio', precio);
  datos.append('cantidad', cantidad);

  try {
    let respuesta = await fetch(
      base_url + "control/VentaController.php?tipo=registrarTemporal",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
      }
    );
    let json = await respuesta.json();

    if (json.status) {
      listar_compra();
    }
  } catch (error) {
    console.log("Error en agregar producto temporal: " + error);
  }
}

// Cargar la lista de compra al iniciar la página
if (document.getElementById("lista_compra")) {
  listar_compra();
}

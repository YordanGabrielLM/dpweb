let productos_venta = {};

let id = 2;
let id2 = 4;

let producto = {};
producto.nombre = "Producto A";
producto.precio = 100;
producto.cantidad = 2;
//producto_venta.push(producto);
productos_venta[id]=producto;
console.log(productos_venta);

let producto2 = {};
producto.nombre = "Producto B";
producto.precio = 100;
producto.cantidad = 2;
//producto_venta.push(producto2);
productos_venta[id2]=producto2;
console.log(productos_venta);


console.log(productos_venta);

async function agregar_producto_temporal() {
   let id = document.getElementById('id_producto_venta').value;
   let precio = document.getElementById('producto_precio_venta').value;
   let cantidad = document.getElementById('producto_cantidad_venta').value;
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
    json = await respuesta.json();
    if (json.msg == "registrado") {
        alert("el producto fue registrado");
    }else{
        alert("el producto fue actualizado");
    }

    } catch (error) {
        console.log("error en agregar producto temporal" + error);
    }
}

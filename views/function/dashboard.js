// Estadísticas generales
function cargarEstadisticas() {
  fetch("controllers/dashboardController.php?tipo=estadisticas")
    .then(res => res.json())
    .then(data => {
      if (data.status) {
        const stats = data.data;
        document.getElementById("totalProductos").innerText = stats.productos;
        document.getElementById("totalCategorias").innerText = stats.categorias;
        document.getElementById("totalUsuarios").innerText = stats.usuarios;
      } else {
        console.error(data.msg);
      }
    })
    .catch(err => console.error("Error en cargarEstadisticas:", err));
}

// Productos con bajo stock
function cargarProductosStockBajo() {
  fetch("controllers/dashboardController.php?tipo=productos_stock_bajo")
    .then(res => res.json())
    .then(data => {
      if (data.status) {
        // renderiza lista en tu tabla
        console.log(data.data);
      }
    })
    .catch(err => console.error("Error en cargarProductosStockBajo:", err));
}

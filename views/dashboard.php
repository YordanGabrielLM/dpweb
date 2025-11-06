<!-- views/dashboard.php -->
<div class="container-fluid">
    <h4 class="mt-3 mb-4">Dashboard Principal</h4>
    
    <!-- Tarjetas de estadísticas -->
    <div class="row" id="estadisticas-dashboard">
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Productos</h6>
                            <h3 id="total-productos" class="mb-0">0</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-box fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Usuarios</h6>
                            <h3 id="total-usuarios" class="mb-0">0</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Clientes</h6>
                            <h3 id="total-clientes" class="mb-0">0</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-user-friends fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Proveedores</h6>
                            <h3 id="total-proveedores" class="mb-0">0</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-truck fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Stock Bajo</h6>
                            <h3 id="stock-bajo" class="mb-0">0</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-triangle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tablas de información -->
    <div class="row mt-4">
        <!-- Productos recientes -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-clock me-2"></i>Productos Recientes</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Proveedor</th>
                                </tr>
                            </thead>
                            <tbody id="productos-recientes">
                                <tr>
                                    <td colspan="4" class="text-center">Cargando...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Productos con stock bajo -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h6 class="mb-0"><i class="fas fa-exclamation-circle me-2"></i>Productos con Stock Bajo</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Stock</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="productos-stock-bajo">
                                <tr>
                                    <td colspan="3" class="text-center">Cargando...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones rápidas -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Acciones Rápidas</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 mb-2">
                            <a href="<?= BASE_URL ?>new-products" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus me-1"></i> Nuevo Producto
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-2">
                            <a href="<?= BASE_URL ?>new-user" class="btn btn-outline-success w-100">
                                <i class="fas fa-user-plus me-1"></i> Nuevo Usuario
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-2">
                            <a href="<?= BASE_URL ?>products" class="btn btn-outline-info w-100">
                                <i class="fas fa-list me-1"></i> Ver Productos
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-2">
                            <a href="<?= BASE_URL ?>users" class="btn btn-outline-warning w-100">
                                <i class="fas fa-users me-1"></i> Ver Usuarios
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para el dashboard -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    cargarEstadisticas();
    cargarProductosRecientes();
    cargarProductosStockBajo();
});

function cargarEstadisticas() {
    fetch('<?= BASE_URL ?>control/dashboardController.php?tipo=obtener_estadisticas')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-productos').textContent = data.total_productos;
            document.getElementById('total-usuarios').textContent = data.total_usuarios;
            document.getElementById('total-clientes').textContent = data.total_clientes;
            document.getElementById('total-proveedores').textContent = data.total_proveedores;
            document.getElementById('stock-bajo').textContent = data.stock_bajo;
        })
        .catch(error => console.error('Error:', error));
}

function cargarProductosRecientes() {
    fetch('<?= BASE_URL ?>control/dashboardController.php?tipo=obtener_productos_recientes')
        .then(response => response.json())
        .then(productos => {
            const tbody = document.getElementById('productos-recientes');
            tbody.innerHTML = '';
            
            if (productos.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center">No hay productos recientes</td></tr>';
                return;
            }
            
            productos.forEach(producto => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${producto.nombre}</td>
                    <td>S/. ${parseFloat(producto.precio).toFixed(2)}</td>
                    <td><span class="badge ${producto.stock < 10 ? 'bg-danger' : 'bg-success'}">${producto.stock}</span></td>
                    <td>${producto.proveedor || 'N/A'}</td>
                `;
                tbody.appendChild(tr);
            });
        })
        .catch(error => console.error('Error:', error));
}

function cargarProductosStockBajo() {
    fetch('<?= BASE_URL ?>control/dashboardController.php?tipo=obtener_stock_bajo')
        .then(response => response.json())
        .then(productos => {
            const tbody = document.getElementById('productos-stock-bajo');
            tbody.innerHTML = '';
            
            if (productos.length === 0) {
                tbody.innerHTML = '<tr><td colspan="3" class="text-center">No hay productos con stock bajo</td></tr>';
                return;
            }
            
            productos.forEach(producto => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${producto.nombre}</td>
                    <td><span class="badge bg-danger">${producto.stock}</span></td>
                    <td>
                        <a href="<?= BASE_URL ?>?view=edit-products&id=${producto.id}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        })
        .catch(error => console.error('Error:', error));
}

// Actualizar cada 30 segundos
setInterval(() => {
    cargarEstadisticas();
    cargarProductosRecientes();
    cargarProductosStockBajo();
}, 30000);
</script>
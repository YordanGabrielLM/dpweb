<div class="container-fluid">
    <!-- Header de la tienda -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="fas fa-store me-2"></i>Nuestra Tienda</h2>
                <div class="d-flex gap-2">
                    <!-- Carrito -->
                    <button class="btn btn-outline-primary position-relative" onclick="verCarrito()">
                        <i class="fas fa-shopping-cart"></i> Carrito
                        <span id="carrito-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                    </button>
                    <!-- Filtros móvil -->
                    <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtersOffcanvas">
                        <i class="fas fa-filter"></i> Filtros
                    </button>
                </div>
            </div>
            <p class="text-muted">Encuentra los mejores productos al mejor precio</p>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar de filtros (Desktop) -->
        <div class="col-lg-3 d-none d-lg-block">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filtros</h6>
                </div>
                <div class="card-body">
                    <!-- Buscador -->
                    <div class="mb-3">
                        <label class="form-label">Buscar producto</label>
                        <input type="text" class="form-control" id="search-input" placeholder="Nombre del producto...">
                    </div>
                    
                    <!-- Filtro por categoría -->
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" id="category-filter">
                            <option value="">Todas las categorías</option>
                            <!-- Las categorías se cargarán dinámicamente -->
                        </select>
                    </div>
                    
                    <!-- Filtro por precio -->
                    <div class="mb-3">
                        <label class="form-label">Precio máximo</label>
                        <input type="range" class="form-range" id="price-range" min="0" max="1000" step="10" value="1000">
                        <div class="d-flex justify-content-between">
                            <small>S/. 0</small>
                            <small>S/. <span id="price-value">1000</span></small>
                        </div>
                    </div>
                    
                    <!-- Filtro por stock -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="stock-filter">
                            <label class="form-check-label" for="stock-filter">
                                Solo productos en stock
                            </label>
                        </div>
                    </div>
                    
                    <!-- Botones de acción -->
                    <button class="btn btn-primary w-100 mb-2" onclick="aplicarFiltros()">
                        <i class="fas fa-check me-1"></i>Aplicar Filtros
                    </button>
                    <button class="btn btn-outline-secondary w-100" onclick="limpiarFiltros()">
                        <i class="fas fa-times me-1"></i>Limpiar
                    </button>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-lg-9">
            <!-- Barra de herramientas -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <span class="me-2">Ordenar por:</span>
                        <select class="form-select form-select-sm" id="sort-select" onchange="ordenarProductos()">
                            <option value="name_asc">Nombre A-Z</option>
                            <option value="name_desc">Nombre Z-A</option>
                            <option value="price_asc">Precio: Menor a Mayor</option>
                            <option value="price_desc">Precio: Mayor a Menor</option>
                            <option value="newest">Más recientes</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <span id="product-count" class="text-muted">Cargando productos...</span>
                </div>
            </div>

            <!-- Grid de productos -->
            <div class="row" id="productos-grid">
                <!-- Los productos se cargarán aquí dinámicamente -->
                <div class="col-12 text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-2">Cargando productos...</p>
                </div>
            </div>

            <!-- Paginación -->
            <div class="row mt-4">
                <div class="col-12">
                    <nav aria-label="Paginación de productos">
                        <ul class="pagination justify-content-center" id="pagination">
                            <!-- La paginación se generará dinámicamente -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas para filtros móvil -->
<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="filtersOffcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filtros</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <!-- El mismo contenido de filtros que en el sidebar -->
        <div class="mb-3">
            <label class="form-label">Buscar producto</label>
            <input type="text" class="form-control" id="search-input-mobile" placeholder="Nombre del producto...">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select class="form-select" id="category-filter-mobile">
                <option value="">Todas las categorías</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Precio máximo</label>
            <input type="range" class="form-range" id="price-range-mobile" min="0" max="1000" step="10" value="1000">
            <div class="d-flex justify-content-between">
                <small>S/. 0</small>
                <small>S/. <span id="price-value-mobile">1000</span></small>
            </div>
        </div>
        
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="stock-filter-mobile">
                <label class="form-check-label" for="stock-filter-mobile">
                    Solo productos en stock
                </label>
            </div>
        </div>
        
        <button class="btn btn-primary w-100 mb-2" onclick="aplicarFiltros()" data-bs-dismiss="offcanvas">
            <i class="fas fa-check me-1"></i>Aplicar Filtros
        </button>
        <button class="btn btn-outline-secondary w-100" onclick="limpiarFiltros()">
            <i class="fas fa-times me-1"></i>Limpiar
        </button>
    </div>
</div>

<!-- Modal para detalles del producto -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalTitle">Detalles del Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="productModalBody">
                <!-- Contenido dinámico -->
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>views/function/tienda.js"></script>
class Tienda {
    constructor() {
        this.productos = [];
        this.productosFiltrados = [];
        this.carrito = JSON.parse(localStorage.getItem('carrito_tienda')) || [];
        this.filtros = {
            search: '',
            category: '',
            maxPrice: 1000,
            inStock: false
        };
        this.orden = 'name_asc';
        this.productosPorPagina = 12;
        this.paginaActual = 1;
        
        console.log('🛒 Tienda inicializada');
        this.init();
    }

    async init() {
        try {
            await this.cargarProductos();
            await this.cargarCategorias();
            this.actualizarContadorCarrito();
            this.renderizarProductos();
            this.configurarEventos();
            console.log('✅ Tienda cargada correctamente');
        } catch (error) {
            console.error('❌ Error inicializando tienda:', error);
            this.mostrarError('Error al cargar la tienda');
        }
    }

    async cargarProductos() {
        try {
            console.log('📦 Cargando productos...');
            
            // CORRECCIÓN: productsController.php (no productosController.php)
            const response = await fetch(`${base_url}control/productosController.php?tipo=mostrar_productos`);
            
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            
            const productos = await response.json();
            console.log('✅ Productos cargados:', productos);
            
            if (!Array.isArray(productos)) {
                throw new Error('La respuesta no es un array válido');
            }
            
            this.productos = productos;
            this.productosFiltrados = [...productos];
            
        } catch (error) {
            console.error('❌ Error cargando productos:', error);
            this.mostrarError('Error al cargar los productos');
            this.productos = [];
            this.productosFiltrados = [];
        }
    }

    async cargarCategorias() {
        try {
            console.log('🏷️ Cargando categorías...');
            
            // CORRECCIÓN: ver_categorias (no mostrar_categorias)
            const response = await fetch(`${base_url}control/categoriaController.php?tipo=ver_categorias`);
            
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            
            const resultado = await response.json();
            console.log('✅ Respuesta categorías:', resultado);
            
            // CORRECCIÓN: La respuesta tiene estructura {status, msg, data}
            if (resultado.status && Array.isArray(resultado.data)) {
                this.llenarSelectCategorias(resultado.data);
            } else {
                console.warn('⚠️ No se pudieron cargar las categorías:', resultado.msg);
                this.llenarSelectCategorias([]); // Cargar vacío
            }
            
        } catch (error) {
            console.error('❌ Error cargando categorías:', error);
            this.llenarSelectCategorias([]); // Cargar vacío en caso de error
        }
    }

    llenarSelectCategorias(categorias) {
        const selectDesktop = document.getElementById('category-filter');
        const selectMobile = document.getElementById('category-filter-mobile');
        
        if (!selectDesktop || !selectMobile) {
            console.warn('⚠️ No se encontraron los selects de categorías');
            return;
        }
        
        let optionsHTML = '<option value="">Todas las categorías</option>';
        
        if (Array.isArray(categorias) && categorias.length > 0) {
            categorias.forEach(categoria => {
                optionsHTML += `<option value="${categoria.id}">${categoria.nombre}</option>`;
            });
            console.log(`✅ ${categorias.length} categorías cargadas`);
        } else {
            optionsHTML += '<option value="">No hay categorías disponibles</option>';
            console.warn('⚠️ No hay categorías para mostrar');
        }
        
        selectDesktop.innerHTML = optionsHTML;
        selectMobile.innerHTML = optionsHTML;
    }

    configurarEventos() {
        console.log('⚙️ Configurando eventos...');
        
        // Eventos de búsqueda
        const searchInput = document.getElementById('search-input');
        const searchInputMobile = document.getElementById('search-input-mobile');
        
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                this.filtros.search = e.target.value;
                this.aplicarFiltros();
            });
        }
        
        if (searchInputMobile) {
            searchInputMobile.addEventListener('input', (e) => {
                this.filtros.search = e.target.value;
                this.aplicarFiltros();
            });
        }

        // Eventos de categoría
        const categoryFilter = document.getElementById('category-filter');
        const categoryFilterMobile = document.getElementById('category-filter-mobile');
        
        if (categoryFilter) {
            categoryFilter.addEventListener('change', (e) => {
                this.filtros.category = e.target.value;
                this.aplicarFiltros();
            });
        }
        
        if (categoryFilterMobile) {
            categoryFilterMobile.addEventListener('change', (e) => {
                this.filtros.category = e.target.value;
                this.aplicarFiltros();
            });
        }

        // Eventos de precio
        const priceRange = document.getElementById('price-range');
        const priceRangeMobile = document.getElementById('price-range-mobile');
        
        if (priceRange) {
            priceRange.addEventListener('input', (e) => {
                this.filtros.maxPrice = parseInt(e.target.value);
                document.getElementById('price-value').textContent = e.target.value;
                this.aplicarFiltros();
            });
        }
        
        if (priceRangeMobile) {
            priceRangeMobile.addEventListener('input', (e) => {
                this.filtros.maxPrice = parseInt(e.target.value);
                document.getElementById('price-value-mobile').textContent = e.target.value;
                this.aplicarFiltros();
            });
        }

        // Eventos de stock
        const stockFilter = document.getElementById('stock-filter');
        const stockFilterMobile = document.getElementById('stock-filter-mobile');
        
        if (stockFilter) {
            stockFilter.addEventListener('change', (e) => {
                this.filtros.inStock = e.target.checked;
                this.aplicarFiltros();
            });
        }
        
        if (stockFilterMobile) {
            stockFilterMobile.addEventListener('change', (e) => {
                this.filtros.inStock = e.target.checked;
                this.aplicarFiltros();
            });
        }
        
        console.log('✅ Eventos configurados correctamente');
    }

    aplicarFiltros() {
        console.log('🔍 Aplicando filtros:', this.filtros);
        
        this.productosFiltrados = this.productos.filter(producto => {
            // Filtro de búsqueda
            const coincideBusqueda = !this.filtros.search || 
                producto.nombre.toLowerCase().includes(this.filtros.search.toLowerCase()) ||
                (producto.detalle && producto.detalle.toLowerCase().includes(this.filtros.search.toLowerCase()));

            // Filtro de categoría
            const coincideCategoria = !this.filtros.category || 
                producto.id_categoria == this.filtros.category;

            // Filtro de precio
            const coincidePrecio = parseFloat(producto.precio) <= this.filtros.maxPrice;

            // Filtro de stock
            const coincideStock = !this.filtros.inStock || (producto.stock > 0);

            return coincideBusqueda && coincideCategoria && coincidePrecio && coincideStock;
        });

        console.log(`📊 Productos después de filtrar: ${this.productosFiltrados.length} de ${this.productos.length}`);
        
        this.paginaActual = 1;
        this.ordenarYRenderizar();
    }

    limpiarFiltros() {
        console.log('🧹 Limpiando filtros...');
        
        this.filtros = {
            search: '',
            category: '',
            maxPrice: 1000,
            inStock: false
        };

        // Limpiar inputs
        const elementsToClear = [
            'search-input', 'search-input-mobile',
            'category-filter', 'category-filter-mobile',
            'stock-filter', 'stock-filter-mobile'
        ];

        elementsToClear.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                if (element.type === 'text' || element.type === 'search') {
                    element.value = '';
                } else if (element.type === 'select-one') {
                    element.value = '';
                } else if (element.type === 'checkbox') {
                    element.checked = false;
                }
            }
        });

        // Resetear sliders de precio
        const priceRange = document.getElementById('price-range');
        const priceRangeMobile = document.getElementById('price-range-mobile');
        if (priceRange) priceRange.value = 1000;
        if (priceRangeMobile) priceRangeMobile.value = 1000;

        const priceValue = document.getElementById('price-value');
        const priceValueMobile = document.getElementById('price-value-mobile');
        if (priceValue) priceValue.textContent = '1000';
        if (priceValueMobile) priceValueMobile.textContent = '1000';

        this.aplicarFiltros();
    }

    ordenarProductos() {
        const sortSelect = document.getElementById('sort-select');
        if (sortSelect) {
            this.orden = sortSelect.value;
            this.ordenarYRenderizar();
        }
    }

    ordenarYRenderizar() {
        console.log(`🔄 Ordenando por: ${this.orden}`);
        
        // Aplicar ordenamiento
        switch(this.orden) {
            case 'name_asc':
                this.productosFiltrados.sort((a, b) => a.nombre.localeCompare(b.nombre));
                break;
            case 'name_desc':
                this.productosFiltrados.sort((a, b) => b.nombre.localeCompare(a.nombre));
                break;
            case 'price_asc':
                this.productosFiltrados.sort((a, b) => parseFloat(a.precio) - parseFloat(b.precio));
                break;
            case 'price_desc':
                this.productosFiltrados.sort((a, b) => parseFloat(b.precio) - parseFloat(a.precio));
                break;
            case 'newest':
                this.productosFiltrados.sort((a, b) => b.id - a.id);
                break;
        }

        this.renderizarProductos();
    }

    renderizarProductos() {
        const grid = document.getElementById('productos-grid');
        if (!grid) {
            console.error('❌ No se encontró el contenedor de productos');
            return;
        }

        const totalProductos = this.productosFiltrados.length;
        
        // Actualizar contador
        const productCount = document.getElementById('product-count');
        if (productCount) {
            productCount.textContent = 
                `${totalProductos} producto${totalProductos !== 1 ? 's' : ''} encontrado${totalProductos !== 1 ? 's' : ''}`;
        }

        if (totalProductos === 0) {
            grid.innerHTML = `
                <div class="col-12 text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No se encontraron productos</h4>
                    <p class="text-muted">Intenta con otros filtros de búsqueda</p>
                    <button class="btn btn-primary" onclick="tienda.limpiarFiltros()">
                        <i class="fas fa-times me-1"></i>Limpiar filtros
                    </button>
                </div>
            `;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        // Calcular paginación
        const totalPaginas = Math.ceil(totalProductos / this.productosPorPagina);
        const inicio = (this.paginaActual - 1) * this.productosPorPagina;
        const fin = inicio + this.productosPorPagina;
        const productosPagina = this.productosFiltrados.slice(inicio, fin);

        // Renderizar productos
        grid.innerHTML = productosPagina.map(producto => this.crearCardProducto(producto)).join('');

        // Renderizar paginación
        this.renderizarPaginacion(totalPaginas);
        
        console.log(`🎨 Renderizados ${productosPagina.length} productos (página ${this.paginaActual} de ${totalPaginas})`);
    }

    crearCardProducto(producto) {
        const precio = parseFloat(producto.precio).toFixed(2);
        const stockStatus = producto.stock > 0 ? 
            `<span class="badge bg-success">En stock (${producto.stock})</span>` : 
            `<span class="badge bg-danger">Sin stock</span>`;
        
        const botonAgregar = producto.stock > 0 ? 
            `<button class="btn btn-primary btn-sm" onclick="tienda.agregarAlCarrito(${producto.id})">
                <i class="fas fa-cart-plus me-1"></i>Agregar
            </button>` :
            `<button class="btn btn-secondary btn-sm" disabled>
                <i class="fas fa-times me-1"></i>Sin stock
            </button>`;

        // Manejar imagen - si no tiene imagen, usar placeholder
        const imagenSrc = producto.imagen ? 
            `${base_url}${producto.imagen}` : 
            'https://via.placeholder.com/300x200?text=Sin+Imagen';

        // Manejar descripción
        const descripcion = producto.detalle ? 
            producto.detalle.substring(0, 80) + '...' : 
            'Sin descripción disponible';

        return `
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card h-100 product-card shadow-sm">
                    <div class="position-relative">
                        <img src="${imagenSrc}" 
                             class="card-img-top" 
                             alt="${producto.nombre}"
                             style="height: 200px; object-fit: cover; cursor: pointer;"
                             onclick="tienda.mostrarDetalles(${producto.id})"
                             onerror="this.src='https://via.placeholder.com/300x200?text=Error+Imagen'">
                        <div class="position-absolute top-0 end-0 m-2">
                            ${stockStatus}
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">${producto.nombre}</h6>
                        <p class="card-text text-muted small flex-grow-1">${descripcion}</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="text-primary mb-0">S/. ${precio}</h5>
                                ${botonAgregar}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    renderizarPaginacion(totalPaginas) {
        const pagination = document.getElementById('pagination');
        if (!pagination) return;
        
        if (totalPaginas <= 1) {
            pagination.innerHTML = '';
            return;
        }

        let html = '';
        
        // Botón anterior
        html += `
            <li class="page-item ${this.paginaActual === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="tienda.cambiarPagina(${this.paginaActual - 1}); return false;">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        `;

        // Números de página
        for (let i = 1; i <= totalPaginas; i++) {
            if (i === 1 || i === totalPaginas || (i >= this.paginaActual - 1 && i <= this.paginaActual + 1)) {
                html += `
                    <li class="page-item ${i === this.paginaActual ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="tienda.cambiarPagina(${i}); return false;">${i}</a>
                    </li>
                `;
            } else if (i === this.paginaActual - 2 || i === this.paginaActual + 2) {
                html += '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        // Botón siguiente
        html += `
            <li class="page-item ${this.paginaActual === totalPaginas ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="tienda.cambiarPagina(${this.paginaActual + 1}); return false;">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        `;

        pagination.innerHTML = html;
    }

    cambiarPagina(pagina) {
        this.paginaActual = pagina;
        this.renderizarProductos();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    async mostrarDetalles(productoId) {
        try {
            console.log(`🔍 Mostrando detalles del producto: ${productoId}`);
            
            const response = await fetch(`${base_url}control/productosController.php?tipo=ver`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id_producto=${productoId}`
            });
            
            const result = await response.json();
            
            if (result.status && result.data) {
                const producto = result.data;
                this.mostrarModalProducto(producto);
            } else {
                this.mostrarError(result.msg || 'Error al cargar detalles del producto');
            }
        } catch (error) {
            console.error('❌ Error cargando detalles:', error);
            this.mostrarError('Error al cargar los detalles del producto');
        }
    }

    mostrarModalProducto(producto) {
        const precio = parseFloat(producto.precio).toFixed(2);
        const stockStatus = producto.stock > 0 ? 
            `<span class="badge bg-success">En stock</span>` : 
            `<span class="badge bg-danger">Sin stock</span>`;
        
        const botonAgregar = producto.stock > 0 ? 
            `<button class="btn btn-primary" onclick="tienda.agregarAlCarrito(${producto.id})">
                <i class="fas fa-cart-plus me-1"></i>Agregar al carrito
            </button>` :
            `<button class="btn btn-secondary" disabled>
                <i class="fas fa-times me-1"></i>Producto no disponible
            </button>`;

        // Manejar imagen
        const imagenSrc = producto.imagen ? 
            `${base_url}${producto.imagen}` : 
            'https://via.placeholder.com/500x300?text=Sin+Imagen';

        document.getElementById('productModalTitle').textContent = producto.nombre;
        document.getElementById('productModalBody').innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <img src="${imagenSrc}" 
                         class="img-fluid rounded" 
                         alt="${producto.nombre}"
                         onerror="this.src='https://via.placeholder.com/500x300?text=Error+Imagen'">
                </div>
                <div class="col-md-6">
                    <h4 class="text-primary">S/. ${precio}</h4>
                    <p class="text-muted">${producto.detalle || 'Sin descripción disponible'}</p>
                    
                    <div class="mb-3">
                        <strong>Stock disponible:</strong> ${producto.stock} unidades
                        ${stockStatus}
                    </div>
                    
                    ${producto.fecha_vencimiento ? `
                    <div class="mb-3">
                        <strong>Fecha de vencimiento:</strong> 
                        ${new Date(producto.fecha_vencimiento).toLocaleDateString()}
                    </div>
                    ` : ''}
                    
                    <div class="d-grid gap-2">
                        ${botonAgregar}
                        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Cerrar
                        </button>
                    </div>
                </div>
            </div>
        `;

        const modal = new bootstrap.Modal(document.getElementById('productModal'));
        modal.show();
    }

    agregarAlCarrito(productoId) {
        console.log(`🛒 Agregando producto al carrito: ${productoId}`);
        
        const producto = this.productos.find(p => p.id == productoId);
        
        if (!producto) {
            this.mostrarError('Producto no encontrado');
            return;
        }
        
        if (producto.stock <= 0) {
            this.mostrarError('Este producto no está disponible en stock', 'error');
            return;
        }

        const itemExistente = this.carrito.find(item => item.id == productoId);
        
        if (itemExistente) {
            if (itemExistente.cantidad >= producto.stock) {
                this.mostrarError('No hay suficiente stock disponible', 'error');
                return;
            }
            itemExistente.cantidad += 1;
        } else {
            this.carrito.push({
                id: producto.id,
                nombre: producto.nombre,
                precio: parseFloat(producto.precio),
                imagen: producto.imagen,
                cantidad: 1,
                stock: producto.stock
            });
        }

        this.guardarCarrito();
        this.actualizarContadorCarrito();
        this.mostrarAlerta('✅ Producto agregado al carrito', 'success');
    }

    guardarCarrito() {
        localStorage.setItem('carrito_tienda', JSON.stringify(this.carrito));
    }

    actualizarContadorCarrito() {
        const totalItems = this.carrito.reduce((sum, item) => sum + item.cantidad, 0);
        const carritoCount = document.getElementById('carrito-count');
        if (carritoCount) {
            carritoCount.textContent = totalItems;
        }
    }

    verCarrito() {
        this.mostrarAlerta('🛒 Funcionalidad del carrito en desarrollo', 'info');
    }

    mostrarAlerta(mensaje, tipo = 'info') {
        // Crear alerta temporal
        const alerta = document.createElement('div');
        alerta.className = `alert alert-${tipo === 'error' ? 'danger' : tipo} alert-dismissible fade show position-fixed`;
        alerta.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alerta.innerHTML = `
            ${mensaje}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alerta);
        
        setTimeout(() => {
            if (alerta.parentNode) {
                alerta.remove();
            }
        }, 3000);
    }

    mostrarError(mensaje) {
        this.mostrarAlerta(mensaje, 'error');
    }
}

// Inicializar tienda cuando el DOM esté listo
let tienda;
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM cargado, inicializando tienda...');
    tienda = new Tienda();
});

// Funciones globales para los eventos HTML
function aplicarFiltros() {
    if (tienda) tienda.aplicarFiltros();
}

function limpiarFiltros() {
    if (tienda) tienda.limpiarFiltros();
}

function ordenarProductos() {
    if (tienda) tienda.ordenarProductos();
}

function verCarrito() {
    if (tienda) tienda.verCarrito();
}
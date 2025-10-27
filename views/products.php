<div class="container">
    <h5 class="mt-3 text-center">Lista de Productos</h5>
    <button type="button" class="btn btn-success" onclick="nuevoProducto()">
            + Nuevo Producto
        </button>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoria</th>
                <th>F.V.</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody id="content_productos">
        </tbody>

    </table>
</div>

<script src="<?php echo BASE_URL; ?>views/function/Producto.js"></script>
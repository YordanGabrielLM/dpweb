<div class="container">
    <h5 class="mt-3 text-center">Lista de Categorias</h5>
    <a href="<?php echo BASE_URL; ?>new-categoria" class="btn btn-success">
    + Nueva Categoría
  </a>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody id="content_categorias">
        </tbody>

    </table>
</div>

<script src="<?php echo BASE_URL; ?>views/function/Categoria.js"></script>
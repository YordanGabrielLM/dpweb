
<!-- Inicio de cuerpo de Página -->
    <div class="container mt-5">
        <div class="card">
            <h5 class="card-header">Registro de Categoría</h5>
            <form id="frm_categoria" action="" method="post">
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="detalle" class="col-sm-2 col-form-label">Detalle:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="detalle" name="detalle" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Registrar</button>
                    <button type="reset" class="btn btn-secondary">Limpiar</button>
                    <button type="button" class="btn btn-danger">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
<!-- Fin de cuerpo de Página -->
<script src="<?php echo BASE_URL; ?>views/function/Categoria.js"></script>


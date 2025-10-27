<!-- Inicio de cuerpo de Página -->
    <div class="container-fluid">
        <div class="card shadow-sm">
            <h5 class="card-header">Registro de Clientes</h5>
            <form id="frm_cliente" action="" method="">
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="nro_identidad" class="col-sm-2 col-form-label">Nro identidad</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="11" class="form-control" id="nro_identidad" name="nro_identidad" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="razon_social" class="col-sm-2 col-form-label">Razón Social</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="130" class="form-control" id="razon_social" name="razon_social" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="15" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                        <div class="col-sm-10">
                            <input type="email" maxlength="100" class="form-control" id="correo" name="correo" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="departamento" class="col-sm-2 col-form-label">Departamento</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="20" class="form-control" id="departamento" name="departamento" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="provincia" class="col-sm-2 col-form-label">Provincia</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="30" class="form-control" id="provincia" name="provincia" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="distrito" class="col-sm-2 col-form-label">Distrito</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="50" class="form-control" id="distrito" name="distrito" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="cod_postal" class="col-sm-2 col-form-label">Código Postal</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="cod_postal" name="cod_postal" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="150" class="form-control" id="direccion" name="direccion" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="rol" class="col-sm-2 col-form-label">Rol</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="rol" name="rol">
                                <option value="Cliente" selected>Cliente</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button type="submit" class="btn btn-success">Registrar</button>
                      <button type="reset" class="btn btn-secondary">Limpiar</button>
                      <button type="button" class="btn btn-danger">Cancelar</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin de cuerpo de Página -->
 <script src="<?php echo BASE_URL; ?>views/function/clientes.js"></script>
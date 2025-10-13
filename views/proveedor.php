<div class="container">
    <h4 class="mt-3 mb-3">Lista de Proveedores</h4>
    <button type="button" class="btn btn-success" onclick="nuevoProveedor()">
            + Agregar Proveedor
        </button>
<table class="table table-striped-columns">
    <thead>
        <tr>
            <th class="text-center">Nro</th>
            <th class="text-center">DNI</th>
            <th class="text-center">Nombres y Apellidos</th>
            <th class="text-center">Correo</th>
            <th class="text-center">Rol</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Acciones</th>

        </tr>
    </thead>
    <tbody id="content_proveedor">
        
    </tbody>
</table>
</div>
<script src="<?= BASE_URL ?>views/function/proveedor.js"></script>
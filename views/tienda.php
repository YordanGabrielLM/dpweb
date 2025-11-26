<div class="container-fluid mt-4 row">
    <h2>Ventas</h2>
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Busqueda de Productos</h5>
                <div class="row mb-3">
                    <div class="col-12">
                        <input type="text" id="buscar_producto" class="form-control" placeholder="Buscar por nombre o código...">
                    </div>
                </div>
                <div class="row container-fluid" id="productos_venta">
                    <div class="card m-2 col-3">
                        <div class="card-body">
                            <img src="https://www.agenciaeplus.com.br/wp-content/uploads/2021/12/pagina-de-produto.jpg" alt="" width="100%" height="150px">
                            <p class="card-text">Descripcion del producto</p>
                            <button class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lista de Compra</h5>
                <div class="row" style="min-height: 500px;">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="lista_compra">
                                <tr>
                                    <td>Producto 1</td>
                                    <td>2</td>
                                    <td>$10.00</td>
                                    <td>$20.00</td>
                                    <td><button class="btn btn-danger btn-sm">Eliminar</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <h4>Subtotal : <label id="subtotal">$0.00</label></h4>
                        <h4>IGV (18%) : <label id="igv">$0.00</label></h4>
                        <h4>Total : <label id="total">$0.00</label></h4>
                        <button class="btn btn-success" onclick="realizar_venta()">Realizar Venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>views/function/Producto.js"></script>

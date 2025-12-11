<div class="container-fluid mt-4 row">
    <h2>Ventas</h2>
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Busqueda de Productos</h5>
                <div class="row mb-3">
                    <div class="col-12">
                        <input type="text" id="busqueda_venta" class="form-control" placeholder="Buscar por nombre o código..." onkeyup="listar_productos_venta();">
                        <input type="hidden" id="id_producto_venta">
                        <input type="hidden" id="producto_precio_venta">
                        <input type="hidden" id="producto_cantidad_venta" value="1">
                    </div>
                </div>
                <div class="row container-fluid" id="productos_venta">
                    <!--<div class="card m-2 col-3">
                        <div class="card-body">
                            <img src="https://www.agenciaeplus.com.br/wp-content/uploads/2021/12/pagina-de-produto.jpg" alt="" width="100%" height="150px">
                            <p class="card-text">Descripcion del producto</p>
                            <button class="btn btn-primary">Agregar</button>
                        </div>
                    </div>-->
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
                                <!-- Los productos se cargan dinámicamente -->
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
<script src="<?php echo BASE_URL; ?>views/function/venta.js"></script>
<script>
    let input = document.getElementById("busqueda_venta");
    input.addEventListener('keydown', (event)=>{
        if (event.key =='Enter') {
            agregar_producto_temporal();
        }
    })
</script>



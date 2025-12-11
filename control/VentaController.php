<?php
require_once("../model/VentaModel.php");
require_once("../model/ProductsModel.php");

$objProducto = new ProductsModel();
$objVenta = new VentaModel();

$tipo = $_GET['tipo'];

// Registrar producto en temporal_venta
if ($tipo == "registrarTemporal") {
    $respuesta = array('status'=> false, 'msg' => 'fallo el controlador');
    $id_producto = $_POST['id_producto'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    
    $b_producto = $objVenta->buscarTemporal($id_producto);
    if ($b_producto) {
        $n_cantidad = $b_producto->cantidad + 1;
        $objVenta->actualizarCantidadTemporal($id_producto, $n_cantidad);
        $respuesta = array('status' => true, 'msg' => 'actualizado');
    }else{
        $registro = $objVenta->registrar_temporal($id_producto, $precio, $cantidad);
        $respuesta = array('status'=> true, 'msg' => 'registrado');
    }
    echo json_encode($respuesta);
}

// Listar productos temporales para la lista de compra
if ($tipo == "listarTemporales") {
    $respuesta = array('status'=> false, 'msg' => 'No hay productos en la lista');
    $productos = $objVenta->buscarTemporales();
    if (count($productos) > 0) {
        $respuesta = array('status' => true, 'data' => $productos);
    }
    echo json_encode($respuesta);
}

// Eliminar producto de temporal_venta
if ($tipo == "eliminarTemporal") {
    $respuesta = array('status'=> false, 'msg' => 'Error al eliminar');
    $id = $_POST['id'];
    $resultado = $objVenta->eliminarTemporal($id);
    if ($resultado) {
        $respuesta = array('status' => true, 'msg' => 'Producto eliminado de la lista');
    }
    echo json_encode($respuesta);
}

// Limpiar toda la lista temporal
if ($tipo == "limpiarTemporales") {
    $respuesta = array('status'=> false, 'msg' => 'Error al limpiar');
    $resultado = $objVenta->eliminarTemporales();
    if ($resultado) {
        $respuesta = array('status' => true, 'msg' => 'Lista limpiada');
    }
    echo json_encode($respuesta);
}

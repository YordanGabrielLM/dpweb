<?php
require_once("../model/ProductsModel.php");
require_once("../model/CategoriaModel.php");

$objProducto = new ProductsModel();
$objCategoria = new CategoriaModel();

$tipo = $_GET['tipo'];
if ($tipo === "registrar") {
    $codigo            = $_POST['codigo'] ?? '';
    $nombre            = $_POST['nombre'] ?? '';
    $detalle           = $_POST['detalle'] ?? '';
    $precio            = $_POST['precio'] ?? '';
    $stock             = $_POST['stock'] ?? '';
    $id_categoria      = $_POST['id_categoria'] ?? '';
    $fecha_vencimiento = $_POST['fecha_vencimiento'] ?? '';
    $id_proveedor = $_POST['id_proveedor'] ?? '';

    if ($codigo === "" || $nombre === "" || $detalle === "" || $precio === "" || $stock === "" || $id_categoria === "" || $fecha_vencimiento === "" || $id_proveedor === "") {
        echo json_encode(['status' => false, 'msg' => 'Error, campos vacíos']);
        exit;
    }
    if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['status' => false, 'msg' => 'Error, imagen no recibida']);
        exit;
    }
    if ($objProducto->existeCodigo($codigo) > 0) {
        echo json_encode(['status' => false, 'msg' => 'Error, el código ya existe']);
        exit;
    }
    $file = $_FILES['imagen'];
    $ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $extPermitidas = ['jpg', 'jpeg', 'png', 'webp', 'jfif'];

    if (!in_array($ext, $extPermitidas)) {
        echo json_encode(['status' => false, 'msg' => 'Formato de imagen no permitido']);
        exit;
    }
    if ($file['size'] > 5 * 1024 * 1024) { // 5MB
        echo json_encode(['status' => false, 'msg' => 'La imagen supera 2MB']);
        exit;
    }
    $carpetaUploads = "../uploads/productos/";
    if (!is_dir($carpetaUploads)) {
        @mkdir($carpetaUploads, 0775, true);
    }

    $nombreUnico = uniqid('prod_') . '.' . $ext;
    $rutaFisica  = $carpetaUploads . $nombreUnico;
    $rutaRelativa = "uploads/productos/" . $nombreUnico;

    if (!move_uploaded_file($file['tmp_name'], $rutaFisica)) {
        echo json_encode(['status' => false, 'msg' => 'No se pudo guardar la imagen']);
        exit;
    }
    $id = $objProducto->registrar($codigo,$nombre,$detalle,$precio,$stock,$id_categoria,$fecha_vencimiento,$rutaRelativa, $id_proveedor);
    if ($id > 0) {
        echo json_encode(['status' => true, 'msg' => 'Registrado correctamente', 'id' => $id, 'img' => $rutaRelativa]);
    } else {
        @unlink($rutaFisica); // revertir archivo si falló BD
        echo json_encode(['status' => false, 'msg' => 'Error, falló en registro']);
    }
    exit;
}

if ($tipo == "ver_productos") {
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $productos = $objProducto->verProductos();
    $arrProduct = array();
    if (count($productos)) {
        foreach ($productos as $producto) {
            $categoria = $objCategoria->ver($producto->id_categoria);
            $producto->categoria = $categoria->nombre;
            array_push($arrProduct, $producto);
        }
        $respuesta = array('status' => true, 'msg' => '', 'data' => $arrProduct);
    }
    echo json_encode($respuesta);
}

if ($tipo == "ver") {
    $respuesta = array('status' => false, 'msg' => '');
    $id_producto = $_POST['id_producto'];
    $producto = $objProducto->ver($id_producto);
    if($producto){
        $respuesta ['status'] = true;
        $respuesta ['data'] = $producto;
    }else {
        $respuesta['msg'] = "Error, producto no existe";
    }
    echo json_encode($respuesta);
}


if ($tipo == "actualizar") {
    $id_producto = $_POST['id_producto'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $id_proveedor = $_POST['id_proveedor'];
    $imagen_actual = $_POST['imagen_actual'];

    if ($id_producto == "" || $codigo == "" || $nombre == "" || $detalle == "" || $precio == "" || $stock == "" || $id_categoria == "" || $fecha_vencimiento == "" || $id_proveedor == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error, campos vacios');
        echo json_encode($arrResponse);
        exit;
    }
    $existeID = $objProducto->ver($id_producto);
    if(!$existeID){
        $arrResponse = array('status' =>false, 'msg' => 'Error, producto no existe');
        echo json_encode($arrResponse);
        exit;
    }
    $imagen = $imagen_actual; // por defecto la imagen actual
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Nueva imagen subida
        $file = $_FILES['imagen'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $extPermitidas = ['jpg', 'jpeg', 'png', 'webp', 'jfif'];
        if (!in_array($ext, $extPermitidas)) {
            echo json_encode(['status' => false, 'msg' => 'Formato de imagen no permitido']);
            exit;
        }
        if ($file['size'] > 5 * 1024 * 1024) {
            echo json_encode(['status' => false, 'msg' => 'La imagen supera 5MB']);
            exit;
        }
        $carpetaUploads = "../uploads/productos/";
        if (!is_dir($carpetaUploads)) {
            @mkdir($carpetaUploads, 0775, true);
        }
        $nombreUnico = uniqid('prod_') . '.' . $ext;
        $rutaFisica = $carpetaUploads . $nombreUnico;
        $rutaRelativa = "uploads/productos/" . $nombreUnico;
        if (move_uploaded_file($file['tmp_name'], $rutaFisica)) {
            $imagen = $rutaRelativa;
            // Opcional: eliminar imagen anterior si existe
            if (!empty($imagen_actual) && file_exists("../" . $imagen_actual)) {
                @unlink("../" . $imagen_actual);
            }
        } else {
            echo json_encode(['status' => false, 'msg' => 'No se pudo guardar la nueva imagen']);
            exit;
        }
    }
    if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
       //echo "no se envio la imagen";
       $imagen = $producto->imagen;
    }else {
        //echo "si se envio la imagen";
        // subir imagen a uploads , obtener la ruta de la imagen
    }
    //Actualizar
    $actualizar = $objProducto->actualizarProducto($id_producto, $codigo, $nombre, $detalle, $precio, $stock, $id_categoria, $fecha_vencimiento, $imagen, $id_proveedor);
    if($actualizar){
        $arrResponse = array('status' => true, 'msg' => 'Actualizado correctamente');
    }else {
        $arrResponse = array('status' => false, 'msg' => 'Error al actualizar producto');
    }
    echo json_encode($arrResponse);
    exit;
}

if($tipo == "eliminar"){
    $id_producto = $_POST['id_producto'];
    if($id_producto == ""){
        $arrResponse = array('status' => false, 'msg' => 'Error, id vacio');
    }else{
        $eliminar = $objProducto->eliminar($id_producto);
        if ($eliminar) {
            $arrResponse = array('status' => true, 'msg' => 'Producto eliminado');
        }else{
            $arrResponse = array('status' => false, 'msg' => 'Error al eliminar producto');
        }
        echo json_encode($arrResponse);
        exit;
    }
}
if ($tipo == "buscar_producto_venta") {
    $dato = $_POST['dato'];
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $productos = $objProducto->buscarProductoByNombreOrCodigo($dato);
    $arrProduct = array();
    if (count($productos)) {
        foreach ($productos as $producto) {
            $categoria = $objCategoria->ver($producto->id_categoria);
            $producto->categoria = $categoria->nombre;
            array_push($arrProduct, $producto);
        }
        $respuesta = array('status' => true, 'msg' => '', 'data' => $arrProduct);
    }
    echo json_encode($respuesta);
}
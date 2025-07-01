<?php
require_once("../model/CategoriaModel.php");

$objCategoria = new CategoriaModel();

$tipo = $_GET['tipo'];

if ($tipo == "registrar") {
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];

    if ($nombre == "" || $detalle == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error, campos vacíos');
    } else {
        $respuesta = $objCategoria->registrar($nombre, $detalle);

        if ($respuesta > 0) {
            $arrResponse = array('status' => true, 'msg' => 'Registrado correctamente');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Error al registrar');
        }
    }
    echo json_encode($arrResponse);
}
?>

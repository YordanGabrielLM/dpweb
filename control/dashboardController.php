<?php
require_once("../model/DashboardModel.php");

$dashboard = new DashboardModel();
$tipo = $_GET['tipo'] ?? '';

header('Content-Type: application/json; charset=utf-8');

switch ($tipo) {
    case 'obtener_estadisticas':
        echo json_encode($dashboard->obtenerEstadisticas());
        break;

    case 'obtener_productos_recientes':
        echo json_encode($dashboard->obtenerProductosRecientes());
        break;

    case 'obtener_stock_bajo':
        echo json_encode($dashboard->obtenerStockBajo());
        break;

    default:
        echo json_encode(['status' => false, 'msg' => 'Tipo de solicitud no válido']);
        break;
}

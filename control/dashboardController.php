<?php
require_once("../model/DashboardModel.php");

$objDashboard = new DashboardModel();

$tipo = $_GET['tipo'] ?? '';

if ($tipo === "estadisticas") {
    $data = $objDashboard->obtenerEstadisticas();
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($tipo === "productos_stock_bajo") {
    $data = $objDashboard->productosStockBajo();
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

echo json_encode(['status' => false, 'msg' => 'Tipo de petición no válido']);

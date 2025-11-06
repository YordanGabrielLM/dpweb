<?php
// control/dashboardController.php
require_once("../model/DashboardModel.php");

$objDashboard = new DashboardModel();

$tipo = $_GET['tipo'] ?? '';

if ($tipo == "obtener_estadisticas") {
    $estadisticas = $objDashboard->getEstadisticas();
    echo json_encode($estadisticas);
    exit;
}

if ($tipo == "obtener_productos_recientes") {
    $productos = $objDashboard->getProductosRecientes();
    echo json_encode($productos);
    exit;
}

if ($tipo == "obtener_stock_bajo") {
    $productos = $objDashboard->getProductosStockBajo();
    echo json_encode($productos);
    exit;
}
<?php
// control/dashboardController.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . "/../model/DashboardModel.php");

$objDashboard = new DashboardModel();

$tipo = $_GET['tipo'] ?? '';

switch ($tipo) {
    case "obtener_estadisticas":
        $estadisticas = $objDashboard->getEstadisticas();
        echo json_encode($estadisticas);
        break;

    case "obtener_productos_recientes":
        $productos = $objDashboard->getProductosRecientes();
        echo json_encode($productos);
        break;

    case "obtener_stock_bajo":
        $productos = $objDashboard->getProductosStockBajo();
        echo json_encode($productos);
        break;

    default:
        echo json_encode(["error" => "Tipo de solicitud no válido"]);
        break;
}

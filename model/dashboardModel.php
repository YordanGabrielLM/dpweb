<?php
// model/DashboardModel.php
require_once(__DIR__ . "/../library/conexion.php");

class DashboardModel {
    private $conexion;
    
    function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    
    public function getEstadisticas() {
        $estadisticas = array();

        try {
            // Total de productos
            $sql = $this->conexion->query("SELECT COUNT(*) as total FROM producto");
            $estadisticas['total_productos'] = $sql->fetch_object()->total ?? 0;

            // Total de usuarios (excluyendo clientes y proveedores)
            $sql = $this->conexion->query("SELECT COUNT(*) as total FROM persona WHERE rol!='Cliente' AND rol!='Proveedor'");
            $estadisticas['total_usuarios'] = $sql->fetch_object()->total ?? 0;

            // Total de clientes
            $sql = $this->conexion->query("SELECT COUNT(*) as total FROM persona WHERE rol='Cliente'");
            $estadisticas['total_clientes'] = $sql->fetch_object()->total ?? 0;

            // Total de proveedores
            $sql = $this->conexion->query("SELECT COUNT(*) as total FROM persona WHERE rol='Proveedor'");
            $estadisticas['total_proveedores'] = $sql->fetch_object()->total ?? 0;

            // Productos con stock bajo (menos de 10)
            $sql = $this->conexion->query("SELECT COUNT(*) as total FROM producto WHERE stock < 10");
            $estadisticas['stock_bajo'] = $sql->fetch_object()->total ?? 0;

        } catch (Exception $e) {
            $estadisticas = ["error" => $e->getMessage()];
        }

        return $estadisticas;
    }
    
    public function getProductosRecientes() {
        $productos = array();
        try {
            $sql = $this->conexion->query("
                SELECT p.*, per.razon_social as proveedor 
                FROM producto p 
                LEFT JOIN persona per ON p.id_proveedor = per.id 
                ORDER BY p.id DESC LIMIT 5
            ");
            while ($obj = $sql->fetch_object()) {
                $productos[] = $obj;
            }
        } catch (Exception $e) {
            $productos = ["error" => $e->getMessage()];
        }
        return $productos;
    }
    
    public function getProductosStockBajo() {
        $productos = array();
        try {
            $sql = $this->conexion->query("
                SELECT * FROM producto WHERE stock < 10 ORDER BY stock ASC LIMIT 5
            ");
            while ($obj = $sql->fetch_object()) {
                $productos[] = $obj;
            }
        } catch (Exception $e) {
            $productos = ["error" => $e->getMessage()];
        }
        return $productos;
    }
}

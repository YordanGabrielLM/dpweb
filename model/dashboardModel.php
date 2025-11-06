<?php
// model/DashboardModel.php
require_once("../library/conexion.php");

class DashboardModel {
    private $conexion;
    
    function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    
    public function getEstadisticas() {
        $estadisticas = array();
        
        // Total de productos
        $sql = $this->conexion->query("SELECT COUNT(*) as total FROM producto");
        $estadisticas['total_productos'] = $sql->fetch_object()->total;
        
        // Total de usuarios (excluyendo clientes y proveedores)
        $sql = $this->conexion->query("SELECT COUNT(*) as total FROM persona WHERE rol!='Cliente' AND rol!='Proveedor'");
        $estadisticas['total_usuarios'] = $sql->fetch_object()->total;
        
        // Total de clientes
        $sql = $this->conexion->query("SELECT COUNT(*) as total FROM persona WHERE rol='Cliente'");
        $estadisticas['total_clientes'] = $sql->fetch_object()->total;
        
        // Total de proveedores
        $sql = $this->conexion->query("SELECT COUNT(*) as total FROM persona WHERE rol='Proveedor'");
        $estadisticas['total_proveedores'] = $sql->fetch_object()->total;
        
        // Productos con stock bajo (menos de 10)
        $sql = $this->conexion->query("SELECT COUNT(*) as total FROM producto WHERE stock < 10");
        $estadisticas['stock_bajo'] = $sql->fetch_object()->total;
        
        return $estadisticas;
    }
    
    public function getProductosRecientes() {
        $productos = array();
        $sql = $this->conexion->query("SELECT p.*, per.razon_social as proveedor 
                                     FROM producto p 
                                     LEFT JOIN persona per ON p.id_proveedor = per.id 
                                     ORDER BY p.id DESC LIMIT 5");
        while($objeto = $sql->fetch_object()) {
            array_push($productos, $objeto);
        }
        return $productos;
    }
    
    public function getProductosStockBajo() {
        $productos = array();
        $sql = $this->conexion->query("SELECT * FROM producto WHERE stock < 10 ORDER BY stock ASC LIMIT 5");
        while($objeto = $sql->fetch_object()) {
            array_push($productos, $objeto);
        }
        return $productos;
    }
}
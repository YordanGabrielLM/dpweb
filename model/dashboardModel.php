<?php
require_once("../library/conexion.php");

class DashboardModel {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    // 🔹 1. Obtener estadísticas generales
    public function obtenerEstadisticas() {
        $data = [
            'total_productos' => 0,
            'total_usuarios' => 0,
            'total_clientes' => 0,
            'total_proveedores' => 0,
            'stock_bajo' => 0
        ];

        // Total de productos
        $query = $this->conexion->query("SELECT COUNT(*) AS total FROM producto");
        $data['total_productos'] = $query ? $query->fetch_object()->total : 0;

        // Total de usuarios
        $query = $this->conexion->query("SELECT COUNT(*) AS total FROM usuario");
        $data['total_usuarios'] = $query ? $query->fetch_object()->total : 0;

        // Total de clientes (si existe tabla cliente)
        $query = $this->conexion->query("SELECT COUNT(*) AS total FROM cliente");
        $data['total_clientes'] = $query ? $query->fetch_object()->total : 0;

        // Total de proveedores
        $query = $this->conexion->query("SELECT COUNT(*) AS total FROM proveedor");
        $data['total_proveedores'] = $query ? $query->fetch_object()->total : 0;

        // Productos con stock bajo (menos de 10 unidades)
        $query = $this->conexion->query("SELECT COUNT(*) AS total FROM producto WHERE stock < 10");
        $data['stock_bajo'] = $query ? $query->fetch_object()->total : 0;

        return $data;
    }

    // 🔹 2. Obtener productos recientes (últimos 10)
    public function obtenerProductosRecientes() {
        $productos = [];
        $sql = $this->conexion->query("
            SELECT p.id, p.nombre, p.precio, p.stock, pr.razon_social AS proveedor
            FROM producto p
            LEFT JOIN proveedor pr ON p.id_proveedor = pr.id
            ORDER BY p.id DESC
            LIMIT 10
        ");
        if ($sql) {
            while ($row = $sql->fetch_object()) {
                $productos[] = $row;
            }
        }
        return $productos;
    }

    // 🔹 3. Obtener productos con stock bajo
    public function obtenerStockBajo() {
        $productos = [];
        $sql = $this->conexion->query("
            SELECT id, nombre, stock
            FROM producto
            WHERE stock < 10
            ORDER BY stock ASC
            LIMIT 10
        ");
        if ($sql) {
            while ($row = $sql->fetch_object()) {
                $productos[] = $row;
            }
        }
        return $productos;
    }
}

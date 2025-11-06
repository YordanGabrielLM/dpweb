<?php
require_once("../library/conexion.php");

class DashboardModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    // 🔹 Estadísticas generales del sistema
    public function obtenerEstadisticas()
    {
        $data = [];

        // Total de productos
        $sql = $this->conexion->query("SELECT COUNT(*) AS total FROM producto");
        $data['productos'] = $sql ? $sql->fetch_object()->total : 0;

        // Total de categorías
        $sql = $this->conexion->query("SELECT COUNT(*) AS total FROM categoria");
        $data['categorias'] = $sql ? $sql->fetch_object()->total : 0;

        // Total de proveedores (si existe tabla)
        $sql = $this->conexion->query("SELECT COUNT(*) AS total FROM proveedor");
        $data['proveedores'] = $sql ? $sql->fetch_object()->total : 0;

        // Total de usuarios (si existe tabla)
        $sql = $this->conexion->query("SELECT COUNT(*) AS total FROM usuario");
        $data['usuarios'] = $sql ? $sql->fetch_object()->total : 0;

        // Total de ventas (si existe tabla)
        $sql = $this->conexion->query("SELECT COUNT(*) AS total FROM venta");
        $data['ventas'] = $sql ? $sql->fetch_object()->total : 0;

        return ['status' => true, 'data' => $data];
    }

    // 🔹 Productos con bajo stock (por debajo de 5 unidades, puedes ajustar)
    public function productosStockBajo()
    {
        $arr = [];
        $sql = $this->conexion->query("
            SELECT p.id, p.codigo, p.nombre, p.stock, c.nombre AS categoria
            FROM producto p
            LEFT JOIN categoria c ON p.id_categoria = c.id
            WHERE p.stock <= 5
            ORDER BY p.stock ASC
            LIMIT 10
        ");
        if ($sql) {
            while ($row = $sql->fetch_object()) {
                $arr[] = $row;
            }
        }
        return ['status' => true, 'data' => $arr];
    }
}

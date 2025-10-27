<?php
require_once("../library/conexion.php");
class ProductsModel
{
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function registrar($codigo, $nombre, $detalle, $precio, $stock, $id_categoria, $fecha_vencimiento, $imagen, $id_proveedor)
    {
        $codigo            = $this->conexion->real_escape_string($codigo);
        $nombre            = $this->conexion->real_escape_string($nombre);
        $detalle           = $this->conexion->real_escape_string($detalle);
        $precio            = floatval($precio);
        $stock             = intval($stock);
        $id_categoria      = intval($id_categoria);
        $fecha_vencimiento = $this->conexion->real_escape_string($fecha_vencimiento);
        $id_proveedor      = intval($id_proveedor);
        $imagen            = $this->conexion->real_escape_string($imagen);
        $consulta = "INSERT INTO producto (codigo, nombre, detalle, precio, stock, id_categoria, fecha_vencimiento, imagen, id_proveedor) VALUES ('$codigo', '$nombre', '$detalle', $precio, $stock, $id_categoria, '$fecha_vencimiento', '$imagen', '$id_proveedor')";
        $sql = $this->conexion->query($consulta);
        if ($sql) {
            return $this->conexion->insert_id;
        }
        return 0;
    }

    public function existeProducto($codigo)
    {
        $consulta = "SELECT * FROM producto WHERE codigo ='$codigo'";
        $sql = $this->conexion->query($consulta);
        return $sql->num_rows;
    }

    public function buscarProductoPorCodigo($codigo)
    {
        $consulta = "SELECT id, codigo FROM producto WHERE codigo='$codigo' LIMIT 1";
        $sql = $this->conexion->query($consulta);
        return $sql->fetch_object();
    }

    public function mostrarProductos()
    {
        $arr_productos = array();
        $consulta = "SELECT p.*, c.nombre AS categoria
                 FROM producto p
                 LEFT JOIN categoria c ON p.id_categoria = c.id";
        $sql = $this->conexion->query($consulta);
        if (!$sql) {
            error_log("Error en query(): " . $this->conexion->error);
            return $arr_productos;
        }
        while ($objeto = $sql->fetch_object()) {
            array_push($arr_productos, $objeto);
        }
        return $arr_productos;
    }


    public function ver($id)
    {
        $consulta = "SELECT * FROM producto WHERE id = '$id'";
        $sql = $this->conexion->query($consulta);
        return $sql->fetch_object();
    }

    public function actualizarProducto($id_producto, $codigo, $nombre, $detalle, $precio, $stock, $id_categoria, $fecha_vencimiento, $imagen, $id_proveedor) {
        $codigo = $this->conexion->real_escape_string($codigo);
        $nombre = $this->conexion->real_escape_string($nombre);
        $detalle = $this->conexion->real_escape_string($detalle);
        $precio = floatval($precio);
        $stock = intval($stock);
        $id_categoria = intval($id_categoria);
        $fecha_vencimiento = $this->conexion->real_escape_string($fecha_vencimiento);
        $imagen = $this->conexion->real_escape_string($imagen);
        $id_proveedor = intval($id_proveedor);
        $consulta = "UPDATE producto SET codigo='$codigo', nombre='$nombre', detalle='$detalle', precio=$precio, stock=$stock, id_categoria=$id_categoria, fecha_vencimiento='$fecha_vencimiento', imagen='$imagen', id_proveedor=$id_proveedor WHERE id='$id_producto'";
        $sql = $this->conexion->query($consulta);
        return $sql;
    }

    public function eliminar($id_producto)
    {
        $consulta = "DELETE FROM producto WHERE id='$id_producto'";
        $sql = $this->conexion->query($consulta);
        return $sql;
    }
    public function existeCodigo($codigo)
    {
        $codigo = $this->conexion->real_escape_string($codigo);
        $consulta = "SELECT id FROM producto WHERE codigo='$codigo' LIMIT 1";
        $sql = $this->conexion->query($consulta);
        return $sql->num_rows;
    }
}

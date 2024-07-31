<?php

namespace Dao\ProductosElectronicos;

class Productos extends \Dao\Table
{
   
    public static function createProducto(
        $nombreProducto,
        $precio,
        $cantidadDisponible,
        $estadoProducto,
        $categoria,
        $marca,
        $modelo,
        $descripcion,
        $proveedor,
        $fechaAdquisicion,
        $imagenesProducto,
        $garantia
    ) {
        $InsSql = "INSERT INTO productos_electronicos (
            Nombre_Producto, Precio, Cantidad_Disponible, Estado_Producto, Categoría,
            Marca, Modelo, Descripción, Proveedor, Fecha_Adquisición, Imagenes_Producto, Garantía
        ) VALUES (
            :nombreProducto, :precio, :cantidadDisponible, :estadoProducto, :categoria,
            :marca, :modelo, :descripcion, :proveedor, :fechaAdquisicion, :imagenesProducto, :garantia
        );";
        $insParams = [
            'nombreProducto' => $nombreProducto,
            'precio' => $precio,
            'cantidadDisponible' => $cantidadDisponible,
            'estadoProducto' => $estadoProducto,
            'categoria' => $categoria,
            'marca' => $marca,
            'modelo' => $modelo,
            'descripcion' => $descripcion,
            'proveedor' => $proveedor,
            'fechaAdquisicion' => $fechaAdquisicion,
            'imagenesProducto' => $imagenesProducto,
            'garantia' => $garantia
        ];

        return self::executeNonQuery($InsSql, $insParams);
    }

    public static function updateProducto(
        $idProducto,
        $nombreProducto,
        $precio,
        $cantidadDisponible,
        $estadoProducto,
        $categoria,
        $marca,
        $modelo,
        $descripcion,
        $proveedor,
        $fechaAdquisicion,
        $imagenesProducto,
        $garantia
    ) {
        $UpdSql = "UPDATE productos_electronicos SET
            Nombre_Producto = :nombreProducto,
            Precio = :precio,
            Cantidad_Disponible = :cantidadDisponible,
            Estado_Producto = :estadoProducto,
            Categoría = :categoria,
            Marca = :marca,
            Modelo = :modelo,
            Descripción = :descripcion,
            Proveedor = :proveedor,
            Fecha_Adquisición = :fechaAdquisicion,
            Imagenes_Producto = :imagenesProducto,
            Garantía = :garantia
        WHERE ID_Producto = :idProducto;";
        $updParams = [
            'idProducto' => $idProducto,
            'nombreProducto' => $nombreProducto,
            'precio' => $precio,
            'cantidadDisponible' => $cantidadDisponible,
            'estadoProducto' => $estadoProducto,
            'categoria' => $categoria,
            'marca' => $marca,
            'modelo' => $modelo,
            'descripcion' => $descripcion,
            'proveedor' => $proveedor,
            'fechaAdquisicion' => $fechaAdquisicion,
            'imagenesProducto' => $imagenesProducto,
            'garantia' => $garantia
        ];

        return self::executeNonQuery($UpdSql, $updParams);
    }

    public static function deleteProducto($idProducto)
    {
        $DelSql = "DELETE FROM productos_electronicos WHERE ID_Producto = :idProducto;";
        $delParams = ['idProducto' => $idProducto];
        return self::executeNonQuery($DelSql, $delParams);
    }

    public static function readAllProductos($filtro = '')
    {
        $sqlstr = "SELECT * FROM productos_electronicos
        WHERE Nombre_Producto LIKE :filtro;";
        $params = array('filtro' => '%' . $filtro . '%');
        return self::obtenerRegistros($sqlstr, $params);
    }

    public static function readProducto($idProducto)
    {
        $sqlstr = "SELECT * FROM productos_electronicos WHERE ID_Producto = :idProducto;";
        $params = array('idProducto' => $idProducto);
        return self::obtenerUnRegistro($sqlstr, $params);
    }
}

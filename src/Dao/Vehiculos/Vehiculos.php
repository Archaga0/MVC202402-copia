<?php

namespace Dao\Vehiculos;

class Vehiculos extends \Dao\Table {

    public static function getDBVehiculos(): array
    {
        $sqlstr = "SELECT * from datosvehiculos;";
        $productos = self::obtenerRegistros($sqlstr, array());
        return $productos;
    }

    /* CRUD
        Create -- Insert (Insertar)
        Read -- Select (Leer)
        Update -- Update (Actualizar)
        Delete -- Delete (Eliminar)
    */

    public static function createVehiculo(
        $marca,
        $modelo,
        $anio_fabricacion,
        $tipo_combustible,
        $kilometraje
    ){
        $InSql = "INSERT INTO datosvehiculos (marca, modelo, año_fabricacion, tipo_combustible,kilometraje)
         values (:marca, :modelo, :año_fabricacion, :tipo_combustible, :kilometraje);";
        $insParams = [
            'marca' => $marca,
            'modelo' => $modelo,
            'año_fabricacion' => $anio_fabricacion,
            'tipo_combustible' => $tipo_combustible,
            'kilometraje' => $kilometraje
        ];
        return self::executeNonQuery($InSql, $insParams);
    }

    public static function updateVehiculo(
        $id_vehiculo,
        $marca,
        $modelo,
        $anio_fabricacion,
        $tipo_combustible,
        $kilometraje
    ){
        $UpdSql = "UPDATE datosvehiculos set marca = :marca, modelo = :modelo, año_fabricacion = :año_fabricacion, tipo_combustible = :tipo_combustible, kilometraje = :kilometraje   where id_vehiculo = :id_vehiculo;";
        $UpdParams = [
            'id_vehiculo' => $id_vehiculo,
            'marca' => $marca,
            'modelo' => $modelo,
            'año_fabricacion' => $anio_fabricacion,
            'tipo_combustible' => $tipo_combustible,
            'kilometraje' => $kilometraje
        ];

        return self::executeNonQuery($UpdSql, $UpdParams);
    }

    public static function deleteVehiculo($id){
        $DelSql = "DELETE * from productos where id_vehiculo = :id;";
        $DelParams = ['id' => $id];
        return self::executeNonQuery($DelSql,$DelParams);
    }

    public static function readAllVehiculos($filter = '')
    {
        $sqlstr = "SELECT * from datosvehiculos where marca like :filter;";
        $params = array('filter' => '%' . $filter . '%');
        return self::obtenerRegistros($sqlstr, $params);
    }

    public static function readVehiculo($id)
    {
        $sqlstr = "SELECT * from datosvehiculos where id_vehiculo = :id;";
        $params = array('id' => $id);
        return self::obtenerUnRegistro($sqlstr, $params);
    }
    
}
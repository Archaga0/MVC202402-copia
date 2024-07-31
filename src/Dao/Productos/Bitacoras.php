<?php

namespace Dao\Bitacora;

class Bitacoras extends \Dao\Table
{
    public static function getBitacora(): array
    {
        $sqlstr = "SELECT bitacorafch as fecha, bitprograma as programa, bitdescripcion as descripcion, bitobservacion as observacion, bitTipo as tipo, bitusuario as usuario from bitacora;";
        $bitacora = self::obtenerRegistros($sqlstr, array());
        return $bitacora;
    }

    /* CRUD
        Create -- Insert
        Read -- Select
        Update -- Update
        Delete -- Delete
    */

    public static function createEntrada(
        $fecha,
        $programa,
        $descripcion,
        $observacion,
        $tipo,
        $usuario
    ) {
        $InsSql = "INSERT INTO bitacora (bitacorafch, bitprograma, bitdescripcion, bitobservacion, bitTipo, bitusuario)
         value (:fecha, :programa, :descripcion, :observacion, :tipo, :usuario);";
        $insParams = [
            'fecha' => $fecha,
            'programa' => $programa,
            'descripcion' => $descripcion,
            'observacion' => $observacion,
            'tipo' => $tipo,
            'usuario' => $usuario
        ];

        return self::executeNonQuery($InsSql, $insParams);
    }

    public static function updateEntrada(
        $bitacoracod,
        $fecha,
        $programa,
        $descripcion,
        $observacion,
        $tipo,
        $usuario
    ) {
        $UpdSql = "UPDATE bitacora set bitacorafch = :fecha, bitprograma = :programa, bitdescripcion = :descripcion, bitobservacion = :observacion, bitTipo = :tipo, bitusuario = :usuario where bitacoracod = :bitacoracod;";
        $updParams = [
            'bitacoracod' => $bitacoracod,
            'fecha' => $fecha,
            'programa' => $programa,
            'descripcion' => $descripcion,
            'observacion' => $observacion,
            'tipo' => $tipo,
            'usuario' => $usuario
        ];

        return self::executeNonQuery($UpdSql, $updParams);
    }

    public static function deleteEntrada($bitacoracod)
    {
        $DelSql = "DELETE from bitacora where bitacoracod = :bitacoracod;";
        $delParams = ['bitacoracod' => $bitacoracod];
        return self::executeNonQuery($DelSql, $delParams);
    }

    public static function readAllEntradas($filter = '')
    {
        $sqlstr = "SELECT * from bitacora where bitprograma like :filter or bitdescripcion like :filter or bitobservacion like :filter;";
        $params = array('filter' => '%' . $filter . '%');
        return self::obtenerRegistros($sqlstr, $params);
    }

    public static function readEntrada($bitacoracod)
    {
        $sqlstr = "SELECT * from bitacora where bitacoracod = :bitacoracod;";
        $params = array('bitacoracod' => $bitacoracod);
        return self::obtenerUnRegistro($sqlstr, $params);
    }
}


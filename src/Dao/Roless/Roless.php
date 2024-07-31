<?php

namespace Dao\Roless;

use Dao\Table;

class Roless extends Table
{

        private $rolescod;
        private $rolesdsc;
        private $rolesest;


        public static function getRoles()
        {
                $sqlstr = "SELECT * FROM roles";
                $params = [];
                $registros = self::obtenerRegistros($sqlstr, $params);
                return $registros;
        }

        public static function insertRoles($rolescod, $rolesdsc, $rolesest)
        {

                $sqlstr = "INSERT INTO roles (rolescod, rolesdsc, rolesest) VALUES (? , ? , ?)";
                $params = [':rolescod' => $rolescod, ':rolesdsc' => $rolesdsc, ':rolesest' => $rolesest];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }

        public static function updateRoles($rolescod, $rolesdsc, $rolesest)
        {

                $sqlstr = "UPDATE roles SET rolescod = :rolescod, rolesdsc = :rolesdsc, rolesest = :rolesest WHERE rolescod = :rolescod";
                $params = [':rolescod' => $rolescod, ':rolesdsc' => $rolesdsc, ':rolesest' => $rolesest];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }

        public static function obtenerPorId($id)
        {
                $sqlstr = "SELECT * FROM roles WHERE rolescod = :id";
                $params = ['id' => $id];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }

        public static function deleteRoles($id)
        {
                $sqlstr = "DELETE  FROM roles WHERE rolescod = :id";
                $params = ['id' => $id];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }
}
<?php

namespace Dao\Roles_usuarioss;

use Dao\Table;

class Roles_usuarioss extends Table
{

        private $usercod;
        private $rolescod;
        private $roleuserest;
        private $roleuserfch;
        private $roleuserexp;


        public static function getRoles_usuarios()
        {
                $sqlstr = "SELECT * FROM roles_usuarios";
                $params = [];
                $registros = self::obtenerRegistros($sqlstr, $params);
                return $registros;
        }

        public static function insertRoles_usuarios($usercod, $rolescod, $roleuserest, $roleuserfch, $roleuserexp)
        {

                $sqlstr = "INSERT INTO roles_usuarios (usercod, rolescod, roleuserest, roleuserfch, roleuserexp) VALUES (? , ? , ? , ? , ?)";
                $params = [':usercod' => $usercod, ':rolescod' => $rolescod, ':roleuserest' => $roleuserest, ':roleuserfch' => $roleuserfch, ':roleuserexp' => $roleuserexp];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }

        public static function updateRoles_usuarios($usercod, $rolescod, $roleuserest, $roleuserfch, $roleuserexp)
        {

                $sqlstr = "UPDATE roles_usuarios SET usercod = :usercod, rolescod = :rolescod, roleuserest = :roleuserest, roleuserfch = :roleuserfch, roleuserexp = :roleuserexp WHERE usercod = :usercod";
                $params = [':usercod' => $usercod, ':rolescod' => $rolescod, ':roleuserest' => $roleuserest, ':roleuserfch' => $roleuserfch, ':roleuserexp' => $roleuserexp];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }

        public static function obtenerPorId($id)
        {
                $sqlstr = "SELECT * FROM roles_usuarios WHERE usercod = :id";
                $params = ['id' => $id];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }

        public static function deleteRoles_usuarios($id)
        {
                $sqlstr = "DELETE  FROM roles_usuarios WHERE usercod = :id";
                $params = ['id' => $id];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }
}
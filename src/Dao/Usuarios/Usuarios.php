<?php

namespace Dao\Usuarios;

use Dao\Table;

class Usuarios extends Table
{

        private $usercod;
        private $useremail;
        private $username;
        private $userpswd;
        private $userfching;
        private $userpswdest;
        private $userpswdexp;
        private $userest;
        private $useractcod;
        private $userpswdchg;
        private $usertipo;


        public static function getUsuario()
        {
                $sqlstr = "SELECT * FROM usuario";
                $params = [];
                $registros = self::obtenerRegistros($sqlstr, $params);
                return $registros;
        }

        public static function insertUsuario($usercod, $useremail, $username, $userpswd, $userfching, $userpswdest, $userpswdexp, $userest, $useractcod, $userpswdchg, $usertipo)
        {

                $sqlstr = "INSERT INTO usuario (usercod, useremail, username, userpswd, userfching, userpswdest, userpswdexp, userest, useractcod, userpswdchg, usertipo) VALUES (? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?)";
                $params = [':usercod' => $usercod, ':useremail' => $useremail, ':username' => $username, ':userpswd' => $userpswd, ':userfching' => $userfching, ':userpswdest' => $userpswdest, ':userpswdexp' => $userpswdexp, ':userest' => $userest, ':useractcod' => $useractcod, ':userpswdchg' => $userpswdchg, ':usertipo' => $usertipo];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }

        public static function updateUsuario($usercod, $useremail, $username, $userpswd, $userfching, $userpswdest, $userpswdexp, $userest, $useractcod, $userpswdchg, $usertipo)
        {

                $sqlstr = "UPDATE usuario SET usercod = :usercod, useremail = :useremail, username = :username, userpswd = :userpswd, userfching = :userfching, userpswdest = :userpswdest, userpswdexp = :userpswdexp, userest = :userest, useractcod = :useractcod, userpswdchg = :userpswdchg, usertipo = :usertipo WHERE usercod = :usercod";
                $params = [':usercod' => $usercod, ':useremail' => $useremail, ':username' => $username, ':userpswd' => $userpswd, ':userfching' => $userfching, ':userpswdest' => $userpswdest, ':userpswdexp' => $userpswdexp, ':userest' => $userest, ':useractcod' => $useractcod, ':userpswdchg' => $userpswdchg, ':usertipo' => $usertipo];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }

        public static function obtenerPorId($id)
        {
                $sqlstr = "SELECT * FROM usuario WHERE usercod = :id";
                $params = ['id' => $id];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }

        public static function deleteUsuario($id)
        {
                $sqlstr = "DELETE  FROM usuario WHERE usercod = :id";
                $params = ['id' => $id];
                $registros = self::executeNonQuery($sqlstr, $params);
                return $registros;
        }
}
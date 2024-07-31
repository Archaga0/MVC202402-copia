<?php

namespace Controllers\Mantenimientos\Usuarios;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Usuarios\Usuarios as DAOUsuario;
use Utilities\Site;
use Utilities\Validators;
use Utilities\Context;
use Utilities\Paging;

class Usuario extends PublicController
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

    public function run(): void
    {
        Site::addLink('usuario_style');
        $viewData['usercod'] = 'usercod';
        $viewData['useremail'] = 'useremail';
        $viewData['username'] = 'username';
        $viewData['userpswd'] = 'userpswd';
        $viewData['userfching'] = 'userfching';
        $viewData['userpswdest'] = 'userpswdest';
        $viewData['userpswdexp'] = 'userpswdexp';
        $viewData['userest'] = 'userest';
        $viewData['useractcod'] = 'useractcod';
        $viewData['userpswdchg'] = 'userpswdchg';
        $viewData['usertipo'] = 'usertipo';
        $viewData['usuario'] = DAOUsuario::getUsuario();
        Renderer::render("usuarios/usuariolist", $viewData);
    }
}
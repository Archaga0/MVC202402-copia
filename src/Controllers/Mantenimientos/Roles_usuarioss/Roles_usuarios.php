<?php

namespace Controllers\Mantenimientos\Roles_usuarioss;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Roles_usuarioss\Roles_usuarioss as DAORoles_usuarios;
use Utilities\Site;
use Utilities\Validators;
use Utilities\Context;
use Utilities\Paging;

class Roles_usuarios extends PublicController
{
    private $usercod;
    private $rolescod;
    private $roleuserest;
    private $roleuserfch;
    private $roleuserexp;

    public function run(): void
    {
        Site::addLink('roles_usuarios_style');
        $viewData['usercod'] = 'usercod';
        $viewData['rolescod'] = 'rolescod';
        $viewData['roleuserest'] = 'roleuserest';
        $viewData['roleuserfch'] = 'roleuserfch';
        $viewData['roleuserexp'] = 'roleuserexp';
        $viewData['roles_usuarios'] = DAORoles_usuarios::getRoles_usuarios();
        Renderer::render("roles_usuarioss/roles_usuarioslist", $viewData);
    }
}
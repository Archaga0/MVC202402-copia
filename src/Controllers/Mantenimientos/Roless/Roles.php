<?php

namespace Controllers\Mantenimientos\Roless;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Roless\Roless as DAORoles;
use Utilities\Site;
use Utilities\Validators;
use Utilities\Context;
use Utilities\Paging;

class Roles extends PublicController
{
    private $rolescod;
    private $rolesdsc;
    private $rolesest;

    public function run(): void
    {
        Site::addLink('roles_style');
        $viewData['rolescod'] = 'rolescod';
        $viewData['rolesdsc'] = 'rolesdsc';
        $viewData['rolesest'] = 'rolesest';
        $viewData['roles'] = DAORoles::getRoles();
        Renderer::render("roless/roleslist", $viewData);
    }
}
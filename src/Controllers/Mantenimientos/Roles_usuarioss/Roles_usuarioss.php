<?php

namespace Controllers\Mantenimientos\Roles_usuarioss;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Roles_usuarioss\Roles_usuarioss as DAORoles_usuarios;
use Utilities\Site;
use Utilities\Validators;

class Roles_usuarioss extends PublicController
{
    private $usercod;
    private $rolescod;
    private $roleuserest;
    private $roleuserfch;
    private $roleuserexp;
    private $roles_usuarios = [
        "usercod" => "",
        "rolescod" => "",
        "roleuserest" => "",
        "roleuserfch" => "",
        "roleuserexp" => ""
    ];
    private $listUrl = "index.php?page=Roles_usuarioss_Roles_usuarios";
    private $mode = 'INS';
    private $viewData = [];
    private $error = [];
    private $xss_token = '';
    private $modes = [
        "INS" => "Creando nueva roles_usuarios",
        "UPD" => "Editando",
        "DEL" => "Eliminando",
        "DSP" => "Detalle"
    ];

    public function run(): void
    {
        $this->init();
        if ($this->isPostBack()) {
            if ($this->validateFormData()) {
                $this->roles_usuarios['usercod'] = $_POST['usercod'];
                $this->roles_usuarios['rolescod'] = $_POST['rolescod'];
                $this->roles_usuarios['roleuserest'] = $_POST['roleuserest'];
                $this->roles_usuarios['roleuserfch'] = $_POST['roleuserfch'];
                $this->roles_usuarios['roleuserexp'] = $_POST['roleuserexp'];
                $this->processAction();
            }
        }
        $this->prepareViewData();
        $this->render();
    }
    private function init()
    {
        if (isset($_GET["mode"])) {
            if (isset($this->modes[$_GET["mode"]])) {
                $this->mode = $_GET["mode"];
                if ($this->mode !== "INS") {
                    if (isset($_GET["usercod"])) {
                        $this->roles_usuarios = DAORoles_usuarios::obtenerPorId(strval($_GET["usercod"]));
                        if (!$this->roles_usuarios) {
                            throw new \Exception("No se encontró", 1);
                        }
                    }
                }
            } else {
                $this->handleError("Oops, el programa no encuentra el modo solicitado, intente de nuevo");
            }
        } else {
            $this->handleError("Oops, el programa falló, intente de nuevo.");
        }
    }
    private function handleError($errMsg)
    {
        Site::redirectToWithMsg($this->listUrl, $errMsg);
    }

    private function validateFormData()
    {
        if (isset($_POST["xss-token"])) {
            $this->xss_token = $_POST["xss-token"];
            if ($_SESSION["xss_token_Roles_usuarios"] !== $this->xss_token) {
                $this->handleError("Error al procesar la peticion");
                return false;
            }
        } else {
            $this->handleError("Error al procesar la peticion");
            return false;
        }
        if (Validators::IsEmpty($_POST["usercod"])) {
            $this->error["usercod_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["rolescod"])) {
            $this->error["rolescod_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["roleuserest"])) {
            $this->error["roleuserest_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["roleuserfch"])) {
            $this->error["roleuserfch_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["roleuserexp"])) {
            $this->error["roleuserexp_error"] = "Campo es requerido";
        }
        if (!in_array($_POST["status"], ["INA", "ACT"])) {
            $this->error["status_error"] = "Estado es inválido.";
        } else {
            $this->error["status_error"] = "";
        }

        return count($this->error) == 0;
    }

    private function processAction()
    {
        switch ($this->mode) {
            case 'INS':
                if (DAORoles_usuarios::insertRoles_usuarios(
                    $this->roles_usuarios["usercod"],
                    $this->roles_usuarios["rolescod"],
                    $this->roles_usuarios["roleuserest"],
                    $this->roles_usuarios["roleuserfch"],
                    $this->roles_usuarios["roleuserexp"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Roles_usuarios creada exitosamente.");
                } else {
                    Site::redirectToWithMsg($this->listUrl, "Hubo un error.");
                }
                break;
            case 'UPD':
                if (DAORoles_usuarios::updateRoles_usuarios(
                    $this->roles_usuarios["usercod"],
                    $this->roles_usuarios["rolescod"],
                    $this->roles_usuarios["roleuserest"],
                    $this->roles_usuarios["roleuserfch"],
                    $this->roles_usuarios["roleuserexp"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Roles_usuarios actualizada exitosamente.");
                } else {
                    Site::redirectToWithMsg($this->listUrl, "Hubo un error.");
                }
                break;
            case 'DEL':
                if (DAORoles_usuarios::deleteRoles_usuarios(
                    $this->roles_usuarios["usercod"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Roles_usuarios eliminada exitosamente.");
                } else {
                    Site::redirectToWithMsg($this->listUrl, "Hubo un error.");
                }
                break;
        }
    }


    private function prepareViewData()
    {
        $this->viewData["mode"] = $this->mode;
        $this->viewData["roles_usuarios"] = $this->roles_usuarios;
        if ($this->mode == "INS") {
            $this->viewData["modedsc"] = $this->modes[$this->mode];
        } else {
            //$this->viewData["modedsc"] = sprintf(
            // $this->modes[$this->mode], 
            //);
        }
        //$this->viewData["roles_usuarios"][$this->roles_usuarios["status"]."_selected"] = 'selected';
        foreach ($this->error as $key => $error) {
            if ($error !== null) {
                $this->viewData["roles_usuarios"][$key] = $error;
            }
        }
        $this->viewData["readonly"] = in_array($this->mode, ["DSP", "DEL"]) ? 'readonly' : '';
        $this->viewData["showConfirm"] = $this->mode !== "DSP";
        $this->xss_token = md5("roles_usuarioss_roles_usuarios" . date('Ymdhisu'));
        $_SESSION["xss_token_roles_usuarios"] = $this->xss_token;
        $this->viewData["xss_token"] = $this->xss_token;
    }


    private function render()
    {
        Renderer::render("roles_usuarioss/roles_usuariosform", $this->viewData);
    }
}
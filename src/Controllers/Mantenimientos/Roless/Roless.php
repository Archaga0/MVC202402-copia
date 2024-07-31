<?php

namespace Controllers\Mantenimientos\Roless;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Roless\Roless as DAORoles;
use Utilities\Site;
use Utilities\Validators;

class Roless extends PublicController
{
    private $rolescod;
    private $rolesdsc;
    private $rolesest;
    private $roles = [
        "rolescod" => "",
        "rolesdsc" => "",
        "rolesest" => ""
    ];
    private $listUrl = "index.php?page=Roless_Roles";
    private $mode = 'INS';
    private $viewData = [];
    private $error = [];
    private $xss_token = '';
    private $modes = [
        "INS" => "Creando nueva roles",
        "UPD" => "Editando",
        "DEL" => "Eliminando",
        "DSP" => "Detalle"
    ];

    public function run(): void
    {
        $this->init();
        if ($this->isPostBack()) {
            if ($this->validateFormData()) {
                $this->roles['rolescod'] = $_POST['rolescod'];
                $this->roles['rolesdsc'] = $_POST['rolesdsc'];
                $this->roles['rolesest'] = $_POST['rolesest'];
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
                    if (isset($_GET["rolescod"])) {
                        $this->roles = DAORoles::obtenerPorId(strval($_GET["rolescod"]));
                        if (!$this->roles) {
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
            if ($_SESSION["xss_token_Roles"] !== $this->xss_token) {
                $this->handleError("Error al procesar la peticion");
                return false;
            }
        } else {
            $this->handleError("Error al procesar la peticion");
            return false;
        }
        if (Validators::IsEmpty($_POST["rolescod"])) {
            $this->error["rolescod_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["rolesdsc"])) {
            $this->error["rolesdsc_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["rolesest"])) {
            $this->error["rolesest_error"] = "Campo es requerido";
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
                if (DAORoles::insertRoles(
                    $this->roles["rolescod"],
                    $this->roles["rolesdsc"],
                    $this->roles["rolesest"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Roles creada exitosamente.");
                } else {
                    Site::redirectToWithMsg($this->listUrl, "Hubo un error.");
                }
                break;
            case 'UPD':
                if (DAORoles::updateRoles(
                    $this->roles["rolescod"],
                    $this->roles["rolesdsc"],
                    $this->roles["rolesest"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Roles actualizada exitosamente.");
                } else {
                    Site::redirectToWithMsg($this->listUrl, "Hubo un error.");
                }
                break;
            case 'DEL':
                if (DAORoles::deleteRoles(
                    $this->roles["rolescod"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Roles eliminada exitosamente.");
                } else {
                    Site::redirectToWithMsg($this->listUrl, "Hubo un error.");
                }
                break;
        }
    }


    private function prepareViewData()
    {
        $this->viewData["mode"] = $this->mode;
        $this->viewData["roles"] = $this->roles;
        if ($this->mode == "INS") {
            $this->viewData["modedsc"] = $this->modes[$this->mode];
        } else {
            //$this->viewData["modedsc"] = sprintf(
            // $this->modes[$this->mode], 
            //);
        }
        //$this->viewData["roles"][$this->roles["status"]."_selected"] = 'selected';
        foreach ($this->error as $key => $error) {
            if ($error !== null) {
                $this->viewData["roles"][$key] = $error;
            }
        }
        $this->viewData["readonly"] = in_array($this->mode, ["DSP", "DEL"]) ? 'readonly' : '';
        $this->viewData["showConfirm"] = $this->mode !== "DSP";
        $this->xss_token = md5("roless_roles" . date('Ymdhisu'));
        $_SESSION["xss_token_roles"] = $this->xss_token;
        $this->viewData["xss_token"] = $this->xss_token;
    }


    private function render()
    {
        Renderer::render("roless/rolesform", $this->viewData);
    }
}
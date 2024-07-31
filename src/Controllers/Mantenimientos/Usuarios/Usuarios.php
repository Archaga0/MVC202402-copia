<?php

namespace Controllers\Mantenimientos\Usuarios;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Usuarios\Usuarios as DAOUsuario;
use Utilities\Site;
use Utilities\Validators;

class Usuarios extends PublicController
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
    private $usuario = [
        "usercod" => "",
        "useremail" => "",
        "username" => "",
        "userpswd" => "",
        "userfching" => "",
        "userpswdest" => "",
        "userpswdexp" => "",
        "userest" => "",
        "useractcod" => "",
        "userpswdchg" => "",
        "usertipo" => ""
    ];
    private $listUrl = "index.php?page=Usuarios_Usuario";
    private $mode = 'INS';
    private $viewData = [];
    private $error = [];
    private $xss_token = '';
    private $modes = [
        "INS" => "Creando nueva usuario",
        "UPD" => "Editando",
        "DEL" => "Eliminando",
        "DSP" => "Detalle"
    ];

    public function run(): void
    {
        $this->init();
        if ($this->isPostBack()) {
            if ($this->validateFormData()) {
                $this->usuario['usercod'] = $_POST['usercod'];
                $this->usuario['useremail'] = $_POST['useremail'];
                $this->usuario['username'] = $_POST['username'];
                $this->usuario['userpswd'] = $_POST['userpswd'];
                $this->usuario['userfching'] = $_POST['userfching'];
                $this->usuario['userpswdest'] = $_POST['userpswdest'];
                $this->usuario['userpswdexp'] = $_POST['userpswdexp'];
                $this->usuario['userest'] = $_POST['userest'];
                $this->usuario['useractcod'] = $_POST['useractcod'];
                $this->usuario['userpswdchg'] = $_POST['userpswdchg'];
                $this->usuario['usertipo'] = $_POST['usertipo'];
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
                        $this->usuario = DAOUsuario::obtenerPorId(strval($_GET["usercod"]));
                        if (!$this->usuario) {
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
            if ($_SESSION["xss_token_Usuario"] !== $this->xss_token) {
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
        if (Validators::IsEmpty($_POST["useremail"])) {
            $this->error["useremail_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["username"])) {
            $this->error["username_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["userpswd"])) {
            $this->error["userpswd_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["userfching"])) {
            $this->error["userfching_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["userpswdest"])) {
            $this->error["userpswdest_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["userpswdexp"])) {
            $this->error["userpswdexp_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["userest"])) {
            $this->error["userest_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["useractcod"])) {
            $this->error["useractcod_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["userpswdchg"])) {
            $this->error["userpswdchg_error"] = "Campo es requerido";
        }
        if (Validators::IsEmpty($_POST["usertipo"])) {
            $this->error["usertipo_error"] = "Campo es requerido";
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
                if (DAOUsuario::insertUsuario(
                    $this->usuario["usercod"],
                    $this->usuario["useremail"],
                    $this->usuario["username"],
                    $this->usuario["userpswd"],
                    $this->usuario["userfching"],
                    $this->usuario["userpswdest"],
                    $this->usuario["userpswdexp"],
                    $this->usuario["userest"],
                    $this->usuario["useractcod"],
                    $this->usuario["userpswdchg"],
                    $this->usuario["usertipo"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Usuario creada exitosamente.");
                } else {
                    Site::redirectToWithMsg($this->listUrl, "Hubo un error.");
                }
                break;
            case 'UPD':
                if (DAOUsuario::updateUsuario(
                    $this->usuario["usercod"],
                    $this->usuario["useremail"],
                    $this->usuario["username"],
                    $this->usuario["userpswd"],
                    $this->usuario["userfching"],
                    $this->usuario["userpswdest"],
                    $this->usuario["userpswdexp"],
                    $this->usuario["userest"],
                    $this->usuario["useractcod"],
                    $this->usuario["userpswdchg"],
                    $this->usuario["usertipo"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Usuario actualizada exitosamente.");
                } else {
                    Site::redirectToWithMsg($this->listUrl, "Hubo un error.");
                }
                break;
            case 'DEL':
                if (DAOUsuario::deleteUsuario(
                    $this->usuario["usercod"]
                )) {
                    Site::redirectToWithMsg($this->listUrl, "Usuario eliminada exitosamente.");
                } else {
                    Site::redirectToWithMsg($this->listUrl, "Hubo un error.");
                }
                break;
        }
    }


    private function prepareViewData()
    {
        $this->viewData["mode"] = $this->mode;
        $this->viewData["usuario"] = $this->usuario;
        if ($this->mode == "INS") {
            $this->viewData["modedsc"] = $this->modes[$this->mode];
        } else {
            //$this->viewData["modedsc"] = sprintf(
            // $this->modes[$this->mode], 
            //);
        }
        //$this->viewData["usuario"][$this->usuario["status"]."_selected"] = 'selected';
        foreach ($this->error as $key => $error) {
            if ($error !== null) {
                $this->viewData["usuario"][$key] = $error;
            }
        }
        $this->viewData["readonly"] = in_array($this->mode, ["DSP", "DEL"]) ? 'readonly' : '';
        $this->viewData["showConfirm"] = $this->mode !== "DSP";
        $this->xss_token = md5("usuarios_usuario" . date('Ymdhisu'));
        $_SESSION["xss_token_usuario"] = $this->xss_token;
        $this->viewData["xss_token"] = $this->xss_token;
    }


    private function render()
    {
        Renderer::render("usuarios/usuarioform", $this->viewData);
    }
}
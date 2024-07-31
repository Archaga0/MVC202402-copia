<?php

namespace Controllers\Mantenimientos\Bitacora;

use \Dao\Bitacora\Bitacora as DaoBitacora;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Bitacora extends \Controllers\PublicController
{
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Nueva Entrada en Bitácora",
        "UPD" => "Actualizando Entrada en Bitácora %s",
        "DSP" => "Detalle de Entrada en Bitácora %s",
        "DEL" => "Eliminando Entrada en Bitácora %s"
    ];
    private $modeDsc = "";

    private $bitacoracod = 0;
    private $bitacorafch = "";
    private $bitprograma = "";
    private $bitdescripcion = "";
    private $bitobservacion = "";
    private $bitTipo = "";
    private $bitusuario = 0;

    private $errors = array();
    private $xsrftk = "";

    public function run(): void
    {
        // 1. Cargar datos del GET
        $this->obtenerDatosDelGet();
        
        // 2. Si en GET viene el ID, obtener datos de la Bitácora desde la DB
        $this->getDatosFromDB();
        
        // 3. Si es un postback
        if ($this->isPostBack()) {
            $this->obtenerDatosDePost();
            if (count($this->errors) === 0) {
                // 3.3 Si los datos son válidos
                // 3.3.1 Guardar datos en la base de datos
                $this->procesarAccion();
            }
            // 3.4 Si los datos no son válidos
            // 3.4.1 Mostrar errores
        }
        
        // 4. Mostrar el formulario
        $this->showView();
    }

    private function obtenerDatosDelGet()
    {
        if (isset($_GET["mode"])) {
            $this->mode = $_GET["mode"];
        }
        if (!isset($this->modeDscArr[$this->mode])) {
            throw new \Exception("Modo no válido");
        }
        if (isset($_GET["bitacoracod"])) {
            $this->bitacoracod = intval($_GET["bitacoracod"]);
        }
        if ($this->mode != "INS" && $this->bitacoracod <= 0) {
            throw new \Exception("ID no válido");
        }
    }

    private function getDatosFromDB()
    {
        if ($this->bitacoracod > 0) {
            $entrada = DaoBitacora::readEntrada($this->bitacoracod);
            if (!$entrada) {
                throw new \Exception("Entrada en Bitácora no encontrada");
            }
            $this->bitacorafch = $entrada["bitacorafch"];
            $this->bitprograma = $entrada["bitprograma"];
            $this->bitdescripcion = $entrada["bitdescripcion"];
            $this->bitobservacion = $entrada["bitobservacion"];
            $this->bitTipo = $entrada["bitTipo"];
            $this->bitusuario = $entrada["bitusuario"];
        }
    }

    private function obtenerDatosDePost()
    {
        $tmpPrograma = $_POST["bitprograma"] ?? "";
        $tmpDescripcion = $_POST["bitdescripcion"] ?? "";
        $tmpObservacion = $_POST["bitobservacion"] ?? "";
        $tmpTipo = $_POST["bitTipo"] ?? "";
        $tmpUsuario = $_POST["bitusuario"] ?? 0;
        $tmpMode = $_POST["mode"] ?? "";
        $tmpXsrfTk = $_POST["xsrftk"] ?? "";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrió un error al procesar la solicitud.");
        }

        if (Validators::IsEmpty($tmpPrograma)) {
            $this->addError("bitprograma", "El programa no puede estar vacío", "error");
        }
        $this->bitprograma = $tmpPrograma;

        if (Validators::IsEmpty($tmpDescripcion)) {
            $this->addError("bitdescripcion", "La descripción no puede estar vacía", "error");
        }
        $this->bitdescripcion = $tmpDescripcion;

        // Validar otros campos según sea necesario

        if (Validators::IsEmpty($tmpMode) || !in_array($tmpMode, ["INS", "UPD", "DEL"])) {
            $this->throwError("Ocurrió un error al procesar la solicitud.");
        }
    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case "INS":
                $insResult = DaoBitacora::createEntrada(
                    $this->bitprograma,
                    $this->bitdescripcion,
                    $this->bitobservacion,
                    $this->bitTipo,
                    $this->bitusuario
                );
                $this->validateDBOperation(
                    "Entrada en Bitácora insertada correctamente",
                    "Ocurrió un error al insertar la entrada en Bitácora",
                    $insResult
                );
                break;
            case "UPD":
                $updResult = DaoBitacora::updateEntrada(
                    $this->bitacoracod,
                    $this->bitprograma,
                    $this->bitdescripcion,
                    $this->bitobservacion,
                    $this->bitTipo,
                    $this->bitusuario
                );
                $this->validateDBOperation(
                    "Entrada en Bitácora actualizada correctamente",
                    "Ocurrió un error al actualizar la entrada en Bitácora",
                    $updResult
                );
                break;
            case "DEL":
                $delResult = DaoBitacora::deleteEntrada($this->bitacoracod);
                $this->validateDBOperation(
                    "Entrada en Bitácora eliminada correctamente",
                    "Ocurrió un error al eliminar la entrada en Bitácora",
                    $delResult
                );
                break;
        }
    }

    private function validateDBOperation($msg, $error, $result)
    {
        if (!$result) {
            $this->errors["error_general"] = $error;
        } else {
            Site::redirectToWithMsg(
                "index.php?page=Mantenimientos-Bitacora-Entradas",
                $msg
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=Mantenimientos-Bitacora-Entradas",
            $msg
        );
    }

    private function addError($key, $msg, $context = "general")
    {
        if (!isset($this->errors[$context . "_" . $key])) {
            $this->errors[$context . "_" . $key] = [];
        }
        $this->errors[$context . "_" . $key][] = $msg;
    }

    private function generateXSRFToken()
    {
        $this->xsrftk = md5(uniqid(rand(), true));
        $_SESSION[$this->name . "_xsrftk"] = $this->xsrftk;
    }

    private function getXSRFToken()
    {
        if (isset($_SESSION[$this->name . "_xsrftk"])) {
            $this->xsrftk = $_SESSION[$this->name . "_xsrftk"];
        }
    }

    private function compareXSRFToken($postXSFR)
    {
        return $postXSFR === $this->xsrftk;
    }

    private function showView()
    {
        $this->generateXSRFToken();
        $viewData = array();
        $viewData["mode"] = $this->mode;
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->bitprograma);
        $viewData["bitacoracod"] = $this->bitacoracod;
        $viewData["bitprograma"] = $this->bitprograma;
        $viewData["bitdescripcion"] = $this->bitdescripcion;
        $viewData["bitobservacion"] = $this->bitobservacion;
        $viewData["bitTipo"] = $this->bitTipo;
        $viewData["bitusuario"] = $this->bitusuario;
        $viewData["errors"] = $this->errors;
        $viewData["xsrftk"] = $this->xsrftk;
        $viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode == "DSP";
        \Views\Renderer::render("mantenimientos/bitacora/form", $viewData);
    }
}


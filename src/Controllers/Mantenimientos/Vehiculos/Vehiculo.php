<?php

namespace Controllers\Mantenimientos\Vehiculos;

use \Dao\Vehiculos\Vehiculos as DaoVehiculos;
use \Dao\Productos\Categories as DaoCategories;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Vehiculo extends \Controllers\PublicController
{
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Nuevo Vehiculo",
        "UPD" => "Actualizando Vehiculo %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];
    private $modeDsc = "";

    private $errors = array();
    private $xsrftk = "";

    private $id_vehiculo;
    private $marca;
    private $modelo;
    private $anio_fabricacion;
    private $tipo_combustible;
    private $kilometraje;


    public function run(): void
    {

        // 1 cargarData del GET
        $this->obtenerDatosDelGet();
        // 2 si en GET viene el ID obtener producto del DB
        $this->getDatosFromDB();
        // 3 si es  un postback
        if ($this->isPostBack()) {
            $this->obtenerDatosDePost();
            if (count($this->errors) === 0) {
                // 3.3 si los datos son validos
                // 3.3.1 guardar datos en la base de datos
                // 3.3.2 redirigir a la lista de productos
                $this->procesarAccion();
            }
            // 3.4 si los datos no son validos
            // 3.4.1 mostrar errores
        }
        // 4 mostrar el formulario
        $this->showView();
    }

    private function obtenerDatosDelGet()
    {
        if (isset($_GET["mode"])) {
            $this->mode = $_GET["mode"];
        }
        if (!isset($this->modeDscArr[$this->mode])) {
            throw new \Exception("Modo no valido");
        }
        if (isset($_GET["id_vehiculo"])) {
            $this->id = intval($_GET["id_vehiculo"]);
        }
        if ($this->mode != "INS" && $this->id_vehiculo <= 0) {
            throw new \Exception("ID no valido");
        }
    }

    private function getDatosFromDB()
    {
        if ($this->id_vehiculo > 0) {
            $vehiculo = DaoVehiculos::readVehiculo($this->id_vehiculo);
            if (!$vehiculo) {
                throw new \Exception("Vehiculo no encontrado");
            }
            $this->marca = $vehiculo["marca"];
            $this->modelo = $vehiculo["modelo"];
            $this->anio_fabricacion = $vehiculo["año_fabricacion"];
            $this->tipo_combustible = $vehiculo["tipo_combustible"];
            $this->kilometraje = $vehiculo["kilometraje"];
        }
    }

    private function obtenerDatosDePost()
    {
        $tmpMarca = $_POST["marca"] ?? "";
        $tmpModelo = $_POST["modelo"] ?? "";
        $tmpAnio_fabricacion = $_POST["año_fabricacion"] ?? "";
        $tmpTipo_combustible = $_POST["tipo_combustible"] ?? "";
        $tmpKilometraje = $_POST["kilometraje"] ?? "";
        $tmpXsrfTk = $_POST["xsrftk"] ?? "";
        $tmpMode = $_POST["mode"] ?? "";
       

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }

        if (Validators::IsEmpty($tmpMarca)) {
            $this->addError("marca", "La Marca no puede estar vacio", "error");
        }
        $this->marca = $tmpMarca;

        if (Validators::IsEmpty($tmpModelo)) {
            $this->addError("modelo", "El modelo no puede estar vacio", "error");
        }
        $this->modelo = $tmpModelo;

        if (Validators::IsEmpty($tmpAnio_fabricacion)) {
            $this->addError("año_fabricacion", "El Año no puede estar vacio", "error");
        } elseif (!Validators::IsInteger($tmpAnio_fabricacion)) {
            $this->addError("año_fabricacion", "El Año no es valido", "error");
        }
        $this->anio_fabricacion = $tmpAnio_fabricacion;

        if (Validators::IsEmpty($tmpTipo_combustible)) {
            $this->addError("tipo_combustible", "El Tipo de combustible no puede estar vacio", "error");
        }
        $this->tipo_combustible = $tmpTipo_combustible;

        if (Validators::IsEmpty($tmpKilometraje)) {
            $this->addError("kilometraje", "El kilometraje no puede estar vacio", "error");
        } elseif (!Validators::IsInteger($tmpKilometraje)) {
            $this->addError("kilometraje", "El kilometraje no es valido", "error");
        }
        $this->kilometraje = $tmpKilometraje;

        if (Validators::IsEmpty($tmpMode) || !in_array($tmpMode, ["INS", "UPD", "DEL"])) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }

    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case "INS":
                $insResult = DaoVehiculos::createVehiculo   (
                    $this->marca,
                    $this->modelo,
                    $this->anio_fabricacion,
                    $this->tipo_combustible,
                    $this->kilometraje
                );
                $this->validateDBOperation(
                    "Vehiculo insertado correctamente",
                    "Ocurrio un error al insertar el Vehiculo",
                    $insResult
                );
                break;
            case "UPD":
                $updResult = DaoVehiculos::updateVehiculo(
                    $this->id_vehiculo,
                    $this->marca,
                    $this->modelo,
                    $this->anio_fabricacion,
                    $this->tipo_combustible,
                    $this->kilometraje
                );
                $this->validateDBOperation(
                    "Vehiculo actualizado correctamente",
                    "Ocurrio un error al actualizar el Vehiculo",
                    $updResult
                );
                break;
            case "DEL":
                $delResult = DaoVehiculos::deleteVehiculo($this->id_vehiculo);
                $this->validateDBOperation(
                    "Vehiculo eliminado correctamente",
                    "Ocurrio un error al eliminar el Vehiculo",
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
                "index.php?page=Mantenimientos-Vehiculos-Vehiculos",
                $msg
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=Mantenimientos-Vehiculos-Vehiculos",
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
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->marca);
        $viewData["id_vehiculo"] = $this->id_vehiculo;
        $viewData["marca"] = $this->marca;
        $viewData["modelo"] = $this->modelo;
        $viewData["año_fabricacion"] = $this->anio_fabricacion;
        $viewData["tipo_combustible"] = $this->tipo_combustible;
        $viewData["kilometraje"] = $this->kilometraje;
        $viewData["errors"] = $this->errors;
        $viewData["xsrftk"] = $this->xsrftk;
        $viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode == "DSP";
        \Views\Renderer::render("mantenimientos/vehiculos/form", $viewData);
    }
}

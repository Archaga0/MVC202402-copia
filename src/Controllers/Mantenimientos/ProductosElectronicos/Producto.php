<?php

namespace Controllers\Mantenimientos\ProductosElectronicos;

use \Dao\ProductosElectronicos\Productos as DaoProductosElectronicos;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Producto extends \Controllers\PublicController
{
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Nuevo Producto",
        "UPD" => "Actualizando Producto %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];
    private $modeDsc = "";

    private $id = 0;
    private $nombreProducto = "";
    private $categoria = "";
    private $marca = "";
    private $modelo = "";
    private $descripcion = "";
    private $precio = 0;
    private $cantidadDisponible = 0;
    private $proveedor = "";
    private $fechaAdquisicion = "";
    private $estadoProducto = "Nuevo";
    private $imagenesProducto = "";
    private $garantia = "";
    private $errores = [];
    private $tokenXSRF = "";

    public function run(): void
    {
        // 1. Cargar datos del GET
        $this->obtenerDatosDelGet();
        // 2. Si en GET viene el ID, obtener producto del DB
        $this->getDatosFromDB();
        // 3. Si es un postback
        if ($this->isPostBack()) {
            $this->obtenerDatosDelPost();
            if (count($this->errores) === 0) {
                // 3.3 Si los datos son válidos
                // 3.3.1 Guardar datos en la base de datos
                // 3.3.2 Redirigir a la lista de productos
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
        if (isset($_GET["id"])) {
            $this->id = intval($_GET["id"]);
        }
        if ($this->mode != "INS" && $this->id <= 0) {
            throw new \Exception("ID no válido");
        }
    }

    private function getDatosFromDB()
    {
        if ($this->id > 0) {
            $producto = DaoProductosElectronicos::readProducto($this->id);
            if (!$producto) {
                throw new \Exception("Producto no encontrado");
            }
            $this->nombreProducto = $producto["Nombre_Producto"];
            $this->categoria = $producto["Categoria"];
            $this->marca = $producto["Marca"];
            $this->modelo = $producto["Modelo"];
            $this->descripcion = $producto["Descripcion"];
            $this->precio = $producto["Precio"];
            $this->cantidadDisponible = $producto["Cantidad_Disponible"];
            $this->proveedor = $producto["Proveedor"];
            $this->fechaAdquisicion = $producto["Fecha_Adquisicion"];
            $this->estadoProducto = $producto["Estado_Producto"];
            $this->imagenesProducto = $producto["Imagenes_Producto"];
            $this->garantia = $producto["Garantia"];
        }
    }

    private function obtenerDatosDelPost()
    {
        $tmpNombre = $_POST["nombre"] ?? "";
        $tmpCategoria = $_POST["categoria"] ?? "";
        $tmpMarca = $_POST["marca"] ?? "";
        $tmpModelo = $_POST["modelo"] ?? "";
        $tmpDescripcion = $_POST["descripcion"] ?? "";
        $tmpPrecio = $_POST["precio"] ?? "";
        $tmpCantidadDisponible = $_POST["cantidadDisponible"] ?? "";
        $tmpProveedor = $_POST["proveedor"] ?? "";
        $tmpFechaAdquisicion = $_POST["fechaAdquisicion"] ?? "";
        $tmpEstadoProducto = $_POST["estadoProducto"] ?? "";
        $tmpImagenesProducto = $_POST["imagenesProducto"] ?? "";
        $tmpGarantia = $_POST["garantia"] ?? "";
        $tmpMode = $_POST["mode"] ?? "";
        $tmpTokenXSRF = $_POST["tokenXSRF"] ?? "";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpTokenXSRF)) {
            $this->throwError("Ocurrió un error al procesar la solicitud.");
        }

        if (Validators::IsEmpty($tmpNombre)) {
            $this->agregarError("nombre", "El nombre no puede estar vacío", "error");
        }
        $this->nombreProducto = $tmpNombre;

        if (Validators::IsEmpty($tmpPrecio)) {
            $this->agregarError("precio", "El precio no puede estar vacío", "error");
        } elseif (!Validators::IsCurrency($tmpPrecio)) {
            $this->agregarError("precio", "El precio no es válido", "error");
        }
        $this->precio = $tmpPrecio;

        if (Validators::IsEmpty($tmpCantidadDisponible)) {
            $this->agregarError("cantidadDisponible", "La cantidad disponible no puede estar vacía", "error");
        } elseif (!Validators::IsInteger($tmpCantidadDisponible)) {
            $this->agregarError("cantidadDisponible", "La cantidad disponible no es válida", "error");
        }
        $this->cantidadDisponible = $tmpCantidadDisponible;

        if (Validators::IsEmpty($tmpEstadoProducto) || !in_array($tmpEstadoProducto, ["Nuevo", "Usado", "Reacondicionado"])) {
            $this->agregarError("estadoProducto", "El estado no es válido", "error");
        }
        $this->estadoProducto = $tmpEstadoProducto;

        if (Validators::IsEmpty($tmpMode) || !in_array($tmpMode, ["INS", "UPD", "DEL"])) {
            $this->throwError("Ocurrió un error al procesar la solicitud.");
        }

        $this->categoria = $tmpCategoria;
        $this->marca = $tmpMarca;
        $this->modelo = $tmpModelo;
        $this->descripcion = $tmpDescripcion;
        $this->proveedor = $tmpProveedor;
        $this->fechaAdquisicion = $tmpFechaAdquisicion;
        $this->imagenesProducto = $tmpImagenesProducto;
        $this->garantia = $tmpGarantia;
    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case "INS":
                $resultadoIns = DaoProductosElectronicos::createProducto(
                    $this->nombreProducto,
                    $this->categoria,
                    $this->marca,
                    $this->modelo,
                    $this->descripcion,
                    $this->precio,
                    $this->cantidadDisponible,
                    $this->proveedor,
                    $this->fechaAdquisicion,
                    $this->estadoProducto,
                    $this->imagenesProducto,
                    $this->garantia
                );
                $this->validarOperacionBD(
                    "Producto insertado correctamente",
                    "Ocurrió un error al insertar el producto",
                    $resultadoIns
                );
                break;
            case "UPD":
                $resultadoUpd = DaoProductosElectronicos::updateProducto(
                    $this->id,
                    $this->nombreProducto,
                    $this->categoria,
                    $this->marca,
                    $this->modelo,
                    $this->descripcion,
                    $this->precio,
                    $this->cantidadDisponible,
                    $this->proveedor,
                    $this->fechaAdquisicion,
                    $this->estadoProducto,
                    $this->imagenesProducto,
                    $this->garantia
                );
                $this->validarOperacionBD(
                    "Producto actualizado correctamente",
                    "Ocurrió un error al actualizar el producto",
                    $resultadoUpd
                );
                break;
            case "DEL":
                $resultadoDel = DaoProductosElectronicos::deleteProducto($this->id);
                $this->validarOperacionBD(
                    "Producto eliminado correctamente",
                    "Ocurrió un error al eliminar el producto",
                    $resultadoDel
                );
                break;
        }
    }

    private function validarOperacionBD($mensaje, $error, $resultado)
    {
        if (!$resultado) {
            $this->errores["error_general"] = $error;
        } else {
            Site::redirectToWithMsg(
                "index.php?page=Mantenimientos-ProductosElectronicos-Productos",
                $mensaje
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=Mantenimientos-ProductosElectronicos-Productos",
            $msg
        );
    }

    private function generateXSRFToken()
    {
        $this->tokenXSRF = bin2hex(random_bytes(32));
        $_SESSION["tokenXSRF"] = $this->tokenXSRF;
    }

    private function getXSRFToken()
    {
        $this->tokenXSRF = $_SESSION["tokenXSRF"] ?? "";
    }

    private function compareXSRFToken($token)
    {
        return $this->tokenXSRF === $token;
    }

    private function showView()
    {
        $this->modeDsc = sprintf($this->modeDscArr[$this->mode], $this->nombreProducto);
        $data = [
            "modeDsc" => $this->modeDsc,
            "mode" => $this->mode,
            "id" => $this->id,
            "nombre" => $this->nombreProducto,
            "categoria" => $this->categoria,
            "marca" => $this->marca,
            "modelo" => $this->modelo,
            "descripcion" => $this->descripcion,
            "precio" => $this->precio,
            "cantidadDisponible" => $this->cantidadDisponible,
            "proveedor" => $this->proveedor,
            "fechaAdquisicion" => $this->fechaAdquisicion,
            "estadoProducto" => $this->estadoProducto,
            "imagenesProducto" => $this->imagenesProducto,
            "garantia" => $this->garantia,
            "estadoProductoOptions" => [
                ["value" => "Nuevo", "text" => "Nuevo", "selected" => $this->estadoProducto == "Nuevo"],
                ["value" => "Usado", "text" => "Usado", "selected" => $this->estadoProducto == "Usado"],
                ["value" => "Reacondicionado", "text" => "Reacondicionado", "selected" => $this->estadoProducto == "Reacondicionado"]
            ],
            "errores" => $this->errores,
            "tokenXSRF" => $this->tokenXSRF,
        ];
        \Views\Renderer::render("Mantenimientos/Productoselectronicos/form", $data);
    }

    private function agregarError($field, $msg, $type = "error")
    {
        $this->errores[$field][] = [
            "text" => $msg,
            "type" => $type
        ];
    }
}


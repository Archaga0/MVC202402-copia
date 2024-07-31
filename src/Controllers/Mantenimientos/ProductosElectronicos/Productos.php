<?php

namespace Controllers\Mantenimientos\ProductosElectronicos;

use \Dao\ProductosElectronicos\Productos as DaoProductosElectronicos;

const SESION_BUSQUEDA_PRODUCTOS = "productos_busqueda_datos";

class Productos extends \Controllers\PublicController
{
    public function run(): void
    {
        $datosVista = array();
        $datosVista["busqueda"] = $this->obtenerDatosBusquedaDeSesion();
        if ($this->isPostBack()) {
            $datosVista["busqueda"] = $this->obtenerDatosBusqueda();
            $this->establecerDatosBusquedaDeSesion($datosVista["busqueda"]);
        }

        $datosVista["productos"] = DaoProductosElectronicos::readAllProductos($datosVista["busqueda"]);
        $datosVista["total"] = count($datosVista["productos"]);

        \Views\Renderer::render("mantenimientos/productoselectronicos/lista", $datosVista);
    }

    private function obtenerDatosBusqueda()
    {
        if (isset($_POST["busqueda"])) {
            return $_POST["busqueda"];
        }
        return "";
    }

    private function obtenerDatosBusquedaDeSesion()
    {
        if (isset($_SESSION[SESION_BUSQUEDA_PRODUCTOS])) {
            return $_SESSION[SESION_BUSQUEDA_PRODUCTOS];
        }
        return "";
    }

    private function establecerDatosBusquedaDeSesion($busqueda)
    {
        $_SESSION[SESION_BUSQUEDA_PRODUCTOS] = $busqueda;
    }
}

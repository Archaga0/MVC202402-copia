<?php

namespace Controllers\Mantenimientos\Bitacora;

use \Dao\Bitacora\Bitacora as DaoBitacora;

const SESSION_BITACORA_SEARCH = "bitacora_search_data";

class Bitacoras extends \Controllers\PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["search"] = $this->getSessionSearchData();
        if ($this->isPostBack()) {
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
        }

        $viewData["entradas"] = DaoBitacora::readAllEntradas($viewData["search"]);
        $viewData["total"] = count($viewData["entradas"]);

        \Views\Renderer::render("mantenimientos/bitacora/lista", $viewData);
    }

    private function getSearchData()
    {
        if (isset($_POST["search"])) {
            return $_POST["search"];
        }
        return "";
    }

    private function getSessionSearchData()
    {
        if (isset($_SESSION[SESSION_BITACORA_SEARCH])){
            return $_SESSION[SESSION_BITACORA_SEARCH];
        }
        return "";
    }

    private function setSessionSearchData($search){
        $_SESSION[SESSION_BITACORA_SEARCH] = $search;
    }
}


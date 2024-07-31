<?php

namespace Controllers\Landing;

use Controllers\PublicController;
use Dao\Productos\Productos;
use Views\Renderer;

class ProductosOfertas extends PublicController {

    public function run(): Void {

        // extraer los 5 productos con oferta
        // DAO data acces object
        //crear una vista para crear los productos
        // inyectar los productos en la vista

        $viewData = array();

        $viewData['productos'] = Productos::getDBProductosOferta();

        Renderer::render('productos/productosOferta', $viewData);

    
    }

}

   
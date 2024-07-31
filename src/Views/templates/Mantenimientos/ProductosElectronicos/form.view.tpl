<section class="grid">
    <section class="row">
        <h2 class="col-12 col-m-6 offset-m-3 depth-1 p-4">{{modeDsc}}</h2>
    </section>
</section>

<section class="grid">
    <section class="row my-4">
        <form class="col-12 col-m-6 offset-m-3 depth-1" action="index.php?page=Mantenimientos-ProductosElectronicos-producto&mode={{mode}}&id={{id}}" method="POST">
            <input type="hidden" name="id" value="{{id}}">
            <input type="hidden" name="xsrftk" value="{{tokenXSRF}}">
            <input type="hidden" name="mode" value="{{mode}}">

            <div class="row my-4">
                <label class="col-4" for="prdId">ID Producto:</label>
                <input class="col-8" type="text" name="id" id="prdId" value="{{id}}" readonly>
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdNombre">Nombre:</label>
                <input class="col-8" type="text" name="nombre" id="prdNombre" value="{{nombre}}" required {{isReadOnly}}>
                {{with errores}}
                    {{if errores.nombre}}
                        {{foreach errores.nombre}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdCategoria">Categoría:</label>
                <input class="col-8" type="text" name="categoria" id="prdCategoria" value="{{categoria}}" required {{isReadOnly}}>
                {{with errores}}
                    {{if errores.categoria}}
                        {{foreach errores.categoria}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdMarca">Marca:</label>
                <input class="col-8" type="text" name="marca" id="prdMarca" value="{{marca}}" required {{isReadOnly}}>
                {{with errores}}
                    {{if errores.marca}}
                        {{foreach errores.marca}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdModelo">Modelo:</label>
                <input class="col-8" type="text" name="modelo" id="prdModelo" value="{{modelo}}" required {{isReadOnly}}>
                {{with errores}}
                    {{if errores.modelo}}
                        {{foreach errores.modelo}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdDescripcion">Descripción:</label>
                <textarea class="col-8" name="descripcion" id="prdDescripcion" required {{isReadOnly}}>{{descripcion}}</textarea>
                {{with errores}}
                    {{if errores.descripcion}}
                        {{foreach errores.descripcion}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdPrecio">Precio:</label>
                <input class="col-8" type="number" step="0.01" name="precio" id="prdPrecio" value="{{precio}}" required {{isReadOnly}}>
                {{with errores}}
                    {{if errores.precio}}
                        {{foreach errores.precio}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdCantidad">Cantidad:</label>
                <input class="col-8" type="number" name="cantidadDisponible" id="prdCantidad" value="{{cantidadDisponible}}" required {{isReadOnly}}>
                {{with errores}}
                    {{if errores.cantidadDisponible}}
                        {{foreach errores.cantidadDisponible}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdProveedor">Proveedor:</label>
                <input class="col-8" type="text" name="proveedor" id="prdProveedor" value="{{proveedor}}" {{isReadOnly}}>
                {{with errores}}
                    {{if errores.proveedor}}
                        {{foreach errores.proveedor}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdFecha">Fecha de Adquisición:</label>
                <input class="col-8" type="date" name="fechaAdquisicion" id="prdFecha" value="{{fechaAdquisicion}}" {{isReadOnly}}>
                {{with errores}}
                    {{if errores.fechaAdquisicion}}
                        {{foreach errores.fechaAdquisicion}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdEstado">Estado:</label>
                <select class="col-8" name="estadoProducto" id="prdEstado" required {{if isReadOnly}} readonly disabled {{endif}}>
                    {{foreach estadoProductoOptions}}
                        <option value="{{value}}" {{selected ? "selected" : ""}}>{{text}}</option>
                    {{endfor}}
                </select>
                {{with errores}}
                    {{if errores.estadoProducto}}
                        {{foreach errores.estadoProducto}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdImagenes">Imágenes:</label>
                <input class="col-8" type="text" name="imagenesProducto" id="prdImagenes" value="{{imagenesProducto}}" {{isReadOnly}}>
                {{with errores}}
                    {{if errores.imagenesProducto}}
                        {{foreach errores.imagenesProducto}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="prdGarantia">Garantía:</label>
                <input class="col-8" type="text" name="garantia" id="prdGarantia" value="{{garantia}}" {{isReadOnly}}>
                {{with errores}}
                    {{if errores.garantia}}
                        {{foreach errores.garantia}}
                            <div class="col-12 error">{{text}}</div>
                        {{endfor}}
                    {{endif}}
                {{endwith}}
            </div>

            <div class="row flex-end">
                {{if !isDisplay}}
                    <button type="submit" class="primary mx-2">
                        <i class="fa-solid fa-check"></i>&nbsp;
                        Guardar
                    </button>
                {{endif}}
                <button type="button" onclick="window.location='index.php?page=Mantenimientos-ProductosElectronicos-Productos'">
                    <i class="fa-solid fa-xmark"></i>
                    Cancelar
                </button>
            </div>
        </form>
    </section>
</section>

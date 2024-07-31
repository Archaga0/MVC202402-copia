<section class="grid">
    <section class="row">
        <h2 class="col-12 col-m-6 offset-m-3 depth-1 p-4">{{modeDsc}}</h2>
    </section>
</section>
<section class="grid">
    <section class="row my-4">
        <form class="col-12 col-m-6 offset-m-3 depth-1" action="index.php?page=Mantenimientos-Bitacora-Bitacora&mode={{mode}}&bitacoracod={{bitacoracod}}" method="POST">
            <input type="hidden" name="bitacoracod" value="{{bitacoracod}}">
            <input type="hidden" name="xsrftk" value="{{xsrftk}}">
            <input type="hidden" name="mode" value="{{mode}}">
            <div class="row my-4">
                <label class="col-4" for="bitacoracod">Código:</label>
                <input class="col-8" type="text" name="bitacoracod" id="bitacoracod" value="{{bitacoracod}}" readonly>
            </div>
            <div class="row my-4">
                <label class="col-4" for="bitprograma">Programa:</label>
                <input class="col-8" type="text" name="bitprograma" id="bitprograma" value="{{bitprograma}}" required {{isReadOnly}}>
                {{with errors}}
                    {{if error_bitprograma}}
                        {{foreach error_bitprograma}}
                            <div class="col-12 error">{{this}}</div>
                        {{endfor error_bitprograma}}
                    {{endif error_bitprograma}}
                {{endwith errors}}
            </div>
            <div class="row my-4">
                <label class="col-4" for="bitdescripcion">Descripción:</label>
                <input class="col-8" type="text" name="bitdescripcion" id="bitdescripcion" value="{{bitdescripcion}}" required {{isReadOnly}}>
                {{with errors}}
                    {{if error_bitdescripcion}}
                        {{foreach error_bitdescripcion}}
                            <div class="col-12 error">{{this}}</div>
                        {{endfor error_bitdescripcion}}
                    {{endif error_bitdescripcion}}
                {{endwith errors}}
            </div>
            <div class="row my-4">
                <label class="col-4" for="bitobservacion">Observación:</label>
                <textarea class="col-8" name="bitobservacion" id="bitobservacion" rows="5" required {{isReadOnly}}>{{bitobservacion}}</textarea>
                {{with errors}}
                    {{if error_bitobservacion}}
                        {{foreach error_bitobservacion}}
                            <div class="col-12 error">{{this}}</div>
                        {{endfor error_bitobservacion}}
                    {{endif error_bitobservacion}}
                {{endwith errors}}
            </div>
            <div class="row my-4">
                <label class="col-4" for="bitTipo">Tipo:</label>
                <input class="col-8" type="text" name="bitTipo" id="bitTipo" value="{{bitTipo}}" required {{isReadOnly}}>
                {{with errors}}
                    {{if error_bitTipo}}
                        {{foreach error_bitTipo}}
                            <div class="col-12 error">{{this}}</div>
                        {{endfor error_bitTipo}}
                    {{endif error_bitTipo}}
                {{endwith errors}}
            </div>
            <div class="row my-4">
                <label class="col-4" for="bitusuario">Usuario:</label>
                <input class="col-8" type="text" name="bitusuario" id="bitusuario" value="{{bitusuario}}" required {{isReadOnly}}>
                {{with errors}}
                    {{if error_bitusuario}}
                        {{foreach error_bitusuario}}
                            <div class="col-12 error">{{this}}</div>
                        {{endfor error_bitusuario}}
                    {{endif error_bitusuario}}
                {{endwith errors}}
            </div>
            <div class="row flex-end">
                {{ifnot isDisplay}}
                    <button type="submit" class="primary mx-2">
                        <i class="fa-solid fa-check"></i>&nbsp;
                        Guardar
                    </button>
                {{endifnot isDisplay}}
                <button type="button" onclick="window.location='index.php?page=Mantenimientos-Bitacora-Bitacora'">
                    <i class="fa-solid fa-xmark"></i>
                    Cancelar
                </button>
            </div>
        </form>
    </section>
</section>

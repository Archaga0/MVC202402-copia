<section class="grid">
    <section class="row">
        <h2 class="col-12 col-m-6 offset-m-3 depth-1 p-4">{{modeDsc}}</h2>
    </section>
</section>
<section class="grid">
    <section class="row my-4">
    <form class="col-12 col-m-6 offset-m-3 depth-1" action="index.php?page=Mantenimientos-Vehiculos-Vehiculos&mode={{mode}}&id={{id_vehiculo}}" method="POST" >
         <input type="hidden" name="id_vehiculo" value="{{id_vehiculo}}">
        <input type="hidden" name="xsrftk" value="{{xsrftk}}">
        <input type="hidden" name="mode" value="{{mode}}">
        <div class="row my-4">
            <label class="col-4" for="id_vehiculo">Id:</label>
            <input class="col-8" type="text" name="id_vehiculo" id="id_vehiculo" value="{{id_vehiculo}}" readonly>
        </div>
        <div class="row my-4">
            <label class="col-4" for="marca">Marca:</label>
            <input class="col-8" type="text" name="marca" id="marca" value="{{marca}}">
            {{with errors}}
                {{if error_name}}
                    {{foreach error_name}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_name}}
                {{endif error_name}}
            {{endwith errors}}
        </div>
        <div class="row my-4">
            <label class="col-4" for="modelo">Modelo:</label>
            <input class="col-8" type="text" name="modelo" id="modelo" value="{{modelo}}">
            {{with errors}}
                {{if error_name}}
                    {{foreach error_name}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_name}}
                {{endif error_name}}
            {{endwith errors}}
        </div>
        
        <div class="row my-4">
            <label class="col-4" for="año_fabricacion">Año de Fabricacion:</label>
            <input class="col-8" type="number" name="año_fabricacion" id="año_fabricacion" value="{{anio_fabricacion}}">
            {{with errors}}
                {{if error_price}}
                    {{foreach error_price}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_price}}
                {{endif error_price}}
            {{endwith errors}}
        </div>

        <div class="row my-4">
            <label class="col-4" for="tipo_combustible">Tipo de Combustible:</label>
            <input class="col-8" type="text" name="tipo_combustible" id="tipo_combustible" value="{{tipo_combustible}}">
            {{with errors}}
                {{if error_stock}}
                    {{foreach error_stock}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_stock}}
                {{endif error_stock}}
            {{endwith errors}}
        </div>

         <div class="row my-4">
            <label class="col-4" for="kilometraje">Kilometraje:</label>
            <input class="col-8" type="text" name="kilometraje" id="kilometraje" value="{{kilometraje}}" required {{isReadOnly}}>
            {{with errors}}
                {{if error_stock}}
                    {{foreach error_stock}}
                        <div class="col-12 error">{{this}}</div>
                    {{endfor error_stock}}
                {{endif error_stock}}
            {{endwith errors}}
        </div>
        
        <div class="row flex-end">
            {{ifnot isDisplay}}
                <button type="submit" class="primary mx-2">
                    <i class="fa-solid fa-check"></i>&nbsp;
                    Guardar
                </button>
            {{endifnot isDisplay}}
            <button type="button" onclick="window.location='index.php?page=Mantenimientos-Vehiculos-Vehiculos'">
                <i class="fa-solid fa-xmark"></i>
                Cancelar
            </button>
        </div>
    </form>
    </section>
</section>
<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de productos</h2>
        <section class="grid">
            <form action="index.php?page=Mantenimientos-Vehiculos-Vehiculos" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por marca" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Combustible</th>
                <th>Kilometraje</th>
                <th><a href="index.php?page=Mantenimientos-Vehiculos-Vehiculo&mode=INS">
                    <i class="fa-solid fa-file-circle-plus"></i>
                    &nbsp; Nuevo producto</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach vehiculos}}
                <tr>
                    <td>{{id_vehiculo}}</td>
                    <td><a href="index.php?page=Mantenimientos-Vehiculos-Vehiculo&mode=DSP&id={{id_vehiculo}}"><i class="fa-solid fa-eye"></i> &nbsp;{{marca}}</a></td>
                    <td>{{modelo}}</td>
                    <td>{{anio_fabricacion}}</td>
                    <td>{{tipo_combustible}}</td>
                    <td>{{Kilometraje}}</td>
                    <td class="center">
                        <a href="index.php?page=Mantenimientos-Vehiculos-Vehiculo&mode=UPD&id={{id_vehiculo}}">
                            <i class="fa-solid fa-pen"></i> &nbsp; Editar
                        </a>
                        &nbsp;
                        &nbsp;
                        <a href="index.php?page=Mantenimientos-Vehiculos-Vehiculo&mode=DEL&id={{id_vehiculo}}">
                            <i class="fa-solid fa-trash-can"></i> &nbsp;
                            Eliminar
                        </a>
                    </td>
                </tr>
            {{endfor vehiculos}}

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>
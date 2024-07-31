<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de productos</h2>
        <section class="grid">
            <form action="index.php?page=Mantenimientos-ProductosElectronicos-Productos" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por nombre" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Imagen</th>
                <th>Garantía</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{foreach productos}}
                <tr>
                    <td>{{ID_Producto}}</td>
                    <td>
                        <a href="index.php?page=Mantenimientos-ProductosElectronicos-Producto&mode=DSP&id={{ID_Producto}}">
                            <i class="fa-solid fa-eye"></i> &nbsp;{{Nombre_Producto}}
                        </a>
                    </td>
                    <td>{{Categoria}}</td>
                    <td>{{Marca}}</td>
                    <td>{{Modelo}}</td>
                    <td>{{Descripcion}}</td>
                    <td>{{Precio}}</td>
                    <td>{{Cantidad_Disponible}}</td>
                    <td>{{Proveedor}}</td>
                    <td>{{Fecha_Adquisicion}}</td>
                    <td>{{Estado_Producto}}</td>
                    <td>{{Imagenes_Producto}}</td>
                    <td>{{Garantia}}</td>
                    <td class="center">
                        <a href="index.php?page=Mantenimientos-ProductosElectronicos-Producto&mode=UPD&id={{ID_Producto}}">
                            <i class="fa-solid fa-pen"></i> &nbsp; Editar
                        </a>
                        &nbsp;
                        &nbsp;
                        <a href="index.php?page=Mantenimientos-ProductosElectronicos-Producto&mode=DEL&id={{ID_Producto}}">
                            <i class="fa-solid fa-trash-can"></i> &nbsp;Eliminar
                        </a>
                    </td>
                </tr>
            {{endfor productos}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="14">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
    <section class="add-new">
        <a href="index.php?page=Mantenimientos-ProductosElectronicos-Producto&mode=INS" class="add-new-product">
            <i class="fa-solid fa-file-circle-plus"></i> &nbsp; Nuevo producto
        </a>
    </section>
</section>

<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de bitácora</h2>
        <section class="grid">
            <form action="index.php?page=Mantenimientos-Bitacora-Bitacora" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por programa" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th>Código</th>
                <th>Fecha</th>
                <th>Programa</th>
                <th>Descripción</th>
                <th>Observación</th>
                <th>Tipo</th>
                <th>Usuario</th>
                <th><a href="index.php?page=Mantenimientos-Bitacora-Bitacora&mode=INS">
                    <i class="fa-solid fa-file-circle-plus"></i>
                    &nbsp; Nueva entrada</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach bitacoras}}
                <tr>
                    <td>{{bitacoracod}}</td>
                    <td>{{bitacorafch}}</td>
                    <td><a href="index.php?page=Mantenimientos-Bitacora-Bitacora&mode=DSP&bitacoracod={{bitacoracod}}">
                        <i class="fa-solid fa-eye"></i> &nbsp; {{bitprograma}}</a></td>
                    <td>{{bitdescripcion}}</td>
                    <td>{{bitobservacion}}</td>
                    <td>{{bitTipo}}</td>
                    <td>{{bitusuario}}</td>
                    <td class="center">
                        <a href="index.php?page=Mantenimientos-Bitacora-Bitacora&mode=UPD&bitacoracod={{bitacoracod}}">
                            <i class="fa-solid fa-pen"></i> &nbsp; Editar
                        </a>
                        &nbsp;
                        &nbsp;
                        <a href="index.php?page=Mantenimientos-Bitacora-Bitacora&mode=DEL&bitacoracod={{bitacoracod}}">
                            <i class="fa-solid fa-trash-can"></i> &nbsp;
                            Eliminar
                        </a>
                    </td>
                </tr>
            {{endfor bitacoras}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>

<section><h2 class="text-2xl font-bold mb-4"> LISTADO DE ROLES</h2>
<div class="overflow-x-auto">
<table class="min-w-full bg-white border border-gray-300">
<thead>
<tr>
	<th class="py-2 px-4 border-b">ROLESCOD</th>
	<th class="py-2 px-4 border-b">ROLESDSC</th>
	<th class="py-2 px-4 border-b">ROLESEST</th><th><a href="index.php?page=Roless_Roles&mode=INS">Nuevo</a></th>
	</tr>
</thead><tbody>{{foreach roles}}<tr><td class="p-2 text-center"><a class="text-blue-500 hover:text-blue-700" href="index.php?page=Roless_Roless&mode=DSP&rolescod={{rolescod}} ">{{rolescod}}</a></td><td class="p-2 text-center"><a class="text-blue-500 hover:text-blue-700" href="index.php?page=Roless_Roless&mode=DSP&rolescod={{rolescod}} ">{{rolesdsc}}</a></td><td class="p-2 text-center"><a class="text-blue-500 hover:text-blue-700" href="index.php?page=Roless_Roless&mode=DSP&rolescod={{rolescod}} ">{{rolesest}}</a></td>
            <td class"p-2 text-center">
                <a class="text-green-500 hover:text-green-700" href="index.php?page=Roless_Roless&mode=UPD&rolescod={{rolescod}}" >Editar</a> 
                <a class="text-red-500 hover:text-red-700" href="index.php?page=Roless_Roless&mode=DEL&rolescod={{rolescod}}" >Eliminar</a>
            </td>
	</tr>
 {{endfor roles}}</tbody>
</table>
</div> </section>
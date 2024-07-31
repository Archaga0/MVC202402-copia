<section><h2 class="text-2xl font-bold mb-4"> LISTADO DE ROLES_USUARIOS</h2>
<div class="overflow-x-auto">
<table class="min-w-full bg-white border border-gray-300">
<thead>
<tr>
	<th class="py-2 px-4 border-b">USERCOD</th>
	<th class="py-2 px-4 border-b">ROLESCOD</th>
	<th class="py-2 px-4 border-b">ROLEUSEREST</th>
	<th class="py-2 px-4 border-b">ROLEUSERFCH</th>
	<th class="py-2 px-4 border-b">ROLEUSEREXP</th><th><a href="index.php?page=Roles_usuarioss_Roles_usuarios&mode=INS">Nuevo</a></th>
	</tr>
</thead><tbody>{{foreach roles_usuarios}}<tr><td class="p-2 text-center"><a class="text-blue-500 hover:text-blue-700" href="index.php?page=Roles_usuarioss_Roles_usuarioss&mode=DSP&usercod={{usercod}} ">{{usercod}}</a></td><td class="p-2 text-center"><a class="text-blue-500 hover:text-blue-700" href="index.php?page=Roles_usuarioss_Roles_usuarioss&mode=DSP&usercod={{usercod}} ">{{rolescod}}</a></td><td class="p-2 text-center"><a class="text-blue-500 hover:text-blue-700" href="index.php?page=Roles_usuarioss_Roles_usuarioss&mode=DSP&usercod={{usercod}} ">{{roleuserest}}</a></td><td class="p-2 text-center"><a class="text-blue-500 hover:text-blue-700" href="index.php?page=Roles_usuarioss_Roles_usuarioss&mode=DSP&usercod={{usercod}} ">{{roleuserfch}}</a></td><td class="p-2 text-center"><a class="text-blue-500 hover:text-blue-700" href="index.php?page=Roles_usuarioss_Roles_usuarioss&mode=DSP&usercod={{usercod}} ">{{roleuserexp}}</a></td>
            <td class"p-2 text-center">
                <a class="text-green-500 hover:text-green-700" href="index.php?page=Roles_usuarioss_Roles_usuarioss&mode=UPD&usercod={{usercod}}" >Editar</a> 
                <a class="text-red-500 hover:text-red-700" href="index.php?page=Roles_usuarioss_Roles_usuarioss&mode=DEL&usercod={{usercod}}" >Eliminar</a>
            </td>
	</tr>
 {{endfor roles_usuarios}}</tbody>
</table>
</div> </section>
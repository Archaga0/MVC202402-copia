<section class="bg-gray-100 p-4">
    <h1 class="text-2xl font-bold mb-4"> Descripcion roles_usuarios {{modedsc}}</h1>
    
{{with roles_usuarios}}

    <form class="my-4 bg-white p-8 rounded shadow-lg mx-auto max-w-md" action="index.php?page=Roles_usuarioss_Roles_usuarios&mode={{~mode}}&usercod={{id}}" method="POST"><input type="hidden" name="xss-token" value="{{~xss_token}}"/><section class="mb-4">
                <label for="usercod" class="block text-gray-700 text-sm font-bold mb-2">usercod</label>
                <input type="text" id="usercod" name="usercod" placeholder="usercod de roles_usuarios " value="{{usercod}}" {{if ~readonly}} disabled readonly {{endif ~readonly}} class="w-full py-2 px-3 border border-gray-300 rounded focus:outline-none focus:border-blue-400"/>
                {{if usercod_error}}<div class="text-red-500 text-sm">{{usercod_error}}</div>{{endif usercod_error}}
            </section><section class="mb-4">
                <label for="rolescod" class="block text-gray-700 text-sm font-bold mb-2">rolescod</label>
                <input type="text" id="rolescod" name="rolescod" placeholder="rolescod de roles_usuarios " value="{{rolescod}}" {{if ~readonly}} disabled readonly {{endif ~readonly}} class="w-full py-2 px-3 border border-gray-300 rounded focus:outline-none focus:border-blue-400"/>
                {{if rolescod_error}}<div class="text-red-500 text-sm">{{rolescod_error}}</div>{{endif rolescod_error}}
            </section><section class="mb-4">
                <label for="roleuserest" class="block text-gray-700 text-sm font-bold mb-2">roleuserest</label>
                <input type="text" id="roleuserest" name="roleuserest" placeholder="roleuserest de roles_usuarios " value="{{roleuserest}}" {{if ~readonly}} disabled readonly {{endif ~readonly}} class="w-full py-2 px-3 border border-gray-300 rounded focus:outline-none focus:border-blue-400"/>
                {{if roleuserest_error}}<div class="text-red-500 text-sm">{{roleuserest_error}}</div>{{endif roleuserest_error}}
            </section><section class="mb-4">
                <label for="roleuserfch" class="block text-gray-700 text-sm font-bold mb-2">roleuserfch</label>
                <input type="text" id="roleuserfch" name="roleuserfch" placeholder="roleuserfch de roles_usuarios " value="{{roleuserfch}}" {{if ~readonly}} disabled readonly {{endif ~readonly}} class="w-full py-2 px-3 border border-gray-300 rounded focus:outline-none focus:border-blue-400"/>
                {{if roleuserfch_error}}<div class="text-red-500 text-sm">{{roleuserfch_error}}</div>{{endif roleuserfch_error}}
            </section><section class="mb-4">
                <label for="roleuserexp" class="block text-gray-700 text-sm font-bold mb-2">roleuserexp</label>
                <input type="text" id="roleuserexp" name="roleuserexp" placeholder="roleuserexp de roles_usuarios " value="{{roleuserexp}}" {{if ~readonly}} disabled readonly {{endif ~readonly}} class="w-full py-2 px-3 border border-gray-300 rounded focus:outline-none focus:border-blue-400"/>
                {{if roleuserexp_error}}<div class="text-red-500 text-sm">{{roleuserexp_error}}</div>{{endif roleuserexp_error}}
            </section><section class="col-12 right">
        {{if ~showConfirm}}
            <button type="submit" name="btnConfirm">Confirmar</button>&nbsp;
        {{endif ~showConfirm}}
        <button id="btnCancel">Cancelar</button>
        </section>
        </section></form></section>
{{endwith roles_usuarios}}

<script>
        document.addEventListener("DOMContentLoaded", ()=>{
            document.getElementById("btnCancel").addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                document.location.assign("index.php?page=Roles_usuarioss_Roles_usuarios");
            });
        });
    </script>
<section class="bg-gray-100 p-4">
    <h1 class="text-2xl font-bold mb-4"> Descripcion roles {{modedsc}}</h1>
    
{{with roles}}

    <form class="my-4 bg-white p-8 rounded shadow-lg mx-auto max-w-md" action="index.php?page=Roless_Roles&mode={{~mode}}&rolescod={{id}}" method="POST"><input type="hidden" name="xss-token" value="{{~xss_token}}"/><section class="mb-4">
                <label for="rolescod" class="block text-gray-700 text-sm font-bold mb-2">rolescod</label>
                <input type="text" id="rolescod" name="rolescod" placeholder="rolescod de roles " value="{{rolescod}}" {{if ~readonly}} disabled readonly {{endif ~readonly}} class="w-full py-2 px-3 border border-gray-300 rounded focus:outline-none focus:border-blue-400"/>
                {{if rolescod_error}}<div class="text-red-500 text-sm">{{rolescod_error}}</div>{{endif rolescod_error}}
            </section><section class="mb-4">
                <label for="rolesdsc" class="block text-gray-700 text-sm font-bold mb-2">rolesdsc</label>
                <input type="text" id="rolesdsc" name="rolesdsc" placeholder="rolesdsc de roles " value="{{rolesdsc}}" {{if ~readonly}} disabled readonly {{endif ~readonly}} class="w-full py-2 px-3 border border-gray-300 rounded focus:outline-none focus:border-blue-400"/>
                {{if rolesdsc_error}}<div class="text-red-500 text-sm">{{rolesdsc_error}}</div>{{endif rolesdsc_error}}
            </section><section class="mb-4">
                <label for="rolesest" class="block text-gray-700 text-sm font-bold mb-2">rolesest</label>
                <input type="text" id="rolesest" name="rolesest" placeholder="rolesest de roles " value="{{rolesest}}" {{if ~readonly}} disabled readonly {{endif ~readonly}} class="w-full py-2 px-3 border border-gray-300 rounded focus:outline-none focus:border-blue-400"/>
                {{if rolesest_error}}<div class="text-red-500 text-sm">{{rolesest_error}}</div>{{endif rolesest_error}}
            </section><section class="col-12 right">
        {{if ~showConfirm}}
            <button type="submit" name="btnConfirm">Confirmar</button>&nbsp;
        {{endif ~showConfirm}}
        <button id="btnCancel">Cancelar</button>
        </section>
        </section></form></section>
{{endwith roles}}

<script>
        document.addEventListener("DOMContentLoaded", ()=>{
            document.getElementById("btnCancel").addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                document.location.assign("index.php?page=Roless_Roles");
            });
        });
    </script>
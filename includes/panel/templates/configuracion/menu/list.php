<script>
    angular.element(function () {

        scope.data=<?php echo json_encode($menu)?>;
scope.addSubitem=function (v) {
    vex.dialog.open({
        message: 'Agregando item de menú',
        input: [
            '<label  for="menu-name">Nombre</label>',
            '<input id="menu-name"  name="name" type="text" required />',
            '<label>Url (opcional)</label>',
            '<input  name="url" type="text"  />',
            '<label><input type="checkbox" name="submenu" checked> Permite submenú</label>'

        ].join(''),
        buttons: [
            $.extend({}, vex.dialog.buttons.YES, { text: 'Ok' }),
            $.extend({}, vex.dialog.buttons.NO, { text: 'Cancelar' })
        ],
        callback: function (data) {

            if(data)
            {

            }
        }

    });


}

        scope.save=function () {

            $.ajax(
                {
                    method:"post",
                    url:"<?php echo $configuracion->getSiteAddress()?>/admin/configuracion/menu/data.php?act=save",
                    data:{"sidenav":angular.copy(scope.data)},
                    dataType:"json",
                    success:function (e) {

                        toastr.success('', 'Menú guardado con éxito');
                        location.reload();
                    },
                    error:error
                    
                }
            );

        }
        scope.$apply();
    });

</script>


<header>
    <h2>Árbol de menú</h2>
</header>

<div class="body">
<!-- Nested node template -->
<script type="text/ng-template" id="nodes_renderer.html">
    <div class="seccion" ui-tree-handle>
        <span>{{v.text}}</span>
        <i data-ng-if="v.submenu"  data-nodrag  data-ng-click="addSubitem(v)" class="fa fa-plus-square-o icon add-seccion" aria-hidden="true"></i>
        <i  data-ng-if="v.delete"  data-nodrag data-ng-click="deleteSeccion(seccion)" data-ng-hide="checkPostsInside(seccion) || seccion.cantPosts > 0" class="fa fa-trash icon" aria-hidden="true"></i>
        <i data-ng-if="v.edit" data-nodrag data-ng-click="editSeccion(seccion)" class="fa fa-pencil icon" aria-hidden="true"></i>

    </div>
    <ul ui-tree-nodes="" data-ng-model="v.items">
        <li ng-repeat="(k,v) in v.items" ui-tree-node data-ng-include="'nodes_renderer.html'">
        </li>
    </ul>
</script>

<div class="secciones" ui-tree>
    <ul ui-tree-nodes="" data-ng-model="data" id="tree-root">
        <li  data-ng-repeat="(k,v) in data" ui-tree-node data-ng-include="'nodes_renderer.html'"></li>
    </ul>
</div>

<div class="fila center" style="margin-top: 25px">
    <button data-ng-click="save()" class="btn">
        Guardar Menú
    </button>
</div>

    </div>

<script>
    angular.element(function () {

        scope.secciones=<?php    echo json_encode($menu)?>;

        function saveMenu() {
            
        }

        scope.addItem=function () {

            vex.dialog.open({
                message: 'Agregando item de menú',
                input: [
                    '<label  for="menu-name">Nombre</label>',
                    '<input id="menu-name"  name="name" type="text" required />',
                    '<label>Url (opcional)</label>',
                    '<label><input type="checkbox" name="submenu" checked> Permite submenú</label>',
                    '<input  name="url" type="text"  />',
                    ,
                    '<div><h1>a</h1></div>'
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
        
        scope.$apply();
    });
</script>

<header>
    <h2>Menú</h2>
</header>
<script type="text/ng-template" id="categoryTree">
    <div class="seccion animated">

        <span>{{ seccion.text }}</span>
        <i data-ng-show="seccion.append" data-ng-click="addSubmenu(seccion)" class="fa fa-plus-square-o icon add-seccion" aria-hidden="true"></i>
        <i  data-ng-show="seccion.delete" class="fa fa-trash icon" aria-hidden="true"></i>
        <i data-ng-show="seccion.edit" class="fa fa-pencil icon" aria-hidden="true"></i>


    </div>
    <ul data-ng-if="seccion.items">
        <li  data-ng-repeat="(key,seccion)  in seccion.items" data-ng-include="'categoryTree'">

        </li>
    </ul>


</script>

<div class="body">
    <button data-ng-click="addItem()" class="btn" style="margin-bottom: 10px">Nuevo item</button>
    <!--<div class="info">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        <p>Si la sección contiene elementos, no se puede eliminar</p>
    </div>-->
    <ul class="secciones">
        <li data-posts="{{seccion.cantPosts}}" data-ng-repeat="(key,seccion) in secciones"  data-ng-include="'categoryTree'"></li>
    </ul>
    <h3 class="no-content" data-ng-if="secciones.length==0">No hay items de menu para mostrar</h3>
</div>

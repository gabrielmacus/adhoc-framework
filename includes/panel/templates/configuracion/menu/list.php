
<script>
    angular.element(function () {

        scope.secciones=<?php    echo json_encode($menu)?>;


        scope.addSubmenu=function (seccion) {

        }
        
        scope.$apply();
    });
</script>

<header>
    <h2><?php echo $lang["secciones"]?></h2>
</header>
<script type="text/ng-template" id="categoryTree">
    <div class="seccion animated">

        <span>{{ seccion.text }}</span>
        <i data-ng-click="addSubmenu(seccion)" class="fa fa-plus-square-o icon add-seccion" aria-hidden="true"></i>
        <i  data-ng-show="seccion.delete" class="fa fa-trash icon" aria-hidden="true"></i>
        <i data-ng-show="seccion.edit" class="fa fa-pencil icon" aria-hidden="true"></i>


    </div>
    <ul data-ng-if="seccion.items">
        <li  data-ng-repeat="(key,seccion)  in seccion.items" data-ng-include="'categoryTree'">

        </li>
    </ul>


</script>

<div class="body">
    <button data-ng-click="addSeccion()" class="btn" style="margin-bottom: 10px">Nueva sección</button>
    <!--<div class="info">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        <p>Si la sección contiene elementos, no se puede eliminar</p>
    </div>-->
    <ul class="secciones">
        <li data-posts="{{seccion.cantPosts}}" data-ng-repeat="(key,seccion) in secciones"  data-ng-include="'categoryTree'"></li>
    </ul>
    <h3 class="no-content" data-ng-if="secciones.length==0">No hay items de menu para mostrar</h3>
</div>

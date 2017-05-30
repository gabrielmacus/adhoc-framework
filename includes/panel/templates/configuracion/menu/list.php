<script>
    angular.element(function () {

        scope.data=<?php echo json_encode($menu)?>;

        scope.$apply();
    });

</script>


<header>
    <h2>Árbol de menú</h2>
</header>

<!-- Nested node template -->
<script type="text/ng-template" id="nodes_renderer.html">
    <div class="seccion" ui-tree-handle>
        <span>{{v.text}}</span>
        <i data-ng-click="addSubseccion(seccion.id)" class="fa fa-plus-square-o icon add-seccion" aria-hidden="true"></i>
        <i data-ng-click="deleteSeccion(seccion)" data-ng-hide="checkPostsInside(seccion) || seccion.cantPosts > 0" class="fa fa-trash icon" aria-hidden="true"></i>
        <i data-ng-click="editSeccion(seccion)" class="fa fa-pencil icon" aria-hidden="true"></i>

    </div>
    <ul ui-tree-nodes="" ng-model="v.items">
        <li ng-repeat="(k,v) in v.items" ui-tree-node ng-include="'nodes_renderer.html'">
        </li>
    </ul>
</script>

<div class="secciones" ui-tree>
    <ul ui-tree-nodes="" ng-model="data" id="tree-root">
        <li  ng-repeat="(k,v) in data" ui-tree-node ng-include="'nodes_renderer.html'"></li>
    </ul>
</div>

<div class="fila">
    <button class="btn">
        Guardar Menú
    </button>
</div>
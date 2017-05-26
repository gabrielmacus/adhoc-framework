<script>
    angular.element(function () {

        scope.data=<?php echo json_encode($menu)?>;

        scope.$apply();
    });

</script>



<!-- Nested node template -->
<script type="text/ng-template" id="nodes_renderer.html">
    <div class="seccion" ui-tree-handle>
        {{v.text}}
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

